<?php

/**
 * class for performing all ticket type related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class TicketType extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'TicketType';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'ticket_type';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array(
        'name' => array(
            'rule' => 'notBlank',
            'required' => true,
        )
    );

    /**
     * This function is used to get all ticket types list.
     *
     * @access public
     * @return array
     */
    public function getTicketTypeList()
    {
        $result = $this->find('list', array('fields' => array('TicketType.id', 'TicketType.name')));
        return $result;
    }

    /**
     * This function is used to get first ticket type by id
     *
     * @access public
     * @return array
     */
    public function getTicketTypeName($ticketId)
    {
        $result = $this->find('first', array('conditions' => array('TicketType.id' => $ticketId), 'fields' => array('name')));
        return $result;
    }
}
