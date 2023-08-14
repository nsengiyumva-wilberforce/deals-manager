<?php

/**
 * Class for performing all source related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class SourcesController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('Source', 'SourceDeal', 'Deal');

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
     * This function is used to display source home page.
     *
     * @var array
     */
    public function index()
    {
        //get all sources
        $sources = $this->Source->getAllSources();

        //set variables to view
        $this->set(compact('sources'));
    }

    /**
     * This function is used to add new source
     *
     * @return void
     */
    public function add()
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->Source->create();
            //save source
            if ($this->Source->save($this->request->data)) {
                //sucess message
                $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
                //redirect to sources home page
                return $this->redirect(
                        array('controller' => 'sources', 'action' => 'index')
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
    public function edit()
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            //--------- Ajax request  -----------
            if ($this->RequestHandler->isAjax()) {
                $this->layout = 'ajax';
                //common variables
                $this->request->data['Source']['id'] = $this->request->data['pk'];
                $this->request->data['Source']['name'] = $this->request->data['value'];
                //update source
                $success = $this->Source->save($this->request->data);
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
     * This function is used to search source in view deal page
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
                //get like  sources by search source keyword
                $results = $this->Source->find('all', array('conditions' => array('Source.name LIKE' => '%' . $name . '%'), 'fields' => array('Source.name,Source.id')));
            };
            foreach ($results as $row) {
                $arr[] = array('id' => $row['Source']['id'], 'name' => $row['Source']['name']);
            }
            //return json source names
            echo json_encode($arr);
        }
    }

    /**
     * This function is used to delete source
     *
     * @return json
     */
    public function delete()
    {
        // autorender off for view
        $this->autoRender = false;
        $sourceId = $this->request->data['Source']['id'];
        if (!empty($sourceId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete source
                $success = $this->Source->delete($sourceId, false);
                if ($success) {
                    //delete all assing sources to deal
                    $this->SourceDeal->deleteAll(array('SourceDeal.source_id' => $sourceId));
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $sourceId);
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
     * This function is used to add source in deal
     *
     * @return json
     */
    public function deal()
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Ajax request  -----------
        if ($this->RequestHandler->isAjax()) {
            $this->layout = 'ajax';
            $sourceId = $this->request->data['itemId'];
            $dealId = $this->request->data['dealId'];
            if (!empty($sourceId)) {
                //check assign source
                $result = $this->SourceDeal->getSourceDeal($dealId, $sourceId);
                if ($result) {
                    //return json failure message
                    $response = array('bug' => 1, 'msg' => 'failure');
                    return json_encode($response);
                } else {
                    $this->SourceDeal->create();
                    $this->request->data['SourceDeal']['source_id'] = $sourceId;
                    $this->request->data['SourceDeal']['deal_id'] = $dealId;
                    //assign source to deal
                    if ($this->SourceDeal->save($this->request->data)) {
                        //get source by id
                        $source = $this->Source->getSourceById($sourceId);
                        //activity for add source
                        $this->activity($dealId, $source['Source']['name'], 'add_Source');

                        //set task variable to view
                        $this->set(compact('source'));
                        $data = $this->render('/Elements/deal-data');
                        $arrays = array('module' => 1, 'html' => $data->body());
                        return new CakeResponse(array('type' => 'json', 'body' => json_encode($arrays)));
                    }
                }
            }
        }
    }

    /**
     * This function is used to delete source from deal
     *
     * @return json
     */
    public function unlink()
    {
        // autorender off for view
        $this->autoRender = false;
        //common variables
        $sourceId = $this->request->data['Item']['id'];
        $dealId = $this->request->data['Deal']['id'];
        if (!empty($sourceId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete source from deal
                $success = $this->SourceDeal->deleteAll(array('deal_id' => $dealId, 'source_id' => $sourceId), true);
                if ($success) {
                    $source = $this->Source->getSourceById($sourceId);
                    //activity for add source
                    $this->activity($dealId, $source['Source']['name'], 'unlink_Source');
                    //retu
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $sourceId);
                    return json_encode($response);
                } else {
                    $response = array('bug' => 1, 'msg' => 'failure');
                    return json_encode($response);
                }
            }
        }
    }

    /**
     * This function is used to View for source details page
     *
     * @return array
     */
    public function view($id = null)
    {
        $userId = ($this->checkAdmin()) ? '' : $this->Auth->user('id');
        $userGId = $this->Auth->user('user_group_id');
        $groupId = $this->Auth->user('group_id');
        //get source
        $source = $this->Source->getSourceById($id);
        //get deals in source
        $deals = $this->Deal->getDealsBySource($id, $userId, $userGId, $groupId);
        //set variables to view
        $this->set(compact('source', 'deals'));
    }
}

/* End of file SourcesController.php */
/* Location: ./app/Controller/SourcesController.php */