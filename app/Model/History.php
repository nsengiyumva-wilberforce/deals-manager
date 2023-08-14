<?php

/**
 * class for performing all History for won/loss related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class History extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'History';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'history';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array();

}
