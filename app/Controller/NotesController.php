<?php

/**
 * Class for performing all note related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class NotesController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('NoteDeal', 'Note');

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
     * Default index 
     *
     */
    public function index()
    {
        $userId = $this->Auth->user('id');
        //get notes
        $notes = $this->Note->getNote($userId);
        //set variables to view
        $this->set(compact('notes'));
    }

    /**
     * This function is used to add note to deal 
     *
     * @return void
     */
    public function add()
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->NoteDeal->create();
            $this->request->data['NoteDeal']['user_id'] = $this->Auth->user('id');
            $dealId = $this->request->data['NoteDeal']['deal_id'];
            //save note
            if ($this->NoteDeal->save($this->request->data)) {
                //success message
                $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
            //redirect to deal view
            if ($this->checkClient()):
                return $this->redirect(
                        array('controller' => 'Deals', 'action' => 'cview', $dealId)
                );
            else:
                return $this->redirect(
                        array('controller' => 'Deals', 'action' => 'view', $dealId)
                );
            endif;
        }
    }

    /**
     * This function is used to update note in deal
     *
     * @return void
     */
    public function edit()
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $dealId = $this->request->data['NoteDeal']['deal_id'];
            //save note
            $success = $this->NoteDeal->save($this->request->data);
            if ($success) {
                //success message
                $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
            //redirect to deal view
            return $this->redirect(
                    array('controller' => 'Deals', 'action' => 'view', $dealId)
            );
        }
    }

    /**
     * This function is used to get modal for add & edit note
     *
     * @return void
     */
    public function getModal($id = Null)
    {
        if ($id):
            $note = $this->Note->getNoteById($id);
            $this->request->data = $note;
        endif;
        //set variables to view
        $this->set(compact('note'));
    }

    /**
     * This function is used to save note
     *
     * @return void
     */
    public function save($id = Null)
    {
        $this->autoRender = false;
        if ($this->request->is(array('post', 'put'))) {
            if (!$id):
                $this->Note->create();
            endif;
            $this->request->data['Note']['user_id'] = $this->Auth->user('id');
            if ($this->Note->save($this->request->data)) {
                return $this->redirect(array('action' => 'index'));
            }
        }
    }
    
     /**
     * This function is used to delete note
     *
     * @return void
     */
    
     public function delete() {
        // autorender off for view
        $this->autoRender = false;
        $noteId = $this->request->data['Item']['id'];
        if (!empty($noteId) && $this->request->is(array('post', 'put'))) {
            //--------- Post/Ajax request  -----------           
            //delete role
            $success = $this->Note->delete($noteId, false);
            if ($success) {
                //return json success message
                $response = array('bug' => 0, 'msg' => 'success', 'module' => 'note-section', 'action' => 'row', 'vId' => $noteId);
                return json_encode($response);
            } else {
                $response = array('bug' => 1, 'msg' => 'failure');
                return json_encode($response);
            }
        }
     }
}

/* End of file NotesController.php */
/* Location: ./app/Controller/NotesController.php */