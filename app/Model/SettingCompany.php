<?php

/**
 * class for performing all company settings related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class SettingCompany extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'SettingCompany';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'settings_company';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array();

    /**
     * This function is used to get company name from setting
     *
     * @access public
     * @return array
     */
    public function getCompName()
    {
        //query
        $result = $this->find('first', array('conditions' => array('SettingCompany.id' => '1'), 'fields' => array('SettingCompany.name')));
        return $result;
    }
}
