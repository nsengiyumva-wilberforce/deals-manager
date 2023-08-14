<?php

/**
 *  Class for performing all activity related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class TimelinesController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('Timeline');

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
        $this->checkPermission('6');
        //set layout
        $this->layout = 'admin';
    }

    /**
     * This Function is used to display all Activity page.
     *
     * @return array
     */
    public function index()
    {
        $limit = 20;
        $conditions = array();

        //set session variables
        if ($this->request->is('post') || $this->request->is('ajax')) {
            if (!empty($this->request->data['Timeline']['pipeline_id'])) {
                $this->Session->write('Timeline.pipeline_id', $this->request->data['Timeline']['pipeline_id']);
            } else {
                $this->Session->delete('Timeline.pipeline_id');
            }
            if (!empty($this->request->data['Timeline']['user_id'])) {
                $this->Session->write('Timeline.user_id', $this->request->data['Timeline']['user_id']);
            } else {
                $this->Session->delete('Timeline.user_id');
            }
            if (!empty($this->request->data['Timeline']['module'])) {
                $this->Session->write('Timeline.module', $this->request->data['Timeline']['module']);
            } else {
                $this->Session->delete('Timeline.module');
            }
            if (!empty($this->request->data['Timeline']['to'])) {
                $this->Session->write('Timeline.from', date('Y-m-d', strtotime($this->request->data['Timeline']['from'])));
                $this->Session->write('Timeline.to', date('Y-m-d 24:00:00', strtotime($this->request->data['Timeline']['to'])));
            }
            //read session variables
            if ($this->Session->check('Timeline.pipeline_id')) {
                $conditions['Timeline.pipeline_id'] = $this->Session->read('Timeline.pipeline_id');
            }
            if ($this->Session->check('Timeline.user_id')) {
                $conditions['Timeline.user_id'] = $this->Session->read('Timeline.user_id');
            }
            if ($this->Session->check('Timeline.module')) {
                $conditions['Timeline.module'] = $this->Session->read('Timeline.module');
            }
            if (!empty($this->request->data['Timeline']['to'])) {
                $conditions['Timeline.created >='] = $this->Session->read('Timeline.from');
                $conditions['Timeline.created <='] = $this->Session->read('Timeline.to');
            }
        } else {
            $this->Session->delete('Timeline');
        }
        //pagination conditions for getting activities
        $this->paginate = array(
            'conditions' => $conditions,
            'joins' => array(
                array(
                    'alias' => 'Deal',
                    'table' => 'deal',
                    'type' => 'LEFT',
                    'conditions' => 'Deal.id = Timeline.deal_id'
                ),
                array(
                    'alias' => 'Pipeline',
                    'table' => 'pipeline',
                    'type' => 'LEFT',
                    'conditions' => 'Pipeline.id = Timeline.pipeline_id'
                ),
                array(
                    'alias' => 'User',
                    'table' => 'users',
                    'type' => 'LEFT',
                    'conditions' => 'User.id = Timeline.user_id'
                )
            ),
            'limit' => $limit,
            'order' => 'Timeline.id desc',
            'fields' => array('Timeline.*', 'Deal.name', 'Pipeline.name', 'User.picture', 'User.first_name', 'User.last_name'),
        );
        $Activity = $this->paginate('Timeline');
        //set variable to view
        $this->set(compact('Activity'));

        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $this->render('/Elements/timeline_list');
        }
    }

    /**
     * This Function used to delete activity
     *
     * @return json
     */
    public function delete()
    {
        // autorender off for view
        $this->autoRender = false;
        $timelineId = $this->request->data['Timeline']['id'];
        if (!empty($timelineId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete activity
                $success = $this->Timeline->delete($timelineId, false);
                if ($success) {
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $timelineId);
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

/* End of file TimelinesController.php */
/* Location: ./app/Controller/TimelinesController.php */