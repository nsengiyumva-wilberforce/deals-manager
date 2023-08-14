<?php

/**
 * class for performing all task related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Task extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Task';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'tasks';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array();

    /**
     * This function used to get missed task by user id
     *
     * @access public
     * @return array
     */
    public function getMissedTask($userId, $pipelineId = null, $motive = null)
    {
        $date = date('Y-m-d');
        $conditions = array();
        $conditions['Task.user_id'] = $userId;
        $conditions['Task.date <'] = $date;
        if (!empty($pipelineId)) {
            $conditions['Deal.pipeline_id'] = $pipelineId;
        }
        if (!empty($motive)) {
            $conditions['Task.motive'] = $motive;
        }
        $result = $this->find('all', array(
            'joins' => array(
                array(
                    'table' => 'deal',
                    'alias' => 'Deal',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array(
                        'Deal.id = Task.deal_id'
                    )),
                array(
                    'table' => 'pipeline',
                    'alias' => 'Pipeline',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array(
                        'Pipeline.id = Deal.pipeline_id'
                    ))
            ),
            'conditions' => $conditions,
            'fields' => array('Task.*', 'Deal.name', 'Pipeline.name'),
            'order' => array('Task.status asc', 'Task.date desc')
        ));
        return $result;
    }

    /**
     * This function used to get today task by user id
     *
     * @access public
     * @return array
     */
    public function getTodayTask($userId, $pipelineId = null, $motive = null)
    {
        $date = date('Y-m-d');
        $conditions = array();
        $conditions['Task.user_id'] = $userId;
        $conditions['Task.date'] = $date;
        if (!empty($pipelineId)) {
            $conditions['Deal.pipeline_id'] = $pipelineId;
        }
        if (!empty($motive)) {
            $conditions['Task.motive'] = $motive;
        }
        $result = $this->find('all', array(
            'joins' => array(
                array(
                    'table' => 'deal',
                    'alias' => 'Deal',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array(
                        'Deal.id = Task.deal_id'
                    )),
                array(
                    'table' => 'pipeline',
                    'alias' => 'Pipeline',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array(
                        'Pipeline.id = Deal.pipeline_id'
                    ))
            ),
            'conditions' => $conditions,
            'fields' => array('Task.*', 'Deal.name', 'Pipeline.name'),
            'order' => 'Task.status asc',
        ));
        return $result;
    }

    /**
     * This function used to get coming task by user id
     *
     * @access public
     * @return array
     */
    public function getComingTask($userId, $limit, $page = null, $pipelineId = null, $motive = null)
    {
        $date = date('Y-m-d');
        $conditions = array();
        $conditions['Task.user_id'] = $userId;
        $conditions['Task.date >'] = $date;
        if (!empty($pipelineId)) {
            $conditions['Deal.pipeline_id'] = $pipelineId;
        }
        if (!empty($motive)) {
            $conditions['Task.motive'] = $motive;
        }
        if (!empty($page)) {
            $page = 5 * $page;
        } else {
            $page = 0;
        }
        $result = $this->find('all', array(
            'joins' => array(
                array(
                    'table' => 'deal',
                    'alias' => 'Deal',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array(
                        'Deal.id = Task.deal_id'
                    )),
                array(
                    'table' => 'pipeline',
                    'alias' => 'Pipeline',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array(
                        'Pipeline.id = Deal.pipeline_id'
                    ))
            ),
            'conditions' => $conditions,
            'fields' => array('Task.*', 'Deal.name', 'Pipeline.name'),
            'limit' => $limit,
            'offset' => $page,
            'order' => array('Task.status asc', 'Task.date asc'),
        ));
        return $result;
    }

    /**
     * This function used to get tasks for deal by deal id
     *
     * @access public
     * @return array
     */
    public function getTasksByDeal($dealId)
    {
        $results = $this->find('all', array(
            'joins' => array(
                array(
                    'table' => 'deal',
                    'alias' => 'Deal',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Deal.id = Task.deal_id'
                    )
                ),
                array(
                    'alias' => 'User',
                    'table' => 'users',
                    'type' => 'INNER',
                    'conditions' => 'User.id = Task.user_id'
                )
            ),
            'conditions' => array('Task.deal_id' => $dealId),
            'fields' => array('Task.*', 'Deal.name', 'User.first_name', 'User.last_name'),
            'order' => array('Task.status asc', 'Task.date desc')
        ));
        return $results;
    }

    /**
     * This function used to get task count by user id
     *
     * @access public
     * @return array
     */
    public function getTaskCount($userId)
    {
        $date = date('Y-m-d');
        $result = $this->find('count', array('conditions' => array('Task.user_id' => $userId, 'Task.date >' => $date)));
        return $result;
    }

    /**
     * This function used to get all task count
     *
     * @access public
     * @return array
     */
    public function getAllTaskCount()
    {
        $date = date('Y-m-d');
        $result = $this->find('count', array('conditions' => array()));
        return $result;
    }

    /**
     * This function used to get task by task id
     *
     * @access public
     * @return array
     */
    public function getTaskById($taskId)
    {
        $result = $this->find('first', array('conditions' => array('Task.id' => $taskId)));
        return $result;
    }

    /**
     * This function used to get tasks for export by user id etc 
     *
     * @access public
     * @return array
     */
    public function getExport($userId, $Tasktype, $fDate, $tDate)
    {
        $conditions = array();

        if (!empty($Tasktype)) {
            $conditions['Task.user_id'] = $userId;
        }
        if (!empty($fDate) && !empty($tDate)) {
            $conditions['and'] = array(array('Task.date <= ' => $tDate, 'Task.date >= ' => $fDate));
        }
        $result = $this->find('all', array(
            'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array(
                        'User.id = Task.user_id'
                    )
                ),
                array(
                    'table' => 'deal',
                    'alias' => 'Deal',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array(
                        'Deal.id = Task.deal_id'
                    )
                ),
                array(
                    'table' => 'pipeline',
                    'alias' => 'Pipeline',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array(
                        'Pipeline.id = Deal.pipeline_id'
                    )
                )
            ),
            'fields' => array('Task.id', 'Task.task', 'Task.priority', 'Task.date', 'Task.time', 'Task.status', 'User.first_name', 'User.last_name', 'Pipeline.name', 'Deal.name'),
            'conditions' => $conditions
        ));
        return $result;
    }

    /**
     * This function used to get count of tasks for deal 
     *
     * @access public
     * @return array
     */
    public function getTasksCount($dealId)
    {
        $results = $this->find('count', array(
            'conditions' => array('Task.deal_id' => $dealId)
        ));
        return $results;
    }

    /**
     * This function used to get all task by user id
     *
     * @access public
     * @return array
     */
    public function getAllTask($userId)
    {
        $conditions = array();
        $conditions['Task.user_id'] = $userId;

        $result = $this->find('all', array(
            'conditions' => $conditions,
            'fields' => array('Task.id', 'Task.motive', 'Task.task', 'Task.date'),
            'order' => array('Task.status asc', 'Task.date desc')
        ));
        return $result;
    }

    /**
     * This function used to get all task by user id for calender
     *
     * @access public
     * @return array
     */
    public function getAllTaskCalender($userId)
    {
        $conditions = array();
        $conditions['Task.user_id'] = $userId;
        $conditions['Task.status'] = 0;

        $result = $this->find('all', array(
            'conditions' => $conditions,
            'fields' => array('Task.id', 'Task.motive', 'Task.task', 'Task.date', 'Task.time'),
            'order' => array('Task.status asc', 'Task.date desc')
        ));
        return $result;
    }

    /**
     * This function used to get  task by task id for modal
     *
     * @access public
     * @return array
     */
    public function getTask($taskId)
    {
        $conditions = array();
        $conditions['Task.id'] = $taskId;

        $result = $this->find('first', array(
            'joins' => array(
                array(
                    'table' => 'deal',
                    'alias' => 'Deal',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array(
                        'Deal.id = Task.deal_id'
                    )),
                array(
                    'table' => 'pipeline',
                    'alias' => 'Pipeline',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array(
                        'Pipeline.id = Deal.pipeline_id'
                    ))
            ),
            'conditions' => $conditions,
            'fields' => array('Task.*', 'Deal.name', 'Pipeline.name'),
            'order' => array('Task.status asc', 'Task.date desc')
        ));
        return $result;
    }

    /**
     * This function used to get missed task by user id
     *
     * @access public
     * @return array
     */
    public function getMissedTaskD($userId, $status, $motive = null)
    {
        $date = date('Y-m-d');
        $conditions = array();
        $conditions['Task.user_id'] = $userId;
        $conditions['Task.date <'] = $date;
        $conditions['Task.status'] = $status;
        if (!empty($motive)) {
            $conditions['Task.motive'] = $motive;
        }
        $result = $this->find('all', array(
            'joins' => array(
                array(
                    'table' => 'deal',
                    'alias' => 'Deal',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array(
                        'Deal.id = Task.deal_id'
                    )),
            ),
            'conditions' => $conditions,
            'fields' => array('Task.*', 'Deal.name'),
            'order' => array('Task.status asc', 'Task.date desc')
        ));
        return $result;
    }

    /**
     * This function used to get today task by user id
     *
     * @access public
     * @return array
     */
    public function getTodayTaskD($userId, $status, $motive = null)
    {
        $date = date('Y-m-d');
        $conditions = array();
        $conditions['Task.user_id'] = $userId;
        $conditions['Task.date'] = $date;
        $conditions['Task.status'] = $status;
        if (!empty($motive)) {
            $conditions['Task.motive'] = $motive;
        }
        $result = $this->find('all', array(
            'joins' => array(
                array(
                    'table' => 'deal',
                    'alias' => 'Deal',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array(
                        'Deal.id = Task.deal_id'
                    )),
            ),
            'conditions' => $conditions,
            'fields' => array('Task.*', 'Deal.name'),
            'order' => 'Task.status asc',
        ));
        return $result;
    }

    /**
     * This function used to get Tommorow task by user id
     *
     * @access public
     * @return array
     */
    public function getTommorowTaskD($userId, $status, $motive = null)
    {
        $date = date('Y-m-d', strtotime(' +1 day'));
        $conditions = array();
        $conditions['Task.user_id'] = $userId;
        $conditions['Task.date'] = $date;
        $conditions['Task.status'] = $status;
        if (!empty($motive)) {
            $conditions['Task.motive'] = $motive;
        }
        $result = $this->find('all', array(
            'joins' => array(
                array(
                    'table' => 'deal',
                    'alias' => 'Deal',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array(
                        'Deal.id = Task.deal_id'
                    )),
            ),
            'conditions' => $conditions,
            'fields' => array('Task.*', 'Deal.name'),
            'order' => 'Task.status asc',
        ));
        return $result;
    }

    /**
     * This function used to get coming task by user id
     *
     * @access public
     * @return array
     */
    public function getComingTaskD($userId, $status, $motive = null)
    {
        $date = date('Y-m-d', strtotime(' +1 day'));
        $conditions = array();
        $conditions['Task.user_id'] = $userId;
        $conditions['Task.date >'] = $date;
        $conditions['Task.status'] = $status;
        if (!empty($motive)) {
            $conditions['Task.motive'] = $motive;
        }

        $result = $this->find('all', array(
            'joins' => array(
                array(
                    'table' => 'deal',
                    'alias' => 'Deal',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array(
                        'Deal.id = Task.deal_id'
                    )),
            ),
            'conditions' => $conditions,
            'fields' => array('Task.*', 'Deal.name'),
            'order' => array('Task.status asc', 'Task.date asc'),
        ));
        return $result;
    }

    /**
     * This function used to get tasks for deal add
     *
     * @access public
     * @return array
     */
    public function getTasksForDeal($Id)
    {
        $results = $this->find('first', array(
            'joins' => array(
                array(
                    'table' => 'deal',
                    'alias' => 'Deal',
                    'type' => 'LEFT',
                    'conditions' => array(
                        'Deal.id = Task.deal_id'
                    )
                ),
                array(
                    'alias' => 'User',
                    'table' => 'users',
                    'type' => 'INNER',
                    'conditions' => 'User.id = Task.user_id'
                )
            ),
            'conditions' => array('Task.id' => $Id),
            'fields' => array('Task.*', 'Deal.name', 'User.first_name', 'User.last_name')
        ));
        return $results;
    }
}
