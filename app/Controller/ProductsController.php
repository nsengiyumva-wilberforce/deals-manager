<?php

/**
 * Class for performing all product related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class ProductsController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('Product', 'ProductDeal', 'Deal', 'Request', 'ProductCategory', 'BrandCategory', 'UnitCategory', 'IssuanceCategory');

    /**
     * This controller uses following helpers
     *
     * @var array
     */
    var $helpers = array('Html', 'Form', 'Js', 'Paginator', 'Time');

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
        //check if admin or staff
        $this->checkAdminStaff();
    }

    /**
     * This function is used to display product home page
     *
     * @return array
     */
    public function index()
    {
        //check permissions
        $this->checkStaffPermission('31');

        //get all products
        $products = $this->Product->getAllProducts();

        //get approved Requests
        $approvedRequests = $this->Request->getApprovedRequests();

        //brand categories
        $brandCategories = $this->BrandCategory->getAllCategories();

        //units categories
        $unitCategories = $this->UnitCategory->getAllCategories();

        //product categories
        $productCategories = $this->ProductCategory->getAllCategories();

        //issuance categorries
        $issuanceCategories = $this->IssuanceCategory->getAllIssuancesArr();

        //set product variable for view
        $this->set(compact('products', 'approvedRequests', 'brandCategories', 'unitCategories', 'productCategories', 'issuanceCategories'));
    }

    /**
     * This function is used to add product 
     *
     * @return void
     */
    public function add()
    {
        // autorender off for view
        $this->autoRender = false;
        //check permissions
        $this->checkStaffPermission('32');
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->Product->create();
            //save product
            if ($this->Product->save($this->request->data)) {
                //success message
                $this->Flash->success(__('Request has been completed.'), array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success(__('Request has been not completed.'), array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
            return $this->redirect(
                array('controller' => 'products', 'action' => 'index')
            );
        }
    }

    /**
     * It is used to edit product
     *
     * @return json
     */
    public function edit()
    {
        // autorender off for view
        $this->autoRender = false;
        //check permissions
        $this->checkStaffPermission('33');
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            //--------- Ajax request  -----------
            if ($this->RequestHandler->isAjax()) {
                $this->layout = 'ajax';
                //common variables
                $field = $this->request->data['name'];
                $this->request->data['Product']['id'] = $this->request->data['pk'];
                if ($field == 'name') {
                    $this->request->data['Product']['name'] = $this->request->data['value'];
                } else if ($field == 'price') {
                    $this->request->data['Product']['price'] = $this->request->data['value'];
                } else if ($field == 'sku') {
                    $this->request->data['Product']['sku'] = $this->request->data['value'];
                } else if ($field == 'brand') {
                    $this->request->data['Product']['brand'] = $this->request->data['value'];
                } else if ($field == 'category') {
                    $this->request->data['Product']['category'] = $this->request->data['value'];
                } else if ($field == 'unit') {
                    $this->request->data['Product']['unit'] = $this->request->data['value'];
                }
                //save product
                $success = $this->Product->save($this->request->data);
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
     * This function is used to delete product
     *
     * @return json
     */
    public function delete()
    {
        // autorender off for view
        $this->autoRender = false;
        //check permissions
        $this->checkStaffPermission('34');
        $productId = $this->request->data['Product']['id'];

        //if product id exist
        if (!empty($productId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete product
                $success = $this->Product->delete($productId, false);
                if ($success) {
                    //delete assign product to deals
                    $this->ProductDeal->deleteAll(array('ProductDeal.product_id' => $productId));
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
     * This function is used to search product in deal view page
     *
     * @return json
     */
    public function search()
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $results = array();
            if (isset($_GET['name'])) {
                $name = $_GET['name'];
                //get all product like search keyword
                $results = $this->Product->find('all', array('conditions' => array('Product.name LIKE' => '%' . $name . '%'), 'fields' => array('Product.name,Product.id')));
            }
            foreach ($results as $row) {
                $arr[] = array('id' => $row['Product']['id'], 'name' => $row['Product']['name']);
            }
            //return json product names
            echo json_encode($arr);
        }
    }

    /**
     * This function is used to add product in deal from deal view page after search
     *
     * @return json
     */
    public function deal()
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $productId = $this->request->data['itemId'];
            $dealId = $this->request->data['dealId'];
            if (!empty($productId)) {
                //check if product assign to deal
                $result = $this->ProductDeal->getProductDeal($dealId, $productId);
                if ($result) {
                    //return json failure message
                    $response = array('bug' => 1, 'msg' => 'failure');
                    return json_encode($response);
                } else {
                    $this->ProductDeal->create();
                    //common variables
                    $this->request->data['ProductDeal']['product_id'] = $productId;
                    $this->request->data['ProductDeal']['deal_id'] = $dealId;
                    $product = $this->Product->getProductPrice($productId);
                    $this->request->data['ProductDeal']['price'] = $product['Product']['price'];
                    $ProductDeal = $this->ProductDeal->getDealProduct($dealId);
                    //assign product to deal
                    if ($this->ProductDeal->save($this->request->data)) {
                        //update deal price
                        if ($ProductDeal) {
                            $deal = $this->Deal->getDealPrice($dealId);
                            $this->Deal->id = $dealId;
                            $price = $product['Product']['price'] + $deal['Deal']['price'];
                            $this->Deal->saveField('price', $price);
                        } else {
                            $this->Deal->id = $dealId;
                            $this->Deal->saveField('price', $this->request->data['ProductDeal']['price']);
                        }
                        //get product
                        $product = $this->Product->getProductsForDeal($productId);
                        //activity for assign product
                        $this->activity($dealId, $product['Product']['name'], 'add_Product');

                        //set variable to view
                        $this->set(compact('product'));
                        $data = $this->render('/Elements/deal-data');
                        $arrays = array('module' => 1, 'html' => $data->body());
                        return new CakeResponse(array('type' => 'json', 'body' => json_encode($arrays)));
                    }
                }
            }
        }
    }

    /**
     * This function is used to delete product from deal in deal view page
     *
     * @return void
     */
    public function unlink()
    {
        // autorender off for view
        $this->autoRender = false;
        //common variables
        $productId = $this->request->data['Item']['id'];
        $dealId = $this->request->data['Deal']['id'];

        //if product id exist
        if (!empty($productId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete product from deal
                $success = $this->ProductDeal->deleteAll(array('deal_id' => $dealId, 'product_id' => $productId), true);
                if ($success) {
                    $product = $this->Product->getProductById($productId);
                    //activity for delete product from deal
                    $this->activity($dealId, $product['Product']['name'], 'unlink_Product');
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
     * This function is used to display product details page
     *
     * @return array
     */
    public function view($id = null)
    {
        $userId = ($this->checkAdmin()) ? '' : $this->Auth->user('id');
        $userGId = $this->Auth->user('user_group_id');
        $groupId = $this->Auth->user('group_id');
        //get product
        $Product = $this->Product->getProductById($id);
        //get deals in product
        $deals = $this->Deal->getDealsByProduct($id, $userId, $userGId, $groupId);
        //set variables for view
        $this->set(compact('Product', 'deals'));
    }

    /**
     * This function is used to update product discount and price
     *
     * @return void
     */
    public function discount()
    {
        $id = $this->request->data['ProductDeal']['id'];
        $ProductDeal = $this->ProductDeal->getProductD($id);
        //get product
        $product = $this->Product->getProductById($ProductDeal['ProductDeal']['product_id']);
        //common variables
        $price = $product['Product']['price'];
        $quantity = $this->request->data['ProductDeal']['quantity'];
        $discount = $this->request->data['ProductDeal']['discount'];
        $this->request->data['ProductDeal']['price'] = $quantity * $price * (1 - $discount / 100);
        if ($id) {
            $this->ProductDeal->save($this->request->data);
            //get all assign product to deal
            $allProductDeal = $this->ProductDeal->getAllProductDeal($ProductDeal['ProductDeal']['deal_id']);
            $p = 0;
            foreach ($allProductDeal as $row):
                $p += $row['ProductDeal']['price'];
            endforeach;
            $this->Deal->id = $ProductDeal['ProductDeal']['deal_id'];
            //update deal price
            $this->Deal->saveField('price', $p);
            //activity for update product
            $this->activity($ProductDeal['ProductDeal']['deal_id'], $product['Product']['name'], 'update_Product');
            //success message
            $this->Session->setFlash('Request has been completed.', 'default', array('class' => 'alert alert-info'), 'success');
        } else {
            //failure message
            $this->Session->setFlash('Request has been not completed.', 'default', array('class' => 'alert alert-danger'), 'fail');
        }
        //redirect to deal view
        return $this->redirect(
            array('controller' => 'deals', 'action' => 'view', $ProductDeal['ProductDeal']['deal_id'])
        );
    }

    public function request_item()
    {
        // autorender off for view
        $this->autoRender = false;
        //check permissions
        // $this->checkStaffPermission('32');
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->Request->create();
            $this->request->data['Request']['return_date'] = ($this->request->data['Request']['return_date']) ? date('Y-m-d', strtotime($this->request->data['Request']['return_date'])) : null;
            $this->request->data['Request']['requester_id'] = $this->Auth->user('id');
            //save product
            if ($this->Request->save($this->request->data)) {
                //success message
                $this->Flash->success(__('Request has been completed.'), array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success(__('Request has been not completed.'), array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
            return $this->redirect(
                array('controller' => 'products', 'action' => 'index')
            );
        }
    }

    public function view_requested_items()
    {
        //check permissions
        $this->checkStaffPermission('31');

        //get all products
        $requests = $this->Request->getAllRequests();

        //set product variable for view
        $this->set(compact('requests'));
    }

    public function approve_request($requestId)
    {
        // autorender off for view
        $this->autoRender = false;
        //check permissions
        $this->checkStaffPermission('31');

        $approval = $this->Request->approveRequest($requestId);

        if ($approval) {
            //success message
            $this->Flash->success(__('Request has been approved.'), array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
        } else {
            $this->Flash->success(__('Request has been not completed.'), array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
        }
        return $this->redirect(
            array('controller' => 'products', 'action' => 'view_requested_items')
        );
    }

    /**
     * This Function is used to add new category  from setting.
     *
     * @return void
     */
    public function add_brand_category()
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->BrandCategory->create();
            //save ticket type
            if ($this->BrandCategory->save($this->request->data)) {
                //success message
                $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
            //redirect to settings page
            return $this->redirect(
                array('controller' => 'settings', 'action' => 'brand_categories')
            );
        }
    }
    /**
     * This Function is used to add new category  from setting.
     *
     * @return void
     */
    public function add_product_category()
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->ProductCategory->create();
            //save ticket type
            if ($this->ProductCategory->save($this->request->data)) {
                //success message
                $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
            //redirect to settings page
            return $this->redirect(
                array('controller' => 'settings', 'action' => 'product_categories')
            );
        }
    }

        /**
     * This Function is used to add new category  from setting.
     *
     * @return void
     */
    public function add_issuance_category()
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->IssuanceCategory->create();
            //save ticket type
            if ($this->IssuanceCategory->save($this->request->data)) {
                //success message
                $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
            //redirect to settings page
            return $this->redirect(
                array('controller' => 'settings', 'action' => 'issuance_categories')
            );
        }
    }

    /**
     * This Function is used to add new category  from setting.
     *
     * @return void
     */
    public function add_unit_category()
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->UnitCategory->create();
            //save ticket type
            if ($this->UnitCategory->save($this->request->data)) {
                //success message
                $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
            //redirect to settings page
            return $this->redirect(
                array('controller' => 'settings', 'action' => 'unit_categories')
            );
        }
    }

    /**
     * This Function is used to delete category from settings.
     *
     * @return json
     */
    public function remove_category()
    {
        // autorender off for view
        $this->autoRender = false;
        $catId = $this->request->data['ProductCategory']['id'];
        if (!empty($catId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete ticket
                $success = $this->ProductCategory->delete($catId, false);
                if ($success) {
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $catId);
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
     * This Function is used to delete brand from settings.
     *
     * @return json
     */
    public function remove_brand()
    {
        // autorender off for view
        $this->autoRender = false;
        $catId = $this->request->data['BrandCategory']['id'];
        if (!empty($catId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete ticket
                $success = $this->BrandCategory->delete($catId, false);
                if ($success) {
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $catId);
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
     * This Function is used to delete unit from settings.
     *
     * @return json
     */
    public function remove_unit()
    {
        // autorender off for view
        $this->autoRender = false;
        $catId = $this->request->data['UnitCategory']['id'];
        if (!empty($catId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete ticket
                $success = $this->UnitCategory->delete($catId, false);
                if ($success) {
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $catId);
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
     * This Function is used to delete issuance from settings.
     *
     * @return json
     */
    public function remove_issuance()
    {
        // autorender off for view
        $this->autoRender = false;
        $catId = $this->request->data['IssuanceCategory']['id'];
        if (!empty($catId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete ticket
                $success = $this->IssuanceCategory->delete($catId, false);
                if ($success) {
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $catId);
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

/* End of file ProductsController.php */
/* Location: ./app/Controller/ProductsController.php */