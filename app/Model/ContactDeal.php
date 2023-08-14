<?php

/**
 * class for performing all contact assign to deal related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class ContactDeal extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'ContactDeal';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'contact_deals';

    /**
     * This function is used to get assign contact to deal by contact id
     *
     * @access public
     * @return array
     */
    public function getContactDeal($dealId, $contactId)
    {
        $result = $this->find('first', array('conditions' => array('contact_id' => $contactId, 'deal_id' => $dealId)));
        return $result;
    }

    /**
     * This function is used to get count of assign contact to deal 
     *
     * @access public
     * @return array
     */
    public function getContactCount($dealId)
    {
        $result = $this->find('count', array('conditions' => array('deal_id' => $dealId)));
        return $result;
    }
}
