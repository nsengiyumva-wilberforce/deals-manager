<?php

/**
 * class for performing all email settings related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class SettingEmail extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'SettingEmail';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'settings_email';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array();

    /**
     * This function is used to get  email's setting
     *
     * @access public
     * @return array
     */
    public function getSettings()
    {
        //query
        $result = $this->find('first', array('conditions' => array('SettingEmail.id' => '1'), 'fields' => array('message', 'ticket', 'add_user')));
        return $result;
    }
}
