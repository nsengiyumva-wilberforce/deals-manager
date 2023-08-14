<?php

/**
 * class for performing all role related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Role extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Role';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'user_roles';

    /**
     * This function is used to get role by role id 
     *
     * @access public
     * @return array
     */
    public function getRoleById($roleId)
    {
        $result = $this->find('first', array('conditions' => array('Role.id' => $roleId)));
        return $result;
    }

    /**
     * This function is used to get role by role id 
     *
     * @access public
     * @return array
     */
    public function getRoleByType($type)
    {
        $result = $this->find('list', array('conditions' => array('Role.type' => $type)));
        return $result;
    }

    /**
     * This function is used to get role permissions by role id 
     *
     * @access public
     * @return array
     */
    public function getRolePermissions($roleId)
    {
        $result = $this->find('first', array('conditions' => array('Role.id' => $roleId), 'fields' => array('Role.permission')));
        return $result;
    }
}
