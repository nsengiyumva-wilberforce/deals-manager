<?php
/**
 *  Shows Pagination on various modules.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
if (!isset($updateDivId)) {
    $updateDivId = "updateData";
}
$ajax = true;
if ($ajax) {
    $this->Paginator->options(array(
        'update' => '#' . $updateDivId,
        'evalScripts' => true,
        'before' => "$('.loader').show()",
        'complete' => "$('.loader').hide()"
    ));
}