<?php

/**
 * class for performing all expense category related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class ExpenseCategory extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'ExpenseCategory';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'expenses_category';

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
     * This function is used to get first category name by id
     *
     * @access public
     * @return array
     */
    public function getCategoryName($catId)
    {
        $result = $this->find('first', array('conditions' => array('ExpenseCategory.id' => $catId), 'fields' => array('name')));
        return $result;
    }
}
