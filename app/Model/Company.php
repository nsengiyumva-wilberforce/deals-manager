<?php

/**
 * class for performing all company related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Company extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Company';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'company';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array();

    /**
     * This function is used to get company by company id
     *
     * @access public
     * @return array
     */
    public function getCompanyById($Id)
    {
        $result = $this->find('first', array('conditions' => array('Company.id' => $Id), 'fields' => array('Company.*')));
        return $result;
    }

    /**
     * This function is Used to get all company list
     *
     * @access public
     * @return array
     */
    public function getCompanyList()
    {
        $result = $this->find('list', array('fields' => array('id', 'name'), 'order' => array('name' => 'ASC')));
        return $result;
    }

    /**
     * This function is used to get  all companies id
     *
     * @access public
     * @return array
     */
    public function getAllCompaniesID()
    {
        $result = $this->find('all', array(
            'fields' => array('Company.id')
        ));
        return $result;
    }

    /**
     * This function is used to get company in deal by company id
     *
     * @access public
     * @return array
     */
    public function getCompanyDeal($Id)
    {
        $result = $this->find('first', array('conditions' => array('Company.id' => $Id), 'fields' => array('Company.id', 'Company.name')));
        return $result;
    }

    /**
     * This function is used to get company by company id
     *
     * @access public
     * @return array
     */
    public function getCompanyGroups($Id)
    {
        $result = $this->find('first', array('conditions' => array('Company.id' => $Id), 'fields' => array('Company.groups')));
        return $result;
    }

    /**
     * This function is used to get company by company id and group
     *
     * @access public
     * @return array
     */
    public function checkCompanyGroups($groupId, $companyId)
    {
        $result = $this->find('first', array('conditions' => array('FIND_IN_SET(\'' . $groupId . '\',Company.groups)', 'Company.id' => $companyId,), 'fields' => array('Company.groups')));
        return $result;
    }

    /**
     * This function is used to get companies by group
     *
     * @access public
     * @return array
     */
    public function getCompaniesByGroup($groupId)
    {
        $result = $this->find('list', array('conditions' => array('FIND_IN_SET(\'' . $groupId . '\',Company.groups)'), 'fields' => array('Company.id', 'Company.name')));
        return $result;
    }
}
