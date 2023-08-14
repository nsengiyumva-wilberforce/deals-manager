<?php
/**
 * class for performing all todo related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Todo extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Todo';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'todo';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array();

    

    /**
     * This function is used to get todos by status & user
     *
     * @access public
     * @return array
     */
    public function getTodoByStatus($status,$userId)
    {
        $result = $this->find('all', array('conditions' => array('Todo.status' => $status, 'Todo.user_id' => $userId), 'fields' => array('Todo.*')));
        return $result;
    }
    
    
}
