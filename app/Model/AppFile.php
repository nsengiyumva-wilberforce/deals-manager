<?php

/**
 * class for performing all deal file related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class AppFile extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'AppFile';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'files';

    /**
     * Relation to user 
     *
     * @var array
     */
    public $belongsTo = array(
        'User' => array(
            'className' => 'User',
            'foreignKey' => false,
            'fields' => array('User.name'),
            'conditions' => 'User.id = AppFile.user_id',
        )
    );

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array();

    /**
     * This function is used to get files by deal id
     *
     * @access public
     * @return array
     */
    public function getFilesByDeal($dealId)
    {
        $results = $this->find('all', array(
            'conditions' => array('AppFile.deal_id' => $dealId),
            'order' => array('AppFile.id DESC'),
            'fields' => array('AppFile.id', 'AppFile.name', 'AppFile.description', 'AppFile.deal_id', 'User.first_name', 'User.last_name')
        ));
        return $results;
    }

    /**
     * This function is used to get first file by file id
     *
     * @access public
     * @return array
     */
    public function getFilesById($id)
    {
        $results = $this->find('first', array(
            'conditions' => array('AppFile.id' => $id),
        ));
        return $results;
    }

    /**
     * This function is used to get files by deal id
     *
     * @access public
     * @return array
     */
    public function getFilesByDealDelete($dealId)
    {
        //bind user table 
        $this->unBindModel(array('belongsTo' => array('User')));
        //query for getting all files
        $results = $this->find('all', array(
            'conditions' => array('AppFile.deal_id' => $dealId),
            'order' => array('AppFile.id DESC'),
            'fields' => array('AppFile.id', 'AppFile.name')
        ));
        return $results;
    }
}
