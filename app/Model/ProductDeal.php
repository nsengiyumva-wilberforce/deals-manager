<?php

/**
 * class for performing all deal product related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class ProductDeal extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'ProductDeal';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'product_deals';

    /**
     * This function is used to get product for deal by product id
     *
     * @access public
     * @return array
     */
    public function getProductDeal($dealId, $productId)
    {
        $result = $this->find('first', array('conditions' => array('product_id' => $productId, 'deal_id' => $dealId)));
        return $result;
    }

    /**
     * This function is used to get first assign product 
     *
     * @access public
     * @return array
     */
    public function getProductD($Id)
    {
        $result = $this->find('first', array('conditions' => array('ProductDeal.id' => $Id)));
        return $result;
    }

    /**
     * This function is used to get all assign products to deal
     *
     * @access public
     * @return array
     */
    public function getAllProductDeal($dealId)
    {
        $result = $this->find('all', array('conditions' => array('deal_id' => $dealId), 'fields' => array('id', 'price')));
        return $result;
    }

    /**
     * This function is used to get count of assign products to deal
     *
     * @access public
     * @return array
     */
    public function getProductCount($dealId)
    {
        $result = $this->find('count', array('conditions' => array('deal_id' => $dealId)));
        return $result;
    }

    /**
     * This function is used to get first assign product by deal id
     *
     * @access public
     * @return array
     */
    public function getDealProduct($dealId)
    {
        $result = $this->find('first', array('conditions' => array('ProductDeal.deal_id' => $dealId), 'fields' => array('id')));
        return $result;
    }
}
