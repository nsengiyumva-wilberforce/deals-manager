<?php

/**
 * class for performing all deal activity related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Timeline extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Timeline';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'timeline';

    /**
     * This function is used to get activity by deal
     *
     * @access public
     * @return array
     */
    public function getAllByDeal($dealId, $limit = null, $page = null)
    {
        if (!empty($page)) {
            $page = 15 * $page;
        } else {
            $page = 0;
        }
        //query
        $result = $this->find('all', array('conditions' => array('Timeline.deal_id' => $dealId),
            'fields' => array('id', 'activity', 'module', 'user', 'created'),
            'limit' => $limit,
            'offset' => $page,
            'order' => 'Timeline.id DESC',
        ));
        return $result;
    }

    /**
     * This function is used to get activity count by deal id
     *
     * @access public
     * @return class for performing all backup related data abstraction
     */
    public function getTimelineCount($dealId)
    {
        $result = $this->find('count', array('conditions' => array('Timeline.deal_id' => $dealId), 'fields' => array('id')));
        return $result;
    }

    /**
     * This function is used to get activity by user
     *
     * @access public
     * @return array
     */
    public function getAllByUser($userId, $limit = null, $page = null)
    {
        if (!empty($page)) {
            $page = 10 * $page;
        } else {
            $page = 0;
        }
        //query
        $result = $this->find('all', array('conditions' => array('Timeline.user_id' => $userId),
            'fields' => array('id', 'activity', 'module', 'user', 'created'),
            'limit' => $limit,
            'offset' => $page,
            'order' => 'Timeline.id DESC',
        ));
        return $result;
    }

    /**
     * This function is used to get activity count by user id
     *
     * @access public
     * @return class for performing all backup related data abstraction
     */
    public function getTimeCountUser($userId)
    {
        $result = $this->find('count', array('conditions' => array('Timeline.user_id' => $userId), 'fields' => array('id')));
        return $result;
    }
}
