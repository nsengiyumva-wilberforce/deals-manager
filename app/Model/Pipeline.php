<?php

/**
 * class for performing all pipeline related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Pipeline extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Pipeline';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'pipeline';

    /**
     * model validation array
     *
     * @var array
     */
    public $validate = array(
        'name' => array(
            'rule' => 'notBlank',
            'required' => true,
        )
    );

    /**
     * This function is used to get all pipelines
     *
     * @access public
     * @return array
     */
    public function getAllPipelinesDesc()
    {
        //query
        $result = $this->find('all', array('order' => array('Pipeline.id DESC')));
        return $result;
    }

    /**
     * This function is used to get all pipelines with stages
     *
     * @access public
     * @return array
     */
    public function getPipelines()
    {
        //bind to stage table
        $this->bindModel(array(
            'hasMany' => array(
                'Stage' => array(
                    'className' => 'Stage',
                    'conditions' => array('Stage.pipeline_id' => 'Pipeline.id'),
                    'foreignKey' => 'pipeline_id',
                    'order' => 'Stage.position ASC',
                ),
            ),
        ));
        //query
        $result = $this->find('all');
        return $result;
    }

    /**
     * This function is used to get all pipelines
     *
     * @access public
     * @return array
     */
    public function getAllPipelines()
    {
        //query
        $result = $this->find('all');
        return $result;
    }

    /**
     * This function is used to get first pipeline by id
     *
     * @access public
     * @return array
     */
    public function getPipelineById($pipelineId)
    {
        //query
        $result = $this->find('first', array('conditions' => array('Pipeline.id' => $pipelineId)));
        return $result;
    }

    /**
     * This function is used to get pipeline name
     *
     * @access public
     * @return array
     */
    public function getPipelineName($id)
    {
        //query
        $result = $this->find('first', array('conditions' => array('Pipeline.id' => $id), 'fields' => array('Pipeline.name')));
        return $result;
    }
}
