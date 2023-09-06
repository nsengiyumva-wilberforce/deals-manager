<?php

/**
 * class for performing all expense category related data abstraction
 * 
 * @author:   impactoutsourcing.com
 * @Copyright: impact outsourcing 2023
 * @Website:   https://www.impactoutsourcing.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class UnitCategory extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'UnitCategory';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'units_category';

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
        $result = $this->find('first', array('conditions' => array('unitCategory.id' => $catId), 'fields' => array('name')));
        return $result;
    }

           /**
     * This function is used to get all product units
     *
     * @access public
     * @return array
     */
    public function getAllCategories()
    {
        //query
        $categories = $this->find('all', array('order' => array('UnitCategory.id DESC')));
    
        // Initialize an empty array to store the result
        $result = array();
    
        // Loop through the categories and format the result array
        foreach ($categories as $category) {
            $result[$category['UnitCategory']['id']] = $category['UnitCategory']['name'];
        }
    
        return $result;
    }
}
