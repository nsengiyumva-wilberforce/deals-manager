<?php

/**
 * Class for performing all expenses related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class ExpensesController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('Expense', 'ExpenseCategory', 'Deal', 'User');

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
     * This function is used to display expense home page
     *
     * @return array
     */
    public function index()
    {
        //check if admin
        $this->isAdmin();
        //get user group type
        $userGId = $this->Auth->user('user_group_id');
        $userId = $this->Auth->user('id');
        if ($userGId == 1) {
            $expenses = $this->Expense->getExpenseAll(Null, Null, Null);
            $deals = $this->Deal->getAllDeals();
        } elseif ($userGId == 2) {
            $gId = $this->Auth->user('group_id');
            $members = $this->User->getUserIdByGroup($gId);
            $expenses = $this->Expense->getExpenseAll($userGId, $gId, $members);
        } else {
            $expenses = $this->Expense->getExpenseAll($userGId, Null, $userId);
        }
        $categories = $this->ExpenseCategory->find('list', array('fields' => array('id', 'name'), 'order' => array('name' => 'ASC')));

        //set product variable for view
        $this->set(compact('expenses', 'categories', 'deals'));
    }

    /**
     * This function is used to add Expense 
     *
     * @return void
     */
    public function add()
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Post request  -----------
        if ($this->request->is(array('post', 'put'))) {
            $this->Expense->create();
            $this->request->data['Expense']['date'] = date('Y-m-d', strtotime($this->request->data['Expense']['date']));
            if (!empty($this->request->data['Expense']['file']['tmp_name']) && is_uploaded_file($this->request->data['Expense']['file']['tmp_name'])) {
                $path_info = pathinfo($this->request->data['Expense']['file']['name']);
                chmod($this->request->data['Expense']['file']['tmp_name'], 0644);
                $file = time() . mt_rand() . "." . $path_info['extension'];
                //path to save image
                $fullpath = WWW_ROOT . "files/expenses";
                //save image on server
                move_uploaded_file($this->request->data['Expense']['file']['tmp_name'], $fullpath . DS . $file);
                $this->request->data['Expense']['file'] = $file;
            } else {
                $this->request->data['Expense']['file'] = '';
            }

            //save product
            if ($this->Expense->save($this->request->data)) {
                //success message
                $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
            return $this->redirect(
                    array('controller' => 'expenses', 'action' => 'index')
            );
        }
    }

    /**
     * It is used to edit Expense
     *
     * @return json
     */
    public function edit($id)
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Post request  -----------
        if ($this->request->is('post') || $this->request->is('put')) {
            //common variables
            $this->request->data['Expense']['date'] = date('Y-m-d', strtotime($this->request->data['Expense']['date']));
            if (!empty($this->request->data['Expense']['file']['tmp_name']) && is_uploaded_file($this->request->data['Expense']['file']['tmp_name'])) {
                $path_info = pathinfo($this->request->data['Expense']['file']['name']);
                chmod($this->request->data['Expense']['file']['tmp_name'], 0644);
                $file = time() . mt_rand() . "." . $path_info['extension'];
                //path to save image
                $fullpath = WWW_ROOT . "files/expenses";
                //save image on server
                move_uploaded_file($this->request->data['Expense']['file']['tmp_name'], $fullpath . DS . $file);
                $this->request->data['Expense']['file'] = $file;
            } else {
                unset($this->request->data['Expense']['file']);
            }
            //save product
            $success = $this->Expense->save($this->request->data);
            return $this->redirect(
                    array('controller' => 'expenses', 'action' => 'index')
            );
            // }
        }
    }

    /**
     * This function is used to delete Expense
     *
     * @return json
     */
    public function delete()
    {
        // autorender off for view
        $this->autoRender = false;
        $expenseId = $this->request->data['Expense']['id'];

        //if Expense id exist
        if (!empty($expenseId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete Expense
                $success = $this->Expense->delete($expenseId, false);
                if ($success) {
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $expenseId);
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
     * This Function is used to add new category  from setting.
     *
     * @return void
     */
    public function get_form()
    {

        if (isset($this->request->data['id'])):
            $expense = $this->Expense->findById($this->request->data['id']);
            $this->request->data = $expense;
        endif;
        $categories = $this->ExpenseCategory->find('list', array('fields' => array('id', 'name'), 'order' => array('name' => 'ASC')));
        $deals = $this->Deal->getAllDeals();
        //set product variable for view
        $this->set(compact('categories', 'deals'));
    }

    /**
     * This Function is used to add new category  from setting.
     *
     * @return void
     */
    public function category()
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->ExpenseCategory->create();
            //save ticket type
            if ($this->ExpenseCategory->save($this->request->data)) {
                //success message
                $this->Flash->success('Request has been completed.', array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            } else {
                //failure message
                $this->Flash->success('Request has been not completed.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            }
            //redirect to settings page
            return $this->redirect(
                    array('controller' => 'settings', 'action' => 'expenses')
            );
        }
    }

    /**
     * This Function is used to update expense category from settings
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
                $this->request->data['ExpenseCategory']['id'] = $this->request->data['pk'];
                if ($field == 'name') {
                    $this->request->data['ExpenseCategory']['name'] = $this->request->data['value'];
                } else {
                    $expCat = $this->ExpenseCategory->getCategoryName($this->request->data['ExpenseCategory']['id']);
                    $this->request->data['ExpenseCategory']['name'] = $expCat['ExpenseCategory']['name'];
                    $this->request->data['ExpenseCategory']['description'] = $this->request->data['value'];
                }
                //update expense category
                $success = $this->ExpenseCategory->save($this->request->data);
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
     * This Function is used to delete expense category from settings.
     *
     * @return json
     */
    public function remove()
    {
        // autorender off for view
        $this->autoRender = false;
        $catId = $this->request->data['ExpenseCategory']['id'];
        if (!empty($catId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //check if ticket type have tickets
                $expense = $this->Expense->getExpense($catId);

                if ($expense) {
                    //return json failure message for active tickets
                    $response = array('bug' => 1, 'msg' => 'Category have expenses.');
                    return json_encode($response);
                } else {
                    //delete ticket
                    $success = $this->ExpenseCategory->delete($catId, false);
                    if ($success) {
                        //return json success message
                        $response = array('bug' => 0, 'msg' => 'success', 'vId' => $catId);
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

    /**
     * This function used to download file
     *
     * @return file
     */
    public function download($name = null)
    {
        // autorender off for view
        $this->autoRender = false;
        //class for media
        $this->viewClass = 'Media';
        //file full path
        $filepath = APP . WEBROOT_DIR . DS . "files/expenses/" . $name;
        //file for download
        $this->response->file($filepath, array('download' => true));
    }
}

/* End of file ExpensesController.php */
/* Location: ./app/Controller/ExpensesController.php */