<?php

/**
 * class for performing all deal label related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class LabelDeal extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'LabelDeal';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'label_deals';

    /**
     * This function is used to get labels by deal id
     *
     * @access public
     * @return array
     */
    public function getLabelDeal($dealId)
    {
        $result = $this->find('all', array(
            'joins' => array(
                array('table' => 'labels',
                    'alias' => 'Label',
                    'type' => 'left',
                    'foreignKey' => false,
                    'conditions' => array('Label.id = LabelDeal.label_id')
                )
            ),
            'conditions' => array('deal_id' => $dealId),
            'fields' => array('Label.*'),
        ));
        return $result;
    }

    /**
     * This function is used to get list of labels by deal id
     *
     * @access public
     * @return array
     */
    public function getLabelsByDeal($dealId)
    {
        $result = $this->find('list', array(
            'conditions' => array('deal_id' => $dealId),
            'fields' => array('LabelDeal.label_id'),
        ));
        return $result;
    }

    /**
     * This function is used to get first label by deal and label id.
     *
     * @access public
     * @return array
     */
    public function glabelDeal($dealId, $labelId)
    {
        $result = $this->find('first', array('conditions' => array('label_id' => $labelId, 'deal_id' => $dealId)));
        return $result;
    }
}
