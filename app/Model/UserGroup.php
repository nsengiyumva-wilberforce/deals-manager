<?php

/**
 * class for performing all deal user related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class UserGroup extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'UserGroup';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'user_groups';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array(
        'name' => array(
            'rule' => 'notBlank',
            'required' => true,
        )
    );

    /**
     * This function is used to get users of deal
     *
     * @access public
     * @return array
     */
    public function getGroupList()
    {
        $results = $this->find('list', array(
            'order' => array('UserGroup.name ASC'),
            'fields' => array('UserGroup.id', 'UserGroup.name'),
        ));
        return $results;
    }
}
