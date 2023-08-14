<?php

/**
 * class for performing all deal note related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class NoteDeal extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'NoteDeal';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'note_deals';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array(
        'note' => array(
            'rule' => 'notBlank',
            'required' => true,
        )
    );

    /**
     * This function is used to get note for deal by user
     *
     * @access public
     * @return array
     */
    public function getNote($dealId, $userId)
    {
        //query
        $result = $this->find('first', array('conditions' => array('NoteDeal.deal_id' => $dealId, 'NoteDeal.user_id' => $userId)));
        return $result;
    }
}
