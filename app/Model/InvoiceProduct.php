<?php

/**
 * class for performing all invoice product related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class InvoiceProduct extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'InvoiceProduct';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'invoice_products';

    /**
     * This function is used to get product for invoice by product id
     *
     * @access public
     * @return array
     */
    public function getProductInvoice($productId)
    {
        $result = $this->find('first', array('conditions' => array('id' => $productId)));
        return $result;
    }

    /**
     * This function is used to get all products to invoice
     *
     * @access public
     * @return array
     */
    public function getAllProductInvoice($invoiceId)
    {
        $result = $this->find('all', array('conditions' => array('invoice_id' => $invoiceId)));
        return $result;
    }

    /**
     * This function is used to get sum of all products in invoice
     *
     * @access public
     * @return array
     */
    public function getAllProductSum($invoiceId)
    {
        $result = $this->find('all', array('conditions' => array('InvoiceProduct.invoice_id' => $invoiceId), 'fields' => array('Sum(InvoiceProduct.product_total) as total')));
        return $result;
    }
}
