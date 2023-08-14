<?php
/**
 * Class for performing  Application related functions
 * 
 * @author:   AnkkSoft.com
 * Copyright: AnkkSoft 2020
 * Website:   https://www.ankksoft.com
 * CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
App::uses('Controller', 'Controller');

class AppController extends Controller
{

    /**
     * This controller uses following components
     *
     * @var array
     */
    public $components = array(
        'Session',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'userModel' => 'User',
                    'fields' => array(
                        'username' => 'username',
                        'password' => 'password'
                    ),
                    'scope' => array('User.active' => '1')
                )
            ),
            'loginRedirect' => array('controller' => 'admins', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
            'loginAction' => array('admin' => false, 'controller' => 'admins', 'action' => 'index'),
            'authError' => 'Check logged in.',
            'loginError' => 'Invalid Username or Password',
        ),
    );

    /**
     * Called before the controller action.  You can use this method to configure and customize components
     * or perform logic that needs to happen before each controller action.
     *
     * @return void
     */
    public function beforeFilter()
    {
        //allow functions access without login
        $this->Auth->allow('login', 'forgotPassword');
        //set appliction time zone
        Configure::write('Config.timezone', $this->Session->read('Auth.User.timezone'));
        Configure::write('Config.language', $this->Session->read('Auth.User.language'));
    }

    /**
     * This function is performed before view
     *
     * @return void
     */
    public function beforeRender()
    {
        //set error page layout
        if ($this->name == 'CakeError') {
            $this->layout = 'error';
        }
    }

    /**
     * This function is used for check user is login or not
     *
     * @return void
     */
    public function checkLogin()
    {
        if (!$this->Auth->user('id') || $this->Auth->user('active') == '0') {
            //redirect to login page
            return $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }
    }

    /**
     * This Function is used for add activity of deal in various module.
     *
     * @return void
     */
    public function activity($dealId, $act, $module)
    {
        //load activity modal
        $this->loadModel('Timeline');
        //common variables
        $this->request->data['Timeline']['activity'] = $act;
        $this->request->data['Timeline']['module'] = $module;
        $this->request->data['Timeline']['deal_id'] = $dealId;
        $this->request->data['Timeline']['user_id'] = $this->Auth->user('id');
        $this->request->data['Timeline']['user'] = $this->Auth->user('name');
        $this->request->data['Timeline']['pipeline_id'] = $this->Session->read('Pipeline.id');
        $this->Timeline->create();
        //save activity
        $this->Timeline->save($this->request->data);
    }

    /**
     * This Function is used to check if user type is Admin or not.
     *
     * @var bool
     */
    public function isAdmin()
    {
        //check if user type is admin
        if ($this->Auth->user('user_group_id') == '1') {
            return true;
        } else {
            //redirect to dashboard
            return $this->redirect(array('controller' => 'admins', 'action' => 'index'));
        }
    }

    /**
     * This Function is used to check if user type is staff or not.
     *
     * @var bool
     */
    public function isStaff()
    {
        //check if user type is admin
        if ($this->Auth->user('user_group_id') == '3') {
            return true;
        } else {
            //redirect to dashboard
            return $this->redirect(array('controller' => 'admins', 'action' => 'index'));
        }
    }

    /**
     * This Function is used to check if user type is admin or manager.
     *
     * @var bool
     */
    public function isAdminManager()
    {
        //check if user type is admin
        if ($this->Auth->user('user_group_id') == '1' || $this->Auth->user('user_group_id') == '2') {
            return true;
        } else {
            //redirect to dashboard
            return $this->redirect(array('controller' => 'admins', 'action' => 'index'));
        }
    }

    /**
     *  This Function is used to check if user type is admin or not.
     *
     * @return bool
     */
    public function checkAdmin()
    {
        if ($this->Auth->user('user_group_id') == '1') {
            return true;
        }
    }

    /**
     *  This Function is used to check if user type is manager or not.
     *
     * @return bool
     */
    public function checkManager()
    {
        if ($this->Auth->user('user_group_id') == '2') {
            return true;
        }
    }

    /**
     *  This Function is used to check if user type is staff or not.
     *
     * @return bool
     */
    public function checkStaff()
    {
        if ($this->Auth->user('user_group_id') == '3') {
            return true;
        }
    }

    /**
     *  This Function is used to check if user type is manager & staff or not.
     *
     * @return bool
     */
    public function checkManagerStaff()
    {
        if ($this->Auth->user('user_group_id') == '2' || $this->Auth->user('user_group_id') == '3') {
            return true;
        }
    }

    /**
     *  This Function is used to check if user type is admin & staff or not.
     *
     * @return bool
     */
    public function checkAdminStaff()
    {
        if ($this->Auth->user('user_group_id') == '1' || $this->Auth->user('user_group_id') == '2' || $this->Auth->user('user_group_id') == '3') {
            return true;
        } else {
            //redirect to dashboard
            return $this->redirect(array('controller' => 'admins', 'action' => 'index'));
        }
    }

    /**
     *  This Function is used to check if user type is client or not.
     *
     * @return bool
     */
    public function checkClient()
    {
        if ($this->Auth->user('user_group_id') == '4') {
            return true;
        }
    }

    /**
     *  This Function is used to check if admin has permission to access module.
     *
     * @return bool
     */
    public function checkPermission($id = null)
    {
        $user = $this->Auth->user('permission');
        if (empty($user)) {
            return true;
        } else {
            //redirect to dashboard
            $permissions = explode(',', $this->Auth->user('permission'));
            if (in_array($id, $permissions)) {
                return true;
            } else {
                return $this->redirect(array('controller' => 'admins', 'action' => 'index'));
            }
        }
    }

    /**
     *  This Function is used to check if staff has permission to access module.
     *
     * @return bool
     */
    public function checkStaffPermission($id = null)
    {
        $user = $this->Auth->user('permission');
        if (empty($user) || $this->Auth->user('user_group_id') == '1') {
            return true;
        } else {
            //redirect to dashboard
            $permissions = explode(',', $this->Auth->user('permission'));
            if (in_array($id, $permissions)) {
                return true;
            } else {
                return $this->redirect(array('controller' => 'admins', 'action' => 'index'));
            }
        }
    }

    /**
     * Resize image and make thumbnail of image to any size.
     *
     * @return bool
     */
    public function resize_image($src, $dest, $extension, $toWidth, $toHeight, $options = array())
    {
        if (!file_exists($src)) {
            die("$src file does not exist");
        }

        //OPEN THE IMAGE INTO A RESOURCE
        switch ($extension) {
            case 'jpg':
                $img = imagecreatefromjpeg($src);  //try jpg
                break;

            case 'gif':
                $img = imagecreatefromgif($src);   //try gif
                break;

            case 'png':
                $img = imageCreateFromPng($src);   //try png
                break;
        }

        //ORIGINAL DIMENTIONS
        list( $width, $height ) = getimagesize($src);

        //ORIGINAL SCALE
        $xscale = $width / $toWidth;
        $yscale = $height / $toHeight;

        //NEW DIMENSIONS WITH SAME SCALE
        if ($yscale > $xscale) {
            $new_width = round($width * (1 / $yscale));
            $new_height = round($height * (1 / $yscale));
        } else {
            $new_width = round($width * (1 / $xscale));
            $new_height = round($height * (1 / $xscale));
        }

        //NEW IMAGE RESOURCE
        if (!($imageResized = imagecreatetruecolor($new_width, $new_height))) {
            die("Could not create new image resource of width : $new_width , height : $new_height");
        }

        //RESIZE IMAGE
        if (!imagecopyresampled($imageResized, $img, 0, 0, 0, 0, $new_width, $new_height, $width, $height)) {
            die('Resampling failed');
        }
        switch ($extension) {
            case 'jpg':
                imagejpeg($imageResized, $dest); //try jpg
                break;

            case 'gif':
                imagegif($imageResized, $dest);   //try gif
                break;

            case 'png':
                imagepng($imageResized, $dest);    //try png
                break;
        }
        chmod($dest, 0777);
        //Free the memory
        imagedestroy($img);
        imagedestroy($imageResized);

        return true;
    }

    /**
     * Email Function for sending emails
     *
     * @return void
     */
    public function Notification($template, $to, $subject = null, $data = null)
    {
        //load company settings modal
        $this->loadModel('SettingCompany');
        $this->loadModel('SettingEmail');
        //get company settings
        $Company = $this->SettingCompany->findById('1');
        if ($subject == null) {
            $subject = 'company.com';
        }
        if ($to == null) {
            $to = $Company['SettingCompany']['system_email'];
        }
        //check if localhost or live server
        $whitelist = array(
            '127.0.0.1',
            '::1'
        );
        //Get Email Settings
        App::uses('CakeEmail', 'Network/Email');
        $EmailSettings = $this->SettingEmail->findById('1');
        if (in_array($_SERVER['REMOTE_ADDR'], $whitelist) || $EmailSettings['SettingEmail']['protocol'] == '1') {
            $cakeEmail = new CakeEmail('smtp');
        } else {
            $cakeEmail = new CakeEmail();
        }
        //send email
        $cakeEmail->template($template)
            ->emailFormat('html')
            ->subject($subject)
            ->to($to)
            ->from($Company['SettingCompany']['system_email_from'], $Company['SettingCompany']['name'])
            ->replyTo('no-reply@example.com')
            ->viewVars(array(
                'data' => $data,
                'company' => $Company,
            ))
            ->send();
    }
}

/* End of file AppController.php */
/* Location: ./app/Controller/AppController.php */