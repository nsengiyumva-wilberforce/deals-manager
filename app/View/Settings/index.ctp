<?php
/**
 * View for system setting page.
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
                    <h1 class="pull-left"><?php echo __('System Settings'); ?></h1>
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

                        <?php echo $this->Form->create('Setting', array('url' => array('controller' => 'Settings', 'action' => 'general'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'form-horizontal vForm', 'enctype' => 'multipart/form-data')); ?>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" ><?php echo __('Title'); ?></label>
                            <div class="col-lg-10">
                                <?php echo $this->Form->input('Setting.title', array('type' => 'select', 'options' => array('1' => __('Text'), '2' => __('Logo')), 'class' => 'select-box-search full-width')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" ><?php echo __('Title Text'); ?>*</label>
                            <div class="col-lg-10">
                                <?php echo $this->Form->input('Setting.title_text', array('type' => 'text', 'class' => 'form-control input-inline')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" ><?php echo __('Logo'); ?></label>
                            <div class="col-lg-1">
                                <?php echo $this->Html->image($this->request->data['Setting']['title_logo'], array('class' => '')); ?>                                      
                            </div>
                            <div class="col-lg-9">                                       
                                <?php echo $this->Form->input('Setting.title_logo', array('type' => 'file', 'class' => '')); ?>                         
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" ><?php echo __('Currency'); ?>*</label>
                            <div class="col-lg-10">
                                <?php echo $this->Form->input('Setting.currency', array('type' => 'text', 'class' => 'form-control input-inline')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" ><?php echo __('Currency Symbol'); ?>*</label>
                            <div class="col-lg-10">
                                <?php echo $this->Form->input('Setting.currency_symbol', array('type' => 'text', 'class' => 'form-control input-inline')); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" ><?php echo __('Date Format'); ?></label>
                            <div class="col-lg-10">
                                <?php echo $this->Form->input('Setting.date_format', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array('d-m-Y' => 'd-m-y', 'm-d-Y' => 'm-d-y', 'Y-m-d' => 'y-m-d', 'M j, Y' => 'Jan 1,2015'))); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" ><?php echo __('Time Format'); ?></label>
                            <div class="col-lg-10">
                                <?php echo $this->Form->input('Setting.time_format', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array('g:i A' => '10:30 PM', 'g:i a' => '10:30 pm', 'H:i' => '22:30'))); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-2 control-label" ><?php echo __('Time Zone'); ?></label>
                            <div class="col-lg-10">                                       
                                <?php echo $this->Form->input('Setting.time_zone', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $this->Common->generate_timezone_list())); ?>
                            </div>
                        </div>
                        <div class="text-center">
                            <?php echo $this->Form->Submit(__('Save Changes'), array('class' => 'btn btn-primary blue', 'id' => 'addUserSubmitBtn', 'div' => false)); ?>					
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