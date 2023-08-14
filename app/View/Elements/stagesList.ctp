<?php
/**
 *  List stages
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
echo $this->Form->input('Deal.stage_id', array('type' => 'select', 'class' => 'form-control input-inline input-medium', 'options' => $stages, 'label' => false));

?>		