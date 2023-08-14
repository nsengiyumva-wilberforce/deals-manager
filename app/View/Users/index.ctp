<?php

/**
 * View for all users list in application .
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
?>
<!-- Delete User modal -->
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
                    <h1 class="pull-left"><?php echo __('Users'); ?></h1>
                    <div class="pull-right top-page-ui">
                        <a class="btn btn-primary btn-xs" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'admin')); ?>" ref="popover" data-content="View Admins">
                            <i class="fa fa-eye fa-1"></i> <?php echo __('Admins'); ?>
                        </a>
                        <a class="btn btn-primary btn-xs" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'manager')); ?>" ref="popover" data-content="View Manager">
                            <i class="fa fa-eye fa-1"></i> <?php echo __('Managers'); ?>
                        </a>
                        <a class="btn btn-primary btn-xs" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'staff')); ?>" ref="popover" data-content="View Staff">
                            <i class="fa fa-eye fa-1"></i> <?php echo __('Staff'); ?>
                        </a>
                        <a class="btn btn-primary btn-xs" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'group')); ?>" ref="popover" data-content="View Groups">
                            <i class="fa fa-eye fa-1"></i> <?php echo __('Groups'); ?>
                        </a>
                        <a class="btn btn-primary btn-xs" href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'role')); ?>" ref="popover" data-content="View Roles">
                            <i class="fa fa-eye fa-1"></i> <?php echo __('Roles'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 col-sm-4 col-xs-12">
                        <div class="main-box infographic-box">
                            <i class="fa fa-users  red-bg"></i>
                            <span class="headline"><?php echo __('Admins'); ?></span>
                            <span class="value">
                                <span class="timer"><?php echo h($cAdmin); ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-12">
                        <div class="main-box infographic-box">
                            <i class="fa fa-users  emerald-bg"></i>
                            <span class="headline"><?php echo __('Group Managers'); ?></span>
                            <span class="value">
                                <span class="timer"><?php echo h($cManager); ?></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-4 col-xs-12">
                        <div class="main-box infographic-box">
                            <i class="fa fa-users green-bg"></i>
                            <span class="headline"><?php echo __('Staff'); ?></span>
                            <span class="value">
                                <span class="timer"><?php echo h($cStaff); ?></span>
                            </span>
                        </div>
                    </div>             
                </div>
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