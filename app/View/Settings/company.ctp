<?php
/**
 * View for setting company page.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Content -->
<div class="row"> 
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">
                    <h1 class="pull-left"><?php echo __('Company Details'); ?></h1>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Setting Sidebar -->
            <div class="col-sm-3">
                <?php echo $this->element('settings-sidebar'); ?>
            </div>
            <!-- /Setting Sidebar -->
            <div class="col-sm-9">
                <div class="main-box no-header clearfix">					  
                    <div class="main-box-body clearfix">
                        <?php echo $this->Form->create('Setting', array('url' => array('controller' => 'Settings', 'action' => 'company'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'form-horizontal vFormN')); ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" ><?php echo __('Company Name'); ?>*</label>
                            <div class="col-lg-10">
                                <?php echo $this->Form->input('SettingCompany.name', array('type' => 'text', 'class' => 'form-control input-inline', 'label' => false, 'value' => h($settingCompany['SettingCompany']['name']))); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" ><?php echo __('Address'); ?></label>
                            <div class="col-lg-10">
                                <?php echo $this->Form->input('SettingCompany.address', array('type' => 'text', 'class' => 'form-control input-inline', 'label' => false, 'value' => h($settingCompany['SettingCompany']['address']))); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" ><?php echo __('City'); ?></label>
                            <div class="col-lg-10">
                                <?php echo $this->Form->input('SettingCompany.city', array('type' => 'text', 'class' => 'form-control input-inline', 'label' => false, 'value' => h($settingCompany['SettingCompany']['city']))); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" ><?php echo __('State'); ?></label>
                            <div class="col-lg-10">
                                <?php echo $this->Form->input('SettingCompany.state', array('type' => 'text', 'class' => 'form-control input-inline', 'label' => false, 'value' => h($settingCompany['SettingCompany']['state']))); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" ><?php echo __('Zip/Post Code'); ?></label>
                            <div class="col-lg-10">
                                <?php echo $this->Form->input('SettingCompany.zip_code', array('type' => 'text', 'class' => 'form-control input-inline', 'label' => false, 'value' => h($settingCompany['SettingCompany']['zip_code']))); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" ><?php echo __('Country'); ?></label>
                            <div class="col-lg-10">
                                <?php echo $this->Form->input('SettingCompany.country', array('type' => 'text', 'class' => 'form-control input-inline', 'label' => false, 'value' => h($settingCompany['SettingCompany']['country']))); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" ><?php echo __('Telephone'); ?></label>
                            <div class="col-lg-10">
                                <?php echo $this->Form->input('SettingCompany.telephone', array('type' => 'text', 'class' => 'form-control input-inline', 'label' => false, 'value' => h($settingCompany['SettingCompany']['telephone']))); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" ><?php echo __('System Email'); ?>*</label>
                            <div class="col-lg-10">
                                <?php echo $this->Form->input('SettingCompany.system_email', array('type' => 'text', 'class' => 'form-control input-inline', 'label' => false, 'value' => h($settingCompany['SettingCompany']['system_email']))); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" ><?php echo __('Email (From Name)'); ?>*</label>
                            <div class="col-lg-10">
                                <?php echo $this->Form->input('SettingCompany.system_email_from', array('type' => 'text', 'class' => 'form-control input-inline', 'label' => false, 'value' => h($settingCompany['SettingCompany']['system_email_from']))); ?>
                            </div>
                        </div>
                        <div class="text-center">
                            <?php echo $this->Form->Submit(__('Save Changes'), array('class' => 'btn btn-primary blue', 'div' => false)); ?>					
                        </div>
                        <?php echo $this->Form->end(); ?>	
                        <?php echo $this->Js->writeBuffer(); ?>	  
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>
<!-- /Content -->