<?php

/**
 * class for performing all ticket related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Ticket extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Ticket';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'tickets';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array();

    /**
     * This function is used to get ticket by ticket id
     *
     * @access public
     * @return array
     */
    public function getTicketById($ticketId)
    {
        $options = array();
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
        //query
        $result = $this->find('first', array('conditions' => array('Ticket.id' => $ticketId),
            'joins' => $options,
            'fields' => array('User.first_name', 'User.last_name', 'User.email', 'User.picture', 'Ticket.*', 'TicketType.name', 'Company.name', 'Assign.first_name', 'Assign.last_name'),
        ));
        return $result;
    }

    /**
     * This function is used to get ticket by ticket id and user id
     *
     * @access public
     * @return array
     */
    public function getTicketUser($ticketId, $userId)
    {
        $conditions = array();
        $conditions['Ticket.id'] = $ticketId;
        if (!empty($userId)) {
            $conditions['OR'] = array(
                'Ticket.user_id' => $userId,
                'Ticket.assign' => $userId,
            );
        }
        //query
        $result = $this->find('first', array(
            'conditions' => $conditions,
            'fields' => array('Ticket.id')));
        return $result;
    }

    /**
     * This function is used to get ticket by ticket type
     *
     * @access public
     * @return array
     */
    public function getTicketByType($typeId)
    {
        $result = $this->find('first', array('conditions' => array('Ticket.type_id' => $typeId), 'fields' => array('Ticket.id')));
        return $result;
    }

    /**
     * This function is used to get ticket by ticket id
     *
     * @access public
     * @return array
     */
    public function getTicket($ticketId)
    {
        $result = $this->find('first', array('conditions' => array('Ticket.id' => $ticketId), 'fields' => array('Ticket.status')));
        return $result;
    }
}
