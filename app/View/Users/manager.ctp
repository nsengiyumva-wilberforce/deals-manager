<?php
/**
 * View for all manager list in application .
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Add Manager Modal -->
<div class="modal fade" id="staffModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Add Manager'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="error-Msg"></div>
                <?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'add'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'userForm')); ?>
                <?php echo $this->Form->input('user_group_id', array('type' => 'hidden', 'value' => '2')); ?>
                <div class="form-group">
                    <label><?php echo __('First Name'); ?></label>
                    <?php echo $this->Form->input('User.first_name', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('First Name'))); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('Last Name'); ?></label>
                    <?php echo $this->Form->input('User.last_name', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Last Name'))); ?>
                </div>
                <div class="form-group">
                    <label><?php echo __('Email'); ?></label>
                    <?php echo $this->Form->input('User.email', array('type' => 'text', 'class' => 'form-control', 'Placeholder' => __('Email'))); ?>
                </div>
                <div class="form-group">
                    <label><?php echo __('Password'); ?></label>
                    <?php echo $this->Form->input('User.password', array('type' => 'password', 'class' => 'form-control', 'Placeholder' => 'Password')); ?>
                </div>
                <div class="form-group">
                    <label><?php echo __('Job Title'); ?></label>
                    <?php echo $this->Form->input('User.job_title', array('type' => 'text', 'class' => 'form-control', 'Placeholder' => __('Job Title'))); ?>
                </div>
                <div class="form-group">
                    <label><?php echo __('Group'); ?></label>
                    <?php echo $this->Form->input('User.group_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $groups, 'empty' => __('Select Group'))); ?>
                </div> 
                <div class="form-group">
                    <label><?php echo __('Role'); ?></label>
                    <?php echo $this->Form->input('User.role', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $roles, 'empty' => __('Select Role'))); ?>
                </div> 
            </div>
            <div class="modal-footer">			
                <button class="btn btn-primary blue btn-sm" type="submit"><i class="fa fa-check"></i> <?php echo __('Save'); ?></button>
                <button class="btn default btn-sm" data-dismiss="modal" type="button"><i class="fa fa-times"></i> <?php echo __('Close'); ?></button>					
            </div>
            <?php echo $this->Form->end(); ?>	
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!-- /.modal -->

<!-- Delete Manager modal -->
<div class="modal fade" id="delUserM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('User', array('url' => array('action' => 'delete'))); ?>
            <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p><?php echo __('Are you sure to delete this user ? All data related to this user also deleted.'); ?> </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary delSubmit"  type="button"><?php echo __('Yes'); ?></button>
                <button class="btn default" data-dismiss="modal" type="button"><?php echo __('No'); ?></button>
            </div>
            <?php echo $this->Form->end(); ?>
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!-- Content Section -->
<div class="row">											
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">
                    <h1 class="pull-left"><?php echo __('Managers'); ?></h1>
                    <div class="pull-right top-page-ui">                      
                        <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#staffModal">
                            <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Add Manager'); ?>
                        </a>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">					  
                    <div class="main-box-body clearfix">
                        <!-- Users List -->
                        <div class="table-responsive">
                            <?php echo $this->element('users'); ?>	
                        </div>
                        <!--End Users List -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>
<!-- End Content Section-->