<?php

/**
 * class for performing all expense category related data abstraction
 * 
 * @author:   impactotsourcing.com
 * @Copyright: impact outsourcing 2023
 * @Website:   https://www.impactoutsourcing.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class BrandCategory extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'BrandCategory';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'brands_category';

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
        $result = $this->find('first', array('conditions' => array('BrandCategory.id' => $catId), 'fields' => array('name')));
        return $result;
    }

    /**
     * This function is used to get all products
     *
     * @access public
     * @return array
     */
    public function getAllCategories()
    {
        //query
        $categories = $this->find('all', array('order' => array('BrandCategory.id DESC')));

        // Initialize an empty array to store the result
        $result = array();

        // Loop through the categories and format the result array
        foreach ($categories as $category) {
            $result[$category['BrandCategory']['id']] = $category['BrandCategory']['name'];
        }

        return $result;
    }


}