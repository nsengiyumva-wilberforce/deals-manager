<?php

/**
 * Class for performing all note related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Note extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Note';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'notes';

    /**
     * This function is used to get note by user id
     *
     * @access public
     * @return array
     */
    public function getNote($userId)
    {
        $result = $this->find('all', array('conditions' => array('Note.user_id' => $userId), 'fields' => array('Note.*'),'order' => 'Note.id Desc'));

        return $result;
    }

    /**
     * This function is used to get note by id
     *
     * @access public
     * @return array
     */
    public function getNoteById($id)
    {
        $result = $this->find('first', array('conditions' => array('Note.id' => $id)));
        return $result;
    }
}
