<?php
/**
 * View for setting email page.
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
                    <h1 class="pull-left"><?php echo __('Email Settings'); ?></h1>
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
                <div class="main-box  clearfix">					  
                    <div class="tabs-wrapper tabs-no-header">
                        <!-- Setting tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#tab-general"><?php echo __('Notification'); ?></a></li>                           
                            <li><a data-toggle="tab" href="#tab-smtp"><?php echo __('SMTP'); ?></a></li>
                        </ul>
                        <!--End Setting tabs -->
                        <!-- Setting tabs Content-->
                        <div class="tab-content">
                            <!-- General Tab -->
                            <div id="tab-general" class="tab-pane fade active in">
                                <?php echo $this->Form->create('Setting', array('url' => array('controller' => 'Settings', 'action' => 'noticeemail'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'form-horizontal vForm', 'enctype' => 'multipart/form-data')); ?>
                                <div class="form-group">
                                    <label class="col-lg-6" ><?php echo __('Email Notification on add user to user (username & password)'); ?></label>
                                    <div class="col-lg-6">
                                        <div class="onoffswitch">
                                            <input type="checkbox"  id="adduser" class="onoffswitch-checkbox"  name="data[SettingEmail][add_user]" value="1"  <?php
                                            if ($this->request->data['SettingEmail']['add_user'] == '1') {
                                                echo 'checked';
                                            }

                                            ?>>
                                            <label for="adduser" class="onoffswitch-label">
                                                <div class="onoffswitch-inner"></div>
                                                <div class="onoffswitch-switch"></div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-6" ><?php echo __('Email Notification on Ticket messages'); ?></label>
                                    <div class="col-lg-6">
                                        <div class="onoffswitch">
                                            <input type="checkbox"  id="tickets" class="onoffswitch-checkbox"  name="data[SettingEmail][ticket]" value="1"  <?php
                                            if ($this->request->data['SettingEmail']['ticket'] == '1') {
                                                echo 'checked';
                                            }

                                            ?>>
                                            <label for="tickets" class="onoffswitch-label">
                                                <div class="onoffswitch-inner"></div>
                                                <div class="onoffswitch-switch"></div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-6" ><?php echo __('Email Notification on Messages'); ?></label>
                                    <div class="col-lg-6">
                                        <div class="onoffswitch">
                                            <input type="checkbox"  id="messages" class="onoffswitch-checkbox"  name="data[SettingEmail][message]" value="1"  <?php
                                            if ($this->request->data['SettingEmail']['message'] == '1') {
                                                echo 'checked';
                                            }

                                            ?>>
                                            <label for="messages" class="onoffswitch-label">
                                                <div class="onoffswitch-inner"></div>
                                                <div class="onoffswitch-switch"></div>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <?php echo $this->Form->Submit(__('Save Changes'), array('class' => 'btn btn-primary blue', 'id' => 'addUserSubmitBtn', 'div' => false)); ?>					
                                <?php echo $this->Form->end(); ?>	
                                <?php echo $this->Js->writeBuffer(); ?>
                                <br>
                                <div class="alert alert-info">
                                    <?php echo __('On Local Host Please set SMTP to work notification and application.'); ?> 
                                </div>
                            </div>
                            <!--End General Tab -->
                            <!-- SMTP Tab -->
                            <div id="tab-smtp" class="tab-pane fade">
                                <?php echo $this->Form->create('Setting', array('url' => array('controller' => 'Settings', 'action' => 'emails'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'form-horizontal vFormN')); ?>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" ><?php echo __('SMTP Email Protocol'); ?></label>
                                    <div class="col-lg-10">                                        
                                        <div class="onoffswitch">
                                            <input type="checkbox"  id="myonoffswitch" class="onoffswitch-checkbox"  name="data[SettingEmail][protocol]" value="1"  <?php
                                            if ($this->request->data['SettingEmail']['protocol'] == '1') {
                                                echo 'checked';
                                            }

                                            ?>>
                                            <label for="myonoffswitch" class="onoffswitch-label">
                                                <div class="onoffswitch-inner"></div>
                                                <div class="onoffswitch-switch"></div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" ><?php echo __('SMTP Host'); ?></label>
                                    <div class="col-lg-10">
                                        <?php echo $this->Form->input('SettingEmail.host', array('type' => 'text', 'class' => 'form-control input-inline')); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" ><?php echo __('SMTP User'); ?></label>
                                    <div class="col-lg-10">
                                        <?php echo $this->Form->input('SettingEmail.user', array('type' => 'text', 'class' => 'form-control input-inline')); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" ><?php echo __('SMTP Password'); ?></label>
                                    <div class="col-lg-10">
                                        <?php echo $this->Form->input('SettingEmail.password', array('type' => 'text', 'class' => 'form-control input-inline')); ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-2 control-label" ><?php echo __('SMTP Port'); ?></label>
                                    <div class="col-lg-10">
                                        <?php echo $this->Form->input('SettingEmail.port', array('type' => 'text', 'class' => 'form-control input-inline')); ?>
                                    </div>
                                </div>                             
                                <?php echo $this->Form->Submit(__('Save Changes'), array('class' => 'btn btn-primary blue')); ?>					
                                <?php echo $this->Form->end(); ?>	
                                <?php echo $this->Js->writeBuffer(); ?>	  
                            </div>
                            <!--End Company Tab -->
                        </div> <!--End Setting tabs Content-->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>
<!-- /Content -->