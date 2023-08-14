<?php

/**
 * class for performing all pipeline permission related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class PipelinePermission extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'PipelinePermission';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'pipeline_permission';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array();

    /**
     * This function is used to get user by email
     *
     * @access public
     * @return array
     */
    public function checkPermission($pipelineId, $userId)
    {
        //query
        $result = $this->find('first', array('conditions' => array('pipeline_id' => $pipelineId, 'user_id' => $userId), 'fields' => array('id')));
        return $result;
    }
}
