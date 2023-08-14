<?php
/**
 * Class for performing all user related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('User', 'UserGroup', 'UserDetail', 'Setting', 'UserDeal', 'SettingCompany', 'SettingEmail', 'Role', 'UserGroup', 'Timeline', 'History');

    /**
     * This controller uses following helpers
     *
     * @var array
     */
    var $helpers = array('Session', 'Form', 'Html', 'Time', 'Js', 'Paginator');

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
        //set layout
        $this->layout = 'admin';
    }

    /**
     * This function is used to display all users
     *
     * @return void
     */
    public function index()
    {
        //check if login
        $this->checkLogin();
        //check if admin
        $this->isAdmin();

        //pagination ,getting all admins
        $this->paginate = array('conditions' => array('User.user_group_id <>' => '4'),
            'joins' => array(
                array(
                    'alias' => 'Role',
                    'table' => 'user_roles',
                    'type' => 'LEFT',
                    'conditions' => 'Role.id = User.role'
                ),
                array(
                    'alias' => 'UserGroup',
                    'table' => 'user_groups',
                    'type' => 'LEFT',
                    'conditions' => 'UserGroup.id = User.group_id'
                )
            ),
            'fields' => array('User.id', 'User.name', 'User.user_group_id', 'User.email', 'User.picture', 'User.active', 'User.created', 'User.job_title', 'Role.name', 'UserGroup.name'),
            'limit' => 20,
            'order' => 'User.id desc');
        $users = $this->paginate('User');
        //get roles
        $roles = $this->Role->getRoleByType('1');

        $cAdmin = $this->User->getUsersCount('1');
        $cManager = $this->User->getUsersCount('2');
        $cStaff = $this->User->getUsersCount('3');
        //set variable for view
        $this->set(compact('users', 'roles', 'cAdmin', 'cManager', 'cStaff'));

        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $this->render('/Elements/users');
        }
    }

    /**
     * This function is used to display all admins
     *
     * @return void
     */
    public function admin()
    {
        //check if login
        $this->checkLogin();
        //check if admin
        $this->isAdmin();

        //pagination ,getting all managers
        $this->paginate = array('conditions' => array('User.user_group_id' => '1'),
            'joins' => array(
                array(
                    'alias' => 'Role',
                    'table' => 'user_roles',
                    'type' => 'LEFT',
                    'conditions' => 'Role.id = User.role'
                )
            ),
            'fields' => array('User.id', 'User.name', 'User.user_group_id', 'User.email', 'User.picture', 'User.active', 'User.created', 'User.job_title', 'Role.name'),
            'limit' => 20,
            'order' => 'User.id desc');
        $users = $this->paginate('User');

        $admin = 1;

        //get roles
        $roles = $this->Role->getRoleByType('1');
        //set variable for view
        $this->set(compact('users', 'admin', 'roles'));

        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $this->render('/Elements/users');
        }
    }

    /**
     * This function is used to display all managers
     *
     * @return void
     */
    public function manager()
    {
        //check if login
        $this->checkLogin();
        //check if admin
        $this->isAdmin();
        //pagination ,getting all managers
        $this->paginate = array('conditions' => array('User.user_group_id' => '2'),
            'joins' => array(
                array(
                    'alias' => 'Role',
                    'table' => 'user_roles',
                    'type' => 'LEFT',
                    'conditions' => 'Role.id = User.role'
                ),
                array(
                    'alias' => 'UserGroup',
                    'table' => 'user_groups',
                    'type' => 'LEFT',
                    'conditions' => 'UserGroup.id = User.group_id'
                )
            ),
            'fields' => array('User.id', 'User.name', 'User.user_group_id', 'User.email', 'User.picture', 'User.active', 'User.created', 'User.job_title', 'Role.name', 'UserGroup.name'),
            'limit' => 20,
            'order' => 'User.id desc');
        $users = $this->paginate('User');

        //get roles
        $roles = $this->Role->getRoleByType('2');

        //get groups
        $groups = $this->UserGroup->getGroupList();
        //set variable for view
        $this->set(compact('users', 'roles', 'groups'));

        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $this->render('/Elements/users');
        }
    }

    /**
     * This function is used to display all staffs
     *
     * @return void
     */
    public function staff()
    {
        //check if login
        $this->checkLogin();
        //check if admin
        $this->isAdmin();
        //check permissions
        $this->checkPermission('4');
        //pagination ,getting all staffs
        $this->paginate = array('conditions' => array('User.user_group_id' => '3'),
            'joins' => array(
                array(
                    'alias' => 'Role',
                    'table' => 'user_roles',
                    'type' => 'LEFT',
                    'conditions' => 'Role.id = User.role'
                ),
                array(
                    'alias' => 'UserGroup',
                    'table' => 'user_groups',
                    'type' => 'LEFT',
                    'conditions' => 'UserGroup.id = User.group_id'
                )
            ),
            'fields' => array('User.id', 'User.name', 'User.user_group_id', 'User.email', 'User.picture', 'User.active', 'User.job_title', 'User.created', 'Role.name', 'UserGroup.name'),
            'limit' => 20,
            'order' => 'User.id desc');
        $users = $this->paginate('User');
        //get roles
        $roles = $this->Role->getRoleByType('2');

        //get groups
        $groups = $this->UserGroup->getGroupList();
        //set variable for view
        $this->set(compact('users', 'roles', 'groups'));

        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $this->render('/Elements/users');
        }
    }

    /**
     * This function is used to display all clients
     *
     * @return void
     */
    public function client()
    {
        //check if login
        $this->checkLogin();
        //check if admin
        $this->isAdmin();
        //check permissions
        $this->checkPermission('4');
        //pagination ,getting all clients
        $this->paginate = array('conditions' => array('User.user_group_id' => '4'),
            'joins' => array(
                array(
                    'alias' => 'UserGroup',
                    'table' => 'user_groups',
                    'type' => 'LEFT',
                    'conditions' => 'UserGroup.id = User.group_id'
                )
            ),
            'limit' => 20,
            'fields' => array('User.id', 'User.name', 'User.user_group_id', 'User.email', 'User.picture', 'User.active', 'User.job_title', 'User.created', 'UserGroup.name'),
            'order' => 'User.id desc');
        $users = $this->paginate('User');
        $client = 1;
        //get groups
        $groups = $this->UserGroup->getGroupList();



        //set variable for view'
        $this->set(compact('users', 'client', 'groups'));

        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $this->render('/Elements/users');
        }
    }

    /**
     * This function is used to display all user roles
     *
     * @return void
     */
    public function role()
    {
        //check if login
        $this->checkLogin();
        //check if admin
        $this->isAdmin();
        //check permissions
        $this->checkPermission('7');
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->Role->create();
            $this->request->data['Role']['permission'] = implode(",", $this->request->data['module']);
            //save role data
            if ($this->Role->save($this->request->data)) {
                //success message
                $this->Flash->success(__('Request has been completed.'), array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success(__('Request has been not completed.'), array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
        }
        //pagination ,getting all roles
        $this->paginate = array('limit' => 20, 'order' => 'Role.id desc');
        $roles = $this->paginate('Role');
        //set variable for view
        $this->set(compact('roles'));

        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $this->render('/Elements/roles');
        }
    }

    /**
     * This function is used to delete role
     *
     * @return json
     */
    public function role_delete()
    {
        // autorender off for view
        $this->autoRender = false;
        $roleId = $this->request->data['Role']['id'];
        if (!empty($roleId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax() || isset($_SERVER['HTTP_REFERER'])) {
                $checkRoleUsers = $this->User->checkRole($roleId);
                if ($checkRoleUsers) {
                    //return json failure  role if active users
                    $response = array('bug' => 1, 'msg' => __('Role have users'));
                    return json_encode($response);
                } else {
                    //delete role
                    $success = $this->Role->delete($roleId, false);
                    if ($success) {
                        //return json success message
                        $response = array('bug' => 0, 'msg' => 'success', 'vId' => $roleId);
                        return json_encode($response);
                    }
                }
            }
        }
        exit;
    }

    /**
     * This function is used for login page
     *
     * @return void
     */
    public function login()
    {
        $this->layout = 'login';
        // if already logged-in and active redirect
        if ($this->Session->check('Auth.User') && $this->Auth->user('active') == 1) {
            $this->redirect(array('controller' => 'admins', 'action' => 'index'));
        }
        //get settings 
        $settings = $this->Setting->getSettings();
        $company = $this->SettingCompany->getCompName();
        //write comapny name from setting to session
        $this->Session->write('Company.name', $company['SettingCompany']['name']);

        //Set language 
        Configure::write('Config.language', $settings['Setting']['language']);
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->request->data['User']['username'] = $this->request->data['User']['email'];
            //check if user loged in
            if ($this->Auth->login()) {
                //if user active
                if ($this->Auth->user('active') == '1') {
                    //write session variables
                    $this->Session->write('Auth.User.timezone', $settings['Setting']['time_zone']);
                    $this->Session->write('Auth.User.title', $settings['Setting']['title']);
                    $this->Session->write('Auth.User.title_text', $settings['Setting']['title_text']);
                    $this->Session->write('Auth.User.title_logo', $settings['Setting']['title_logo']);
                    $this->Session->write('Auth.User.currency_symbol', $settings['Setting']['currency_symbol']);
                    $this->Session->write('Auth.User.date_format', $settings['Setting']['date_format']);
                    $this->Session->write('Auth.User.time_format', $settings['Setting']['time_format']);
                    $this->Session->write('Auth.User.language', $settings['Setting']['language']);
                    $this->Session->write('Pipeline.id', $settings['Setting']['pipeline']);
                    //get user permissions
                    if ($this->Auth->user('role')) {
                        $role = $this->Role->getRolePermissions($this->Auth->user('role'));
                        $this->Session->write('Auth.User.permission', $role['Role']['permission']);
                    }
                    $groupId = $this->Auth->user('user_group_id');
                    if ($groupId == 4) :
                        return $this->redirect(array('controller' => 'deals', 'action' => 'index'));
                    else:
                        return $this->redirect(array('controller' => 'admins', 'action' => 'index'));
                    endif;
                } else {
                    //failure message
                    $this->Session->setFlash(__('Inactive Account,contact admin'));
                }
            } else {
                //failure message
                $this->Session->setFlash(__('Invalid username or password'));
            }
        }
        //set variable to view
        $this->set(compact('settings'));
    }

    /**
     * This function is used to forgot Password email and send new password email.
     *
     * @return array
     */
    public function forgotPassword()
    {
        //set layout for page
        $this->layout = 'login';

        //get settings 
        $settings = $this->Setting->getSettings();
        $company = $this->SettingCompany->getCompName();

        //write company name to session
        $this->Session->write('Company.name', $company['SettingCompany']['name']);

        //Set language 
        Configure::write('Config.language', $settings['Setting']['language']);
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->User->set($this->request->data);
            $requestEmail = $this->request->data['User']['email'];
            // Getting user's information who wants to reset password.
            $userInfo = $this->User->findByEmail($requestEmail);
            if ($userInfo) {
                //common variables
                $userID = (int) $userInfo['User']['id'];
                $this->request->data['User']['password'] = $this->randomPassword();
                $this->request->data['User']['id'] = $userID;
                $data = array('password' => $this->request->data['User']['password']);
                //save user 
                if ($this->User->save($this->data)) {
                    //email notification for forgot password
                    try {
                        $mail = $this->Notification('forgot_password', $requestEmail, 'Forgot Password', $data);
                    } catch (Exception $e) {
                        
                    }
                    //success message
                    $this->Session->setFlash(__('New password are send to your email,please check email.'));
                    //redirect to forgot password
                    return $this->redirect(array('controller' => 'users', 'action' => 'forgotPassword'));
                }
            } else {
                //error message,email not find 
                $this->Session->setFlash(__('Email not exist,please check it.'));
            }
        }
        //set settings variables to view
        $this->set(compact('settings'));
    }

    /**
     * This function is used to generate Random Password for Forgot Password.
     *
     * @return string
     */
    function randomPassword()
    {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    /**
     *  This function is used to log Out From Application
     *
     * @return void
     */
    public function logout()
    {
        if ($this->Auth->logout()) {
            //destroy session and cookie
            $this->Cookie->destroy();
            $this->Session->destroy();
        }
        //redirect to user login
        $this->redirect(array('controller' => 'users', 'action' => 'login'));
    }

    /**
     * This function is used to add new user 
     *
     * @return json
     */
    public function add()
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->autoRender = false;
            $this->User->set($this->request->data);
            //check user validations
            $UserValidate = $this->User->UserValidate();
            if ($UserValidate) {
                //common variables
                $this->request->data['User']['username'] = $this->request->data['User']['email'];
                $this->request->data['User']['active'] = 1;
                $this->request->data['User']['user_id'] = $this->Auth->user('id');
                $this->request->data['User']['picture'] = 'user.png';
                $this->User->create();
                //save new user
                if ($this->User->save($this->request->data)) {
                    $this->request->data['UserDetail']['user_id'] = $this->User->getLastInsertID();
                    //save user details
                    if ($this->UserDetail->save($this->request->data, false)) {
                        //success message
                        $this->Flash->success(__('Request has been completed.'), array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
                        $data = array('username' => $this->request->data['User']['email'], 'pass' => $this->request->data['User']['password']);
                        // Email notification
                        $emailSettings = $this->SettingEmail->getSettings();
                        if ($emailSettings['SettingEmail']['add_user'] == '1') {
                            try {
                                $send = $this->Notification('signup', $this->request->data['User']['email'], 'Signup Confirmation', $data);
                            } catch (Exception $e) {
                                
                            }
                        }
                        //return json success message
                        $response = array('bug' => 0, 'msg' => 'success');
                        return json_encode($response);
                    }
                }
            } else {
                //return json failure message
                $response = array('bug' => 1, 'msg' => 'failure');
                $response['data']['User'] = $this->User->validationErrors;
                return json_encode($response);
            }
        }
    }

    /**
     * This function is used to display profile page of user.
     *
     * @return void
     */
    public function profile($id = null)
    {
        //check if user login
        $this->checkLogin();
        $userId = ($id) ? $id : $this->Auth->user('id');

        //--------- Post request  -----------
        if ($this->request->is(array('post', 'put'))) {
            $this->User->set($this->request->data);
            $this->UserDetail->set($this->request->data);
            //save user details
            $this->User->saveAssociated($this->request->data);
            //success message
            $this->Flash->success(__('Request has been completed.'), array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            // check if my profile 
            if ($userId == $this->Auth->user('id')) {
                if (isset($this->request->data['User']['first_name']) && isset($this->request->data['User']['last_name'])) {
                    //write session variables
                    $this->Session->write('Auth.User.first_name', $this->request->data['User']['first_name']);
                    $this->Session->write('Auth.User.last_name', $this->request->data['User']['last_name']);
                    $this->Session->write('Auth.User.name', $this->request->data['User']['first_name'] . ' ' . $this->request->data['User']['last_name']);
                }
                $this->redirect(array('action' => 'profile'));
            } else {
                $this->redirect(array('action' => 'profile', $userId));
            }
        } else {
            //get user
            $user = $this->User->getUserById($userId);
            $user['Roles'] = $this->Role->getRoleByType($user['User']['user_group_id']);

            $countActivity = $this->Timeline->getTimeCountUser($userId);  // count activity
            $limit = 10;
            $total_pages = ceil($countActivity / $limit);
            $activity = $this->Timeline->getAllByUser($userId, $limit, null);  //get all activity for user  
            $wonDeals = $this->History->find('count', array('conditions' => array('History.user_id' => $userId, 'History.status' => 1)));
            $lossDeals = $this->History->find('count', array('conditions' => array('History.user_id' => $userId, 'History.status' => 2)));
            $deals = $this->UserDeal->find('count', array('conditions' => array('UserDeal.user_id' => $userId)));
            //get roles
            if ($user['User']['user_group_id'] == 1):
                $roles = $this->Role->getRoleByType('1');
            elseif ($user['User']['user_group_id'] == 2 || $user['User']['user_group_id'] == 3):
                $roles = $this->Role->getRoleByType('2');
            else:
                $roles = array();
            endif;

            //set data for view
            $this->set(compact('activity', 'total_pages', 'wonDeals', 'lossDeals', 'deals', 'roles'));
            $this->request->data = $user;
        }
    }

    /**
     *  This function is used to load more activity on load more click
     *
     * @return void
     */
    public function more($page = null)
    {
        $limit = 10;
        $page = $this->params['url']['page'];
        $userId = $this->params['url']['user'];
        //get all activity of deal
        $activity = $this->Timeline->getAllByUser($userId, $limit, $page);
        //set activity variable to view
        $this->set(compact('activity'));

        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $this->render('/Elements/activity');
        }
    }

    /**
     * This function is used to change User password from profile.
     *
     * @return void
     */
    public function cPassword()
    {
        // autorender off for view
        $this->autoRender = false;

        $this->checkLogin();

        //--------- Post request  -----------
        if ($this->request->is(array('post', 'put'))) {
            $userId = $this->request->data['User']['id'];
            $this->User->set($this->request->data);
            //save new password
            $success = $this->User->Save($this->request->data);
            //success message
            $this->Flash->success(__('Request has been completed.'), array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            //check if my profile
            if ($userId == $this->Auth->user('id')) {
                $this->redirect(array('action' => 'profile'));
            } else {
                $this->redirect(array('action' => 'profile', $userId));
            }
        }
    }

    /**
     * This function is used to update user profile image and create thumbnail.
     *
     * @return void
     */
    public function picture()
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Post/Ajax request  -----------
        if ($this->request->isPost() || $this->RequestHandler->isAjax() || isset($_SERVER['HTTP_REFERER'])) {
            $userId = $this->request->data['User']['id'];
            $this->User->set($this->request->data);
            //check if image exist
            if (!empty($this->request->data['User']['picture']['tmp_name']) && is_uploaded_file($this->request->data['User']['picture']['tmp_name'])) {
                $path_info = pathinfo($this->request->data['User']['picture']['name']);
                chmod($this->request->data['User']['picture']['tmp_name'], 0644);
                $photo = time() . mt_rand() . "." . $path_info['extension'];
                //path to save image
                $fullpath = WWW_ROOT . "img/avatar";
                if (!is_dir($fullpath)) {
                    mkdir($fullpath, 0777, true);
                }
                //save image on server
                move_uploaded_file($this->request->data['User']['picture']['tmp_name'], $fullpath . DS . $photo);
                $this->request->data['User']['picture'] = $photo;
                //remove old image
                if (!empty($user['User']['picture']) && file_exists($fullpath . DS . $user['User']['picture']) && $user['User']['picture'] != 'user.png') {
                    unlink($fullpath . DS . $user['User']['picture']);
                    unlink($fullpath . '/thumb/' . $user['User']['picture']);
                }
                $old_path = $fullpath . DS . $photo;
                $new_path = WWW_ROOT . "img/avatar/thumb" . DS . $photo;
                //create thumbnail
                $this->resize_image($old_path, $new_path, $path_info['extension'], 100, 100, $options = array());
                //save user
                if ($this->User->save($this->request->data)) {
                    //update session for picture
                    $this->Session->write('Auth.User.picture', $this->request->data['User']['picture']);
                    //success message
                    $this->Flash->success(__('Request has been completed.'), array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
                }
            } else {
                unset($this->request->data['User']['picture']);
                $this->Flash->success(__('Request has been not completed.'), array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
            //check if my profile
            if ($userId == $this->Auth->user('id')) {
                $this->redirect(array('action' => 'profile'));
            } else {
                $this->redirect(array('action' => 'profile', $userId));
            }
        }
    }

    /**
     * This function is used to delete user
     *
     * @return json
     */
    public function delete()
    {
        //check if admin
        $this->isAdmin();
        //check permissions
        $this->checkPermission('4');
        // autorender off for view
        $this->autoRender = false;
        $userId = $this->request->data['User']['id'];
        if (!empty($userId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax() || isset($_SERVER['HTTP_REFERER'])) {
                //delete user
                $success = $this->User->delete($userId, false);
                if ($success) {
                    //delete user details
                    $this->UserDetail->deleteAll(array('UserDetail.user_id' => $userId), false);
                    //delete assign user deal
                    $this->UserDeal->deleteAll(array('UserDeal.user_id' => $userId), false);
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $userId);
                    return json_encode($response);
                }
            }
        }
        exit;
    }

    /**
     *  This function is used to search users for adding in deal
     *
     * @return json
     */
    public function search()
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $results = array();
            if (isset($_GET['name'])) {
                $name = $_GET['name'];
                $userGId = $this->Auth->user('user_group_id');
                //get all users with name like keyword
                if ($userGId == '1') {
                    $results = $this->User->find('all', array('conditions' => array('OR' => array('User.first_name LIKE' => $name . '%', 'User.last_name LIKE' => $name . '%'), 'User.user_group_id <>' => 4), 'fields' => array('User.first_name,User.last_name,User.id')));
                } else if ($userGId == '2') {
                    $groupId = $this->Auth->user('group_id');
                    //get admins 
                    $users = $this->User->find('all', array('conditions' => array(
                            'OR' => array('User.first_name LIKE' => $name . '%', 'User.last_name LIKE' => $name . '%'),
                            'User.user_group_id <>' => 4,
                            'User.group_id' => $groupId
                        ),
                        'fields' => array('User.id', 'User.name', 'User.picture', 'User.user_group_id', 'User.job_title')));
                } else if ($userGId == '3') {
                    $groupId = $this->Auth->user('group_id');
                    $users = $this->User->find('all', array('conditions' => array('OR' => array('User.first_name LIKE' => $name . '%', 'User.last_name LIKE' => $name . '%'),
                            'User.user_group_id <>' => 4,
                            'User.group_id' => $groupId),
                        'fields' => array('User.id', 'User.name', 'User.picture', 'User.user_group_id', 'User.job_title')));
                }
            }
            $arr = array();
            foreach ($results as $row) {
                $arr[] = array('id' => $row['User']['id'], 'name' => $row['User']['first_name'] . ' ' . $row['User']['last_name']);
            }
            //return user names in json
            echo json_encode($arr);
        }
    }

    /**
     * This function is used to assign user to deal
     *
     * @return json
     */
    public function deal()
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Ajax request  -----------
        if ($this->request->is('post')) {
            $userIds = $this->request->data['Deal']['User'];
            $dealId = $this->request->data['User']['deal_id'];
            if (!empty($userIds)) :
                foreach ($userIds as $userId):
                    //get assign deal to user
                    $result = $this->UserDeal->getUserDeal($dealId, $userId);
                    //get user name
                    $user = $this->User->getUserName($userId);
                    if (!$result) :
                        $this->UserDeal->create();
                        $this->request->data['UserDeal']['user_id'] = $userId;
                        $this->request->data['UserDeal']['deal_id'] = $dealId;
                        if ($this->UserDeal->save($this->request->data)) :
                            //activity of assign user to deal
                            $this->activity($dealId, $user['User']['name'], 'add_User');
                        endif;
                    endif;
                endforeach;
                //success message
                $this->Flash->success(__('Request has been completed.'), array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            else:
                //failure message
                $this->Flash->success(__('Request has been not completed.'), array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            endif;
            $this->redirect(array('controller' => 'deals', 'action' => 'view', $dealId));
        }
    }

    /**
     * This function is used to unassign user from deal.
     *
     * @return json
     */
    public function unlink()
    {
        // autorender off for view
        $this->autoRender = false;
        $userId = $this->request->data['Item']['id'];
        $dealId = $this->request->data['Deal']['id'];
        if (!empty($userId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete assign user from deal
                $success = $this->UserDeal->deleteAll(array('deal_id' => $dealId, 'user_id' => $userId), true);
                if ($success) {
                    $user = $this->User->getUserName($userId);
                    //activity of un assign user from deal
                    $this->activity($dealId, $user['User']['name'], 'unlink_User');
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $userId);
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
     * This function is used to set user permissions.
     *
     * @return json
     */
    public function permission($roleId = null)
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Post request for update permissions -----------
        if ($this->request->isPost()) {
            $this->request->data['Role']['permission'] = implode(",", $this->request->data['module']);
            $this->Role->save($this->request->data);
            //success message
            $this->Flash->success(__('Request has been completed.'), array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            // check if my profile             
            $this->redirect(array('controller' => 'users', 'action' => 'role'));
        }

        //--------- Ajax request for getting permissions -----------
        if ($this->RequestHandler->isGET()) {
            $this->layout = 'ajax';
            //get user by user id
            $role = $this->Role->getRoleById($roleId);
            //set user variable to view
            if ($role['Role']['type'] == '1') {
                $admin = $role;
                $this->set(compact('admin'));
            } else {
                $this->set(compact('role'));
            }
            $this->render('/Elements/modals');
        }
    }

    /**
     * This function is used to display all user groups
     *
     * @return void
     */
    public function group()
    {
        //check if login
        $this->checkLogin();
        //check if admin
        $this->isAdmin();

        //check permissions
        $this->checkPermission('7');

        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->UserGroup->create();

            //save role data
            if ($this->UserGroup->save($this->request->data)) {
                //success message
                $this->Flash->success(__('Request has been completed.'), array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success(__('Request has been not completed.'), array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
        }
        //pagination ,getting all roles
        $this->paginate = array('limit' => 20, 'order' => 'UserGroup.id desc');
        $groups = $this->paginate('UserGroup');
        //set variable for view
        $this->set(compact('groups'));

        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $this->render('/Elements/groups');
        }
    }

    /**
     * This function is used to add new group
     *
     * @return void
     */
    public function add_group()
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->UserGroup->create();
            //save source
            if ($this->UserGroup->save($this->request->data)) {
                //sucess message
                $this->Flash->success(__('Request has been completed.'), array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
                //redirect to sources home page
                return $this->redirect(
                        array('controller' => 'users', 'action' => 'group')
                );
            } else {
                //return json failure message
                $response = array('bug' => 1, 'msg' => 'failure');
                return json_encode($response);
            }
        }
    }

    /**
     * This function is used to edit source
     *
     * @return json
     */
    public function edit_group()
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            //--------- Ajax request  -----------
            if ($this->RequestHandler->isAjax()) {
                $this->layout = 'ajax';
                //common variables
                $this->request->data['UserGroup']['id'] = $this->request->data['pk'];
                $this->request->data['UserGroup']['name'] = $this->request->data['value'];
                //update source
                $success = $this->UserGroup->save($this->request->data);
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
     * This function is used to delete group
     *
     * @return json
     */
    public function delete_group()
    {
        // autorender off for view
        $this->autoRender = false;
        $groupId = $this->request->data['UserGroup']['id'];
        if (!empty($groupId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete source
                $success = $this->UserGroup->delete($groupId, false);
                if ($success) {
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $groupId);
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
     * This function is used to display all user groups
     *
     * @return void
     */
    public function member($groupId = null)
    {
        //check if login
        $this->checkLogin();
        //check if admin
        $this->isAdmin();
        $group = $this->UserGroup->find('first', array('conditions' => array('UserGroup.id' => $groupId), 'fields' => array('UserGroup.name')));
        $managers = $this->User->find('all', array('conditions' => array('User.user_group_id' => '2', 'User.group_id' => $groupId),
            'joins' => array(
                array(
                    'alias' => 'Role',
                    'table' => 'user_roles',
                    'type' => 'LEFT',
                    'conditions' => 'Role.id = User.role'
                )
            ),
            'fields' => array('User.id', 'User.name', 'User.user_group_id', 'User.email', 'User.picture', 'User.active', 'User.job_title', 'User.created', 'Role.name'),
        ));
        $staff = $this->User->find('all', array('conditions' => array('User.user_group_id' => '3', 'User.group_id' => $groupId),
            'joins' => array(
                array(
                    'alias' => 'Role',
                    'table' => 'user_roles',
                    'type' => 'LEFT',
                    'conditions' => 'Role.id = User.role'
                )
            ),
            'fields' => array('User.id', 'User.name', 'User.user_group_id', 'User.email', 'User.picture', 'User.active', 'User.job_title', 'User.created', 'Role.name'),
        ));
        //set variable for view
        $this->set(compact('managers', 'staff', 'group'));
    }

    /**
     * This function is used to display all user groups
     *
     * @return void
     */
    public function send_message($userId)
    {
        // autorender off for view
        $this->autoRender = false;
        if (!empty($this->request->data['Mail']['subject']) && !empty($this->request->data['Mail']['message'])):
            try {
                $send = $this->Notification('mail', $this->request->data['Mail']['to'], $this->request->data['Mail']['subject'], $this->request->data['Mail']['message']);
            } catch (Exception $e) {
                
            }
        endif;
        $this->redirect(array('action' => 'profile', $userId));
    }
}

/* End of file UsersController.php */
/* Location: ./app/Controller/UsersController.php */