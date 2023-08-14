<?php

/**
 * Class for performing all calender related functions
 * 
 * @author:   AnkkSoft.com
 * Copyright: AnkkSoft 2020
 * Website:   https://www.ankksoft.com
 * CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class CalendersController extends AppController
{

    /**
     * This controller use following model
     *
     * @var array
     */
    public $uses = array('Task', 'Event');

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
        //check if admin,manager,staff
        $this->checkAdminStaff();
        //set layout
        $this->layout = 'admin';
    }

    /**
     * This function is used to display calender
     *
     * @return void
     */
    public function index()
    {
        //get user id        
        $userId = $this->Auth->user('id');
        //get group id
        $groupId = $this->Auth->User('group_id');
        //get all task
        $taskslist = $this->Task->getAllTaskCalender($userId);
        $data = array();
        foreach ($taskslist as $row) {
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
            $data[] = array(
                'id' => $row['Task']['id'],
                'title' => "" . $row['Task']['task'],
                'start' => $row['Task']['date'].' '.$row['Task']['time'],
                'icon' => $motive,
                'allDay' => false
            );
        }
        // get events list
        $eventlist = $this->Event->getAllEvents($userId, $groupId);
        foreach ($eventlist as $row) :
            $data[] = array(
                'id' => $row['Event']['id'],
                'title' => $row['Event']['title'],
                'start' => $row['Event']['start_date'],
                'end' => $row['Event']['end_date'],
                'color' => '#' . $row['Event']['color'],
                'status' => $row['Event']['status'],
                'events' => 'yes',
            );
        endforeach;
        $tasks = json_encode($data);
        //set variable to view
        $this->set(compact('tasks'));
    }

    /**
     * This function is used to add new event
     *
     * @var void
     */
    public function add()
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Post request  -----------
        if ($this->request->isPost()) {
            $this->Event->create();
            //common variables
            $this->request->data['Event']['start_date'] = date('Y-m-d', strtotime($this->request->data['Event']['start_date']));
            $this->request->data['Event']['end_date'] = date('Y-m-d', strtotime($this->request->data['Event']['end_date']));
            $this->request->data['Event']['user_id'] = $this->Auth->user('id');
            $groupId = $this->Auth->User('group_id');
            if ($groupId) {
                $this->request->data['Event']['group_id'] = $groupId;
            }
            //save event
            if ($this->Event->save($this->request->data)) {
                //success message
                $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
            //redirect to my task  page
            return $this->redirect(array('controller' => 'calenders', 'action' => 'index'));
        }
    }

    /**
     * This function is used to delete event
     *
     * @return json
     */
    public function delete($eventId)
    {
        // autorender off for view
        $this->autoRender = false;

        if (!empty($eventId)) {
            //--------- Post/Ajax request  -----------
            if ($this->RequestHandler->isAjax()) {
                //delete task
                $success = $this->Event->delete($eventId, false);
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
     * This function is used to load tasks in modal.
     *
     * @return void
     */
    public function task($taskId)
    {
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            //get task by deal id
            $task = $this->Task->getTask($taskId);

            //set  variable to view
            $this->set(compact('task'));

            $this->render('/Elements/calender-modal');
        }
    }

    /**
     * This function is used to load event in modal.
     *
     * @return void
     */
    public function event($eventId)
    {
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            //get task by deal id
            $event = $this->Event->getEventById($eventId);

            //set  variable to view
            $this->set(compact('event'));

            $this->render('/Elements/calender-modal');
        }
    }
}

/* End of file CalendersController.php */
/* Location: ./app/Controller/CalendersController.php */