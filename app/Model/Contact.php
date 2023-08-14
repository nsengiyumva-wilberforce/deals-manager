<?php

/**
 * class for performing all contact related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Contact extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Contact';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'contact';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array();

    /**
     * This function is used to get contact by contact id
     *
     * @access public
     * @return array
     */
    public function getContactById($contactId)
    {
        $result = $this->find('first', array(
            'joins' => array(
                array('table' => 'company',
                    'alias' => 'Company',
                    'type' => 'left',
                    'foreignKey' => false,
                    'conditions' => array('Company.id = Contact.company_id')
                )
            ),
            'conditions' => array('Contact.id' => $contactId),
            'fields' => array('Contact.*', 'Company.name')
        ));
        return $result;
    }

    /**
     * This function is used to get contact image by contact id
     *
     * @access public
     * @return array
     */
    public function getContactImage($contactId)
    {
        $result = $this->find('first', array('conditions' => array('Contact.id' => $contactId), 'fields' => array('Contact.picture')));
        return $result;
    }

    /**
     * This function is used to get contacts in deal by deal id
     *
     * @access public
     * @return array
     */
    public function getContactsByDeal($dealId)
    {
        $results = $this->find('all', array(
            'joins' => array(
                array('table' => 'contact_deals',
                    'alias' => 'ContactDeal',
                    'type' => 'left',
                    'foreignKey' => false,
                    'conditions' => array('Contact.id = ContactDeal.contact_id')
                )
            ),
            'conditions' => array('ContactDeal.deal_id' => $dealId),
            'order' => array('Contact.name ASC')
        ));
        return $results;
    }

    /**
     * This function is used to get contact by company id
     *
     * @access public
     * @return array
     */
    public function getContactByCompany($companyId)
    {
        $result = $this->find('all', array('conditions' => array('Contact.company_id' => $companyId)));
        return $result;
    }

    /**
     * This function is used to get  all contacts id
     *
     * @access public
     * @return array
     */
    public function getAllContactsID()
    {
        $result = $this->find('all', array(
            'fields' => array('Contact.id')
        ));
        return $result;
    }

    /**
     * This function is used to get all contacts
     *
     * @access public
     * @return array
     */
    public function getContactList()
    {
        $result = $this->find('all', array('order' => array('Contact.name ASC')));
        return $result;
    }
}
