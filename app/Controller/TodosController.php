<?php
/**
 * Class for performing all contact related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop
 */
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class TodosController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('Todo');

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
     * This function is used to display todo list page
     *
     * @return array
     */
    public function index()
    {
        //get user id
        $userId = $this->Auth->user('id');
        //get todo by status pending & completed
        $todo = $this->Todo->getTodoByStatus(0, $userId);
        $completedTodo = $this->Todo->getTodoByStatus(1, $userId);
        //set variables to view
        $this->set(compact('todo', 'completedTodo'));
    }

    /**
     * This function is used to add new todo
     *
     * @return void
     */
    public function save($id = null)
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Post request  -----------
        if ($this->request->is(array('post', 'put'))) {
            $this->Todo->create();
            $this->request->data['Todo']['user_id'] = $this->Auth->user('id');
            //if contact saved
            if (!empty($this->request->data['Todo']['todo'])) {
                if ($this->Todo->save($this->request->data)) {
                    //success message
                    $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
                } else {
                    //failure message
                    $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
                }
            } else {
                //failure message
                $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
            return $this->redirect(array('controller' => 'todos', 'action' => 'index'));
        }
    }

    /**
     * This function is used to add new todo
     *
     * @return void
     */
    public function update($id = null)
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Post request  -----------
        if ($this->request->is(array('post', 'put'))) {
            if (isset($this->params['url']['id'])) {
                $this->request->data['Todo']['id'] = $this->params['url']['id'];
                $this->request->data['Todo']['status'] = $this->params['url']['status'];
                if ($this->Todo->save($this->request->data)) {
                    //return json failure message
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
     * This function is used to delete todo
     *
     * @return json
     */
    public function delete()
    {
        // autorender off for view
        $this->autoRender = false;


        $todoId = $this->request->data['Item']['id'];

        //if not empty contact id
        if (!empty($todoId) && $this->request->is(array('post', 'put'))) {

            //delete todo
            $success = $this->Todo->delete($todoId, false);
            //if todo deleted
            if ($success) {
                //return success json message
                $response = array('bug' => 0, 'msg' => 'success', 'module' => 'todo-section', 'action' => 'row', 'vId' => $todoId);
                return json_encode($response);
            } else {
                //return json failure message
                $response = array('bug' => 1, 'msg' => 'failure');
                return json_encode($response);
            }
        }
    }
}

/* End of file TodosController.php */
/* Location: ./app/Controller/TodosController.php */