<?php

/**
 * Class for performing all task related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class TasksController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('Task', 'Deal', 'User');

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
     *  This function is used to display my task page and list of tasks
     *
     * @return array
     */
    public function index()
    {
        $limit = 5;
        $userId = $this->Auth->user('id');

        //--------- Post request  -----------
        if ($this->request->isPost()) {
            $pipelineId = $this->request->data['Task']['pipeline_id'];
            $motive = $this->request->data['Task']['motive'];
        } else {
            $pipelineId = null;
            $motive = null;
        }
        //get missed tasks
        $missedTask = $this->Task->getMissedTask($userId, $pipelineId, $motive);
        //get todat tasks
        $todayTask = $this->Task->getTodayTask($userId, $pipelineId, $motive);
        //get later taks
        $tasks = $this->Task->getComingTask($userId, $limit, null, $pipelineId, $motive);
        //count later task
        $countTask = $this->Task->getTaskCount($userId, $pipelineId, $motive);
        $total_pages = ceil($countTask / $limit);
        //get deals by user
        $deals = $this->Deal->getDealsByUser($userId);

        //get users
        $type = array(1, 2, 3);
        $users = $this->User->getUserByType($type);
        //set variables for view
        $this->set(compact('missedTask', 'todayTask', 'tasks', 'total_pages', 'deals', 'users'));

        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $this->render('/Elements/tasks');
        }
    }

    /**
     * This function is used to Load coming task on load more click
     *
     * @return array
     */
    public function more($page = null)
    {
        $date = date('Y-m-d');
        $limit = 5;
        $userId = $this->Auth->user('id');
        $page = $this->params['url']['page'];
        $pipelineId = $this->params['url']['pipeline'];
        $motive = $this->params['url']['motive'];
        //get later tasks
        $tasks = $this->Task->getComingTask($userId, $limit, $page, $pipelineId, $motive);
        //set variable for view
        $this->set(compact('tasks'));

        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $this->render('/Elements/tasks');
        }
    }

    /**
     *  This function is used to display my task page and dashboard of tasks
     *
     * @return array
     */
    public function dashboard()
    {
        $this->layout = 'home';
        $userId = $this->Auth->user('id');

        //--------- Post request  -----------
        if ($this->request->isPost()) {
            $pipelineId = $this->request->data['Task']['pipeline_id'];
            $motive = $this->request->data['Task']['motive'];
        } else {
            $pipelineId = null;
            $motive = null;
        }
        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->autoRender = false;
            $this->layout = 'ajax';
            // $this->render('/Elements/tasks');
            $this->request->data['Task']['id'] = $this->request->query['taskId'];
            $stageId = $this->request->query['stageId'];
            $parentId = $this->request->query['parentId'];
            $today = date('Y-m-d');
            if ($stageId == '1'):
                $this->request->data['Task']['date'] = date('Y-m-d', strtotime($today . ' -1 day'));
            elseif ($stageId == '2'):
                $this->request->data['Task']['date'] = $today;
            elseif ($stageId == '3'):
                $this->request->data['Task']['date'] = date('Y-m-d', strtotime($today . ' +1 day'));
            elseif ($stageId == '4'):
                $this->request->data['Task']['date'] = date('Y-m-d', strtotime($today . ' +2 day'));
            endif;
            if ($this->Task->save($this->request->data)) {
                //return json success message
                $response = array('bug' => 0, 'msg' => 'success', 'date' => $this->request->data['Task']['date']);
                return json_encode($response);
            } else {
                //return json failure message
                $response = array('bug' => 1, 'msg' => 'failure');
                return json_encode($response);
            }
            exit;
        }
        //get missed tasks
        $missedTask = $this->Task->getMissedTaskD($userId, '0', $motive);
        //get todat tasks
        $todayTask = $this->Task->getTodayTaskD($userId, '0', $motive);
        //get tommorow task
        $tomorrow_timestamp = strtotime('+1 day', strtotime('2013-01-22'));
        $tomorrowTask = $this->Task->getTommorowTaskD($userId, '0', $motive);
        //get later taks
        $tasks = $this->Task->getComingTaskD($userId, '0', $motive);

        //get deals by user
        $deals = $this->Deal->getDealsByUser($userId);

        //get users
        if ($this->checkAdmin()):
            $type = array(1, 2, 3);
            $users = $this->User->getUserByType($type);
        else:
            $users = '';
        endif;

        //set variables for view
        $this->set(compact('missedTask', 'todayTask', 'tasks', 'deals', 'tomorrowTask', 'users'));
    }

    /**
     * This function is used to display all tasks to admin and filter task with various attributes
     *
     * @return void
     */
    public function lists()
    {
        //check if admin
        $this->isAdminManager();
        //get user group type
        $userGId = $this->Auth->user('user_group_id');
        $limit = 20;
        $conditions = array();
        //--------- Post/Ajax request  -----------
        if ($this->request->is('post') || $this->request->is('ajax')) {
            //--------- Post request  -----------
            if ($this->request->is('post')) {
                //set session variables
                if (!empty($this->request->data['Task']['pipeline_id'])) {
                    $this->Session->write('Task.pipeline_id', $this->request->data['Task']['pipeline_id']);
                } else {
                    $this->Session->delete('Task.pipeline_id');
                }
                if (!empty($this->request->data['Task']['user_id'])) {
                    $this->Session->write('Task.user_id', $this->request->data['Task']['user_id']);
                } else {
                    $this->Session->delete('Task.user_id');
                }
                if (!empty($this->request->data['Task']['motive'])) {
                    $this->Session->write('Task.motive', $this->request->data['Task']['motive']);
                } else {
                    $this->Session->delete('Task.motive');
                }
            }
            //read session variables
            if ($this->Session->check('Task.pipeline_id')) {
                $conditions['Deal.pipeline_id'] = $this->Session->read('Task.pipeline_id');
            }
            if ($this->Session->check('Task.user_id')) {
                $conditions['Task.user_id'] = $this->Session->read('Task.user_id');
            }
            if ($this->Session->check('Task.motive')) {
                $conditions['Task.motive'] = $this->Session->read('Task.motive');
            }
        } else {
            $this->Session->delete('Task');
        }
        if ($userGId == 2) {
            $groupId = $this->Auth->user('group_id');
            $conditions['Deal.group_id'] = $groupId;
        }
        //get all tasks list
        $this->paginate = array(
            'conditions' => $conditions,
            'joins' => array(
                array(
                    'alias' => 'Deal',
                    'table' => 'deal',
                    'type' => 'INNER',
                    'conditions' => 'Deal.id = Task.deal_id'
                ),
                array(
                    'alias' => 'Pipeline',
                    'table' => 'pipeline',
                    'type' => 'LEFT',
                    'conditions' => 'Pipeline.id = Deal.pipeline_id'
                ),
                array(
                    'alias' => 'User',
                    'table' => 'users',
                    'type' => 'LEFT',
                    'conditions' => 'User.id = Task.user_id'
                )
            ),
            'limit' => $limit,
            'order' => array('Task.status' => 'asc', 'Task.date' => 'desc'),
            'fields' => array('Task.*', 'Deal.name', 'Pipeline.name', 'User.first_name', 'User.last_name'),
        );
        $tasks = $this->paginate('Task');

        //get all deals
        $deals = $this->Deal->getAllActiveDeals($groupId);
        //set variables for view
        $this->set(compact('tasks', 'deals'));

        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $this->render('/Elements/tasks_list');
        }
    }

    /**
     * This function is used to add new task from my task
     *
     * @var void
     */
    public function add()
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Post request  -----------
        if ($this->request->isPost()) {
            $this->Task->create();
            //common variables
            $this->request->data['Task']['date'] = date('Y-m-d', strtotime($this->request->data['Task']['date']));
            $this->request->data['Task']['time'] = date('h:i:s', strtotime($this->request->data['Task']['time']));
            if (empty($this->request->data['Task']['user_id'])):
                $this->request->data['Task']['user_id'] = $this->Auth->user('id');
            endif;
            //save task
            if ($this->Task->save($this->request->data)) {
                //activity for add task
                $this->activity($this->request->data['Task']['deal_id'], $this->request->data['Task']['task'], 'add_Task');
                //success message
                $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
            //redirect to my task  page
            if ($this->request->data['Task']['page'] == 'dashboard'):
                return $this->redirect(array('controller' => 'tasks', 'action' => 'dashboard'));
            else:
                return $this->redirect(array('controller' => 'tasks', 'action' => 'index'));
            endif;
        }
    }

    /**
     * This function is used to add new task from all task by admin
     *
     * @return void
     */
    public function addAll()
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Post request  -----------
        if ($this->request->isPost()) {
            $this->Task->create();
            $this->request->data['Task']['date'] = date('Y-m-d', strtotime($this->request->data['Task']['date']));
            $this->request->data['Task']['time'] = date('H:i:s', strtotime($this->request->data['Task']['time']));
            if (empty($this->request->data['Task']['user_id'])):
                $this->request->data['Task']['user_id'] = $this->Auth->user('id');
            endif;
            //save task
            if ($this->Task->save($this->request->data)) {
                //activity for add task
                $this->activity($this->request->data['Task']['deal_id'], $this->request->data['Task']['task'], 'add_Task');
                //success message
                $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
            //redirect to all task list page
            return $this->redirect(array('controller' => 'tasks', 'action' => 'lists'));
        }
    }

    /**
     * This function is used to add task in deal from deal view page
     *
     * @return void
     */
    public function deal()
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Post request  -----------
        if ($this->request->isPost()) {
            $this->Task->create();
            //common variables
            $this->request->data['Task']['date'] = date('Y-m-d', strtotime($this->request->data['Task']['date']));
            $this->request->data['Task']['user_id'] = $this->Auth->user('id');
            $this->request->data['Task']['time'] = date('h:m:s', strtotime($this->request->data['Task']['time']));
            //assing task to deal
            if ($this->Task->save($this->request->data)) {
                $taskId = $this->Task->getLastInsertID();
                //activity for add task
                $this->activity($this->request->data['Task']['deal_id'], $this->request->data['Task']['task'], 'add_Task');
                $task = $this->Task->getTasksForDeal($taskId);
                //set task variable to view
                $this->set(compact('task'));
                $this->render('/Elements/deal-data');
            }
        }
    }

    /**
     * This function is used to edit task  date or status
     *
     * @return void
     */
    public function edit()
    {
        // autorender off for view
        $this->autoRender = false;
        //common variables
        if (isset($this->params['url']['id'])) {
            $this->request->data['Task']['id'] = $this->params['url']['id'];
            $this->request->data['Task']['status'] = $this->params['url']['status'];
            $task = $this->Task->getTaskById($this->request->data['Task']['id']);
            $this->request->data['Task']['task'] = $task['Task']['task'];
            $this->request->data['Task']['deal_id'] = $task['Task']['deal_id'];
            $this->request->data['Task']['time'] = date('h:m:s', strtotime($this->request->data['Task']['time']));
        } else {
            $this->request->data['Task']['date'] = date('Y-m-d', strtotime($this->request->data['Task']['date']));
            $this->request->data['Task']['time'] = date('h:m:s', strtotime($this->request->data['Task']['time']));
        }
        //update task
        if ($this->Task->save($this->request->data)) {
            //activity for update task
            $this->activity($this->request->data['Task']['deal_id'], $this->request->data['Task']['task'], 'update_Task');

            $task = $this->Task->getTasksForDeal($this->request->data['Task']['id']);
            //set task variable to view
            $this->set(compact('task'));
            $data = $this->render('/Elements/deal-data');
            $arrays = array('vId' => $this->request->data['Task']['id'], 'html' => $data->body());
            $options = array(
                'type' => 'json',
                'body' => json_encode($arrays)
            );
            // return json variable
            return new CakeResponse($options);
        } else {
            //return json failure message
            $response = array('bug' => 1, 'msg' => 'failure');
            return json_encode($response);
        }
    }

    /**
     * This function is used to update task load modal
     *
     * @return array
     */
    public function update()
    {
        //--------- Post/Ajax request  -----------
        if ($this->request->is('post') && $this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            //autorender off for view
            $this->autoRender = false;
            $this->request->data['Task']['id'] = $this->params['url']['id'];
            //get task 
            $task = $this->Task->getTaskById($this->request->data['Task']['id']);
            $this->request->data = $task;
            //set variable to view
            $this->set(compact('task'));
            //view
            $this->render('/Elements/modal');
        }
    }

    /**
     * This function is used to delete task
     *
     * @return json
     */
    public function delete()
    {
        // autorender off for view
        $this->autoRender = false;
        $taskId = $this->request->data['Task']['id'];
        if (!empty($taskId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //get task
                $task = $this->Task->getTaskById($taskId);
                //delete task
                $success = $this->Task->delete($taskId, false);
                if ($success) {
                    //activity for delete task
                    $this->activity($task['Task']['deal_id'], $task['Task']['task'], 'unlink_Task');
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $taskId);
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
     * This function is used to unassign task from deal 
     *
     * @return json
     */
    public function unlink()
    {
        // autorender off for view
        $this->autoRender = false;
        //common variables
        $taskId = $this->request->data['Item']['id'];
        $dealId = $this->request->data['Deal']['id'];
        if (!empty($taskId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //get task
                $task = $this->Task->getTaskById($taskId);
                //delete task
                $success = $this->Task->delete($taskId, false);
                if ($success) {
                    //activity for delete task
                    $this->activity($dealId, $task['Task']['task'], 'unlink_Task');
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $taskId);
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
     * This function is used to get notifications tasks
     *
     * @return json
     */
    public function notifications()
    {
        $this->autoRender = false;
        $userId = $this->Auth->user('id');
        //get missed tasks
        $tasks = $this->Task->getMissedTaskD($userId, '0', null);
        //get today tasks
        $todayTask = $this->Task->getTodayTaskD($userId, '0', null);
        //set variables to view
        $this->set(compact('tasks', 'todayTask'));
        if ($tasks) {
            $total = count($tasks) + count($todayTask);
            $data = $this->render('/Elements/alerts');
            $arrays = array('notifications_total' => $total, 'notifications_list' => $data->body());
            return new CakeResponse(array('type' => 'json', 'body' => json_encode($arrays)));
        }
    }
}

/* End of file TasksController.php */
/* Location: ./app/Controller/TasksController.php */