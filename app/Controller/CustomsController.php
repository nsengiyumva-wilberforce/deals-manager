<?php

/**
 * Class for performing all custom fields related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class CustomsController extends AppController
{

    /**
     * This controller use following models
     *
     * @var array
     */
    public $uses = array('Custom', 'CustomDeal', 'CustomContact', 'CustomCompany', 'Deal', 'Contact', 'Company');

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
        //check if admin/staff
        $this->checkAdminStaff();
        //set layout
        $this->layout = 'admin';
    }

    /**
     * This function is used to display custom fields for deal,contact,companies
     *
     * @return array
     */
    public function index()
    {
        //check permission
        if ($this->checkAdmin()) {
            $this->checkPermission('51');
        } else {
            $this->checkStaffPermission('51');
        }

        //get all deal custom fields
        $dealFields = $this->Custom->getDealFields();
        //get all contact custom fields
        $contactFields = $this->Custom->getContactFields();
        //get all comapny custom fields
        $companyFields = $this->Custom->getcompanyFields();

        //set variable for view
        $this->set(compact('dealFields', 'contactFields', 'companyFields'));
    }

    /**
     * This function is used to add new custom field
     *
     * @return void
     */
    public function add()
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Post request -----------
        if ($this->request->is('post')) {
            $this->Custom->create();
            //save custom field
            if ($this->Custom->save($this->request->data)) {
                $customId = $this->Custom->getLastInsertID();
                //check for add in old deals or contact or company
                if ($this->request->data['Custom']['old'] == '2') {
                    //add to old deals custom fields
                    if ($this->request->data['Custom']['module'] == 1) {
                        //get all deals
                        $deals = $this->Deal->getAllDealsID();
                        foreach ($deals as $row):
                            $this->CustomDeal->create();
                            $this->request->data['CustomDeal']['custom_id'] = $customId;
                            $this->request->data['CustomDeal']['deal_id'] = $row['Deal']['id'];
                            $this->request->data['CustomDeal']['value'] = '';
                            $this->CustomDeal->save($this->request->data);
                        endforeach;
                    }
                    //add to old contacts custom fields
                    else if ($this->request->data['Custom']['module'] == 2) {
                        //get all contacts
                        $contacts = $this->Contact->getAllContactsID();
                        foreach ($contacts as $row):
                            $this->CustomContact->create();
                            $this->request->data['CustomContact']['custom_id'] = $customId;
                            $this->request->data['CustomContact']['contact_id'] = $row['Contact']['id'];
                            $this->request->data['CustomContact']['value'] = '';
                            $this->CustomContact->save($this->request->data);
                        endforeach;
                    }
                    //add to old company custom fields
                    else if ($this->request->data['Custom']['module'] == 3) {
                        //get all companies
                        $companies = $this->Company->getAllCompaniesID();
                        foreach ($companies as $row):
                            $this->CustomCompany->create();
                            $this->request->data['CustomCompany']['custom_id'] = $customId;
                            $this->request->data['CustomCompany']['company_id'] = $row['Company']['id'];
                            $this->request->data['CustomCompany']['value'] = '';
                            $this->CustomCompany->save($this->request->data);
                        endforeach;
                    }
                }
                //success message
                $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
            //redirect to custom home 
            return $this->redirect(
                    array('controller' => 'customs', 'action' => 'index')
            );
        }
    }

    /**
     * This function is used to update custom field name
     *
     * @return json
     */
    public function edit()
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Post request -----------
        if ($this->request->is('post')) {
            //--------- Ajax request -----------
            if ($this->RequestHandler->isAjax()) {
                $this->layout = 'ajax';
                //Commin variables
                $this->request->data['Custom']['id'] = $this->request->data['pk'];
                $this->request->data['Custom']['name'] = $this->request->data['value'];
                //save custom fields 
                $success = $this->Custom->save($this->request->data);
                //if label save
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
     * This function is used to delete custom field
     *
     * @return json
     */
    public function delete()
    {
        // autorender off for view
        $this->autoRender = false;
        $customId = $this->request->data['Custom']['id'];

        //if label id exixt
        if (!empty($customId)) {
            //--------- Post/Ajax request -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete custom field
                $success = $this->Custom->delete($customId, false);
                //if custom field deleted
                if ($success) {
                    //delete assing custom fields to deal,contact,company
                    $this->CustomDeal->deleteAll(array('custom_id' => $customId), true);
                    $this->CustomContact->deleteAll(array('custom_id' => $customId), true);
                    $this->CustomCompany->deleteAll(array('custom_id' => $customId), true);
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $customId);
                    return json_encode($response);
                } else {
                    //return json success message
                    $response = array('bug' => 1, 'msg' => 'failure');
                    return json_encode($response);
                }
            }
        }
    }

    /**
     * This function is used to update deal custom field value
     *
     * @return json
     */
    public function deal()
    {


        // autorender off for view
        $this->autoRender = false;

        //--------- Post request -----------
        if ($this->request->is('post')) {
            //--------- Ajax request -----------
            if ($this->RequestHandler->isAjax()) {
                $this->layout = 'ajax';
                //Commin variables
                $this->request->data['CustomDeal']['id'] = $this->request->data['pk'];
                $this->request->data['CustomDeal']['value'] = $this->request->data['value'];
                //save custom deal value 
                $success = $this->CustomDeal->save($this->request->data);
                //if custom field save
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
     * This function is used to update contact custom field value
     *
     * @return json
     */
    public function contact()
    {


        // autorender off for view
        $this->autoRender = false;

        //--------- Post request -----------
        if ($this->request->is('post')) {
            //--------- Ajax request -----------
            if ($this->RequestHandler->isAjax()) {
                $this->layout = 'ajax';
                //Commin variables
                $this->request->data['CustomContact']['id'] = $this->request->data['pk'];
                $this->request->data['CustomContact']['value'] = $this->request->data['value'];
                //save custom field value 
                $success = $this->CustomContact->save($this->request->data);
                //if custom field save
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
     * This function is used to update company custom field value
     *
     * @return json
     */
    public function company()
    {


        // autorender off for view
        $this->autoRender = false;

        //--------- Post request -----------
        if ($this->request->is('post')) {
            //--------- Ajax request -----------
            if ($this->RequestHandler->isAjax()) {
                $this->layout = 'ajax';
                //Commin variables
                $this->request->data['CustomCompany']['id'] = $this->request->data['pk'];
                $this->request->data['CustomCompany']['value'] = $this->request->data['value'];
                //save custom field value 
                $success = $this->CustomCompany->save($this->request->data);
                //if custom field save
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
}

/* End of file CustomsController.php */
/* Location: ./app/Controller/CustomsController.php */