<?php

/**
 * class for performing all event related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Event extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Event';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'events';

    /**
     * model validation array
     *
     * @var array
     */
    public $validate = array(
        'title' => array(
            'rule' => 'notBlank',
            'required' => true,
        )
    );

    /**
     * This function is used to get all events by user
     *
     * @access public
     * @return array
     */
    public function getAllEvents($userId, $groupId)
    {
        $conditions = array();
        if (!empty($groupId)):
            $conditions['Event.group_id'] = $groupId;
        endif;
        $conditions['OR'] = array(
            array('Event.user_id' => $userId),
            array('Event.status' => 1)
        );
        //query
        $result = $this->find('all', array(
            'conditions' => $conditions,
            'fields' => array('Event.*'),
        ));
        return $result;
    }

    /**
     * This function is used to get event by event id
     *
     * @access public
     * @return array
     */
    public function getEventById($id)
    {
        $result = $this->find('first', array(
            'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'type' => 'Left',
                    'foreignKey' => false,
                    'conditions' => array(
                        'User.id = Event.user_id'
                    )
                )
            ),
            'conditions' => array('Event.id' => $id),
            'fields' => array('Event.*', 'User.first_name', 'User.last_name', 'User.picture')
        ));
        return $result;
    }
}
