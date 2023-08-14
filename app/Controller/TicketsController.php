<?php
/**
 * Class for performing all ticket related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class TicketsController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('Ticket', 'User', 'TicketMessage', 'TicketType', 'SettingEmail', 'Company');

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
     * This function is used to display all tickets list ,tickets home page
     *
     * @return array
     */
    public function index()
    {
        $userId = ($this->checkAdmin() || $this->Auth->user('user_group_id') == '2') ? '' : $this->Auth->user('id');
        $userGId = $this->Auth->user('user_group_id');
        $conditions = array();
        //--------- Post/Ajax request  -----------
        if ($this->request->is('post')) {
            //--------- Post request  -----------
            //set session variables
            if (!empty($this->request->data['Ticket']['type_id'])) {
                $this->Session->write('Ticket.type_id', $this->request->data['Ticket']['type_id']);
            } else {
                $this->Session->delete('Ticket.type_id');
            }
            if (!empty($this->request->data['Ticket']['status'])) {
                $this->Session->write('Ticket.status', $this->request->data['Ticket']['status']);
            } else {
                $this->Session->delete('Ticket.status');
            }
            //read session variables
            if ($this->Session->check('Ticket.type_id')) {
                $conditions['Ticket.type_id'] = $this->Session->read('Ticket.type_id');
            }
            if ($this->Session->check('Ticket.status')) {
                $conditions['Ticket.status'] = $this->Session->read('Ticket.status');
            }
        } else {
            $this->Session->delete('Ticket');
        }

        //pagination conditions
        if ($userGId == 2) {
            $gId = $this->Auth->user('group_id');

            $members = $this->User->getUserIdByGroup($gId);
            $conditions['OR'] = array(
                'Ticket.user_id' => $members,
                'Ticket.assign' => $members,
                'Ticket.group_id' => $this->Auth->user('group_id'),
            );
        }
        if (!empty($userId)) {
            $conditions['OR'] = array(
                'Ticket.user_id' => $userId,
                'Ticket.assign' => $userId,
            );
        }
        $options[] = array(
            'alias' => 'TicketType',
            'table' => 'ticket_type',
            'type' => 'LEFT',
            'conditions' => 'TicketType.id = Ticket.type_id'
        );
        $options[] = array(
            'alias' => 'User',
            'table' => 'users',
            'type' => 'LEFT',
            'conditions' => 'User.id = Ticket.user_id'
        );
        $options[] = array(
            'alias' => 'Assign',
            'table' => 'users',
            'type' => 'LEFT',
            'conditions' => 'Assign.id = Ticket.assign'
        );

        $options[] = array(
            'alias' => 'Company',
            'table' => 'company',
            'type' => 'LEFT',
            'conditions' => 'Company.id = Ticket.company_id'
        );
        $this->paginate = array(
            'joins' => $options,
            'conditions' => $conditions,
            'limit' => 25,
            'order' => 'Ticket.id desc',
            'fields' => array('User.first_name', 'User.last_name', 'Ticket.*', 'TicketType.name', 'Company.name', 'Assign.first_name', 'Assign.last_name'),
        );

        $tickets = $this->paginate('Ticket');

        //get all ticket types
        $ticketTypes = $this->TicketType->getTicketTypeList();
        //get companies
        if ($this->checkManagerStaff()):
            $company = $this->Company->find('list', array('conditions' => array('FIND_IN_SET(\'' . $gId . '\',Company.groups)'), 'fields' => array('Company.id')));
        endif;
        $clients = $this->User->getClients($company);
        //set variables to view
        $this->set(compact('tickets', 'ticketTypes', 'clients'));

        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $this->render('/Elements/tickets');
        }
    }

    /**
     * This function is used to add new ticket
     *
     * @return void
     */
    public function add()
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Post request  -----------
        if ($this->request->is('post')) {
            //check if message empty
            if ($this->request->data['Ticket']['message'] == '' || $this->request->data['Ticket']['message'] == '<p><br></p>') {
                //failure message
                $this->Flash->success('Request has been not completed. Please add message.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
                return $this->redirect(array('controller' => 'tickets', 'action' => 'index'));
            } else {
                //if ticket have attachment
                if ($this->request->data['Ticket']['attachment']['name']) {
                    $path_info = pathinfo($this->request->data['Ticket']['attachment']['name']);
                    $file = mt_rand() . $path_info['filename'] . "." . $path_info['extension'];
                    $fullpath = WWW_ROOT . "files/ticket";
                    //move file to server
                    move_uploaded_file($this->request->data['Ticket']['attachment']['tmp_name'], $fullpath . DS . $file);
                    $this->request->data['Ticket']['attachment'] = $file;
                } else {
                    $this->request->data['Ticket']['attachment'] = '';
                }
                if ($this->request->data['Ticket']['user_id']):
                    $client = $this->request->data['Ticket']['user_id'];
                    $comp = $this->User->getClientCompany($client);
                    $this->request->data['Ticket']['company_id'] = $comp['User']['company_id'];
                    $this->request->data['Ticket']['assign'] = $this->Auth->user('id');
                else:
                    $this->request->data['Ticket']['user_id'] = $this->Auth->user('id');
                    $this->request->data['Ticket']['company_id'] = $this->Auth->user('company_id');
                    $this->request->data['Ticket']['assign'] = $this->Auth->user('id');
                endif;

                //get user group type
                $groupId = $this->Auth->user('group_id');
                if ($groupId) {
                    $this->request->data['Ticket']['group_id'] = $groupId;
                }
                //save ticket to database
                if ($this->Ticket->save($this->request->data)) {
                    //success message
                    $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));

                    // Ticket email send to admin
                    $emailSettings = $this->SettingEmail->getSettings();
                    if ($emailSettings['SettingEmail']['ticket'] == '1') {
                        try {
                            $send = $this->Notification('ticket', null, 'Ticket - ' . $this->request->data['Ticket']['subject'], $this->request->data['Ticket']['message']);
                        } catch (Exception $e) {
                            
                        }
                    }
                } else {
                    //failure message
                    $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
                }
                //redirect to tickets home page
                return $this->redirect(array('controller' => 'tickets', 'action' => 'index'));
            }
        }
    }

    /**
     * This function is used to edit ticket details
     *
     * @return void
     */
    public function edit()
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $ticketId = $this->request->data['Ticket']['id'];
            if ($ticketId) {
                //update ticket 
                $success = $this->Ticket->save($this->request->data);
                if ($success) {
                    //success message
                    $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
                    //redirect to ticket view
                    return $this->redirect(array('controller' => 'tickets', 'action' => 'view', $ticketId));
                } else {
                    //failure message
                    $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
                    //redirect to ticket view
                    return $this->redirect(array('controller' => 'tickets', 'action' => 'view', $ticketId));
                }
            }
        }
    }

    /**
     * This function is used to display ticket details page
     *
     * @return array
     */
    public function view($id = null)
    {
        //check if ticket exist
        $this->checkTicket($id);
        //get ticket
        $ticket = $this->Ticket->getTicketById($id);
        //get ticket messages
        $messages = $this->TicketMessage->getMessageByTicket($id);
        //get all ticket types
        $ticketTypes = $this->TicketType->getTicketTypeList();
        //assing user list
        $group = $this->Auth->user('user_group_id');
        if ($group == 1 && !empty($ticket['Ticket']['company_id'])):
            $company = $this->Company->getCompanyById($ticket['Ticket']['company_id']);
            $groups = explode(',', $company['Company']['groups']);
        else:
            $groups = $this->Auth->user('group_id');
        endif;
        $assign = $this->User->getUserByGroup($groups);

        //set variables to view
        $this->set(compact('ticket', 'messages', 'ticketTypes', 'assign'));
    }

    /**
     *  This function is used to Check if ticket is assign or for login user
     *
     * @return void
     */
    public function checkTicket($id)
    {
        $userId = ($this->checkAdmin() || $this->Auth->user('user_group_id') == '2') ? '' : $this->Auth->user('id');
        //check if ticket user exist or not
        $ticket = $this->Ticket->getTicketUser($id, $userId);
        if ($ticket) {
            return true;
        } else {
            return $this->redirect(array('controller' => 'tickets', 'action' => 'index'));
        }
    }

    /**
     * This function is used to reply message for ticket from ticket detail page
     *
     * @return void
     */
    public function reply($ticketId = null)
    {

        //--------- Post request  -----------
        if ($this->request->is('post')) {
            //check if message empty
            if ($this->request->data['TicketMessage']['message'] == '' || $this->request->data['TicketMessage']['message'] == '<p><br></p>') {
                $this->Flash->success('Message is empty ,Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
                return $this->redirect(array('controller' => 'tickets', 'action' => 'view', $ticketId));
            } else {
                $this->TicketMessage->create();
                //if ticket have attachment
                if ($this->request->data['TicketMessage']['attachment']['name']) {
                    $path_info = pathinfo($this->request->data['TicketMessage']['attachment']['name']);
                    $file = mt_rand() . $path_info['filename'] . "." . $path_info['extension'];
                    $fullpath = WWW_ROOT . "files/ticket";
                    //save attachment to server
                    move_uploaded_file($this->request->data['TicketMessage']['attachment']['tmp_name'], $fullpath . DS . $file);
                    $this->request->data['TicketMessage']['attachment'] = $file;
                } else {
                    $this->request->data['TicketMessage']['attachment'] = '';
                }
                //common variables
                $this->request->data['TicketMessage']['ticket_id'] = $ticketId;
                $this->request->data['TicketMessage']['user_id'] = $this->Auth->user('id');
                $userGId = $this->Auth->user('user_group_id');
                if ($userGId != 4):
                    $ticket = $this->Ticket->getTicket($ticketId);
                    if ($ticket['Ticket']['status'] == 0):
                        $this->Ticket->id = $ticketId;
                        $this->Ticket->saveField('status', 1);
                    endif;
                endif;
                //save ticket
                if ($this->TicketMessage->save($this->request->data)) {
                    //success message
                    $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));

                    // Ticket reply email to admin or user
                    $userId = ($this->checkAdmin()) ? '' : $this->Auth->user('id');
                    $ticket = $this->Ticket->getTicketById($ticketId);
                    $email = ($userId) ? null : $ticket['User']['email'];
                    //Email notification
                    $emailSettings = $this->SettingEmail->getSettings();
                    if ($emailSettings['SettingEmail']['ticket'] == '1') {
                        try {
                            $send = $this->Notification('ticket', $email, 'Ticket - ' . $ticket['Ticket']['subject'], $this->request->data['TicketMessage']['message']);
                        } catch (Exception $e) {
                            
                        }
                    }
                    $this->redirect(array('controller' => 'tickets', 'action' => 'view', $ticketId));
                }
            }
        }
    }

    /**
     * This function is used to download ticket files
     *
     * @return file
     */
    public function download($name = null)
    {
        // autorender off for view
        $this->autoRender = false;
        $this->viewClass = 'Media';
        //path of file
        $filepath = APP . WEBROOT_DIR . DS . "files/ticket/" . $name;
        //force download file
        $this->response->file($filepath, array('download' => true));
    }

    /**
     * This function is used to delete ticket
     *
     * @return json
     */
    public function delete()
    {
        // autorender off for view
        $this->autoRender = false;
        $ticketId = $this->request->data['Ticket']['id'];
        if (!empty($ticketId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete ticket
                $success = $this->Ticket->delete($ticketId, false);
                if ($success) {
                    //get messages in ticket
                    $messages = $this->TicketMessage->getAllMessageByTicket($ticketId);
                    foreach ($messages as $row):
                        //remove ticket files from server
                        $fullpath = WWW_ROOT . "files/ticket/" . $row['TicketMessage']['attachment'];
                        if (file_exists($fullpath)):
                            unlink($fullpath);
                        endif;
                        //delete ticket message
                        $this->TicketMessage->delete(array('id' => $row['TicketMessage']['id']), true);
                    endforeach;
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $ticketId);
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
     * This Function is used to add new ticket type from setting.
     *
     * @return void
     */
    public function type()
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->TicketType->create();
            //save ticket type
            if ($this->TicketType->save($this->request->data)) {
                //success message
                $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
            //redirect to settings page
            return $this->redirect(
                    array('controller' => 'settings', 'action' => 'ticket')
            );
        }
    }

    /**
     * This Function is used to update ticket type from settings
     *
     * @return json
     */
    public function update()
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            //--------- Ajax request  -----------
            if ($this->RequestHandler->isAjax()) {
                $this->layout = 'ajax';
                //common variables
                $field = $this->request->data['name'];
                $this->request->data['TicketType']['id'] = $this->request->data['pk'];
                if ($field == 'name') {
                    $this->request->data['TicketType']['name'] = $this->request->data['value'];
                } else {
                    $ticketType = $this->TicketType->getTicketTypeName($this->request->data['TicketType']['id']);
                    $this->request->data['TicketType']['name'] = $ticketType['TicketType']['name'];
                    $this->request->data['TicketType']['description'] = $this->request->data['value'];
                }
                //update ticket type
                $success = $this->TicketType->save($this->request->data);
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
     * This Function is used to delete ticket type from settings.
     *
     * @return json
     */
    public function remove()
    {
        // autorender off for view
        $this->autoRender = false;
        $TicketTypeId = $this->request->data['TicketType']['id'];
        if (!empty($TicketTypeId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //check if ticket type have tickets
                $checkTickets = $this->Ticket->getTicketByType($TicketTypeId);
                if ($checkTickets) {
                    //return json failure message for active tickets
                    $response = array('bug' => 1, 'msg' => 'Ticket Type have tickets');
                    return json_encode($response);
                } else {
                    //delete ticket
                    $success = $this->TicketType->delete($TicketTypeId, false);
                    if ($success) {
                        //return json success message
                        $response = array('bug' => 0, 'msg' => 'success', 'vId' => $TicketTypeId);
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
}

/* End of file TicketsController.php */
/* Location: ./app/Controller/TicketsController.php */