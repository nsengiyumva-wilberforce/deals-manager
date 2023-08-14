<?php

/**
 * class for performing all deal discussion related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Discussion extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Discussion';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'discussion';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array(
        'message' => array(
            'rule' => 'notBlank',
            'required' => true,
        )
    );

    /**
     * This function is used to message for deal by deal id
     *
     * @access public
     * @return array
     */
    public function getMessageByDeal($dealId, $type)
    {

        $result = $this->find('all', array('conditions' => array('Discussion.deal_id' => $dealId, 'Discussion.parent' => 0, 'Discussion.type' => $type),
            'joins' => array(
                array(
                    'alias' => 'User',
                    'table' => 'users',
                    'type' => 'INNER',
                    'conditions' => array(
                        'User.id = Discussion.user_id',
                    ),
                )
            ),
            'fields' => array('Discussion.*', 'User.first_name', 'User.last_name', 'User.picture'),
            'order' => array('Discussion.id DESC')
            )
        );
        return $result;
    }

    /**
     * This function is used to get child message or reply for deal by parent message
     *
     * @access public
     * @return array
     */
    public function getMessageByParent($parent)
    {

        $result = $this->find('all', array('conditions' => array('Discussion.parent' => $parent),
            'joins' => array(
                array(
                    'alias' => 'User',
                    'table' => 'users',
                    'type' => 'INNER',
                    'conditions' => array(
                        'User.id = Discussion.user_id',
                    ),
                )
            ),
            'fields' => array('Discussion.*', 'User.first_name', 'User.last_name', 'User.picture'),
            'order' => array('Discussion.id ASC')
            )
        );
        return $result;
    }

    /**
     * This function is used to get message by id
     *
     * @access public
     * @return array
     */
    public function getMessageById($messageId)
    {
        $result = $this->find('first', array('conditions' => array('id' => $messageId)));
        return $result;
    }
}
