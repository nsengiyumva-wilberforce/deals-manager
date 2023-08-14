<?php

/**
 * class for performing all payment related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Payment extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Payment';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'payments';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array();

    /**
     * This function is used to get payment by invoice id
     *
     * @access public
     * @return array
     */
    public function getPaymentsByInvoice($Id)
    {
        $result = $this->find('all', array(
            'joins' => array(
                array(
                    'table' => 'payment_methods',
                    'alias' => 'PaymentMethod',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array(
                        'PaymentMethod.id = Payment.method'
                    )
                ),
            ),
            'conditions' => array('Payment.invoice_id' => $Id),
            'fields' => array('Payment.*', 'PaymentMethod.name')
        ));
        return $result;
    }

    /**
     * This function is used to get sum of all payment sum in invoice
     *
     * @access public
     * @return array
     */
    public function getAllPaymentSum($invoiceId)
    {
        $result = $this->find('all', array('conditions' => array('Payment.invoice_id' => $invoiceId), 'fields' => array('Sum(Payment.amount) as total')));
        return $result;
    }

    /**
     * This function is used to get payment by id
     *
     * @access public
     * @return array
     */
    public function getPayment($id)
    {
        $result = $this->find('first', array('conditions' => array('Payment.id' => $id), 'fields' => array('Payment.*')));
        return $result;
    }

    /**
     * This function is used to get company by comapny id
     *
     * @access public
     * @return array
     */
    public function getAllPayments()
    {
        $result = $this->find('all', array(
            'joins' => array(
                array('table' => 'payment_methods',
                    'alias' => 'PaymentMethod',
                    'type' => 'left',
                    'foreignKey' => false,
                    'conditions' => array('Payment.method = PaymentMethod.id')
                ),
                array('table' => 'invoices',
                    'alias' => 'Invoice',
                    'type' => 'left',
                    'foreignKey' => false,
                    'conditions' => array('Invoice.id = Payment.invoice_id')
                )
            ),
            'fields' => array('Payment.*', 'PaymentMethod.name', 'Invoice.id', 'Invoice.currency'),
            'order' => 'Payment.id desc'
        ));
        return $result;
    }
}
