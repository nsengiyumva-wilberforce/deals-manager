<?php

/**
 * class for performing all product related data abstraction
 * 
 * @author:   impactoutsourcing.com
 * @Copyright: Impact Outsourcing 2023
 * @Website:   https://www.impactoutsourcing.com
 */
class Maintenance extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Maintenace';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'maintenances';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array();

    /**
     * This function is used to get all maintenance logs
     *
     * @access public
     * @return array
     */
    public function getAllMaintenances()
    {
        //query
        $results = $this->find('all', array(
            'fields' => array('Maintenance.id', 'Maintenance.description', 'Maintenance.created', 'Product.sku', 'Maintenance.performed_by'),
            'order' => array('Maintenance.id ASC'),
            'joins' => array(
                array(
                    'table' => 'products',
                    'alias' => 'Product',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Product.id = Maintenance.product_id'
                    )
                )
            )
        )
        );
        return $results;
    }

    /**
     * This function is used to get maintenance by maintenance id
     *
     * @access public
     * @return array
     */
    public function getMaintenanceById($maintenanceId)
    {
        //query
        $result = $this->find('first', array('conditions' => array('Maintenance.id' => $maintenanceId)));
        return $result;
    }
}