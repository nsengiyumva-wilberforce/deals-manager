<?php

/**
 * Class for performing all discussion related functions on view deal page
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class DiscussionsController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('Message', 'User', 'Discussion');

    /**
     * This controller uses following helpers
     *
     * @var array
     */
    var $helpers = array('Form', 'Html', 'Time', 'Js', 'Paginator', 'Common');

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
     * This Function is default index
     *
     * @return void
     */
    public function index()
    {
        
    }

    /**
     * This Function used to add discussion.
     *
     * @return void
     */
    public function add($dealId = null)
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Post request  -----------
        if ($this->request->is('post')) {

            $this->Discussion->set($this->request->data);
            $this->Discussion->create();
            //if deal id exixt
            if ($dealId) {
                //common variables
                $this->request->data['Discussion']['user_id'] = $this->Auth->user('id');
                $this->request->data['Discussion']['deal_id'] = $dealId;
                //save discussion
                if ($this->Discussion->save($this->request->data)) {
                    //success message
                    $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
                    //save activity for add discussion
                    $this->activity($dealId, $this->request->data['Discussion']['message'], 'add_Discussion');
                } else {
                    //failure message
                    $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
                }
            }
            if ($this->checkClient()):
                return $this->redirect(array('controller' => 'deals', 'action' => 'cview', $dealId));
            else:
                return $this->redirect(array('controller' => 'deals', 'action' => 'view', $dealId));
            endif;
        }
    }

    /**
     * This Function used to delete discussion from deal
     *
     * @return json
     */
    public function unlink()
    {
        // autorender off for view
        $this->autoRender = false;

        //Common variables
        $discussId = $this->request->data['Item']['id'];
        $dealId = $this->request->data['Deal']['id'];

        //if discussion exixt
        if (!empty($discussId)) {

            //get messages for discussion topic
            $discuss = $this->Discussion->getMessageById($discussId);

            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {

                //delete discussion
                $success = $this->Discussion->delete(array('id' => $discussId), true);
                if ($success) {
                    //delete all reply message
                    $this->Discussion->deleteAll(array('deal_id' => $dealId, 'parent' => $discussId), true);
                    //save activity of delete discussion
                    $this->activity($dealId, $discuss['Discussion']['message'], 'unlink_Discussion');
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $discussId);
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

/* End of file DiscussionsController.php */
/* Location: ./app/Controller/DiscussionsController.php */