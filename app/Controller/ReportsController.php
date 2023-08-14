<?php

/**
 * Class for performing all report related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class ReportsController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('User', 'Source', 'Product', 'Deal', 'Stage', 'Setting');

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
        //check if admin
        $this->isAdmin();
        //check permissions
        $this->checkPermission('5');
        //set layout
        $this->layout = 'admin';
    }

    /**
     *  This function is used to display reports home page
     *
     * @return void
     */
    public function index()
    {
        $setting = $this->Setting->getPipeline();
        $pipelineId = $setting['Setting']['pipeline'];
        $Products = $this->Product->find('list', array('fields' => array('Product.id', 'Product.name')));
        $Sources = $this->Source->find('list', array('fields' => array('Source.id', 'Source.name')));
        $Users = $this->User->find('list', array('fields' => array('User.id', 'User.name')));
        //--------- Ajax request  -----------
        if ($this->request->isAjax()) {
            //common variables
            $pipelineId = $this->request->data['Report']['pipeline_id'];
            $userId = $this->request->data['Report']['user_id'];
            $productId = $this->request->data['Report']['product_id'];
            $sourceId = $this->request->data['Report']['source_id'];
            $fromDate = date('Y-m-d', strtotime($this->request->data['Report']['fromDate']));
            $toDate = date('Y-m-d 23:59:00', strtotime($this->request->data['Report']['toDate']));
            $motive = $this->request->data['Report']['motive'];
            //get stages in pipeline
            $stages = $this->Stage->find('all', array('conditions' => array('Stage.pipeline_id' => $pipelineId), 'fields' => array('Stage.id', 'Stage.name')));
            //set title and status
            switch ($motive) {
                case "1":
                    $status = 0;
                    $title = __('Number of Active Deals');
                    break;
                case "2":
                    $status = 1;
                    $title = __('Number of Won Deals');
                    break;
                case "3":
                    $status = 2;
                    $title = __('Number of Lost Deals');
                    break;
                case "4":
                    $status = 0;
                    $price = 1;
                    $title = __('Price of Active Deals');
                    break;
                case "5":
                    $status = 1;
                    $price = 1;
                    $title = __('Price of Won Deals');
                    break;
                case "6":
                    $status = 2;
                    $price = 1;
                    $title = __('Price of Lost Deals');
                    break;
            }

            foreach ($stages as &$row):
                if ($motive == 1 || $motive == 2 || $motive == 3) {
                    //get total deal count by stage
                    $row['Deal']['total'] = $this->Deal->Report($pipelineId, $row['Stage']['id'], $fromDate, $toDate, $status, $userId, $productId, $sourceId);
                } else {
                    //get total price by stage
                    $sum = $this->Deal->Report($pipelineId, $row['Stage']['id'], $fromDate, $toDate, $status, $userId, $productId, $sourceId, $price);
                    $row['Deal']['total'] = ($sum[0]['sum']) ? $sum[0]['sum'] : '0';
                }
            endforeach;
            //set variables to view
            $this->set(compact('stages', 'title', 'motive', 'setting'));
            //view
            $this->render('/Elements/reports');
        } else {
            //get all stages by pipeline
            $stages = $this->Stage->find('all', array('conditions' => array('Stage.pipeline_id' => $pipelineId), 'fields' => array('Stage.id', 'Stage.name')));
            //common variables
            $status = 0;
            $motive = 1;
            $title = __('Number of Active Deals');
            $fromDate = date("Y-m-d", strtotime("-1 month"));
            $toDate = date('Y-m-d 23:59:00');
            foreach ($stages as &$row):
                //get total deals by stage
                $row['Deal']['total'] = $this->Deal->Report($pipelineId, $row['Stage']['id'], $fromDate, $toDate, $status);
            endforeach;
        }
        //set variables for view
        $this->set(compact('Products', 'Sources', 'Users', 'stages', 'pipelineId', 'title', 'motive'));
    }
}

/* End of file ReportsController.php */
/* Location: ./app/Controller/ReportsController.php */