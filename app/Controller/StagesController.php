<?php

/**
 * Class for performing all stages related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class StagesController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('Stage', 'Pipeline', 'Deal');

    /**
     * This controller uses following helpers
     *
     * @var array
     */
    var $helpers = array('Html', 'Form', 'Common', 'Js', 'Paginator', 'Time');

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
     * This function is used to display All Stages By Pipeline
     *
     * @return array
     */
    public function index()
    {
        //check if admin
        $this->isAdmin();
        //check permissions
        $this->checkPermission('2');
        //get all pipelines
        $pipelines = $this->Pipeline->getPipelines();
        //set pipelines variable to view
        $this->set(compact('pipelines'));
    }

    /**
     * This function is used to add new Stage.
     *
     * @return void
     */
    public function add()
    {
        //check if admin
        $this->isAdmin();
        //check permissions
        $this->checkPermission('2');
        // autorender off for view
        $this->autoRender = false;

        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->Stage->create();
            //get last stage order in pipeline
            $order = $this->Stage->getStageOrder($this->request->data['Stage']['pipeline_id']);
            $this->request->data['Stage']['position'] = $order['Stage']['position'] + 1;
            //add new stage
            if ($this->Stage->save($this->request->data)) {
                //success message
                $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success('Request has been mot completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
            //redirect to stages home page
            return $this->redirect(
                    array('controller' => 'stages', 'action' => 'index')
            );
        }
    }

    /**
     * This function is used to edit the Stage.
     *
     * @return json
     */
    public function edit()
    {
        //check if admin
        $this->isAdmin();
        //check permissions
        $this->checkPermission('2');
        // autorender off for view
        $this->autoRender = false;

        //--------- Post request  -----------
        if ($this->request->is('post')) {
            //--------- Ajax request  -----------
            if ($this->RequestHandler->isAjax()) {
                $this->layout = 'ajax';
                //common variables
                $this->request->data['Stage']['id'] = $this->request->data['pk'];
                $this->request->data['Stage']['name'] = $this->request->data['value'];
                //update stage
                $success = $this->Stage->save($this->request->data);
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
     * This function is used to delete the Stage and check if have active deals before delete.
     *
     * @return json
     */
    public function delete()
    {
        //check if admin
        $this->isAdmin();
        //check permissions
        $this->checkPermission('2');
        // autorender off for view
        $this->autoRender = false;
        $stageId = $this->request->data['Stage']['id'];
        if (!empty($stageId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //check if stage have active deal
                $checkDeal = $this->Deal->getStageDeal($stageId);
                if ($checkDeal) {
                    //return json failure  message if active deals
                    $response = array('bug' => 1, 'msg' => __('Stage have active deals'));
                    return json_encode($response);
                } else {
                    //delete stage
                    $success = $this->Stage->delete($stageId, false);
                    if ($success) {
                        //return json success message
                        $response = array('bug' => 0, 'msg' => 'success', 'vId' => $stageId);
                        return json_encode($response);
                    } else {
                        //return json success message
                        $response = array('bug' => 1, 'msg' => 'failure');
                        return json_encode($response);
                    }
                }
            }
        }
    }

    /**
     * This function is used to change the stage order in the pipeline view.
     *
     * @return void
     */
    public function update()
    {
        // autorender off for view
        $this->autoRender = false;
        $stages = $this->request->data['item'];
        $count = 1;
        foreach ($stages as $row):
            $this->request->data['Stage']['id'] = $row;
            $this->request->data['Stage']['position'] = $count;
            //update stage order
            $result = $this->Stage->save($this->request->data);
            $count++;
        endforeach;
    }

    /**
     * This function is used to display list of stages by pipeline.
     *
     * @return array
     */
    public function lists($pipelineId = null)
    {
        // autorender off for view
        $this->autoRender = false;
        //get stages by pipeline
        $stages = $this->Stage->stagesByPipeline($pipelineId);
        //set stages variable to view
        $this->set('stages', $stages);
        //view
        $this->render('/Elements/stagesList');
    }
}

/* End of file StagesController.php */
/* Location: ./app/Controller/StagesController.php */