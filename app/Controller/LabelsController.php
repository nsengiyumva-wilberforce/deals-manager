<?php

/**
 * Class for performing all label related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class LabelsController extends AppController
{

    /**
     * This controller use following models
     *
     * @var array
     */
    public $uses = array('Pipeline', 'Label', 'LabelDeal');

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
    }

    /**
     * This function is used to display label home page and view labels by pipeline
     *
     * @return array
     */
    public function index()
    {
        //check is user admin
        $this->isAdmin();

        //check permissions
        $this->checkPermission('8');

        //get all pipelines
        $pipelines = $this->Pipeline->getAllPipelines();
        foreach ($pipelines as &$row) {
            $row['Label'] = $this->Label->getLabels($row['Pipeline']['id']);
        }
        //set pipelines variable for view
        $this->set(compact('pipelines'));
    }

    /**
     * This function is used to add new label in pipeline
     *
     * @return void
     */
    public function add()
    {
        //check is user admin
        $this->isAdmin();
        //check permissions
        $this->checkPermission('8');
        // autorender off for view
        $this->autoRender = false;

        //--------- Post request -----------
        if ($this->request->is('post')) {
            $this->Label->create();
            //save label
            if ($this->Label->save($this->request->data)) {
                //success message
                $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
            //redirect to label home 
            return $this->redirect(
                    array('controller' => 'labels', 'action' => 'index')
            );
        }
    }

    /**
     * This function is used to update label
     *
     * @return json
     */
    public function edit()
    {
        //check if user admin
        $this->isAdmin();

        //check permissions
        $this->checkPermission('8');

        // autorender off for view
        $this->autoRender = false;

        //--------- Post request -----------
        if ($this->request->is('post')) {
            //--------- Ajax request -----------
            if ($this->RequestHandler->isAjax()) {
                $this->layout = 'ajax';
                //Commin variables
                $this->request->data['Label']['id'] = $this->request->data['pk'];
                $this->request->data['Label']['name'] = $this->request->data['value'];
                //save label 
                $success = $this->Label->save($this->request->data);
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
     * This function is used to delete label
     *
     * @return json
     */
    public function delete()
    {
        //check if user is admin
        $this->isAdmin();

        //check permissions
        $this->checkPermission('8');

        // autorender off for view
        $this->autoRender = false;
        $labelId = $this->request->data['Label']['id'];

        //if label id exixt
        if (!empty($labelId)) {
            //--------- Post/Ajax request -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete label
                $success = $this->Label->delete($labelId, false);
                //if label deleted
                if ($success) {
                    //delete assing label to deals
                    $this->LabelDeal->deleteAll(array('label_id' => $labelId), true);
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $labelId);
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
     *  This function is used to assign label in deal 
     *
     * @return void
     */
    public function deal()
    {
        // autorender off for view
        $this->autoRender = false;
        $dealId = $this->request->data['Label']['deal_id'];
        //if deal id exixt
        if (!empty($dealId) && isset($this->request->data['Label']['labels'])) {
            foreach ($this->request->data['Label']['labels'] as $row):
                //assing labels to deal
                $result = $this->LabelDeal->glabelDeal($dealId, $row);
                if (!($result)) {
                    $this->LabelDeal->create();
                    $this->request->data['LabelDeal']['label_id'] = $row;
                    $this->request->data['LabelDeal']['deal_id'] = $dealId;
                    $this->LabelDeal->save($this->request->data);
                }
            endforeach;
            //get old assing labels to deal
            $oldLabels = $this->LabelDeal->getLabelsByDeal($dealId);
            $labels = array_diff($oldLabels, $this->request->data['Label']['labels']);
            foreach ($labels as $row):
                $this->LabelDeal->deleteAll(array('deal_id' => $dealId, 'label_id' => $row), true);
            endforeach;
        } else if (!empty($dealId)) {
            $this->LabelDeal->deleteAll(array('deal_id' => $dealId), true);
        }
        if ($this->request->data['Label']['control'] == 1) {
            //success message
            $this->Session->setFlash(__('Request has been completed.'), 'default', array('class' => 'alert alert-info'), 'success');
            //redirect to deal view
            return $this->redirect(array('controller' => 'deals', 'action' => 'view', $dealId));
        } else {
            //failure message
            $this->Session->setFlash(__('Request has been completed.'), 'default', array('class' => 'alert alert-info'), 'success');
            //redirect to dashboard
            return $this->redirect(array('controller' => 'admins', 'action' => 'index'));
        }
    }
}

/* End of file LabelsController.php */
/* Location: ./app/Controller/LabelsController.php */