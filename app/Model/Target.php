<?php

/**
 * class for performing all target related data abstraction
 * 
 * @author:   impactoutsourcing.com
 * @Copyright: Impactoutsourcing 2023
 * @Website:   https://www.impactoutsourcing.com
 */
class Target extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Target';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'targets';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array();

    /**
     * This function is used to get all products
     *
     * @access public
     * @return array
     */
    public function getAllTargets()
    {
        //query
        $result = $this->find('all', array(
            'fields' => array('Target.id', 'Target.target', 'Target.description', 'Target.deadline', 'User.username', 'Product.sku'),
            'order' => array('Target.id ASC'),
            'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'type' => 'INNER',
                    'conditions' => array(
                        'User.id = Target.target_owner'
                    )
                ),
                array(
                    'table' => 'products',
                    'alias' => 'Product',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Product.id = Target.product_id'
                    )
                )
            )
        ));
        return $result;
    }

    /**
     * This function is used to get product by product id
     *
     * @access public
     * @return array
     */
    public function getTargetById($targetId)
    {
        //query
        $result = $this->find('first', array('conditions' => array('Target.id' => $targetId)));
        return $result;
    }
}
