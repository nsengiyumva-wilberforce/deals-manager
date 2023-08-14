<?php

/**
 * Class for performing all dashboard related functions
 * 
 * @author:   Impactive digital
 * @Copyright: Ipactive Digital 2023
 * @Website:   https://www.impactoutsourcing.com 
 */
class AdminsController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('Pipeline', 'Stage', 'User', 'Label', 'LabelDeal', 'Deal', 'Contact', 'Task', 'UserDeal', 'ProductDeal', 'Custom', 'CustomDeal', 'AppFile', 'NoteDeal', 'Source', 'Product', 'Discussion', 'ContactDeal', 'Announcement');

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
        $this->layout = 'home';
        //check if admin or staff
    }

    /**
     *  This function is used to display deals dashboard/home page
     *
     * @return array
     */
    public function index()
    {
        // if client redirect to deal list
        if ($this->Auth->user('user_group_id') == '4'):
            return $this->redirect(array('controller' => 'deals', 'action' => 'index'));
        endif;
        //get user group type
        $userGId = $this->Auth->user('user_group_id');
        // write values to session variables
        if (isset($this->request->data['Admin']['pipeline_id'])) {
            $this->Session->write('Pipeline.id', $this->request->data['Admin']['pipeline_id']);
        }
        if (isset($this->request->data['Admin']['label_id'])) {
            $this->Session->write('Label.id', $this->request->data['Admin']['label_id']);
        }
        if (isset($this->request->data['Admin']['user_id'])) {
            $this->Session->write('User.id', $this->request->data['Admin']['user_id']);
        }

        // check if session value set for variables
        $pipelineId = ($this->Session->check('Pipeline.id')) ? $this->Session->read('Pipeline.id') : '';
        $labelId = ($this->Session->check('Label.id')) ? $this->Session->read('Label.id') : '';
        if ($this->checkAdmin() || $this->checkManager()) {
            $userId = ($this->Session->check('User.id')) ? $this->Session->read('User.id') : '';
        } else {
            $userId = $this->Auth->user('id');
        }

        //get pipeline by id
        $pipeline = $this->Pipeline->getPipelineById($pipelineId);

        //get stages in pipeline
        $stages = $this->Stage->getStages($pipelineId);


        //get labels in pipeline
        $labels = $this->Label->getLabels($pipelineId);
        foreach ($stages as &$stage):
            $deals = $this->Deal->getDealsByStage($stage['Stage']['id'], $labelId, $userId, $userGId);
            foreach ($deals as &$row):
                $row['Labels'] = $this->LabelDeal->getLabelDeal($row['Deal']['id']);
                $row['Users'] = $this->UserDeal->getUsersDeal($row['Deal']['id']);
                $row['tasks'] = $this->Task->find('count', array('conditions' => array('Task.deal_id' => $row['Deal']['id'])));
                $row['tasks_u'] = $this->Task->find('count', array('conditions' => array('Task.deal_id' => $row['Deal']['id'], 'Task.status' => 0)));
                $row['files'] = $this->AppFile->find('count', array('conditions' => array('AppFile.deal_id' => $row['Deal']['id'])));
                $row['contacts'] = $this->ContactDeal->find('count', array('conditions' => array('ContactDeal.deal_id' => $row['Deal']['id'])));
            endforeach;
            $stage['Deal'] = $deals;
        endforeach;
        //get all users
        $users = $this->User->getUsers();
        $type = $this->Auth->user('user_group_id');
        $userId = $this->Auth->user('id');
        $announcements = $this->Announcement->getAnnouncements($type, $userId);
        //set variables to view
        $this->set(compact('pipeline', 'stages', 'users', 'labels', 'announcements'));
    }

    /**
     * This function is used to  load deals on scroll down stage deals.
     *
     * @return json
     */
    public function load()
    {
        // autorender off for view
        $this->autoRender = false;
        //get user group type
        $userGId = $this->Auth->user('user_group_id');
        //common variables
        $stageId = $this->params['url']['stage'];
        $page = $this->params['url']['page'];
        $labelId = $this->Session->read('Label.id');
        $userId = $this->Session->read('User.id');

        //get deals by stage
        $deals = $this->Deal->getDealsByStage($stageId, $labelId, $userId, $userGId, $page);

        // count the deals in stage
        $count = count($deals);
        if ($count == '10') {
            $page++;
        } else {
            $page = 0;
        }
        foreach ($deals as &$row):
            $row['Labels'] = $this->LabelDeal->getLabelDeal($row['Deal']['id']);
            $row['Users'] = $this->UserDeal->getUsersDeal($row['Deal']['id']);
            $row['tasks'] = $this->Task->find('count', array('conditions' => array('Task.deal_id' => $row['Deal']['id'])));
            $row['tasks_u'] = $this->Task->find('count', array('conditions' => array('Task.deal_id' => $row['Deal']['id'], 'Task.status' => 0)));
            $row['files'] = $this->AppFile->find('count', array('conditions' => array('AppFile.deal_id' => $row['Deal']['id'])));
            $row['notes'] = $this->NoteDeal->find('count', array('conditions' => array('NoteDeal.deal_id' => $row['Deal']['id'])));
        endforeach;

        //set variables to view
        $this->set(compact('deals', 'stageId'));

        //view 
        $dealData = $this->render('/Elements/home');

        //variables for json response
        $data = array('page' => $page, 'deals' => $dealData->body());
        $options = array(
            'type' => 'json',
            'body' => json_encode($data)
        );

        // return json variable
        return new CakeResponse($options);
    }

    /**
     * This function is used to load contacts in modal for selected deal.
     *
     * @return void
     */
    public function contacts($dealId)
    {
        // autorender off for view
        $this->autoRender = false;

        //get contacts in deal
        $Contacts = $this->Contact->getContactsByDeal($dealId);

        //set contacts variable to view
        $this->set(compact('Contacts'));

        //--------- Ajax request for getting contacts -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $this->render('/Elements/contacts');
        }
    }

    /**
     * This function is used to load labels in modal for selected deal
     *
     * @return void
     */
    public function labels($dealId)
    {
        // autorender off for view
        $this->autoRender = false;

        //get pipeline for deal
        $pipeline = $this->Deal->getDealPipeline($dealId);

        //get labels in pipeline
        $Labels = $this->Label->getLabels($pipeline['Deal']['pipeline_id']);

        //get assign labels to deal
        $labelsDeal = $this->LabelDeal->getLabelsByDeal($dealId);

        //check for controller
        $control = $this->request->data['control'];

        //set variables to view
        $this->set(compact('Labels', 'labelsDeal', 'dealId', 'control'));

        //--------- Ajax request for getting labels -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $this->render('/Elements/home');
        }
    }

    /**
     * This function is used to load products in modal for selected deal
     *
     * @return void
     */
    public function products($id)
    {
        // autorender off for view
        $this->autoRender = false;

        //get assign products to deal
        $ProductDeal = $this->ProductDeal->getProductD($id);

        //set deal product variable to view
        $this->set(compact('ProductDeal'));

        //--------- Ajax request for getting products -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $this->render('/Elements/home');
        }
    }

    /**
     * This function is used to load tasks in modal for selected deal.
     *
     * @return void
     */
    public function tasks($dealId)
    {
        // autorender off for view
        $this->autoRender = false;

        //get task by deal id
        $tasks = $this->Task->getTasksByDeal($dealId);

        //set task variable to view
        $this->set(compact('tasks'));

        //--------- Ajax request for getting tasks -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $this->render('/Elements/tasks_home');
        }
    }

    /**
     * This function is used to load view in modal for selected deal.
     *
     * @return void
     */
    public function view($id)
    {
        $userId = $this->Auth->user('id');
        //get deal
        $deal = $this->Deal->getDealById($id);
        $sources = $this->Source->getSourcesByDeal($id); //get assing sources to deal
        $contacts = $this->Contact->getContactsByDeal($id); //get assing contacts to deal
        $products = $this->Product->getProductsByDeal($id);  //get assing products to deal
        $members = $this->User->getUsersByDeal($id);  //get assing users to deal
        $files = $this->AppFile->getFilesByDeal($id);  //get assing files to deal
        $note = $this->NoteDeal->getNote($id, $userId);  //get assing notes to deal
        $tasks = $this->Task->getTasksByDeal($id);
        $Discussions = $this->Discussion->getMessageByDeal($id, 1);
        foreach ($Discussions as &$row):
            $row['childs'] = $this->Discussion->getMessageByParent($row['Discussion']['id']); //get discussion  reply in deal
        endforeach;
        $feedback = $this->Discussion->getMessageByDeal($id, 2);
        foreach ($feedback as &$row):
            $row['childs'] = $this->Discussion->getMessageByParent($row['Discussion']['id']); //get discussion  reply in deal
        endforeach;
        $custom = $this->Custom->getDealCF($id);  //get deal custom fields
        //set variables to view
        $this->set(compact('deal', 'sources', 'contacts', 'products', 'members', 'files', 'note', 'tasks', 'labels', 'Discussions', 'custom', 'feedback'));
    }
}

/* End of file AdminsController.php */
/* Location: ./app/Controller/AdminsController.php */