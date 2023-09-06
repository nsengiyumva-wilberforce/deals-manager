<?php

/*
 *Class for performing all maintenance logs related functions
 *
 */

class MaintenancesController extends AppController
{
    /**
     * This controller uses the following models
     * @var array
     */

    public $uses = array('Maintenance', 'User', 'Product');

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
        $maintenanceLogs = $this->Maintenance->getAllMaintenances();

        //set product variable for view
        $this->set(compact('maintenanceLogs'));
    }
}