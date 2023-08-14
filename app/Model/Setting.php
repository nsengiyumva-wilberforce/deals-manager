<?php

/**
 * class for performing all setting related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Setting extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Setting';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'settings';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array();

    /**
     * This function is used to get all settings
     *
     * @access public
     * @return array
     */
    public function getSettings()
    {
        //query
        $result = $this->find('first', array('conditions' => array('Setting.id' => '1'), 'fields' => array('Setting.time_zone', 'Setting.title', 'Setting.title_text', 'Setting.title_logo', 'Setting.currency_symbol', 'Setting.date_format', 'Setting.time_format', 'Setting.pipeline', 'Setting.language')));
        return $result;
    }

    /**
     * This function is used to get default pipeline from setting
     *
     * @access public
     * @return array
     */
    public function getPipeline()
    {
        //query
        $result = $this->find('first', array('conditions' => array('Setting.id' => '1'), 'fields' => array('Setting.pipeline', 'Setting.currency_symbol')));
        return $result;
    }
}
