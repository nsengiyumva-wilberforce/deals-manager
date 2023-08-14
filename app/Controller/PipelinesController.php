<?php

/**
 * Class for performing all pipeline related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class PipelinesController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('Pipeline', 'Stage', 'Deal', 'User', 'PipelinePermission', 'Setting');

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
        //check if admin
        $this->isAdmin();
        //check permissions
        $this->checkPermission('1');
        //set layout
        $this->layout = 'admin';
    }

    /**
     * This function is used to Display All Pipelines
     *
     * @return array
     */
    public function index()
    {
        //get all pipelines
        $pipelines = $this->Pipeline->getAllPipelinesDesc();

        //get settings
        $setting = $this->Setting->getPipeline();

        //set variables for view
        $this->set(compact('pipelines', 'setting'));
    }

    /**
     * This function is used to Add New Pipeline.
     *
     * @return void
     */
    public function add()
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->Pipeline->create();
            //save pipeline data
            if ($this->Pipeline->save($this->request->data)) {
                $this->request->data['Stage']['pipeline_id'] = $this->Pipeline->getLastInsertId();
                //add default stages to pipeline
                $stages = array('Idea', 'Qualified', 'Proposal', 'Negotation', 'Final');
                $i = 1;
                foreach ($stages as $stage):
                    $this->Stage->create();
                    $this->request->data['Stage']['name'] = $stage;
                    $this->request->data['Stage']['position'] = $i;
                    $this->Stage->saveAll($this->request->data);
                    $i++;
                endforeach;
                //success message
                $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
            //redirect to pipeline home page
            return $this->redirect(
                    array('controller' => 'pipelines', 'action' => 'index')
            );
        }
    }

    /**
     * This function is used to Edit the Pipeline.
     *
     * @return json
     */
    public function edit()
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            //--------- Ajax request  -----------
            if ($this->RequestHandler->isAjax()) {
                $this->layout = 'ajax';
                //common variables
                $this->request->data['Pipeline']['id'] = $this->request->data['pk'];
                $this->request->data['Pipeline']['name'] = $this->request->data['value'];
                //save pipeline details
                $success = $this->Pipeline->save($this->request->data);
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
     * This function is used to Delete the Pipeline and also stages in pipeline.
     *
     * @return json
     */
    public function delete()
    {
        // autorender off for view
        $this->autoRender = false;
        $pipelineId = $this->request->data['Pipeline']['id'];

        //if pipeline id exixt
        if (!empty($pipelineId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //check if pipeline have active deals
                $checkDeal = $this->Deal->getPipelineDeal($pipelineId);
                if ($checkDeal) {
                    //return json failure message
                    $response = array('bug' => 1, 'msg' => 'Pipeline have active deals');
                    return json_encode($response);
                } else {
                    //delete pipeline
                    $success = $this->Pipeline->delete($pipelineId, false);
                    if ($success) {
                        //delete all stages in pipeline
                        $this->Stage->deleteAll(array('Stage.pipeline_id' => $pipelineId));
                        //return json success message
                        $response = array('bug' => 0, 'msg' => 'success', 'vId' => $pipelineId);
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

    /**
     * This function is used to Dispaly pipeline permission page and update pipeline permission for users.
     *
     * @return array
     */
    public function permission($id = null)
    {
        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            // autorender off for view
            $this->autoRender = false;
            //Common parameters
            $this->request->data['PipelinePermission']['pipeline_id'] = $this->request->data['pipe'];
            $this->request->data['PipelinePermission']['user_id'] = $this->request->data['user'];
            $status = $this->request->data['status'];
            if ($status == 0) {
                //check pipeline permission to user
                $check = $this->PipelinePermission->checkPermission($this->request->data['PipelinePermission']['pipeline_id'], $this->request->data['PipelinePermission']['user_id']);
                if (!$check) {
                    //save pipeline permission to user
                    $success = $this->PipelinePermission->save($this->request->data);
                }
            } else if ($status == 1) {
                //delete pipeline user permission
                $success = $this->PipelinePermission->deleteAll(array('pipeline_id' => $this->request->data['PipelinePermission']['pipeline_id'], 'user_id' => $this->request->data['PipelinePermission']['user_id']), false);
            }
        }

        //get all users
        $users = $this->User->getPipelineUsers($id);

        //get pipeline details
        $pipeline = $this->Pipeline->getPipelineById($id);

        //set users variable for view
        $this->set(compact('users', 'pipeline'));
    }
}

/* End of file PipelinesController.php */
/* Location: ./app/Controller/PipelinesController.php */