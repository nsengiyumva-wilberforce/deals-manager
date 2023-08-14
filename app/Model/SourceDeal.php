<?php

/**
 * class for performing all deal source related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class SourceDeal extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'SourceDeal';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'source_deals';

    /**
     * This function is used to get assign source to deal by source and deal
     *
     * @access public
     * @return array
     */
    public function getSourceDeal($dealId, $sourceId)
    {
        $result = $this->find('first', array('conditions' => array('source_id' => $sourceId, 'deal_id' => $dealId)));
        return $result;
    }

    /**
     * This function is used to get count of assign sources to deal
     *
     * @access public
     * @return array
     */
    public function getSourceCount($dealId)
    {
        $result = $this->find('count', array('conditions' => array('deal_id' => $dealId)));
        return $result;
    }
}
