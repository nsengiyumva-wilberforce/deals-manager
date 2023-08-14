<?php
/**
 * Class for performing all deal related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class DealsController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('Deal', 'Source', 'Contact', 'Product', 'User', 'AppFile', 'NoteDeal', 'Task', 'History', 'Pipeline', 'Stage', 'Timeline', 'LabelDeal', 'Discussion', 'UserDeal', 'SourceDeal', 'ProductDeal', 'ContactDeal', 'CustomDeal', 'Custom', 'Invoice', 'Label', 'Company', 'UserGroup');

    /**
     * This controller uses following models
     *
     * @var array
     */
    var $helpers = array('Html', 'Form', 'Js', 'Paginator', 'Time');

    /**
     * This controller uses following models
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
     * This function is used to display list of deals.
     *
     * @var array
     */
    public function index()
    {
        $userId = ($this->checkAdmin()) ? '' : $this->Auth->user('id');
        $userGId = $this->Auth->user('user_group_id');

        // write values to session variables
        if (isset($this->request->data['Deal']['pipeline_id'])) {
            $this->Session->write('PipelineList.id', $this->request->data['Deal']['pipeline_id']);
        }
        if (isset($this->request->data['Deal']['label_id'])) {
            $this->Session->write('LabelList.id', $this->request->data['Deal']['label_id']);
        }
        if (isset($this->request->data['Deal']['user_id'])) {
            $this->Session->write('UserList.id', $this->request->data['Deal']['user_id']);
        }


        // check if session value set for variables
        $pipelineId = ($this->Session->check('PipelineList.id')) ? $this->Session->read('PipelineList.id') : '';
        $labelId = ($this->Session->check('LabelList.id')) ? $this->Session->read('LabelList.id') : '';
        if ($this->checkAdmin() || $this->checkManager()) {
            $userId = ($this->Session->check('UserList.id')) ? $this->Session->read('UserList.id') : '';
        } else {
            $userId = $this->Auth->user('id');
        }

        //get labels in pipeline
        $labels = $this->Label->getLabels($pipelineId);
        // conditions for getting all deals
        $conditions = array();
        $options = array();
        if (!empty($pipelineId)) {
            $conditions['Deal.pipeline_id'] = $pipelineId;
        }
        if (!empty($labelId)) {
            $conditions['LabelDeal.label_id'] = $labelId;
            $options[] = array(
                'table' => 'label_deals',
                'alias' => 'LabelDeal',
                'type' => 'inner',
                'conditions' => array(
                    'LabelDeal.deal_id = Deal.id'
                )
            );
        }
        if ($userGId == 2) {
            $conditions['Deal.group_id'] = $this->Auth->user('group_id');
            $userId = '';
        }
        if (!empty($userId)) {
            $conditions['UserDeal.user_id'] = $userId;
            $options[] = array(
                'table' => 'user_deals',
                'alias' => 'UserDeal',
                'type' => 'INNER',
                'foreignKey' => false,
                'conditions' => array(
                    'UserDeal.deal_id = Deal.id'
                )
            );
        }
        $conditions['Deal.status'] = '0';
        $options[] = array(
            'alias' => 'Pipeline',
            'table' => 'pipeline',
            'type' => 'LEFT',
            'conditions' => 'Pipeline.id = Deal.pipeline_id'
        );
        $options[] = array(
            'alias' => 'Stage',
            'table' => 'stages',
            'type' => 'LEFT',
            'conditions' => 'Stage.id = Deal.stage_id'
        );
        $options[] = array(
            'alias' => 'User',
            'table' => 'users',
            'type' => 'LEFT',
            'conditions' => 'User.id = Deal.user_id'
        );
        $options[] = array(
            'alias' => 'Company',
            'table' => 'company',
            'type' => 'LEFT',
            'conditions' => 'Company.id = Deal.company_id'
        );
        $deals = $this->Deal->find('all', array(
            'conditions' => $conditions,
            'joins' => $options,
            'order' => 'Deal.id desc',
            'fields' => array('Deal.id', 'Deal.name', 'Deal.price', 'Deal.created', 'Pipeline.name', 'Stage.name', 'User.first_name', 'User.last_name', 'Company.name'),
        ));

        foreach ($deals as &$row):
            $row['Users'] = $this->UserDeal->getUsersDeal($row['Deal']['id']);  //get assign user to deal
            $row['Contacts'] = $this->ContactDeal->getContactCount($row['Deal']['id']);  //get assign contacts to deal
            $row['Sources'] = $this->SourceDeal->getSourceCount($row['Deal']['id']);  //get assign sources to deal
            $row['Tasks'] = $this->Task->getTasksCount($row['Deal']['id']);  //get assign taks to deal
            $row['Products'] = $this->ProductDeal->getProductCount($row['Deal']['id']);  //get assign products to deal
        endforeach;


        //set variables to view
        $this->set(compact('deals', 'labels', 'pipelineId'));

        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $this->render('/Elements/deals');
        }
    }

    /**
     * This function is used to display deal view page.
     *
     * @return array
     */
    public function view($id = Null)
    {
        $userId = $this->Auth->user('id');
        $deal = $this->Deal->getDealForView($id);
        // check if deal exist
        if (!$deal) {
            return $this->redirect(
                    array('controller' => 'admins', 'action' => 'index')
            );
        }

        // check for user if deal is assign
        if (!$this->checkAdmin()) {
            if ($this->checkManager()):
                $groupId = $this->Auth->user('group_id');
                $assign = $this->Deal->getDealByGroup($groupId, $id);
            elseif ($this->checkStaff()):
                $assign = $this->UserDeal->getUserDeal($id, $userId);
            else:
                return $this->redirect(
                        array('controller' => 'deals', 'action' => 'client')
                );
            endif;

            if (!$assign) {
                //redirect to dashboard
                return $this->redirect(
                        array('controller' => 'admins', 'action' => 'index')
                );
            }
        }
        //check if deal is won/loss
        if ($deal['Deal']['status'] != 0) {
            return $this->redirect(
                    array('controller' => 'deals', 'action' => 'history', $deal['Deal']['id'])
            );
        }
        $sources = $this->Source->getSourcesByDeal($id); //get assing sources to deal
        $contacts = $this->Contact->getContactsByDeal($id); //get assing contacts to deal
        $products = $this->Product->getProductsByDeal($id);  //get assing products to deal
        $members = $this->User->getUsersByDeal($id);  //get assing users to deal
        $files = $this->AppFile->getFilesByDeal($id);  //get assing files to deal
        $note = $this->NoteDeal->getNote($id, $userId);  //get assing notes to deal
        $tasks = $this->Task->getTasksByDeal($id);  //get assing tasks to deal
        $countActivity = $this->Timeline->getTimelineCount($id);  // count activity
        $limit = 10;
        $total_pages = ceil($countActivity / $limit);
        $activity = $this->Timeline->getAllByDeal($id, $limit, null); //get all activity in deal
        $labels = $this->LabelDeal->getLabelDeal($id);  //get assing labels to deal
        $custom = $this->Custom->getDealCF($id);  //get deal custom fields
        $company = $this->Company->getCompanyDeal($deal['Deal']['company_id']); //get aasign company
        $groupMembers = $this->User->getUserByGroup($deal['Deal']['group_id']); //get group members
        //set task to calender
        $task_cal = array();
        foreach ($tasks as $row) {
            switch ($row['Task']['motive']) {
                case "1":
                    $motive = 'envelope';
                    break;
                case "2":
                    $motive = 'briefcase';
                    break;
                case "3":
                    $motive = 'phone';
                    break;
                case "4":
                    $motive = 'child';
                    break;
                case "5":
                    $motive = 'tasks';
                    break;
                case "6":
                    $motive = 'quote-left';
                    break;
                case "7":
                    $motive = 'file-archive-o';
                    break;
                case "8":
                    $motive = 'file-question-circle';
                    break;
            }
            if ($row['Task']['status'] == 0):
                $task_cal[] = array(
                    'id' => $row['Task']['id'],
                    'title' => "" . $row['Task']['task'],
                    'start' => $row['Task']['date'],
                    'icon' => $motive,
                );
            endif;
        }
        $task_cal = json_encode($task_cal);


        //set variables to view
        $this->set(compact('deal', 'sources', 'contacts', 'products', 'members', 'files', 'note', 'tasks', 'activity', 'labels', 'total_pages', 'custom', 'task_cal', 'company', 'groupMembers'));
    }

    /**
     *  This function is used to load more activity on load more click
     *
     * @return void
     */
    public function more($page = null)
    {
        $limit = 15;
        $page = $this->params['url']['page'];
        $dealId = $this->params['url']['deal'];
        //get all activity of deal
        $activity = $this->Timeline->getAllByDeal($dealId, $limit, $page);
        //set activity variable to view
        $this->set(compact('activity'));

        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $this->render('/Elements/activity');
        }
    }

    /**
     * This function is used to add new deal to application.
     *
     * @return void
     */
    public function add()
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->Deal->create();
            $this->request->data['Deal']['user_id'] = $this->Auth->User('id');
            $groupId = $this->Auth->User('group_id');
            if ($groupId) {
                $this->request->data['Deal']['group_id'] = $groupId;
            }
            //save new deal
            if ($this->Deal->save($this->request->data)) {
                $dealId = $this->Deal->getLastInsertId();
                //activity for add new deal
                $this->activity($dealId, $this->request->data['Deal']['name'], 'add_Deal');
                //assign add user to deal
                $data = array('user_id' => $this->Auth->user('id'), 'deal_id' => $dealId);
                $this->UserDeal->save($data);

                //custom fields
                $custom = $this->Custom->getDealFieldsId();
                foreach ($custom as $row):
                    $this->CustomDeal->create();
                    $this->request->data['CustomDeal']['custom_id'] = $row['Custom']['id'];
                    $this->request->data['CustomDeal']['deal_id'] = $dealId;
                    $this->request->data['CustomDeal']['value'] = $this->request->data['Custom']['value' . $row['Custom']['id']];
                    $this->CustomDeal->save($this->request->data);
                endforeach;
                //save sources
                if (isset($this->request->data['Deal']['sources'])):
                    foreach ($this->request->data['Deal']['sources'] as $value):
                        $this->SourceDeal->create();
                        $this->request->data['SourceDeal']['source_id'] = $value;
                        $this->request->data['SourceDeal']['deal_id'] = $dealId;
                        $this->SourceDeal->save($this->request->data);
                        //get source
                        $source = $this->Source->getSourceById($value);
                        //activity for add source
                        $this->activity($dealId, $source['Source']['name'], 'add_Source');
                    endforeach;
                endif;
                //save products
                if (isset($this->request->data['Deal']['products'])):
                    foreach ($this->request->data['Deal']['products'] as $value):
                        $this->ProductDeal->create();
                        $this->request->data['ProductDeal']['product_id'] = $value;
                        $this->request->data['ProductDeal']['deal_id'] = $dealId;
                        $this->ProductDeal->save($this->request->data);
                        //get product
                        $product = $this->Product->getProductsForDeal($value);
                        //activity for assign product
                        $this->activity($dealId, $product['Product']['name'], 'add_Product');
                    endforeach;
                endif;
                //save contacts
                if (isset($this->request->data['Deal']['contacts'])):
                    foreach ($this->request->data['Deal']['contacts'] as $value):
                        $this->ContactDeal->create();
                        $this->request->data['ContactDeal']['contact_id'] = $value;
                        $this->request->data['ContactDeal']['deal_id'] = $dealId;
                        $this->ContactDeal->save($this->request->data);
                        //get contact
                        $contact = $this->Contact->getContactById($value);
                        //save contact assign activity
                        $this->activity($dealId, $contact['Contact']['name'], 'add_Contact');
                    endforeach;
                endif;
                //save notes
                if (isset($this->request->data['Deal']['notes'])):
                    $this->NoteDeal->create();
                    $this->request->data['NoteDeal']['note'] = $this->request->data['Deal']['notes'];
                    $this->request->data['NoteDeal']['user_id'] = $this->Auth->user('id');
                    $this->request->data['NoteDeal']['deal_id'] = $dealId;
                    $this->NoteDeal->save($this->request->data);
                endif;
                //success message 
                $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
            // check add from deals list
            if (isset($this->request->data['Deal']['actions']) == 'list') {
                //redirect to deals list page
                return $this->redirect(
                        array('controller' => 'deals', 'action' => 'index')
                );
            } else {
                //redirect to dashboard
                return $this->redirect(
                        array('controller' => 'admins', 'action' => 'index')
                );
            }
        }
    }

    /**
     * This function is used to update deal name,price.
     *
     * @return json
     */
    public function edit()
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            //get deal details
            $deal = $this->Deal->getDealById($this->request->data['Deal']['id']);

            //save deal deatials
            $success = $this->Deal->save($this->request->data);
            if ($success) {
                if ($this->request->data['Deal']['name'] != $deal['Deal']['name']) {
                    //activity for change deal name
                    $activity = $deal['Deal']['name'] . ' to ' . $this->request->data['Deal']['name'];
                    $this->activity($this->request->data['Deal']['id'], $activity, 'rename_Deal');
                }
                if ($this->request->data['Deal']['price'] != $deal['Deal']['price']) {
                    //activity for change deal price
                    $activity = $this->Auth->user('currency_symbol') . '' . $deal['Deal']['price'] . ' to ' . $this->Auth->user('currency_symbol') . '' . $this->request->data['Deal']['price'];
                    $this->activity($this->request->data['Deal']['id'], $activity, 'change_Price');
                }
            }
        }
        //redirect to deal view
        return $this->redirect(
                array('controller' => 'deals', 'action' => 'view', $this->request->data['Deal']['id'])
        );
    }

    /**
     * This function is used to update deal permission for clients.
     *
     * @return json
     */
    public function permission()
    {
        // autorender off for view
        $this->autoRender = false;
        //common variable
        $this->request->data['Deal']['permission'] = ($this->request->data['Deal']['permission']) ? implode(',', $this->request->data['Deal']['permission']) : '';
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            //save deal deatials
            $success = $this->Deal->save($this->request->data);
        }
        //redirect to deal view
        return $this->redirect(
                array('controller' => 'deals', 'action' => 'view', $this->request->data['Deal']['id'])
        );
    }

    /**
     * This function is used to update deal name,price.
     *
     * @return json
     */
    public function update_pipeline()
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            //get deal details
            $deal = $this->Deal->getDealById($this->request->data['Deal']['id']);
            //save deal
            $success = $this->Deal->save($this->request->data);
            if ($success) {
                //activity for deal pipeline changed
                $fromPipeline = $this->Pipeline->getPipelineName($deal['Deal']['pipeline_id']);
                $pipeline = $this->Pipeline->getPipelineName($this->request->data['Deal']['pipeline_id']);
                $activity = $fromPipeline['Pipeline']['name'] . ' to ' . $pipeline['Pipeline']['name'];
                $this->activity($this->request->data['Deal']['id'], $activity, 'move_Pipeline');
                $this->Flash->success('Pipeline has been changed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            }
            //redirect to deal view
            return $this->redirect(
                    array('controller' => 'deals', 'action' => 'view', $this->request->data['Deal']['id'])
            );
        }
    }

    /**
     * This function is used to delete deal.
     *
     * @return void
     */
    public function delete()
    {
        // autorender off for view
        $this->autoRender = false;
        $dealId = $this->request->data['Deal']['id'];
        if (!empty($dealId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //get deal before delete
                $deal = $this->Deal->getDealById($dealId);
                //delete deal
                $success = $this->Deal->delete($dealId, false);
                if ($success) {
                    $this->NoteDeal->deleteAll(array('NoteDeal.deal_id' => $dealId)); //delete  note in deal
                    $this->LabelDeal->deleteAll(array('LabelDeal.deal_id' => $dealId)); //delete assign labels in deal
                    $this->Task->deleteAll(array('Task.deal_id' => $dealId));  //delete assign tasks in deal
                    $this->SourceDeal->deleteAll(array('SourceDeal.deal_id' => $dealId));  //delete assign source in deal
                    $this->ProductDeal->deleteAll(array('ProductDeal.deal_id' => $dealId)); //delete assign products in deal
                    $this->ContactDeal->deleteAll(array('ContactDeal.deal_id' => $dealId));  //delete assign contacts in deal
                    $this->UserDeal->deleteAll(array('UserDeal.deal_id' => $dealId));  //delete assign users in deal
                    $this->Discussion->deleteAll(array('Discussion.deal_id' => $dealId));  //delete discussion in deal
                    //activity for delete deal
                    $this->activity($dealId, $deal['Deal']['name'], 'unlink_Deal');
                    //delete files in deal
                    $files = $this->AppFile->getFilesByDealDelete($dealId);
                    foreach ($files as $row):
                        $fullpath = WWW_ROOT . "files/deal/" . $row['File']['name'];
                        if (file_exists($fullpath)):
                            unlink($fullpath);
                        endif;
                        $this->AppFile->delete(array('id' => $row['File']['id']), true);
                    endforeach;
                    //check if deleting from list/dashboard
                    if (isset($this->request->data['Deal']['actions']) == 'list') {
                        //return json success message
                        $response = array('bug' => 0, 'msg' => 'success', 'vId' => $dealId);
                        return json_encode($response);
                    } else {
                        //redirect to dashboard
                        return $this->redirect(array('controller' => 'admins', 'action' => 'index'));
                    }
                } else {
                    //redirect to dashboard
                    return $this->redirect(array('controller' => 'admins', 'action' => 'index'));
                }
            }
        }
    }

    /**
     * This function is used to update stage of the deal.
     *
     * @return void
     */
    public function stage()
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            //common variables
            $this->request->data['Deal']['id'] = $this->request->data['dealId'];
            $this->request->data['Deal']['stage_id'] = $this->request->data['stageId'];
            //update deal stage
            if ($this->Deal->save($this->request->data)) {
                //activity for change stage of deal
                $fromStage = $this->Stage->getStageName($this->request->data['parentId']);
                $stage = $this->Stage->getStageName($this->request->data['stageId']);
                $activity = $fromStage['Stage']['name'] . ' to ' . $stage['Stage']['name'];
                $this->activity($this->request->data['dealId'], $activity, 'move_Stage');
            }
        }
    }

    /**
     * This function is used to display won deal page.
     *
     * @return array
     */
    public function won()
    {
        //pagination conditions for getting won deals
        $limit = 20;
        $conditions = array();
        if ($this->checkManager()) {
            $conditions['History.group_id'] = $this->Auth->user('group_id');
        } elseif ($this->checkStaff()) {
            $conditions['History.user_id'] = $this->Auth->user('id');
        }
        $conditions['History.status'] = '1';
        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'order' => 'History.id desc',
            'fields' => array('History.*'),
        );
        $deals = $this->paginate('History');
        //set deals variable to view
        $this->set(compact('deals'));

        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->request->data['Deal']['status'] = 1;
            $dealId = $this->request->data['Deal']['id'];
            //seve deal as won
            if ($this->Deal->save($this->request->data)) {
                //get deal
                $deal = $this->Deal->getDealById($dealId);
                //get pipeline
                $pipeline = $this->Pipeline->find('first', array('conditions' => array('Pipeline.id' => $deal['Deal']['pipeline_id']), 'fields' => array('Pipeline.name')));
                //get stage
                $stage = $this->Stage->find('first', array('conditions' => array('Stage.id' => $deal['Deal']['stage_id']), 'fields' => array('Stage.name')));
                //common variables for history
                $this->request->data['History']['deal_id'] = $dealId;
                $this->request->data['History']['deal_name'] = $deal['Deal']['name'];
                $this->request->data['History']['pipeline'] = $pipeline['Pipeline']['name'];
                $this->request->data['History']['stage'] = $stage['Stage']['name'];
                $this->request->data['History']['user'] = $this->Auth->user('name');
                $this->request->data['History']['user_id'] = $this->Auth->user('id');
                $this->request->data['History']['group_id'] = $deal['Deal']['group_id'];
                $this->request->data['History']['status'] = 1;
                $this->History->create();
                //save deal as won 
                $this->History->save($this->request->data);
                //activity for won deal
                $this->activity($dealId, $deal['Deal']['name'], 'won_Deal');
                //redirect to  won deals page
                return $this->redirect(
                        array('controller' => 'deals', 'action' => 'won')
                );
            }
        }

        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $this->render('/Elements/history');
        }
    }

    /**
     * This function is used to display lost deal page.
     *
     * @return array
     */
    public function loss()
    {
        //pagination conditions for getting loss deals
        $limit = 20;
        $conditions = array();
        if ($this->checkManager()) {
            $conditions['History.group_id'] = $this->Auth->user('group_id');
        } elseif ($this->checkStaff()) {
            $conditions['History.user_id'] = $this->Auth->user('id');
        }
        $conditions['History.status'] = '2';
        $this->paginate = array(
            'conditions' => $conditions,
            'limit' => $limit,
            'order' => 'History.id desc',
            'fields' => array('History.*'),
        );
        $deals = $this->paginate('History');
        //set deals variable to view
        $this->set(compact('deals'));

        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->request->data['Deal']['status'] = 2;
            $dealId = $this->request->data['Deal']['id'];
            //mark deal as lost
            if ($this->Deal->save($this->request->data)) {
                //get deal
                $deal = $this->Deal->getDealById($dealId);
                //get pipeline
                $pipeline = $this->Pipeline->find('first', array('conditions' => array('Pipeline.id' => $deal['Deal']['pipeline_id']), 'fields' => array('Pipeline.name')));
                //get stage
                $stage = $this->Stage->find('first', array('conditions' => array('Stage.id' => $deal['Deal']['stage_id']), 'fields' => array('Stage.name')));
                //common history variables
                $this->request->data['History']['deal_id'] = $dealId;
                $this->request->data['History']['deal_name'] = $deal['Deal']['name'];
                $this->request->data['History']['pipeline'] = $pipeline['Pipeline']['name'];
                $this->request->data['History']['stage'] = $stage['Stage']['name'];
                $this->request->data['History']['user'] = $this->Auth->user('name');
                $this->request->data['History']['user_id'] = $this->Auth->user('id');
                $this->request->data['History']['group_id'] = $deal['Deal']['group_id'];
                $this->request->data['History']['status'] = 2;
                $this->History->create();
                //save deal in history
                $this->History->save($this->request->data);
                //activity for loss deal
                $this->activity($dealId, $deal['Deal']['name'], 'loss_Deal');
                //redirect to deals loss page
                return $this->redirect(
                        array('controller' => 'deals', 'action' => 'loss')
                );
            }
        }

        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $this->render('/Elements/history');
        }
    }

    /**
     * This function is used to make deal active from won/loss.
     *
     * @return void
     */
    public function active($Id = null)
    {
        // autorender off for view
        $this->autoRender = false;
        //check deal from history
        $history = $this->History->findById($Id);
        $dealId = $history['History']['deal_id'];
        $this->Deal->id = $dealId;
        //update deal status to active
        $result = $this->Deal->saveField('status', '0');
        if ($result) {
            //activity for deal active 
            $this->activity($dealId, $history['History']['deal_name'], 'make_active');
            //delete deal from history
            $this->History->delete($Id);
            //redirect to dashboard
            return $this->redirect(
                    array('controller' => 'admins', 'action' => 'index')
            );
        }
    }

    /**
     * This function is used to display history of won and loss deals
     *
     * @return array
     */
    public function history($id = Null)
    {
        // check for user if deal is assign
        if (!$this->checkAdmin()) {
            if ($this->checkManager()):
                $groupId = $this->Auth->user('group_id');
                $assign = $this->Deal->getDealByGroup($groupId, $id);
            else:
                $assign = $this->UserDeal->getUserDeal($id, $userId);
            endif;

            if (!$assign) {
                //redirect to dashboard
                return $this->redirect(
                        array('controller' => 'admins', 'action' => 'index')
                );
            }
        }
        $userId = $this->Auth->user('id');
        $deal = $this->Deal->getDealById($id);   //get deal details


        $sources = $this->Source->getSourcesByDeal($id); //get assing sources to deal
        $contacts = $this->Contact->getContactsByDeal($id); //get assing contacts to deal
        $products = $this->Product->getProductsByDeal($id);  //get assing products to deal
        $members = $this->User->getUsersByDeal($id);  //get assing users to deal
        $files = $this->AppFile->getFilesByDeal($id);  //get assing files to deal
        $note = $this->NoteDeal->getNote($id, $userId);  //get assing notes to deal
        $tasks = $this->Task->getTasksByDeal($id);  //get assing tasks to deal
        $countActivity = $this->Timeline->getTimelineCount($id);  // count activity
        $limit = 10;
        $total_pages = ceil($countActivity / $limit);
        $activity = $this->Timeline->getAllByDeal($id, $limit, null); //get all activity in deal
        $labels = $this->LabelDeal->getLabelDeal($id);  //get assing labels to deal
        $Pipe = $this->Pipeline->getPipelineName($deal['Deal']['pipeline_id']); //get pipeline name
        $stage = $this->Stage->getStageName($deal['Deal']['stage_id']); //get stage name
        $custom = $this->Custom->getDealCF($id);  //get deal custom fields
        $company = $this->Company->getCompanyDeal($deal['Deal']['company_id']); //get aasign company
        $Discussions = $this->Discussion->getMessageByDeal($id, 1); //get discussion in deal 
        //get child message       
        foreach ($Discussions as &$row):
            $row['childs'] = $this->Discussion->getMessageByParent($row['Discussion']['id']); //get discussion  reply in deal
        endforeach;
        $feedback = $this->Discussion->getMessageByDeal($id, 2); //get discussion in deal 
        //get child message       
        foreach ($feedback as &$row):
            $row['childs'] = $this->Discussion->getMessageByParent($row['Discussion']['id']); //get discussion  reply in deal
        endforeach;
        $invoices = $this->Invoice->getInvoiceForDeal($id);

        //set variables for view
        $this->set(compact('deal', 'sources', 'contacts', 'products', 'members', 'files', 'note', 'tasks', 'activity', 'labels', 'Discussions', 'feedback', 'invoices'));
    }

    /**
     * This function is used to search deals for search box type.
     *
     * @return json
     */
    public function search()
    {
        // autorender off for view
        $this->autoRender = false;
        if (isset($_GET['name'])) {
            $name = $_GET['name'];
            $userId = ($this->checkAdmin()) ? '' : $this->Auth->user('id');
            //get deals name like  search kayword
            $result = $this->Deal->getFind($name, $userId);
            foreach ($result as $row) {
                $res[] = array('id' => $row['Deal']['id'], 'name' => $row['Deal']['name']);
            }
            //return deal names in json
            echo json_encode($res);
        }
    }

    /**
     * This function is used to get discussion & customer feedback by type.
     *
     * @return html
     */
    public function discussions()
    {
        // autorender off for view
        $this->autoRender = false;
        $dealId = $this->params['url']['deal'];
        $type = $this->params['url']['type'];
        $deal = $this->Deal->getDealById($dealId);
        $Discussions = $this->Discussion->getMessageByDeal($dealId, $type); //get discussion in deal 
        //get child message       
        foreach ($Discussions as &$row):
            $row['childs'] = $this->Discussion->getMessageByParent($row['Discussion']['id']); //get discussion  reply in deal
        endforeach;

        //set variables to view
        $this->set(compact('deal', 'Discussions'));
        if ($type == 1) {
            $this->render('/Elements/discussion');
        } else {
            $this->render('/Elements/deal-feedback');
        }
    }

    /**
     * This function is used to get invoices for deal.
     *
     * @return html
     */
    public function invoices()
    {
        // autorender off for view
        $this->autoRender = false;
        $dealId = $this->params['url']['deal'];
        //get invoices in deal
        $invoices = $this->Invoice->getInvoiceForDeal($dealId);
        //set variables to view
        $this->set(compact('invoices'));
        $this->render('/Elements/deal-data');
    }

    /**
     * This function is used to get invoices for deal.
     *
     * @return html
     */
    public function box()
    {
        // autorender off for view
        $this->autoRender = false;
        $box = 1;

        $sources = $this->Source->getSourceList();
        $products = $this->Product->getProductList();
        $contacts = $this->Contact->getContactList();
        //get all deal custom fields
        $custom = $this->Custom->getDealFieldsId();
        if ($this->checkAdmin()):
            $companies = $this->Company->getCompanyList();
        else:
            $groupId = $this->Auth->user('group_id');
            $companies = $this->Company->getCompaniesByGroup($groupId);
        endif;
        //get groups
        $groups = $this->UserGroup->getGroupList();
        //set variables to view
        $this->set(compact('box', 'sources', 'custom', 'products', 'contacts', 'companies', 'groups'));
        $this->render('/Elements/modal');
    }

    /**
     * This function is used to display list of deals for clients only.
     *
     * @var array
     */
    public function client()
    {
        $companyId = $this->Auth->user('company_id');

        // conditions for getting all deals
        $conditions = array();
        $options = array();
        $conditions['Deal.company_id'] = $companyId;

        $options[] = array(
            'alias' => 'User',
            'table' => 'users',
            'type' => 'LEFT',
            'conditions' => 'User.id = Deal.user_id'
        );
        $options[] = array(
            'alias' => 'Company',
            'table' => 'company',
            'type' => 'LEFT',
            'conditions' => 'Company.id = Deal.company_id'
        );
        $deals = $this->Deal->find('all', array(
            'conditions' => $conditions,
            'joins' => $options,
            'order' => 'Deal.id desc',
            'fields' => array('Deal.id', 'Deal.name', 'Deal.price', 'Deal.created', 'User.first_name', 'User.last_name', 'Company.name'),
        ));



        //set variables to view
        $this->set(compact('deals', 'labels', 'pipelineId'));
    }

    /**
     * This function is used to display deal view page for clients.
     *
     * @return array
     */
    public function cview($id = Null)
    {
        $userId = $this->Auth->user('id');
        $deal = $this->Deal->getDealForView($id);
        // check if deal exist
        if (!$deal) {
            return $this->redirect(
                    array('controller' => 'deals', 'action' => 'client')
            );
        }

        // check for user if deal is assign
        if ($this->checkClient()) {
            $companyId = $this->Auth->user('company_id');
            $assign = $this->Deal->checkDealByCompany($companyId, $id);
            if (!$assign) {
                //redirect to dashboard
                return $this->redirect(
                        array('controller' => 'deals', 'action' => 'client')
                );
            }
        }
        $sources = $this->Source->getSourcesByDeal($id); //get assing sources to deal
        $contacts = $this->Contact->getContactsByDeal($id); //get assing contacts to deal
        $products = $this->Product->getProductsByDeal($id);  //get assing products to deal
        $members = $this->User->getUsersByDeal($id);  //get assing users to deal
        $files = $this->AppFile->getFilesByDeal($id);  //get assing files to deal
        $note = $this->NoteDeal->getNote($id, $userId);  //get assing notes to deal
        $tasks = $this->Task->getTasksByDeal($id);  //get assing tasks to deal
        $countActivity = $this->Timeline->getTimelineCount($id);  // count activity
        $limit = 10;
        $total_pages = ceil($countActivity / $limit);
        $activity = $this->Timeline->getAllByDeal($id, $limit, null); //get all activity in deal
        $labels = $this->LabelDeal->getLabelDeal($id);  //get assing labels to deal
        $custom = $this->Custom->getDealCF($id);  //get deal custom fields
        $company = $this->Company->getCompanyDeal($deal['Deal']['company_id']); //get aasign company
        $groupMembers = $this->User->getUserByGroup($deal['Deal']['group_id']); //get group members
        $dealPermission = explode(',', $deal['Deal']['permission']);
        //set task to calender
        $task_cal = array();
        foreach ($tasks as $row) {
            switch ($row['Task']['motive']) {
                case "1":
                    $motive = 'envelope';
                    break;
                case "2":
                    $motive = 'briefcase';
                    break;
                case "3":
                    $motive = 'phone';
                    break;
                case "4":
                    $motive = 'child';
                    break;
                case "5":
                    $motive = 'tasks';
                    break;
                case "6":
                    $motive = 'quote-left';
                    break;
                case "7":
                    $motive = 'file-archive-o';
                    break;
                case "8":
                    $motive = 'file-question-circle';
                    break;
            }
            if ($row['Task']['status'] == 0):
                $task_cal[] = array(
                    'id' => $row['Task']['id'],
                    'title' => "" . $row['Task']['task'],
                    'start' => $row['Task']['date'],
                    'icon' => $motive,
                );
            endif;
        }
        $task_cal = json_encode($task_cal);


        //set variables to view
        $this->set(compact('deal', 'sources', 'contacts', 'products', 'members', 'files', 'note', 'tasks', 'activity', 'labels', 'total_pages', 'custom', 'task_cal', 'company', 'groupMembers', 'dealPermission'));
    }
}

/* End of file DealsController.php */
/* Location: ./app/Controller/DealsController.php */