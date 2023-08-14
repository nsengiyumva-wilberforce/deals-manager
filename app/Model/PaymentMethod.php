<?php

/**
 * class for performing all payment methods related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class PaymentMethod extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'PaymentMethod';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'payment_methods';

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
     * This function is used to get payment methods
     *
     * @access public
     * @return array
     */
    public function getMethodsInvoice()
    {
        $result = $this->find('list', array('conditions' => array(), 'fields' => array('PaymentMethod.id', 'PaymentMethod.name')));
        return $result;
    }
}
