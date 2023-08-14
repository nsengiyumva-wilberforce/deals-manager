<?php

/**
 * class for performing all stages related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Stage extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Stage';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'stages';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array();

    /**
     * This function is used to get stages list for pipeline 
     *
     * @access public
     * @return array
     */
    public function stagesByPipeline($pipelineId)
    {
        $result = $this->find('list', array('conditions' => array('Stage.pipeline_id' => $pipelineId)));
        return $result;
    }

    /**
     * This function is used to get all stages for pipeline
     *
     * @access public
     * @return array
     */
    public function getStages($pipelineId)
    {
        $result = $this->find('all', array(
            'conditions' => array('Stage.pipeline_id' => $pipelineId),
            'fields' => array('Stage.id', 'Stage.name'),
            'order' => 'Stage.position ASC'
        ));
        return $result;
    }

    /**
     * This function is used to get stage name
     *
     * @access public
     * @return array
     */
    public function getStageName($id)
    {
        $result = $this->find('first', array('conditions' => array('Stage.id' => $id), 'fields' => array('Stage.name')));
        return $result;
    }

    /**
     * This function is used to get stages display order for pipeline
     *
     * @access public
     * @return array
     */
    public function getStageOrder($pipelineId)
    {
        $result = $this->find('first', array('conditions' => array('Stage.pipeline_id' => $pipelineId), 'order' => 'Stage.id DESC', 'fields' => array('Stage.position')));
        return $result;
    }
}
