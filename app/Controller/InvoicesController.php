<?php

/**
 * Class for performing all invoice related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class InvoicesController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('Invoice', 'Deal', 'Company', 'Product', 'InvoiceProduct', 'Tax', 'Payment', 'SettingCompany', 'PaymentMethod', 'Setting', 'User');

    /**
     * This controller uses following helpers
     *
     * @var array
     */
    var $helpers = array('Html', 'Form', 'Js', 'Paginator', 'Time', 'Number');

    /**
     * This controller uses following components
     *
     * @var array
     */
    var $components = array('Auth', 'Cookie', 'Session', 'Paginator', 'RequestHandler', 'Flash');

    /**
     * Called before the controller action.  You can use this method to configure and customize components
     * or perform logic that needs to happen before each controller action.
     *
     * @return void
     */
    public function beforeFilter()
    {
        parent::beforeFilter();
        //check if login
        $this->checkLogin();
        //set layout
        $this->layout = 'admin';
    }

    /**
     * This function is used to display invoices list
     *
     * @return array
     */
    public function index()
    {
        //get user group type
        $userGId = $this->Auth->user('user_group_id');
        $conditions = array();
        //pagination conditions
        $options[] = array(
            'alias' => 'Company',
            'table' => 'company',
            'type' => 'LEFT',
            'conditions' => 'Company.id = Invoice.client_id'
        );
        $options[] = array(
            'alias' => 'Deal',
            'table' => 'deal',
            'type' => 'LEFT',
            'conditions' => 'Deal.id = Invoice.deal_id'
        );
        if ($userGId == 2 || $userGId == 3) {
            $gId = $this->Auth->user('group_id');
            $company = $this->Company->find('list', array('conditions' => array('FIND_IN_SET(\'' . $gId . '\',Company.groups)'), 'fields' => array('Company.id')));
            $conditions['Invoice.client_id'] = $company;
        } elseif ($userGId == 4) {
            $companyId = $this->Auth->user('company_id');
            $conditions['Invoice.client_id'] = $companyId;
        }
        $this->paginate = array(
            'joins' => $options,
            'conditions' => $conditions,
            'limit' => 25,
            'order' => 'Invoice.id desc',
            'fields' => array('Invoice.id', 'Invoice.custom_id', 'Invoice.issue_date', 'Invoice.due_date', 'Invoice.amount', 'Invoice.currency', 'Invoice.status', 'Company.id', 'Company.name', 'Deal.name', 'Deal.id')
        );
        $invoices = $this->paginate('Invoice');
        //get companies
        if ($userGId == 1) {
            $companies = $this->Company->getCompanyList();
        } else {
            $companies = $this->Company->getCompaniesByGroup($gId);
        }
        if ($userGId == 1 || $userGId == 2) {
            $deals = $this->Deal->getAllActiveDeals($gId);
        } else {
            $deals = $this->Deal->getDealsByUser($this->Auth->user('id'));
        }
        //get all taxes
        $taxes = $this->Tax->getAllTaxsList();
        //get last invoice id
        $lastInvoice = $this->Invoice->getLastInvoice();
        $customId = $lastInvoice[0]['Invoice']['custom_id'];
        $lastId = sprintf("%03d", $customId + 1);

        //set invoice variable for view
        $this->set(compact('invoices', 'companies', 'deals', 'taxes', 'lastId'));

        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $this->render('/Elements/invoices');
        }
    }

    /**
     * This function is used to add invoice 
     *
     * @return void
     */
    public function add()
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Post request  -----------
        if ($this->request->is('post')) {

            $this->Invoice->create();
            $this->request->data['Invoice']['issue_date'] = date('Y-m-d', strtotime($this->request->data['Invoice']['issue_date']));
            $this->request->data['Invoice']['due_date'] = date('Y-m-d', strtotime($this->request->data['Invoice']['due_date']));
            if (empty($this->request->data['Invoice']['discount'])):
                $this->request->data['Invoice']['discount'] = 0;
            endif;

            //save product
            if ($this->Invoice->save($this->request->data)) {
                $invoiceID = $this->Invoice->getInsertID();
                //success message
                $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
            return $this->redirect(
                    array('controller' => 'invoices', 'action' => 'view', $invoiceID)
            );
        }
    }

    /**
     * This function is used to edit invoice 
     *
     * @return json
     */
    public function edit()
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $invoiceID = $this->request->data['Invoice']['id'];
            if ($invoiceID) {
                $this->request->data['Invoice']['issue_date'] = date('Y-m-d', strtotime($this->request->data['Invoice']['issue_date']));
                $this->request->data['Invoice']['due_date'] = date('Y-m-d', strtotime($this->request->data['Invoice']['due_date']));

                //save Invoice
                if ($this->Invoice->save($this->request->data)) {
                    //success message
                    $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
                } else {
                    //failure message
                    $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
                }
            }
            return $this->redirect(
                    array('controller' => 'invoices', 'action' => 'view', $invoiceID)
            );
        }
    }

    /**
     * This function is used to delete invoice
     *
     * @return json
     */
    public function delete()
    {
        // autorender off for view
        $this->autoRender = false;
        $invoiceId = $this->request->data['Invoice']['id'];

        //if invoice id exist
        if (!empty($invoiceId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete product
                $success = $this->Invoice->delete($invoiceId, false);
                if ($success) {
                    //delete assign product to deals
                    $this->InvoiceProduct->deleteAll(array('InvoiceProduct.invoice_id' => $invoiceId));
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $invoiceId);
                    return json_encode($response);
                } else {
                    //return json failure message
                    $response = array('bug' => 1, 'msg' => 'failure');
                    return json_encode($response);
                }
            }
        }
    }

    /**
     * This function is used to view invoice
     *
     * @return array
     */
    public function view($id = null)
    {
        //get user group type
        $userGId = $this->Auth->user('user_group_id');
        if ($userGId == 2 || $userGId == 3) {
            $groupId = $this->Auth->user('group_id');
        }
        //get invoice
        $Invoice = $this->Invoice->getInvoiceById($id);
        //get deals in product
        $products = $this->Product->getAllProduct();
        //
        $invoiceProducts = $this->InvoiceProduct->getAllProductInvoice($id);
        //
        //get companies
        if ($userGId == 1) {
            $companies = $this->Company->getCompanyList();
        } else {
            $companies = $this->Company->getCompaniesByGroup($groupId);
        }
        // get active deals
        if ($userGId == 1 || $userGId == 2) {
            $deals = $this->Deal->getAllActiveDeals($gId);
        } else {
            $deals = $this->Deal->getDealsByUser($this->Auth->user('id'));
        }
        $payments = $this->Payment->getPaymentsByInvoice($id);
        //get company 
        $CompanyAdmin = $this->SettingCompany->findById('1');
        $Company = $this->Company->getCompanyById($Invoice['Invoice']['client_id']);
        //get payment methods
        $methods = $this->PaymentMethod->getMethodsInvoice();
        $taxes = $this->Tax->find('all', array('fields' => array('Tax.*'), 'order' => array('Tax.id ASC')));
        //set variables for view
        $this->set(compact('Invoice', 'products', 'invoiceProducts', 'companies', 'deals', 'payments', 'CompanyAdmin', 'Company', 'methods', 'taxes'));
    }

    /**
     * This function is used to add product in invoice 
     *
     * @return void
     */
    public function add_product()
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->InvoiceProduct->create();

            if (empty($this->request->data['InvoiceProduct']['product_quantity'])) :
                $this->request->data['InvoiceProduct']['product_quantity'] = 1;
            endif;
            //get product
            $product = $this->Product->getProductById($this->request->data['InvoiceProduct']['product_id']);
            $this->request->data['InvoiceProduct']['invoice_id'] = $this->request->data['Invoice']['id'];
            $this->request->data['InvoiceProduct']['product_name'] = $product['Product']['name'];
            $this->request->data['InvoiceProduct']['product_unit_price'] = $product['Product']['price'];
            $this->request->data['InvoiceProduct']['product_total'] = $this->request->data['InvoiceProduct']['product_unit_price'] * $this->request->data['InvoiceProduct']['product_quantity'];

            //save product
            if ($this->InvoiceProduct->save($this->request->data)) {
                //get invoice                 
                $Invoice = $this->Invoice->getInvoiceAddProduct($this->request->data['Invoice']['id']);
                $products = $this->InvoiceProduct->getAllProductSum($this->request->data['InvoiceProduct']['invoice_id']);
                $sum = $products[0][0]['total'];
                $sum = $sum - $Invoice['Invoice']['discount'];
                $tax = $Invoice['Invoice']['custom_tax'] / 100 * $sum;
                $amount = $sum + $tax;
                //save amount in invoice        
                $this->Invoice->id = $this->request->data['Invoice']['id'];

                $this->Invoice->saveField("amount", $amount);

                $payments = $this->Payment->getAllPaymentSum($this->request->data['Invoice']['id']);
                $sumP = $payments[0][0]['total'];
                if ($amount > $sumP):
                    $status = 2;
                elseif ($amount <= $sumP):
                    $status = 3;
                endif;
                $this->Invoice->id = $this->request->data['Invoice']['id'];
                $this->Invoice->saveField("status", $status);

                //success message
                $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
            return $this->redirect(
                    array('controller' => 'invoices', 'action' => 'view', $this->request->data['Invoice']['id'])
            );
        }
    }

    /**
     * This function is used to delete product in invoice
     *
     * @return json
     */
    public function delete_product()
    {
        // autorender off for view
        $this->autoRender = false;
        $productId = $this->request->data['InvoiceProduct']['id'];
        $product = $this->InvoiceProduct->find('first', array('conditions' => array('InvoiceProduct.id' => $productId), 'fields' => array('InvoiceProduct.invoice_id', 'InvoiceProduct.product_total')));
        //if product id exist
        if (!empty($productId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete product
                $success = $this->InvoiceProduct->delete($productId, false);
                if ($success) {

                    $invoice = $this->Invoice->find('first', array('conditions' => array('Invoice.id' => $product['InvoiceProduct']['invoice_id']), 'fields' => array('Invoice.amount')));
                    $amount = $invoice['Invoice']['amount'] - $product['InvoiceProduct']['product_total'];
                    $this->Invoice->id = $product['InvoiceProduct']['invoice_id'];
                    $this->Invoice->saveField("amount", $amount);

                    $payments = $this->Payment->getAllPaymentSum($product['InvoiceProduct']['invoice_id']);
                    $sumP = $payments[0][0]['total'];
                    if ($amount > $sumP):
                        $status = 2;
                    elseif ($amount <= $sumP):
                        $status = 3;
                    endif;
                    $this->Invoice->id = $product['InvoiceProduct']['invoice_id'];
                    $this->Invoice->saveField("status", $status);
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $productId);
                    return json_encode($response);
                } else {
                    //return json failure message
                    $response = array('bug' => 1, 'msg' => 'failure');
                    return json_encode($response);
                }
            }
        }
    }

    /**
     * This function is used to update task load modal
     *
     * @return array
     */
    public function update_product($id = null)
    {
        $this->autoRender = false;
        //--------- Post/Ajax request  -----------
        if ($this->request->is('post')) {

            //autorender off for view
            $this->autoRender = false;
            $this->request->data['InvoiceProduct']['product_total'] = $this->request->data['InvoiceProduct']['product_unit_price'] * $this->request->data['InvoiceProduct']['product_quantity'];
            //save Invoice
            $success = $this->InvoiceProduct->save($this->request->data);
            if ($success) {
                $Invoice = $this->Invoice->getInvoiceAddProduct($this->request->data['InvoiceProduct']['invoice_id']);
                $products = $this->InvoiceProduct->getAllProductSum($this->request->data['InvoiceProduct']['invoice_id']);
                $sum = $products[0][0]['total'];
                $sum = $sum - $Invoice['Invoice']['discount'];
                $tax = $Invoice['Invoice']['custom_tax'] / 100 * $sum;
                $amount = $sum + $tax;
                $this->Invoice->id = $this->request->data['InvoiceProduct']['invoice_id'];
                $this->Invoice->saveField("amount", $amount);

                $payments = $this->Payment->getAllPaymentSum($this->request->data['InvoiceProduct']['invoice_id']);
                $sumP = $payments[0][0]['total'];
                if ($amount > $sumP):
                    $status = 2;
                elseif ($amount <= $sumP):
                    $status = 3;
                endif;
                $this->Invoice->id = $this->request->data['InvoiceProduct']['invoice_id'];
                $this->Invoice->saveField("status", $status);
            }
            return $this->redirect(
                    array('controller' => 'invoices', 'action' => 'view', $this->request->data['InvoiceProduct']['invoice_id'])
            );
        }
        $this->request->data = $this->InvoiceProduct->getProductInvoice($id);
        $product = 1;
        $this->set(compact('product'));
        $this->render('/Elements/modal');
    }

    /**
     * This function is used to create invoice pdf
     *
     * @return json
     */
    public function view_pdf($id)
    {

        ob_start();

        $this->layout = false;
        //get company 
        $CompanyAdmin = $this->SettingCompany->findById('1');
        $Invoice = $this->Invoice->find('first', array('conditions' => array('Invoice.id' => $id)));
        $Company = $this->Company->getCompanyById($Invoice['Invoice']['client_id']);
        $payments = $this->Payment->getPaymentsByInvoice($id);
        $settings = $this->Setting->getSettings();
        $invoiceId = "INV" . sprintf("%04d", $Invoice['Invoice']['custom_id']) . '.pdf';
        //get invoices products
        $invoiceProducts = $this->InvoiceProduct->getAllProductInvoice($id);

        $this->set(compact('Invoice', 'products', 'invoiceProducts', 'CompanyAdmin', 'Company', 'payments', 'settings'));

        $view = new View($this, false);
        $output = $view->render('view_pdf');


        App::import('Vendor', 'xtcpdf');
        $pdf = new XTCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetTitle('Invoice');
        $pdf->SetSubject('Invoice Receipt');
        $pdf->SetKeywords('Invoice');
        // remove default header/footer
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, false, PDF_MARGIN_RIGHT);
        $pdf->AddPage();
        $pdf->writeHTML($output, true, false, true, false, '');
        $pdf->Output($invoiceId, 'D');
    }

    /**
     * This function is used to create invoice pdf perview
     *
     * @return json
     */
    public function perview($id)
    {
        //get company 
        $CompanyAdmin = $this->SettingCompany->findById('1');
        $Invoice = $this->Invoice->find('first', array('conditions' => array('Invoice.id' => $id)));
        $Company = $this->Company->getCompanyById($Invoice['Invoice']['client_id']);
        $payments = $this->Payment->getPaymentsByInvoice($id);
        $settings = $this->Setting->getSettings();
        //get invoices products
        $invoiceProducts = $this->InvoiceProduct->getAllProductInvoice($id);
        $this->set(compact('Invoice', 'products', 'invoiceProducts', 'CompanyAdmin', 'Company', 'payments', 'settings'));
    }

    /**
     * This function is used to view tax rates list & add tax rate
     *
     * @return array
     */
    public function tax()
    {
        //check if admin
        $this->isAdmin();
        //get all taxs
        $taxes = $this->Tax->getAllTaxs();
        //set tax variable for view
        $this->set(compact('taxes'));
        if ($this->request->isPost()) {
            $this->Tax->save($this->request->data);
            return $this->redirect(
                    array('controller' => 'invoices', 'action' => 'tax')
            );
        }
    }

    /**
     * This function is used to delete tax rate
     *
     * @return json
     */
    public function delete_tax()
    {
        // autorender off for view
        $this->autoRender = false;
        $taxId = $this->request->data['Tax']['id'];

        //if tax id exist
        if (!empty($taxId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete tax
                $success = $this->Tax->delete($taxId, false);
                if ($success) {
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $taxId);
                    return json_encode($response);
                } else {
                    //return json failure message
                    $response = array('bug' => 1, 'msg' => 'failure');
                    return json_encode($response);
                }
            }
        }
    }

    /**
     * It is used to edit tax rate
     *
     * @return json
     */
    public function edit_tax()
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            //--------- Ajax request  -----------
            if ($this->RequestHandler->isAjax()) {
                $this->layout = 'ajax';
                //common variables
                $field = $this->request->data['name'];
                $this->request->data['Tax']['id'] = $this->request->data['pk'];
                if ($field == 'name') {
                    $this->request->data['Tax']['name'] = $this->request->data['value'];
                } else {
                    $this->request->data['Tax']['rate'] = $this->request->data['value'];
                }
                //save tax
                $success = $this->Tax->save($this->request->data);
                if ($success) {
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success');
                    return json_encode($response);
                } else {
                    //return json failure message
                    $response = array('bug' => 1, 'msg' => 'failure');
                    return json_encode($response);
                }
            }
        }
    }

    /**
     * This function is used to list payments & add payment in invoice
     *
     * @return json
     */
    public function payments()
    {
        //--------- Post request  -----------
        if ($this->request->isPost()) {
            $this->Payment->create();
            $this->request->data['Payment']['invoice_id'] = $this->request->data['Invoice']['id'];
            $this->request->data['Payment']['payment_date'] = date('Y-m-d', strtotime($this->request->data['Payment']['payment_date']));
            $this->request->data['Payment']['user_id'] = $this->Auth->user('id');

            //save product
            if ($this->Payment->save($this->request->data)) {
                $Invoice = $this->Invoice->getInvoiceAddProduct($this->request->data['Payment']['invoice_id']);
                $payments = $this->Payment->getAllPaymentSum($this->request->data['Payment']['invoice_id']);
                $sum = $payments[0][0]['total'];
                $amount = $Invoice['Invoice']['amount'];
                if ($sum == 0):
                    $status = 1;
                elseif ($amount > $sum):
                    $status = 2;
                elseif ($amount <= $sum):
                    $status = 3;
                endif;
                $this->Invoice->id = $this->request->data['Payment']['invoice_id'];
                $this->Invoice->saveField("status", $status);
                //success message
                $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
            return $this->redirect(
                    array('controller' => 'invoices', 'action' => 'view', $this->request->data['Invoice']['id'])
            );
        } else {
            //check if admin
            $this->isAdmin();
            //get all payments     
            $payments = $this->Payment->getAllPayments();
        }

        //set payments variable for view
        $this->set(compact('payments'));


        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $this->render('/Elements/payments');
        }
    }

    /**
     * This function is used to update task load modal
     *
     * @return array
     */
    public function update_payments($id = null)
    {
        $this->autoRender = false;
        //--------- Post/Ajax request  -----------
        if ($this->request->is('post')) {
            //autorender off for view
            $this->autoRender = false;
            $this->request->data['Payment']['payment_date'] = date('Y-m-d', strtotime($this->request->data['Payment']['payment_date']));
            $success = $this->Payment->save($this->request->data);
            if ($success) {
                $Invoice = $this->Invoice->getInvoiceAddProduct($this->request->data['Payment']['invoice_id']);
                $payments = $this->Payment->getAllPaymentSum($this->request->data['Payment']['invoice_id']);
                $sum = $payments[0][0]['total'];
                $amount = $Invoice['Invoice']['amount'];
                if ($sum == 0):
                    $status = 1;
                elseif ($amount > $sum):
                    $status = 2;
                elseif ($amount <= $sum):
                    $status = 3;
                endif;
                $this->Invoice->id = $this->request->data['Payment']['invoice_id'];
                $this->Invoice->saveField("status", $status);
            }
            //redirect
            return $this->redirect(
                    array('controller' => 'invoices', 'action' => 'view', $this->request->data['Payment']['invoice_id'])
            );
        }
        //get payment methods
        $methods = $this->PaymentMethod->getMethodsInvoice();
        $this->request->data = $this->Payment->find('first', array('conditions' => array('Payment.id' => $id)));
        $payment = 1;
        $this->set(compact('payment', 'methods'));
        $this->render('/Elements/modal');
    }

    /**
     * This function is used to delete invoice payment
     *
     * @return json
     */
    public function delete_payment()
    {
        // autorender off for view
        $this->autoRender = false;
        $paymentId = $this->request->data['Payment']['id'];

        //if product id exist
        if (!empty($paymentId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                $payment = $this->Payment->getPayment($paymentId);
                //delete product
                $success = $this->Payment->delete($paymentId, false);
                if ($success) {
                    $Invoice = $this->Invoice->getInvoiceAddProduct($payment['Payment']['invoice_id']);
                    $payments = $this->Payment->getAllPaymentSum($payment['Payment']['invoice_id']);
                    $sum = $payments[0][0]['total'];
                    $this->Invoice->id = $payment['Payment']['invoice_id'];
                    $amount = $Invoice['Invoice']['amount'];
                    if ($sum == 0):
                        $status = 1;
                    elseif ($amount > $sum):
                        $status = 2;
                    elseif ($amount <= $sum):
                        $status = 3;
                    endif;
                    $this->Invoice->saveField("status", $status);
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success');
                    return json_encode($response);
                } else {
                    //return json failure message
                    $response = array('bug' => 1, 'msg' => 'failure');
                    return json_encode($response);
                }
            }
        }
    }
}

/* End of file InvoicesController.php */
/* Location: ./app/Controller/InvoicesController.php */