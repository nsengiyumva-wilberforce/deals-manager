<?php
/**
 * deal view setting tab for clients
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-pencil"></i> <?php echo __('Settings'); ?>
    </div>
    <div class="panel-body">
        <?php echo $this->Form->create('Deal', array('url' => array('controller' => 'Deals', 'action' => 'permission'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'form-horizontal')); ?>
        <?php echo $this->Form->input('Deal.id', array('type' => 'hidden', 'value' => h($deal['Deal']['id']))); ?>
        <?php $permissions = explode(',', $deal['Deal']['permission']); ?>
        <div class="checkbox-nice">
            <input type="checkbox" id="checkbox-1" name="data[Deal][permission][]" value="1" <?= (in_array(1, $permissions)) ? 'checked' : ''; ?>>
            <label for="checkbox-1">
                <?php echo __('Allow client to view deal tasks'); ?>
            </label>
        </div>
        <hr>
        <div class="checkbox-nice">
            <input type="checkbox" id="checkbox-2" name="data[Deal][permission][]" value="2" <?= (in_array(2, $permissions)) ? 'checked' : ''; ?>>
            <label for="checkbox-2">
                <?php echo __('Allow client to view deal products'); ?>
            </label>
        </div>
        <hr>
        <div class="checkbox-nice">
            <input type="checkbox" id="checkbox-3" name="data[Deal][permission][]" value="3" <?= (in_array(3, $permissions)) ? 'checked' : ''; ?>>
            <label for="checkbox-3">
                <?php echo __('Allow client to view deal sources'); ?>
            </label>
        </div>
        <hr>
        <div class="checkbox-nice">
            <input type="checkbox" id="checkbox-4" name="data[Deal][permission][]" value="4" <?= (in_array(4, $permissions)) ? 'checked' : ''; ?>>
            <label for="checkbox-4">
                <?php echo __('Allow client to view deal contacts'); ?>
            </label>
        </div>
        <hr>
        <div class="checkbox-nice">
            <input type="checkbox" id="checkbox-5" name="data[Deal][permission][]" value="5" <?= (in_array(5, $permissions)) ? 'checked' : ''; ?>>
            <label for="checkbox-5">
                <?php echo __('Allow client to view deal files'); ?>
            </label>
        </div>
        <hr>
        <div class="checkbox-nice">
            <input type="checkbox" id="checkbox-6" name="data[Deal][permission][]" value="6" <?= (in_array(6, $permissions)) ? 'checked' : ''; ?>>
            <label for="checkbox-6">
                <?php echo __('Allow client to view deal discussion'); ?>
            </label>
        </div>
        <hr>
        <div class="checkbox-nice">
            <input type="checkbox" id="checkbox-7" name="data[Deal][permission][]" value="7" <?= (in_array(7, $permissions)) ? 'checked' : ''; ?>>
            <label for="checkbox-7">
                <?php echo __('Allow client to view deal invoices'); ?>
            </label>
        </div>
        <hr>
        <div class="checkbox-nice">
            <input type="checkbox"  id="checkbox-8" name="data[Deal][permission][]" value="8" <?= (in_array(8, $permissions)) ? 'checked' : ''; ?>>
            <label for="checkbox-8">
                <?php echo __('Allow client to view deal custom fields'); ?>
            </label>
        </div>
        <hr>
        <div class="checkbox-nice">
            <input type="checkbox"  id="checkbox-9" name="data[Deal][permission][]" value="9" <?= (in_array(9, $permissions)) ? 'checked' : ''; ?>>
            <label for="checkbox-9">
                <?php echo __('Allow client to view deal members'); ?>
            </label>
        </div>
        <hr>     
        <div class="checkbox-nice">
            <input type="checkbox"  id="checkbox-10" name="data[Deal][permission][]" value="10" <?= (in_array(10, $permissions)) ? 'checked' : ''; ?>>
            <label for="checkbox-10">
                <?php echo __('Allow client to add files in deal'); ?>
            </label>
        </div>
        <hr> 
        <div class="checkbox-nice">
            <input type="checkbox"  id="checkbox-11" name="data[Deal][permission][]" value="11" <?= (in_array(11, $permissions)) ? 'checked' : ''; ?>>
            <label for="checkbox-11">
                <?php echo __('Allow client to deal activity'); ?>
            </label>
        </div>

        <hr>
        <?php echo $this->Form->Submit(__('Save Changes'), array('class' => 'btn btn-primary blue', 'div' => false)); ?>
        <?php echo $this->Form->end(); ?>	
        <?php echo $this->Js->writeBuffer(); ?>  
    </div>
</div>         