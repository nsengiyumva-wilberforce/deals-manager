<?php

/**
 * class for performing all backup related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Backup extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Backup';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'backup';

    /**
     * This function is used to get backup file by file id
     *
     * @access public
     * @return array
     */
    public function getFile($id)
    {
        //query
        $results = $this->find('first', array(
            'conditions' => array('Backup.id' => $id)
        ));
        //return results
        return $results;
    }
}
