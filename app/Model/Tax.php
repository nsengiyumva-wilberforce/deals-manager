<?php

/**
 * class for performing all tax related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Tax extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Tax';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'taxes';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array();

    /**
     * This function is used to get tax rates
     *
     * @access public
     * @return array
     */
    public function getAllTaxs()
    {
        $result = $this->find('all', array('order' => array('Tax.id desc')));
        return $result;
    }

    /**
     * This function is used to get tax rates list
     *
     * @access public
     * @return array
     */
    public function getAllTaxsList()
    {
        $result = $this->find('all', array('order' => array('Tax.id ASC')));
        return $result;
    }
}
