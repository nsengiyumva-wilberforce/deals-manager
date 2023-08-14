<?php

/**
 * class for performing all source related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Source extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Source';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'source';

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
     * This function is used to get all sources
     *
     * @access public
     * @return array
     */
    public function getAllSources()
    {
        $result = $this->find('all', array('order' => array('Source.id DESC')));
        return $result;
    }

    /**
     * This function is used to get source by source id
     *
     * @access public
     * @return array
     */
    public function getSourceById($sourceId)
    {
        $result = $this->find('first', array('conditions' => array('Source.id' => $sourceId)));
        return $result;
    }

    /**
     * This function is used to get all sources in deal by deal id
     *
     * @access public
     * @return array
     */
    public function getSourcesByDeal($dealId)
    {
        $results = $this->find('all', array('joins' => array(
                array('table' => 'source_deals',
                    'alias' => 'SourceDeal',
                    'type' => 'left',
                    'foreignKey' => false,
                    'conditions' => array('Source.id = SourceDeal.source_id')
                )
            ),
            'conditions' => array('SourceDeal.deal_id' => $dealId),
            'order' => array('Source.name ASC')
        ));
        return $results;
    }

    /**
     * This function is used to get source by source id
     *
     * @access public
     * @return array
     */
    public function getSourceList()
    {
        $result = $this->find('all', array('order' => array('Source.name ASC')));
        return $result;
    }
}
