<?php

/**
 * class for performing all Request related data abstraction
 * 
 * @author:   Impactoutsourcing.com
 * @Copyright: AnkkSoft 2023
 * @Website:   https://www.impactoutsourcing.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Request extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Request';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'requests';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array();

    /**
     * This function is used to get all Requests
     *
     * @access public
     * @return array
     */
    public function getAllRequests()
    {
        $result = $this->find('all', array(
            'fields' => array('Request.id', 'Request.purpose_of_issuance', 'Request.quantity_requested', 'Request.description', 'Request.return_date', 'Request.status', 'User.username', 'Product.sku'),
            'order' => array('Request.id ASC'),
            'joins' => array(
                array(
                    'table' => 'users',
                    'alias' => 'User',
                    'type' => 'INNER',
                    'conditions' => array(
                        'User.id = Request.requester_id'
                    )
                ),
                array(
                    'table' => 'products',
                    'alias' => 'Product',
                    'type' => 'INNER',
                    'conditions' => array(
                        'Product.id = Request.product_id'
                    )
                )
            )
        ));

        return $result;
    }

    /**
     * This function is used to count all requests where status is 1
     *
     * @access public
     * @return array
     */
    public function getApprovedRequests()
    {
        $result = $this->find('count', array('conditions' => array('Request.status' => 1)));
        return $result;
    }

    /**
     * This function is used to get Request by Request id
     *
     * @access public
     * @return array
     */
    public function getRequestById($RequestId)
    {
        //query
        $result = $this->find('first', array('conditions' => array('Request.id' => $RequestId)));
        return $result;
    }

    /**
     * This function is used to approve request
     *
     * @access public
     * @return array
     */
    public function approveRequest($RequestId)
    {
        //query
        $result = $this->updateAll(array('Request.status' => 1), array('Request.id' => $RequestId));
        return $result;
    }

    /**
     * This function is used to get Requests in deal by deal id
     *
     * @access public
     * @return array
     */
    public function getRequestsByDeal($dealId)
    {
        //query
        $results = $this->find('all', array('joins' => array(
                array('table' => 'Request_deals',
                    'alias' => 'RequestDeal',
                    'type' => 'left',
                    'foreignKey' => false,
                    'conditions' => array('Request.id = RequestDeal.Request_id')
                )
            ),
            'conditions' => array('RequestDeal.deal_id' => $dealId),
            'fields' => array('Request.id', 'Request.name', 'Request.price', 'RequestDeal.id', 'RequestDeal.quantity', 'RequestDeal.discount', 'RequestDeal.price'),
            'order' => array('Request.name ASC')
        ));
        return $results;
    }

    /**
     * This function is used to get Request price by Request id
     *
     * @access public
     * @return array
     */
    public function getRequestPrice($RequestId)
    {
        //query
        $result = $this->find('first', array('conditions' => array('Request.id' => $RequestId), 'fields' => array('Request.price')));
        return $result;
    }

    /**
     * This function is used to get Requests in deal by deal id
     *
     * @access public
     * @return array
     */
    public function getRequestsForDeal($Id)
    {
        //query
        $results = $this->find('first', array('joins' => array(
                array('table' => 'Request_deals',
                    'alias' => 'RequestDeal',
                    'type' => 'left',
                    'foreignKey' => false,
                    'conditions' => array('Request.id = RequestDeal.Request_id')
                )
            ),
            'conditions' => array('Request.id' => $Id),
            'fields' => array('Request.id', 'Request.name', 'Request.price', 'RequestDeal.id', 'RequestDeal.quantity', 'RequestDeal.discount', 'RequestDeal.price'),
        ));
        return $results;
    }

    /**
     * This function is used to get all Requests
     *
     * @access public
     * @return array
     */
    public function getRequestList()
    {
        $result = $this->find('all', array('order' => array('Request.name ASC')));
        return $result;
    }

    /**
     * This function is used to get all Requests
     *
     * @access public
     * @return array
     */
    public function getAllRequestList()
    {
        $result = $this->find('list', array('fields' => array('Request.id', 'Request.name'), 'order' => array('Request.name ASC')));
        return $result;
    }    
}
