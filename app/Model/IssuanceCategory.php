<?php

/**
 * class for performing all expense category related data abstraction
 * 
 * @author:   impactotsourcing.com
 * @Copyright: impact outsourcing 2023
 * @Website:   https://www.impactoutsourcing.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class IssuanceCategory extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'IssuanceCategory';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'issuances_category';

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
        $result = $this->find('first', array('conditions' => array('IssuanceCategory.id' => $catId), 'fields' => array('name')));
        return $result;
    }

    /**
     * get issuances array key-value pair
     */
    public function getAllIssuancesArr()
    {
        //query
        $products = $this->find('all', array('order' => array('IssuanceCategory.id DESC')));

        // Initialize an empty array to store the result
        $result = array();

        // Loop through the products and format the result array
        foreach ($products as $product) {
            $result[$product['IssuanceCategory']['id']] = $product['IssuanceCategory']['name'];
        }

        return $result;
    }
}