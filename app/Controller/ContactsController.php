<?php
/**
 * Class for performing all contact related functions
 * 
 * @author:   AnkkSoft.com
 * Copyright: AnkkSoft 2020
 * Website:   https://www.ankksoft.com
 * CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class ContactsController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('Contact', 'ContactDeal', 'Deal', 'Company', 'Custom', 'CustomContact');

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
        //check if admin or staff
        $this->checkAdminStaff();
    }

    /**
     * This function is used to display contacts home page,list all contacts
     *
     * @return array
     */
    public function index($letter = null)
    {
        //check permissions
        $this->checkStaffPermission('11');

        $limit = 15;
        //pagination conditions
        if ($letter) {
            $conditions['Contact.name LIKE'] = $letter . '%';
        } else {
            $conditions = null;
        }
        $this->paginate = array('conditions' => $conditions, 'limit' => $limit, 'order' => 'Contact.name asc');
        $Contacts = $this->paginate('Contact');
        //count total contacts
        $countContacts = $this->Contact->find('count', array('conditions' => $conditions));
        $total_pages = ceil($countContacts / $limit);

        //get companies list
        if ($this->checkAdmin()):
            $companies = $this->Company->getCompanyList();
        else:
            $groupId = $this->Auth->user('group_id');
            $companies = $this->Company->getCompaniesByGroup($groupId);
        endif;

        //get all contact custom fields
        $custom = $this->Custom->getContactFields();

        //set variables to view
        $this->set(compact('Contacts', 'total_pages', 'companies', 'custom', 'letter'));

        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $data = $this->render('/Elements/contacts');
            $arrays = array('total' => $total_pages, 'letter' => $letter, 'html' => $data->body());
            return new CakeResponse(array('type' => 'json', 'body' => json_encode($arrays)));
        }
    }

    /**
     * This function is used to add new contact
     *
     * @return void
     */
    public function add()
    {
        // autorender off for view
        $this->autoRender = false;
        //check permissions
        $this->checkStaffPermission('12');

        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->Contact->create();
            $this->request->data['Contact']['picture'] = 'user.png';
            $this->request->data['Contact']['user_id'] = $this->Auth->user('id');
            //if contact saved
            if ($this->Contact->save($this->request->data)) {
                //get contact id
                $contactId = $this->Contact->getLastInsertId();
                //custom fields
                $custom = $this->Custom->getContactFieldsId();
                foreach ($custom as $row):
                    $this->CustomContact->create();
                    $this->request->data['CustomContact']['custom_id'] = $row['Custom']['id'];
                    $this->request->data['CustomContact']['contact_id'] = $contactId;
                    $this->request->data['CustomContact']['value'] = $this->request->data['Custom']['value' . $row['Custom']['id']];
                    $this->CustomContact->save($this->request->data);
                endforeach;
                //success message
                $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }

            //redirect to contacts home
            return $this->redirect(
                    array('controller' => 'contacts', 'action' => 'index')
            );
        }
    }

    /**
     * This function is used to update contact details
     *
     * @return json
     */
    public function edit($id = null)
    {
        // autorender off for view
        $this->autoRender = false;

        //check permissions
        $this->checkStaffPermission('13');

        //--------- Post request  -----------
        if ($this->request->is(array('post', 'put'))) {

            $this->request->data['Contact']['id'] = $id;
            //save company details
            $success = $this->Contact->save($this->request->data);

            //if succfully saved 
            if ($success) {
                foreach ($this->request->data['Custom'] as $key => $value):
                    $this->request->data['CustomContact']['id'] = $key;
                    $this->request->data['CustomContact']['value'] = $value;
                    $this->CustomContact->save($this->request->data);
                endforeach;
                $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
        }
        //redirect to companies home page
        return $this->redirect(
                array('controller' => 'contacts', 'action' => 'view', $id)
        );
    }

    /**
     * This function is used to delete contact
     *
     * @return json
     */
    public function delete()
    {
        // autorender off for view
        $this->autoRender = false;

        //check permissions
        $this->checkStaffPermission('14');

        $contactId = $this->request->data['Contact']['id'];

        //if not empty contact id
        if (!empty($contactId)) {

            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //get contact image
                $contact = $this->Contact->getContactImage($contactId);
                //delete contact
                $success = $this->Contact->delete($contactId, false);
                //if contact deleted
                if ($success) {
                    //delete  assign contact to all deals
                    $this->ContactDeal->deleteAll(array('ContactDeal.contact_id' => $contactId));
                    //remove contact image
                    $fullpath = WWW_ROOT . "img/contact";
                    if (!empty($contact['Contact']['picture']) && file_exists($fullpath . DS . $contact['Contact']['picture']) && $contact['Contact']['picture'] != 'user.png') {
                        unlink($fullpath . DS . $contact['Contact']['picture']);
                        unlink($fullpath . '/thumb/' . $contact['Contact']['picture']);
                    }
                    //return success json message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $contactId);
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
     * This function is used to search contacts from deal view page
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
                //get contacts by contact name like
                $results = $this->Contact->find('all', array('conditions' => array('Contact.name LIKE' => '%' . $name . '%'), 'fields' => array('Contact.name,Contact.id')));
            }
            foreach ($results as $row) {
                $arr[] = array('id' => $row['Contact']['id'], 'name' => $row['Contact']['name']);
            }
            //return contacts in json variable
            echo json_encode($arr);
        }
    }

    /**
     * This function is used to add contact in deal after search contact from deal view page
     *
     * @return void
     */
    public function deal()
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';

            //Common variables
            $contactId = $this->request->data['itemId'];
            $dealId = $this->request->data['dealId'];

            //if contact not empty
            if (!empty($contactId)) {
                //check contact already added
                $result = $this->ContactDeal->getContactDeal($dealId, $contactId);
                if ($result) {

                    $response = array('bug' => 1, 'msg' => 'failure');
                    return json_encode($response);
                } else {

                    $this->ContactDeal->create();
                    //Common variables
                    $this->request->data['ContactDeal']['contact_id'] = $contactId;
                    $this->request->data['ContactDeal']['deal_id'] = $dealId;
                    //assign contact to deal
                    if ($this->ContactDeal->save($this->request->data)) {

                        //success message
                        //$this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
                        $contact = $this->Contact->getContactById($contactId);
                        //save contact assign activity
                        $this->activity($dealId, $contact['Contact']['name'], 'add_Contact');
                        //set to view
                        $this->set(compact('contact'));
                        $data = $this->render('/Elements/deal-data');
                        $arrays = array('module' => 2, 'html' => $data->body());
                        return new CakeResponse(array('type' => 'json', 'body' => json_encode($arrays)));
                    }
                }
            }
        }
    }

    /**
     * This function is used to delete contact from deal view page
     *
     * @return json
     */
    public function unlink()
    {
        // autorender off for view
        $this->autoRender = false;
        //Common variables
        $contactId = $this->request->data['Item']['id'];
        $dealId = $this->request->data['Deal']['id'];

        //if contact exixt
        if (!empty($contactId)) {

            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {

                //un assign contact from deal
                $success = $this->ContactDeal->deleteAll(array('deal_id' => $dealId, 'contact_id' => $contactId), true);
                //If contact successfully deleted
                if ($success) {
                    //get contact
                    $contact = $this->Contact->getContactById($contactId);
                    //save un assing activity
                    $this->activity($dealId, $contact['Contact']['name'], 'unlink_Contact');
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $contactId);
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
     * This function is used to display contacts details page
     *
     * @return array
     */
    public function view($id = null)
    {
        //check permissions
        $this->checkStaffPermission('11');

        //if id not exixt return to contacts home page
        if (empty($id)) {
            return $this->redirect(
                    array('controller' => 'contacts', 'action' => 'index')
            );
        }
        //check user is admin or user
        $userId = ($this->checkAdmin()) ? '' : $this->Auth->user('id');
        $userGId = $this->Auth->user('user_group_id');
        $groupId = $this->Auth->user('group_id');
        //get contact 
        $contact = $this->Contact->getContactById($id);
        //get assing deal to contact
        $deals = $this->Deal->getDealsByContact($id, $userId, $userGId, $groupId);
        //get contact custom fields
        $custom = $this->Custom->getContactCF($id);
        //get companies
        if ($this->checkAdmin()):
            $companies = $this->Company->getCompanyList();
        else:
            $groupId = $this->Auth->user('group_id');
            $companies = $this->Company->getCompaniesByGroup($groupId);
        endif;

        //set variables to view
        $this->request->data = $contact;
        $this->set(compact('contact', 'deals', 'custom', 'companies'));
    }

    /**
     * This function is used to update contact picture
     *
     * @return void
     */
    public function picture()
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Post/Ajax request  -----------
        if ($this->request->isPost() || $this->RequestHandler->isAjax() || isset($_SERVER['HTTP_REFERER'])) {
            $contactId = $this->request->data['Contact']['id'];
            $this->Contact->set($this->request->data);

            //check if contact image exixt
            if (!empty($this->request->data['Contact']['picture']['tmp_name']) && is_uploaded_file($this->request->data['Contact']['picture']['tmp_name'])) {
                $path_info = pathinfo($this->request->data['Contact']['picture']['name']);
                chmod($this->request->data['Contact']['picture']['tmp_name'], 0644);
                $photo = time() . mt_rand() . "." . $path_info['extension'];
                //path to contact image directory
                $fullpath = WWW_ROOT . "img/contact";
                if (!is_dir($fullpath)) {
                    mkdir($fullpath, 0777, true);
                }
                //save contact image
                move_uploaded_file($this->request->data['Contact']['picture']['tmp_name'], $fullpath . DS . $photo);
                $contact = $this->Contact->getContactImage($contactId);
                $this->request->data['Contact']['picture'] = $photo;
                //remove old contact image
                if (!empty($contact['Contact']['picture']) && file_exists($fullpath . DS . $contact['Contact']['picture']) && $contact['Contact']['picture'] != 'user.png') {
                    unlink($fullpath . DS . $contact['Contact']['picture']);
                    unlink($fullpath . '/thumb/' . $contact['Contact']['picture']);
                }
                $old_path = $fullpath . DS . $photo;
                $new_path = WWW_ROOT . "img/contact/thumb" . DS . $photo;
                //resize image for thumbnail
                $this->resize_image($old_path, $new_path, $path_info['extension'], 80, 80, $options = array());

                //save contact image in database
                if ($this->Contact->save($this->request->data)) {
                    //redirect to contact view 
                    $this->redirect(array('action' => 'view', $contactId));
                }
            } else {
                $this->Session->setFlash(__('Please Select Image'));
                //redirect to contact view 
                $this->redirect(array('action' => 'view', $contactId));
            }
        }
    }

    /**
     * This function is used to import contacts
     *
     * @return array
     */
    public function import()
    {
        //--------- Ajax request/Post request  -----------
        if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
            if (!empty($this->request->data['Contact']['csv_file']['tmp_name']) && is_uploaded_file($this->request->data['Contact']['csv_file']['tmp_name'])) {
                $path_info = pathinfo($this->request->data['Contact']['csv_file']['name']);
                if (strtolower($path_info['extension']) == 'csv') {
                    $handle = fopen($this->request->data['Contact']['csv_file']['tmp_name'], "r");
                    //Grab the headers before doing insertion
                    $headers = fgetcsv($handle, 1000, ",");
                    while (($value = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $this->Contact->Create();
                        $this->request->data['Contact']['name'] = $value[0];
                        $this->request->data['Contact']['title'] = $value[1];
                        $this->request->data['Contact']['email'] = $value[2];
                        $this->request->data['Contact']['phone'] = $value[3];
                        $this->request->data['Contact']['address'] = $value[4];
                        $this->request->data['Contact']['city'] = $value[5];
                        $this->request->data['Contact']['state'] = $value[6];
                        $this->request->data['Contact']['zip_code'] = $value[7];
                        $this->request->data['Contact']['country'] = $value[8];
                        $this->request->data['Contact']['location'] = $value[9];
                        $this->request->data['Contact']['description'] = $value[10];
                        $this->request->data['Contact']['website'] = $value[11];
                        $this->request->data['Contact']['facebook'] = $value[12];
                        $this->request->data['Contact']['twitter'] = $value[13];
                        $this->request->data['Contact']['linkedIn'] = $value[14];
                        $this->request->data['Contact']['skype'] = $value[15];
                        $this->request->data['Contact']['youtube'] = $value[16];
                        $this->request->data['Contact']['google_plus'] = $value[17];
                        $this->request->data['Contact']['pinterest'] = $value[18];
                        $this->request->data['Contact']['tumblr'] = $value[19];
                        $this->request->data['Contact']['instagram'] = $value[20];
                        $this->request->data['Contact']['github'] = $value[21];
                        $this->request->data['Contact']['digg'] = $value[22];
                        try {
                            $success = $this->Contact->save($this->request->data);
                        } catch (Exception $e) {
                            $success = '';
                        }
                    }
                    if ($success) {
                        //success message
                        $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
                    } else {
                        //failure message
                        $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
                    }
                }
            }
        }
    }

    /**
     * This function is used to display contacts list all contacts
     *
     * @return array
     */
    public function lists()
    {
        //check permissions
        $this->checkStaffPermission('11');

        $limit = 15;

        $this->paginate = array('conditions' => $conditions, 'limit' => $limit, 'order' => 'Contact.name asc');
        $contacts = $this->paginate('Contact');


        //get companies list
        if ($this->checkAdmin()):
            $companies = $this->Company->getCompanyList();
        else:
            $groupId = $this->Auth->user('group_id');
            $companies = $this->Company->getCompaniesByGroup($groupId);
        endif;

        //get all contact custom fields
        $custom = $this->Custom->getContactFields();

        //set variables to view
        $this->set(compact('contacts', 'companies', 'custom'));

        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $this->render('/Elements/contacts-list');
        }
    }

    /**
     * This function is used to send email to contact
     *
     * @return void
     */
    public function send_message()
    {
        // autorender off for view
        $this->autoRender = false;
        if (!empty($this->request->data['Mail']['subject']) && !empty($this->request->data['Mail']['message'])):
            try {
                $send = $this->Notification('mail', $this->request->data['Mail']['to'], $this->request->data['Mail']['subject'], $this->request->data['Mail']['message']);
                if ($send):
                    $response = array('bug' => 0, 'msg' => 'success');
                    return json_encode($response);
                endif;
            } catch (Exception $e) {
                $response = array('bug' => 1, 'msg' => 'fail');
                return json_encode($response);
            }
        else:
            $response = array('bug' => 1, 'msg' => 'fail');
            return json_encode($response);
        endif;
    }
}

/* End of file ContactsController.php */
/* Location: ./app/Controller/ContactsController.php */