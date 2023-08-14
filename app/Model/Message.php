<?php

/**
 * class for performing all message related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Message extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Message';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'message';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array('message' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Message must be required'
            ),
    ));

    /**
     * This function is used to get message by id
     *
     * @access public
     * @return array
     */
    public function getMessageById($messageId)
    {
        //query
        $result = $this->find('first', array('conditions' => array('id' => $messageId)));
        return $result;
    }

    /**
     * This function is used to get messages by user id and admin id
     *
     * @access public
     * @return array
     */
    public function getMessageByUser($userId, $adminId)
    {
        //query
        $result = $this->find('all', array('conditions' => array(
                'OR' =>
                array(
                    array(
                        array('Message.message_to' => $userId),
                        array('Message.message_by' => $adminId)
                    ),
                    array(
                        array('Message.message_to' => $adminId),
                        array('Message.message_by' => $userId)
                    )
                ),
            ),
            'joins' => array(
                array(
                    'alias' => 'User',
                    'table' => 'users',
                    'type' => 'INNER',
                    'conditions' => array(
                        'User.id = Message.message_by',
                    ),
                )
            ),
            'fields' => array('Message.*', 'User.first_name', 'User.last_name', 'User.picture'),
            )
        );
        return $result;
    }

    /**
     * This function is used to get messages for notification
     *
     * @access public
     * @return array
     */
    public function getMessageNotification($userId)
    {
        //query
        $result = $this->find('all', array('conditions' => array('Message.message_to' => $userId, 'Message.read' => 0),
            'joins' => array(
                array(
                    'alias' => 'User',
                    'table' => 'users',
                    'type' => 'INNER',
                    'conditions' => array(
                        'User.id = Message.message_by',
                    ),
                )
            ),
            'fields' => array('Message.*', 'User.first_name', 'User.last_name', 'User.picture'),
        ));
        return $result;
    }

    public function reading($userId, $adminId)
    {
        $result = $this->updateAll(array("read" => 1), array("message_to" => $adminId, "message_by" => $userId));
        return $result;
    }
}
