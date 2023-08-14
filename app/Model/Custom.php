<?php

/**
 * class for performing all custom fields related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Custom extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Custom';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'custom_fields';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array();

    /**
     * This function is used to get all deal custom fields 
     *
     * @access public
     * @return array
     */
    public function getDealFields()
    {
        //query
        $result = $this->find('all', array('conditions' => array('Custom.module' => 1), 'fields' => array('Custom.id', 'Custom.name', 'Custom.type', 'Custom.module')));
        return $result;
    }

    /**
     * This function is used to get all contact custom fields 
     *
     * @access public
     * @return array
     */
    public function getContactFields()
    {
        //query
        $result = $this->find('all', array('conditions' => array('Custom.module' => 2), 'fields' => array('Custom.id', 'Custom.name', 'Custom.type', 'Custom.module')));
        return $result;
    }

    /**
     * This function is used to get all company custom fields 
     *
     * @access public
     * @return array
     */
    public function getcompanyFields()
    {
        //query
        $result = $this->find('all', array('conditions' => array('Custom.module' => 3), 'fields' => array('Custom.id', 'Custom.name', 'Custom.type', 'Custom.module')));
        return $result;
    }

    /**
     * This function is used to get all deal custom fields id,name,type
     *
     * @access public
     * @return array
     */
    public function getDealFieldsId()
    {
        //query
        $result = $this->find('all', array('conditions' => array('Custom.module' => 1), 'fields' => array('Custom.id', 'Custom.name', 'Custom.type')));
        return $result;
    }

    /**
     * This function is used to get all contact custom fields id
     *
     * @access public
     * @return array
     */
    public function getContactFieldsId()
    {
        //query
        $result = $this->find('all', array('conditions' => array('Custom.module' => 2), 'fields' => array('Custom.id')));
        return $result;
    }

    /**
     * This function is used to get all company custom fields id
     *
     * @access public
     * @return array
     */
    public function getCompanyFieldsId()
    {
        //query
        $result = $this->find('all', array('conditions' => array('Custom.module' => 3), 'fields' => array('Custom.id')));
        return $result;
    }

    /**
     * This function is used to get all deal custom fields id,name,type
     *
     * @access public
     * @return array
     */
    public function getDealCF($dealId)
    {
        //query
        $result = $this->find('all', array('conditions' => array('Custom.module' => 1, 'CustomDeal.deal_id' => $dealId),
            'joins' => array(
                array(
                    'table' => 'custom_deals',
                    'alias' => 'CustomDeal',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array(
                        'CustomDeal.custom_id = Custom.id'
                    )
                )),
            'fields' => array('Custom.name', 'CustomDeal.id', 'CustomDeal.value')
        ));
        return $result;
    }

    /**
     * This function is used to get all contact custom fields id,name,type
     *
     * @access public
     * @return array
     */
    public function getContactCF($contactId)
    {
        //query
        $result = $this->find('all', array('conditions' => array('Custom.module' => 2, 'CustomContact.contact_id' => $contactId),
            'joins' => array(
                array(
                    'table' => 'custom_contacts',
                    'alias' => 'CustomContact',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array(
                        'CustomContact.custom_id = Custom.id'
                    )
                )),
            'fields' => array('Custom.name', 'CustomContact.id', 'CustomContact.value')
        ));
        return $result;
    }

    /**
     * This function is used to get all company custom fields id,name,type
     *
     * @access public
     * @return array
     */
    public function getCompanyCF($companyId)
    {
        //query
        $result = $this->find('all', array('conditions' => array('Custom.module' => 3, 'CustomCompany.company_id' => $companyId),
            'joins' => array(
                array(
                    'table' => 'custom_company',
                    'alias' => 'CustomCompany',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array(
                        'CustomCompany.custom_id = Custom.id'
                    )
                )),
            'fields' => array('Custom.id', 'Custom.name', 'Custom.type', 'CustomCompany.id', 'CustomCompany.value')
        ));
        return $result;
    }
}
