<?php

/**
 * class for performing all deal user related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class UserDeal extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'UserDeal';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'user_deals';

    /**
     * This function is used to get user by deal and user
     *
     * @access public
     * @return array
     */
    public function getUserDeal($dealId, $userId)
    {
        $result = $this->find('first', array('conditions' => array('user_id' => $userId, 'deal_id' => $dealId)));
        return $result;
    }

    /**
     * This function is used to get user by deal
     *
     * @access public
     * @return array
     */
    public function getUsersDeal($dealId)
    {
        $result = $this->find('all', array(
            'joins' => array(
                array('table' => 'users',
                    'alias' => 'User',
                    'type' => 'left',
                    'foreignKey' => false,
                    'conditions' => array('User.id = UserDeal.user_id')
                )
            ),
            'conditions' => array('deal_id' => $dealId),
            'fields' => array('User.first_name', 'User.last_name', 'User.picture'),
        ));
        return $result;
    }
}
