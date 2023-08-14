<?php

/**
 * class for performing all invoice related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Invoice extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Invoice';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'invoices';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array();

    /**
     * This function is used to get invoice by invoice id
     *
     * @access public
     * @return array
     */
    public function getInvoiceById($id)
    {
        //query
        $result = $this->find('first', array(
            'joins' => array(
                array('table' => 'deal',
                    'alias' => 'Deal',
                    'type' => 'left',
                    'foreignKey' => false,
                    'conditions' => array('Deal.id = Invoice.deal_id')
                )
            ),
            'conditions' => array('Invoice.id' => $id),
            'fields' => array('Invoice.*', 'Deal.name')
        ));
        return $result;
    }

    /**
     * This function is used to get invoice by deal id
     *
     * @access public
     * @return array
     */
    public function getInvoiceForDeal($dealId)
    {
        //query
        $result = $this->find('all', array('conditions' => array('Invoice.deal_id' => $dealId)));
        return $result;
    }

    /**
     * This function is used to get last invoice id
     *
     * @access public
     * @return array
     */
    public function getLastInvoice()
    {
        //query
        $result = $this->find('all', array('order' => array('id' => 'DESC'), 'limit' => 1, 'fields' => array('Invoice.custom_id')));
        return $result;
    }

    /**
     * This function is used to get invoice by invoice id for add product
     *
     * @access public
     * @return array
     */
    public function getInvoiceAddProduct($id)
    {
        //query
        $result = $this->find('first', array('conditions' => array('Invoice.id' => $id), 'fields' => array('Invoice.amount', 'Invoice.discount', 'Invoice.custom_tax')));
        return $result;
    }
}
