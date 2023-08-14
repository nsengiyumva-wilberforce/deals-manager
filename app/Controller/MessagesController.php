<?php
/**
 * Class for performing all message related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class MessagesController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('Message', 'User', 'SettingEmail', 'Company');

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
        $this->layout = 'admin';
    }

    /**
     * This function is used to display message home page,list users for message
     *
     * @return array
     */
    public function index()
    {
        $userGId = $this->Auth->user('user_group_id');
        //if user type is admin
        if ($userGId == '1') {
            //get all user
            $users = $this->User->find('all', array('fields' => array('User.id', 'User.name', 'User.picture', 'User.user_group_id', 'User.job_title')));
        } else if ($userGId == '2') {
            $groupId = $this->Auth->user('group_id');
            //get admins 
            $users = $this->User->find('all', array('conditions' => array(
                    'OR' => array(
                        array('User.user_group_id' => 1),
                        array('User.group_id' => $groupId)
                    ),
                ),
                'fields' => array('User.id', 'User.name', 'User.picture', 'User.user_group_id', 'User.job_title')));
        } else if ($userGId == '3') {
            $groupId = $this->Auth->user('group_id');
            $users = $this->User->find('all', array('conditions' => array('User.group_id' => $groupId), 'fields' => array('User.id', 'User.name', 'User.picture', 'User.user_group_id', 'User.job_title')));
        } else {
            $companyId = $this->Auth->user('company_id');
            $company = $this->Company->getCompanyGroups($companyId);
            //get all user
            $users = $this->User->find('all', array('conditions' => array('User.group_id' => array($company['Company']['groups'])), 'fields' => array('User.id', 'User.name', 'User.picture', 'User.user_group_id', 'User.job_title')));
        }

        //set users variable to view
        $this->set(compact('users'));
    }

    /**
     * This function is used to view message chat by user id and add new message
     *
     * @return array
     */
    public function read($userId = null)
    {
        $active = $userId;
        // Check for user type to view user messages
        $this->checkMessage($userId);
        //--------- Post request -----------
        if ($this->request->is('post')) {
            $this->Message->set($this->request->data);
            $this->Message->create();
            $this->request->data['Message']['admin'] = $this->Auth->user('id');
            $this->request->data['Message']['message_to'] = $userId;
            $this->request->data['Message']['message_by'] = $this->Auth->user('id');

            //save message
            if ($this->Message->save($this->request->data)) {
                //success message
                $this->Session->setFlash(__('Request has been completed.'), 'default', array('class' => 'alert alert-info'), 'success');
                $name = $this->Auth->user('name');
                $user = $this->User->getUserEmail($userId);
                // Email notification
                $emailSettings = $this->SettingEmail->getSettings();
                if ($emailSettings['SettingEmail']['message'] == '1') {
                    try {
                        $send = $this->Notification('message', $user['User']['email'], 'Message From ' . $name, $this->request->data['Message']['message']);
                    } catch (Exception $e) {
                        
                    }
                }
            }
        }

        $group = $this->Auth->user('user_group_id');
        //check if user type admin
        if ($group == '1') {
            //get all user
            $users = $this->User->find('all', array('fields' => array('User.id', 'User.name', 'User.picture', 'User.user_group_id', 'User.job_title')));
        } else if ($group == '2') {
            $groupId = $this->Auth->user('group_id');
            //get admins 
            $users = $this->User->find('all', array('conditions' => array(
                    'OR' => array(
                        array('User.user_group_id' => 1),
                        array('User.group_id' => $groupId)
                    ),
                ),
                'fields' => array('User.id', 'User.name', 'User.picture', 'User.user_group_id', 'User.job_title')));
        } else if ($group == '3') {
            $groupId = $this->Auth->user('group_id');
            $users = $this->User->find('all', array('conditions' => array('User.group_id' => $groupId), 'fields' => array('User.id', 'User.name', 'User.picture', 'User.user_group_id', 'User.job_title')));
        } else {
            $companyId = $this->Auth->user('company_id');
            $company = $this->Company->getCompanyGroups($companyId);
            //get all user
            $users = $this->User->find('all', array('conditions' => array('User.group_id' => array($company['Company']['groups'])), 'fields' => array('User.id', 'User.name', 'User.picture', 'User.user_group_id', 'User.job_title')));
        }
        $user = $userId;
        $adminId = $this->Auth->user('id');
        //get all message 
        $messages = $this->Message->getMessageByUser($userId, $adminId);
        $admin = $this->User->getUserById($adminId);
        $this->Message->reading($userId, $adminId);
        //set variables to view
        $this->set(compact('users', 'messages', 'user', 'admin', 'active'));
    }

    /**
     * This function is used to delete message
     *
     * @return json
     */
    public function delete()
    {
        // autorender off for view
        $this->autoRender = false;
        $messageId = $this->request->data['Message']['id'];
        //if message id exixt
        if (!empty($messageId)) {
            //--------- Post/Ajax request -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete message
                $success = $this->Message->delete($messageId, false);
                if ($success) {
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $messageId);
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
     * This function is used to Check if user type is user 
     *
     * @return void
     */
    public function checkMessage($userId)
    {
        //get user 
        $admin = $this->User->find('first', array('conditions' => array('User.id' => $userId), 'fields' => array('User.user_group_id', 'User.group_id')));

        // Check if user exist
        if ($admin) {
            $adminUGId = $admin['User']['user_group_id'];
            $adminGId = $admin['User']['group_id'];
            $userGId = $this->Auth->user('user_group_id');
            $userGroupId = $this->Auth->user('group_id');
            if ($userGId == 4):
                $companyId = $this->Auth->user('company_id');
                $company = $this->Company->getCompanyGroups($companyId);
                $groups = explode(",", $company['Company']['groups']);
            endif;
            // if type user then true 
            if (($userGId == 2 && $adminUGId == 1) || ($userGroupId == $adminGId) || ($userGId == 1) || in_array($adminGId, $groups)) {
                return true;
            } else {
                //redirect to message home page
                return $this->redirect(array('controller' => 'messages', 'action' => 'index'));
            }
        } else {
            //redirect to message home page
            return $this->redirect(array('controller' => 'messages', 'action' => 'index'));
        }
    }

    /**
     * This function is used to Check if user type is user 
     *
     * @return void
     */
    public function notifications()
    {
        $this->autoRender = false;
        $userId = $this->Auth->user('id');
        $messages = $this->Message->getMessageNotification($userId);
        //set variables to view
        $this->set(compact('messages'));
        if ($messages) {
            $total = count($messages);
            $data = $this->render('/Elements/notifications');
            $arrays = array('notifications_total' => $total, 'notifications_list' => $data->body());
            return new CakeResponse(array('type' => 'json', 'body' => json_encode($arrays)));
        }
    }
}

/* End of file MessagesController.php */
/* Location: ./app/Controller/MessagesController.php */