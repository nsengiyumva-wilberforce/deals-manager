<?php
/**
 * View for all deals activity page.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Delete activity modal -->
<div class="modal fade" id="delM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('Timeline', array('url' => array('action' => 'delete'))); ?>
            <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p><?php echo __('Are you sure to delete this activity ?'); ?> </p>
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
<!-- /Delete modal -->
<!-- Content -->
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">
                    <h1 class="pull-left"><?php echo __('Activity'); ?></h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">					  
                    <div class="main-box-body clearfix">
                        <!--Filter activity -->
                        <div class="row">
                            <?php echo $this->Form->create('Timeline', array('url' => array('controller' => 'timelines', 'action' => 'index'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm1')); ?>

                            <div class="col-sm-2 form-group">
                                <?php echo $this->Form->input('Timeline.pipeline_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array($this->Common->getPipelineList()), 'empty' => __('All Pipeline'))); ?> 
                            </div>
                            <div class="col-sm-2 form-group">
                                <?php echo $this->Form->input('Timeline.user_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array($this->Common->getUserList()), 'empty' => __('All User'))); ?> 
                            </div>
                            <div class="col-sm-2 form-group"> 
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                    <?php
                                    $from = ($this->Session->read('Timeline.from')) ? date('m/d/Y', strtotime($this->Session->read('Timeline.from'))) : date('m/d/Y');
                                    echo $this->Form->input('Timeline.from', array('type' => 'text', 'class' => 'form-control datepickerDate', 'default' => $from));

                                    ?>
                                </div>	
                            </div>
                            <div class="col-sm-2 form-group"> 
                                <div class="input-group">                                       
                                    <?php
                                    $to = ($this->Session->read('Timeline.to')) ? date('m/d/Y', strtotime($this->Session->read('Timeline.to'))) : date('m/d/Y');
                                    echo $this->Form->input('Timeline.to', array('type' => 'text', 'class' => 'form-control datepickerDate', 'default' => $to));

                                    ?>
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                </div>	
                            </div>
                            <div class="col-sm-3 form-group">
                                <?php echo $this->Form->input('Timeline.module', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array($this->Common->activity()), 'empty' => __('All Activity'))); ?> 
                            </div>       
                            <div class="col-sm-1 form-group">                                    
                                <?php echo $this->Form->Submit(__('Activity'), array('class' => 'btn btn-primary blue')); ?>
                            </div>
                            <?php echo $this->Form->end(); ?>	
                            <?php echo $this->Js->writeBuffer(); ?>
                        </div>
                        <!--End Filter activity -->
                        <!-- Activity List -->
                        <div class="table-responsive timeline-view">
                            <?php echo $this->element('timeline_list'); ?>		
                        </div>
                        <!--End Activity List -->
                        <!-- Information of signs -->
                        <div class="manager-information">
                            Information :- 
                            <a href="javascript:void(0)" ref="popover"  data-content="<?php echo __('Created Deal'); ?>"><i class="fa fa-plus"></i></a>
                            <a href="javascript:void(0)" ref="popover"  data-content="<?php echo __('Deleted Deal'); ?>"><span class="badge badge-danger"><i class="fa fa-fw">&#xf00d;</i></span></a>
                            <a href="javascript:void(0)" ref="popover"  data-content="<?php echo __('Stage changed'); ?>"><i class="fa fa-sitemap"></i></a>
                            <a href="javascript:void(0)" ref="popover"  data-content="<?php echo __('Pipeline changed'); ?>"><i class="fa fa-filter"></i></a>
                            <a href="javascript:void(0)" ref="popover"  data-content="<?php echo __('Mark deal as won'); ?>"><i class="fa fa-thumbs-up"></i></a>
                            <a href="javascript:void(0)" ref="popover"  data-content="<?php echo __('Mark deal as loss'); ?>"><i class="fa fa-thumbs-down"></i></a>
                            <a href="javascript:void(0)" ref="popover"  data-content="<?php echo __('Again Active deal from won/loss'); ?>"><i class="fa fa-arrow-up"></i></a>
                            <a href="javascript:void(0)" ref="popover"  data-content="<?php echo __('Added Task'); ?>"><i class="fa fa-tasks"></i></a>
                            <a href="javascript:void(0)" ref="popover"  data-content="<?php echo __('Updated Task'); ?>"><span class="badge badge-primary"><i class="fa fa-tasks"></i></span></a>
                            <a href="javascript:void(0)" ref="popover"  data-content="<?php echo __('Deleted Task'); ?>"><span class="badge badge-danger"><i class="fa fa-tasks"></i></span></a>
                            <a href="javascript:void(0)" ref="popover"   data-content="<?php echo __('Added Source to deal'); ?>"><i class="fa fa-eye"></i></a>
                            <a href="javascript:void(0)" ref="popover"   data-content="<?php echo __('Deleted Source from deal'); ?>"><span class="badge badge-danger"><i class="fa fa-eye"></i></span></a>
                            <a href="javascript:void(0)" ref="popover"  data-content="<?php echo __('Added contact to deal'); ?>"><i class="fa fa-users"></i></a>
                            <a href="javascript:void(0)" ref="popover"  data-content="<?php echo __('Deleted contact from deal'); ?>"><span class="badge badge-danger"><i class="fa fa-users"></i></span></a>
                            <a href="javascript:void(0)" ref="popover"  data-content="<?php echo __('Apointed user to deal'); ?>"><i class="fa fa-user"></i></a>
                            <a href="javascript:void(0)" ref="popover"  data-content="<?php echo __('Unpointed user from deal'); ?>"><span class="badge badge-danger"><i class="fa fa-user"></i></span></a>
                            <a href="javascript:void(0)" ref="popover"  data-content="<?php echo __('Commented on deal'); ?>"><i class="fa fa-comments-o"></i></a>
                            <a href="javascript:void(0)" ref="popover"  data-content="<?php echo __('Deleted the comment'); ?>"><span class="badge badge-danger"><i class="fa fa-comments-o"></i></span></a>
                            <a href="javascript:void(0)" ref="popover"  data-content="<?php echo __('Added Product to deal'); ?>"><i class="fa fa-gift"></i></a>
                            <a href="javascript:void(0)" ref="popover"  data-content="<?php echo __('Updated Product in deal'); ?>"><span class="badge badge-primary"><i class="fa fa-gift"></i></span></a>
                            <a href="javascript:void(0)" ref="popover"  data-content="<?php echo __('Deleted Product from deal'); ?>"><span class="badge badge-danger"><i class="fa fa-gift"></i></span></a>
                            <a href="javascript:void(0)" ref="popover"  data-content="<?php echo __('Uploaded File in deal'); ?>"><i class="fa fa-file-pdf-o"></i></a>
                            <a href="javascript:void(0)" ref="popover"  data-content="<?php echo __('Deleted File from deal'); ?>"><span class="badge badge-danger"><i class="fa fa-file-pdf-o"></i></span></a>
                        </div>
                        <!--End Information of signs -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>
<!-- /Content -->