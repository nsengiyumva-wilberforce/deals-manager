<?php
/**
 * View for display all tasks for admin or manager
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Update task modal -->
<div class="modal fade" id="TaskM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Update Task'); ?></h4>
            </div>
            <?php echo $this->Form->create('Task', array('url' => array('controller' => 'tasks', 'action' => 'edit'), 'inputDefaults' => array('label' => false, 'div' => false))); ?>
            <div class="modal-body">													
            </div>
            <div class="modal-footer">	
                <button class="btn btn-primary blue btn-sm SubmitD"  type="button"><i class="fa fa-check"></i> <?php echo __('Save'); ?></button>
                <button class="btn default btn-sm" data-dismiss="modal" type="button"><i class="fa fa-times"></i> <?php echo __('Close'); ?></button>		
            </div>
            <?php echo $this->Form->end(); ?>	
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!-- Delete modal -->
<div class="modal fade" id="delTaskM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('Task', array('url' => array('action' => 'delete'))); ?>
            <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p> <?php echo __('Are u sure to delete this task ?'); ?></p>
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
<!-- Content -->
<div class="row">   
    <div class="col-lg-12">
        <!--Tasks Filters -->
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">
                    <?php echo $this->Form->create('Task', array('url' => array('controller' => 'tasks', 'action' => 'lists'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm1')); ?>
                    <div class="col-sm-4 form-group">
                        <h1><?php echo __('All Task'); ?></h1>
                    </div>

                    <div class="col-sm-2 form-group">
                        <?php echo $this->Form->input('Task.pipeline_id', array('type' => 'select', 'class' => 'select-box full-width', 'options' => array($this->Common->getPipelineList()), 'empty' => __('All Pipeline'))); ?> 
                    </div>
                    <div class="col-sm-2 form-group">
                        <?php echo $this->Form->input('Task.motive', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $this->Common->motivesList(), 'empty' => __('All'), 'id' => 'TaskMotiveF')); ?> 
                    </div>
                    <div class="col-sm-2 form-group">
                        <?php echo $this->Form->input('Task.user_id', array('type' => 'select', 'class' => 'select-box full-width', 'options' => array($this->Common->getUserList()), 'empty' => __('All Users'))); ?> 
                    </div>
                    <div class="col-sm-2 form-group">                                    
                        <?php echo $this->Form->Submit(__('Filter'), array('class' => 'btn btn-primary blue')); ?>
                    </div>
                    <?php echo $this->Form->end(); ?>	
                    <?php echo $this->Js->writeBuffer(); ?>
                </div>
            </div>
        </div>
        <!--End Tasks Filters -->
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">					  
                    <div class="main-box-body clearfix">
                        <!--New  Tasks -->
                        <div class="row">
                            <?php echo $this->Form->create('Task', array('url' => array('controller' => 'tasks', 'action' => 'addAll'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
                            <div class="form-group">
                                <div class="col-sm-11 form-group">
                                    <?php echo $this->Form->input('Task.task', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Task'))); ?>	
                                </div>
                                <div class="col-sm-1 form-group">                                    
                                    <?php echo $this->Form->Submit(__('Create'), array('class' => 'btn btn-primary blue')); ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-2 form-group"> 
                                    <?php echo $this->Form->input('Task.deal_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $deals, 'empty' => __('Select Deal'))); ?>	
                                </div>
                                <div class="col-sm-2 form-group"> 
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                        <?php echo $this->Form->input('Task.date', array('type' => 'text', 'class' => 'form-control datepickerDateT')); ?>
                                    </div>	
                                </div>
                                <div class="col-sm-2 form-group"> 
                                    <div class="input-group input-append bootstrap-timepicker">                                        
                                        <?php echo $this->Form->input('Task.time', array('type' => 'text', 'class' => 'form-control', 'id' => 'timepicker')); ?>
                                        <span class="add-on input-group-addon"><i class="fa fa-clock-o"></i></span>
                                    </div>
                                </div>

                                <div class="col-sm-2 form-group"> 
                                    <?php echo $this->Form->input('Task.priority', array('type' => 'select', 'class' => 'select-box full-width', 'options' => array('1' => __('Low Priority'), '2' => __('Medium Priority'), '3' => __('High Priority')))); ?>	
                                </div>
                                <div class="col-sm-2 form-group"> 
                                    <?php echo $this->Form->input('Task.motive', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $this->Common->motivesList())); ?>	
                                </div>
                                <div class="col-sm-2 form-group">
                                    <?php echo $this->Form->input('Task.user_id', array('type' => 'select', 'class' => 'select-box full-width', 'options' => array($this->Common->getUserList()), 'empty' => __('Assign To'))); ?> 
                                </div>

                            </div>
                            <?php echo $this->Form->end(); ?>	
                            <?php echo $this->Js->writeBuffer(); ?>
                        </div>
                        <!--End New  Tasks -->
                        <!--  Tasks List -->
                        <div class="row manager-top">
                            <?php echo $this->element('tasks_list'); ?>
                        </div> 
                        <!--End  Tasks List -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>
<!-- /Content -->