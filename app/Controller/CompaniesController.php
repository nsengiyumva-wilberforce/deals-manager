<?php

/**
 * Class for performing all company related functions
 * 
 * @author:   AnkkSoft.com
 * Copyright: AnkkSoft 2020
 * Website:   https://www.ankksoft.com
 * CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class CompaniesController extends AppController
{

    /**
     * This controller use following model
     *
     * @var array
     */
    public $uses = array('Company', 'Contact', 'Custom', 'CustomCompany', 'User', 'Invoice', 'Deal', 'UserGroup');

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
    var $components = array('Auth', 'Cookie', 'Session', 'Paginator', 'RequestHandler');

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
        $this->isAdminManager();
    }

    /**
     * This function is used to display company home page, all companies list
     *
     * @return void
     */
    public function index($letter = null)
    {
        //check permissions
        $this->checkStaffPermission('21');

        $limit = 15;
        //pagination conditions
        if ($letter) {
            $conditions['Company.name LIKE'] = $letter . '%';
        } else {
            $conditions = null;
        }
        if ($this->checkManagerStaff()):
            $conditions[] = 'FIND_IN_SET(\'' . $this->Auth->user('group_id') . '\',Company.groups)';
        endif;
        //pagination condtions
        $this->paginate = array('conditions' => $conditions, 'limit' => $limit, 'order' => 'Company.name asc');
        $companies = $this->paginate('Company');

        foreach ($companies as &$row):
            $row['Users'] = $this->User->find('all', array('conditions' => array('User.company_id' => $row['Company']['id'], 'User.user_group_id' => 4), 'fields' => array('User.name', 'User.picture'))); //get assign user to deal      
            $row['contacts'] = $this->Contact->find('count', array('conditions' => array('Contact.company_id' => $row['Company']['id'])));
            $row['deals'] = $this->Deal->find('count', array('conditions' => array('Deal.company_id' => $row['Company']['id'], 'Deal.status' => 0)));
            $row['invoices'] = $this->Invoice->find('count', array('conditions' => array('Invoice.client_id' => $row['Company']['id'])));
        endforeach;
        //count total contacts
        $countCompanies = $this->Company->find('count', array('conditions' => $conditions));
        $total_pages = ceil($countCompanies / $limit);

        //get all company custom fields
        $custom = $this->Custom->getCompanyFields();
        //get groups
        if ($this->checkAdmin()):
            $groups = $this->UserGroup->getGroupList();
        endif;
        //set companies variable to view
        $this->set(compact('companies', 'custom', 'total_pages', 'letter', 'groups'));

        //--------- Ajax request for getting companies -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $data = $this->render('/Elements/company');
            $arrays = array('total' => $total_pages, 'letter' => $letter, 'html' => $data->body());
            return new CakeResponse(array('type' => 'json', 'body' => json_encode($arrays)));
        }
    }

    /**
     * This function is used to add new company
     *
     * @return void
     */
    public function add()
    {
        // autorender off for view
        $this->autoRender = false;
        //check permissions
        $this->checkStaffPermission('22');

        //--------- Post request  -----------
        if ($this->request->is('post')) {

            $this->Company->create();
            //save groups
            if (is_array($this->request->data['Company']['groups'])):
                $this->request->data['Company']['groups'] = implode(",", $this->request->data['Company']['groups']);
            endif;

            //save new company
            if ($this->Company->save($this->request->data)) {

                //get company id
                $companyId = $this->Company->getLastInsertId();

                //custom fields
                $custom = $this->Custom->getCompanyFieldsId();
                foreach ($custom as $row):
                    $this->CustomCompany->create();
                    $this->request->data['CustomCompany']['custom_id'] = $row['Custom']['id'];
                    $this->request->data['CustomCompany']['company_id'] = $companyId;
                    $this->request->data['CustomCompany']['value'] = $this->request->data['Custom']['value' . $row['Custom']['id']];
                    $this->CustomCompany->save($this->request->data);
                endforeach;
                //success message
                $this->Session->setFlash(__('Request has been completed.'), 'default', array('class' => 'alert alert-info'), 'success');
            } else {
                //failure message
                $this->Session->setFlash(__('Request has been not completed.'), 'default', array('class' => 'alert alert-danger'), 'fail');
            }

            //redirect to companies home page
            return $this->redirect(
                    array('controller' => 'companies', 'action' => 'index')
            );
        }
    }

    /**
     * This function is used to update company
     *
     * @return json
     */
    public function edit($id)
    {
        // autorender off for view
        $this->autoRender = false;
        //check permissions
        $this->checkStaffPermission('23');

        //--------- Post request  -----------
        if ($this->request->is(array('post', 'put'))) {
 
            $this->request->data['Company']['id'] = $id;
            //save groups
            if (isset($this->request->data['Company']['groups'])):
                $this->request->data['Company']['groups'] = implode(",", $this->request->data['Company']['groups']);
            endif;
            //save company details
            $success = $this->Company->save($this->request->data);

            //if succfully saved 
            if ($success) {
                foreach ($this->request->data['Custom'] as $key => $value):
                    $this->request->data['CustomCompany']['id'] = $key;
                    $this->request->data['CustomCompany']['value'] = $value;
                    $this->CustomCompany->save($this->request->data);
                endforeach;
                $this->Session->setFlash(__('Request has been completed.'), 'default', array('class' => 'alert alert-info'), 'success');
            } else {
                //failure message
                $this->Session->setFlash(__('Request has been not completed.'), 'default', array('class' => 'alert alert-danger'), 'fail');
            }
        }
        //redirect to companies home page
        return $this->redirect(
                array('controller' => 'companies', 'action' => 'view', $id)
        );
    }

    /**
     * This function is used to delete company
     *
     * @return json
     */
    public function delete()
    {
        // autorender off for view
        $this->autoRender = false;
        //check permissions
        $this->checkStaffPermission('24');
        $companyId = $this->request->data['Company']['id'];

        //if company id exixt
        if (!empty($companyId)) {

            //--------- Ajax request/Post request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {

                //delete the company
                $success = $this->Company->delete($companyId, false);

                //if succesfully company deleted
                if ($success) {
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $companyId);
                    return json_encode($response);
                } else {
                    $response = array('bug' => 1, 'msg' => 'failure');
                    return json_encode($response);
                }
            }
        }
    }

    /**
     * This function is used to view company detail page
     *
     * @return array
     */
    public function view($id = null)
    {
        //get company by comapny id
        $company = $this->Company->getCompanyById($id);

        // check if company exist
        if (!$company) {
            return $this->redirect(
                    array('controller' => 'admins', 'action' => 'index')
            );
        }

        // check for user if company is assign
        if (!$this->checkAdmin()) {
            $groupId = $this->Auth->user('group_id');
            $assign = $this->Company->checkCompanyGroups($groupId, $id);

            if (!$assign) {
                //redirect to dashboard
                return $this->redirect(
                        array('controller' => 'admins', 'action' => 'index')
                );
            }
        }

        //get contacts in company
        $contacts = $this->Contact->getContactByCompany($id);

        //get comapny custom fields
        $custom = $this->Custom->getCompanyCF($id);

        //get clients in company
        $clients = $this->User->getUserByCompany($id);
        //get invoices in company
        $invoices = $this->Invoice->find('all', array('conditions' => array('Invoice.client_id' => $id)));

        //get deals in company
        $deals = $this->Deal->getDealsByCompany($id);

        $this->request->data = $company;

        //get groups
        $groups = $this->UserGroup->getGroupList();
        //set variables to view
        $this->set(compact('company', 'contacts', 'custom', 'clients', 'invoices', 'groups', 'deals'));
    }

    /**
     * This function is used to search companies from deal view page
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
                //get companies by companies name like
                $results = $this->Company->find('all', array('conditions' => array('Company.name LIKE' => '%' . $name . '%'), 'fields' => array('Company.name,Company.id')));
            }
            foreach ($results as $row) {
                $arr[] = array('id' => $row['Company']['id'], 'name' => $row['Company']['name']);
            }
            //return companies in json variable
            echo json_encode($arr);
        }
    }

    /**
     * This function is used to import companies
     *
     * @return array
     */
    public function import()
    {
        //--------- Ajax request/Post request  -----------
        if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
            if (!empty($this->request->data['Company']['csv_file']['tmp_name']) && is_uploaded_file($this->request->data['Company']['csv_file']['tmp_name'])) {
                $path_info = pathinfo($this->request->data['Company']['csv_file']['name']);
                if (strtolower($path_info['extension']) == 'csv') {
                    $handle = fopen($this->request->data['Company']['csv_file']['tmp_name'], "r");
                    //Grab the headers before doing insertion
                    $headers = fgetcsv($handle, 1000, ",");
                    while (($value = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $this->Company->Create();
                        $this->request->data['Company']['name'] = $value[0];
                        $this->request->data['Company']['email'] = $value[1];
                        $this->request->data['Company']['phone'] = $value[2];
                        $this->request->data['Company']['address'] = $value[3];
                        $this->request->data['Company']['city'] = $value[4];
                        $this->request->data['Company']['state'] = $value[5];
                        $this->request->data['Company']['zip_code'] = $value[6];
                        $this->request->data['Company']['country'] = $value[7];
                        $this->request->data['Company']['description'] = $value[8];
                        $this->request->data['Company']['website'] = $value[9];
                        $this->request->data['Company']['facebook'] = $value[10];
                        $this->request->data['Company']['twitter'] = $value[11];
                        $this->request->data['Company']['linkedIn'] = $value[12];
                        $this->request->data['Company']['skype'] = $value[13];
                        $this->request->data['Company']['youtube'] = $value[14];
                        $this->request->data['Company']['google_plus'] = $value[15];
                        $this->request->data['Company']['pinterest'] = $value[16];
                        $this->request->data['Company']['tumblr'] = $value[17];
                        $this->request->data['Company']['instagram'] = $value[18];
                        $this->request->data['Company']['github'] = $value[19];
                        $this->request->data['Company']['digg'] = $value[20];
                        try {
                            $success = $this->Company->save($this->request->data);
                        } catch (Exception $e) {
                            $success = '';
                        }
                    }
                    if ($success) {
                        //success message
                        $this->Session->setFlash('Request has been completed.', 'default', array('class' => 'alert alert-info'), 'success');
                    } else {
                        //failure message
                        $this->Session->setFlash('Request has been not completed.', 'default', array('class' => 'alert alert-danger'), 'fail');
                    }
                }
            }
        }
    }

    /**
     * This function is used to send email to company
     *
     * @return void
     */
    public function send_message()
    {
        // autorender off for view
        $this->autoRender = false;
        if (!empty($this->request->data['Mail']['subject']) && !empty($this->request->data['Mail']['message'])):
            try {
                $send = $this->Notification('mail', $this->request->data['Mail']['to'], $this->request->data['Mail']['subject'], $this->request->data['Mail']['message']);
            } catch (Exception $e) {
                
            }
        endif;
        //set flash message
        $this->Session->setFlash('The Email has beed send.', 'default', array('class' => 'alert alert-info'), 'success');
        //redirect to companies home
        return $this->redirect(
                array('controller' => 'companies', 'action' => 'index')
        );
    }

    /**
     * This function is used to display company home page, all companies list
     *
     * @return void
     */
    public function lists()
    {
        //check permissions
        $this->checkStaffPermission('21');
        //pagination condtions
        if ($this->checkManagerStaff()):
            $conditions[] = 'FIND_IN_SET(\'' . $this->Auth->user('group_id') . '\',Company.groups)';
        endif;
        $this->paginate = array('conditions' => $conditions, 'limit' => 20, 'order' => 'Company.id desc');
        $companies = $this->paginate('Company');

        //get all company custom fields
        $custom = $this->Custom->getCompanyFields();

        //set companies variable to view
        $this->set(compact('companies', 'custom'));

        //--------- Ajax request for getting companies -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $this->render('/Elements/company-list');
        }
    }
}

/* End of file CompaniesController.php */
/* Location: ./app/Controller/CompaniesController.php */