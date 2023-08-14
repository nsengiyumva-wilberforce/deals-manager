<?php

/**
 * class for performing all ticket messages related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class TicketMessage extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'TicketMessage';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'ticket_message';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array();

    /**
     * This function is used to get ticket all messages  by ticket id
     *
     * @access public
     * @return array
     */
    public function getMessageByTicket($ticketID)
    {
        //bind user table
        $this->bindModel(array(
            'hasOne' => array(
                'User' => array(
                    'foreignKey' => false,
                    'conditions' => array('User.id = TicketMessage.user_id'),
                    'fields' => array('first_name', 'last_name', 'picture'),
                ),
                'User' => array(
                    'foreignKey' => false,
                    'conditions' => array('User.id = TicketMessage.user_id'),
                    'fields' => array('first_name', 'last_name', 'picture'),
                ),
            )
        ));
        //query
        $result = $this->find('all', array('conditions' => array('TicketMessage.ticket_id' => $ticketID)));
        return $result;
    }

    /**
     * This function is used to get ticket messages pictures by ticket id
     *
     * @access public
     * @return array
     */
    public function getAllMessageByTicket($ticketID)
    {
        $result = $this->find('all', array(
            'conditions' => array('TicketMessage.ticket_id' => $ticketID),
            'fields' => array('TicketMessage.id', 'TicketMessage.attachment'),
        ));
        return $result;
    }
}
