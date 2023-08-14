<?php

/**
 * Class for performing all announcement related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class AnnouncementsController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('Announcement');

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
     * This function is used to display announcements home page.
     *
     * @var array
     */
    public function index()
    {
        //check if admin
        $this->isAdmin();
        //get all announcements     
        $announcements = $this->Announcement->getAllAnnouncement();
        //set variables to view
        $this->set(compact('announcements'));
    }

    /**
     * This function is used to add new announcement
     *
     * @return void
     */
    public function add()
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->Announcement->create();
            $this->request->data['Announcement']['user_id'] = $this->Auth->user('id');
            $this->request->data['Announcement']['start_date'] = date('Y-m-d', strtotime($this->request->data['Announcement']['start_date']));
            $this->request->data['Announcement']['end_date'] = date('Y-m-d', strtotime($this->request->data['Announcement']['end_date']));
            $this->request->data['Announcement']['read'] = 0;
            //save source
            if ($this->Announcement->save($this->request->data)) {
                //sucess message
                $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
                //redirect to sources home page
                return $this->redirect(
                        array('controller' => 'announcements', 'action' => 'index')
                );
            } else {
                //return json failure message
                $response = array('bug' => 1, 'msg' => 'failure');
                return json_encode($response);
            }
        }
    }

    /**
     * This function is used to edit announcement
     *
     * @return json
     */
    public function edit($id = null)
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Post request  -----------
        if ($this->request->is('post')) {

            $this->layout = 'ajax';
            //common variables
            $this->request->data['Announcement']['start_date'] = date('Y-m-d', strtotime($this->request->data['Announcement']['start_date']));
            $this->request->data['Announcement']['end_date'] = date('Y-m-d', strtotime($this->request->data['Announcement']['end_date']));
            //update source
            $success = $this->Announcement->save($this->request->data);
            //redirect to sources home page
            return $this->redirect(
                    array('controller' => 'announcements', 'action' => 'index')
            );
        }
        //--------- Post request  -----------
        if ($this->request->is('get')) {
            //get announcement
            $announcement = $this->Announcement->find('first', array('conditions' => array('Announcement.id' => $id)));
            $this->request->data = $announcement;
            //set variables to view
            $this->set(compact('announcement'));
            $this->render('/Elements/modal');
        }
    }

    /**
     * This function is used to delete announcement
     *
     * @return json
     */
    public function delete()
    {
        // autorender off for view
        $this->autoRender = false;
        $announcementId = $this->request->data['Announcement']['id'];
        if (!empty($announcementId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete source
                $success = $this->Announcement->delete($announcementId, false);
                if ($success) {
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $announcementId);
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
     * This function is used to View for announcement details page
     *
     * @return array
     */
    public function view($id = null)
    {
        //get announcement
        $announcement = $this->Announcement->getAnnouncementById($id);

        //set variables to view
        $this->set(compact('announcement'));
    }

    /**
     * This function is used to read announcements by user
     *
     * @return array
     */
    public function read($id = null)
    {
        // autorender off for view
        $this->autoRender = false;
        if ($id):
            //get announcement
            $announcement = $this->Announcement->getAnnouncementById($id);
            $userId = $this->Auth->user('id');
            $read = $announcement['Announcement']['read'];
            if ($read):
                $read = $read . ',' . $userId;
            else:
                $read = $userId;
            endif;
            $this->Announcement->id = $id;
            $success = $this->Announcement->saveField("read", $read);
            if ($success) {
                //return json success message
                $response = array('bug' => 0, 'msg' => 'success');
                return json_encode($response);
            } else {
                //return json failure message
                $response = array('bug' => 1, 'msg' => 'failure');
                return json_encode($response);
            }
        endif;
    }
}

/* End of file AnnouncementsController.php */
/* Location: ./app/Controller/AnnouncementsController.php */