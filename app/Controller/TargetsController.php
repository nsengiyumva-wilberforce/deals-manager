<?php

/*
 *Class for performing all maintenance logs related functions
 *
 */

class TargetsController extends AppController
{
    /**
     * This controller uses the following models
     * @var array
     */

    public $uses = array('Target', 'Product', 'User', 'ProductCategory', 'User');

    /**
     * This controller uses the following helpers
     *@var array
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
        $targets = $this->Target->getAllTargets();

        //product categories
        $productCategories = $this->Product->getAllProductsArr();

        //user list
        $users = $this->User->getAllUsersArr();

        //set product variable for view
        $this->set(compact('targets', 'productCategories', 'users'));
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
            $this->Target->create();
            $this->request->data['Target']['deadline'] = date('Y-m-d', strtotime($this->request->data['Target']['deadline']));
            //save product
            if ($this->Target->save($this->request->data)) {
                //success message
                $this->Flash->success(__('Target has been set.'), array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success(__('Target setting failed.'), array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
            return $this->redirect(
                array('controller' => 'targets', 'action' => 'index')
            );
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
        $targetId = $this->request->data['Target']['id'];

        //if product id exist
        if (!empty($targetId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete product
                $success = $this->Target->delete($targetId, false);
                if ($success) {
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $targetId);
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