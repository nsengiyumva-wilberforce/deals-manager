<?php

/**
 * class for performing all label related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Label extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Label';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'labels';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array();

    /**
     * This function is used to get all labels by pipeline id
     *
     * @access public
     * @return array
     */
    public function getLabels($pipelineId)
    {
        //query
        $result = $this->find('all', array('conditions' => array('Label.pipeline_id' => $pipelineId), 'fields' => array('Label.id', 'Label.name', 'Label.color')));
        return $result;
    }

    /**
     * This function is used to get label by label id
     *
     * @access public
     * @return array
     */
    public function getLabelById($labelId)
    {
        //query
        $result = $this->find('first', array('conditions' => array('Label.id' => $labelId)));
        return $result;
    }
}
