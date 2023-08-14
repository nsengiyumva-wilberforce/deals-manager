<?php
/**
 * Class for performing all file related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class FilesController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('AppFile');

    /**
     * This controller uses following helpers
     *
     * @var array
     */
    var $helpers = array('Html', 'Form', 'Js', 'Paginator', 'Time', 'Common');

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
     * This Function is default 
     *
     * @return void
     */
    public function index()
    {
        // autorender off for view
        $this->autoRender = false;
    }

    /**
     * This function used to add file in deal
     *
     * @return void
     */
    public function add()
    {
        // autorender off for view
        $this->autoRender = false;
        //if file exixt
        if (!empty($_FILES)) {
            $path_info = pathinfo($_FILES['file']['name']);
            $file = mt_rand() . '-' . pathinfo($_FILES['file']['name'], PATHINFO_FILENAME) . "." . $path_info['extension'];
            //path where file saving
            $fullpath = WWW_ROOT . "files/deal";
            //save file to server
            move_uploaded_file($_FILES['file']['tmp_name'], $fullpath . DS . $file);
            $this->request->data['AppFile']['name'] = $file;
            $this->request->data['AppFile']['user_id'] = $this->Auth->user('id');
            //save file data
            if ($this->AppFile->save($this->request->data)) {
                $fileId = $this->AppFile->getLastInsertID();

                //activity for add file
                $this->activity($this->request->data['AppFile']['deal_id'], $this->request->data['AppFile']['name'], 'add_File');

                $file = $this->AppFile->getFilesById($fileId);
                //set variable to view
                $this->set(compact('file'));
                $data = $this->render('/Elements/deal-data');
                $arrays = array('bug' => 0, 'html' => $data->body());
                return new CakeResponse(array('type' => 'json', 'body' => json_encode($arrays)));
            }
        }
    }

    /**
     * This Function used to update file description.
     *
     * @return json
     */
    public function edit()
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Post request -----------
        if ($this->request->is('post')) {
            //--------- Ajax request for getting companies -----------
            if ($this->RequestHandler->isAjax()) {
                $this->layout = 'ajax';
                //common variables
                $this->request->data['AppFile']['id'] = $this->request->data['pk'];
                $this->request->data['AppFile']['description'] = $this->request->data['value'];
                //save file details
                $success = $this->AppFile->save($this->request->data);
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
     * This function used to download file
     *
     * @return file
     */
    public function download($dealId = null, $name = null)
    {
        // autorender off for view
        $this->autoRender = false;
        //class for media
        $this->viewClass = 'Media';
        //file full path
        $filepath = APP . WEBROOT_DIR . DS . "files/deal/" . $name;
        if (file_exists($filepath)) :
            //file for download
            $this->response->file($filepath, array('download' => true));
        else:
            $this->Flash->success('File not exixts.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            //redirect to setting page
            return $this->redirect(array('controller' => 'deals', 'action' => 'view', $dealId));
        endif;
    }

    /**
     * This Function used to delete file from deal.
     *
     * @return json
     */
    public function unlink()
    {
        // autorender off for view
        $this->autoRender = false;
        //common variables
        $fileId = $this->request->data['Item']['id'];
        $dealId = $this->request->data['Deal']['id'];
        if (!empty($fileId)) {
            //--------- Post/Ajax request -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                $file = $this->AppFile->getFilesById($fileId);
                //delete file from database
                $success = $this->AppFile->delete(array('id' => $fileId), true);
                if ($success) {
                    //activity for file delete
                    $this->activity($dealId, $file['AppFile']['name'], 'unlink_File');
                    $fullpath = WWW_ROOT . "files/deal/" . $file['AppFile']['name'];
                    //remove file from server
                    if (file_exists($fullpath)):
                        unlink($fullpath);
                    endif;
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $fileId);
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

/* End of file FilesController.php */
/* Location: ./app/Controller/FilesController.php */