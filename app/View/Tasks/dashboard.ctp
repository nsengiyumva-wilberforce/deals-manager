<?php
/**
 * View for display my task dashboard page
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
                <button class="btn btn-primary SubmitD"  type="button"><?php echo __('Yes'); ?></button>
                <button class="btn default" data-dismiss="modal" type="button"><?php echo __('No'); ?></button>
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
<!-- Add Task Modal -->
<div class="modal fade" id="addM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Add Task'); ?></h4>
            </div>
            <div class="modal-body">
                <?php echo $this->Form->create('Task', array('url' => array('controller' => 'tasks', 'action' => 'add'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
                <?php echo $this->Form->input('Task.page', array('type' => 'hidden', 'value' => 'dashboard')); ?>
                <div class="form-group"> 
                    <label><?php echo __('Task'); ?></label>
                    <?php echo $this->Form->input('Task.task', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Task Name'))); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('Deal'); ?></label>
                    <?php echo $this->Form->input('Task.deal_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $deals)); ?>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 form-group"> 
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            <?php echo $this->Form->input('Task.date', array('type' => 'text', 'class' => 'form-control datepickerDateT')); ?>
                        </div>	
                    </div>
                    <div class="col-sm-6 form-group"> 
                        <div class="input-group input-append bootstrap-timepicker">                                        
                            <?php echo $this->Form->input('Task.time', array('type' => 'text', 'class' => 'form-control', 'id' => 'timepicker')); ?>
                            <span class="add-on input-group-addon"><i class="fa fa-clock-o"></i></span>
                        </div>
                    </div>    
                </div>
                <div class="form-group">
                    <label><?php echo __('Category'); ?></label>
                    <?php echo $this->Form->input('Task.motive', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $this->Common->motivesList())); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('Priority'); ?></label>
                    <?php echo $this->Form->input('Task.priority', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array('1' => __('Low Priority'), '2' => __('Medium Priority'), '3' => __('High Priority')))); ?>	
                </div>
                <?php if ($this->Common->isAdmin()): ?>
                    <div class="form-group">
                        <label><?php echo __('Assign'); ?></label>
                        <?php echo $this->Form->input('Task.user_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $users, 'empty' => 'Select Member')); ?>	
                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label><?php echo __('Status'); ?></label>
                    <?php echo $this->Form->input('Task.status', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array(0 => 'Yet to Start', 1 => 'Completed'))); ?>	
                </div>
                <div class="form-group"> 
                    <label><?php echo __('Note'); ?></label>
                    <?php echo $this->Form->input('Task.note', array('type' => 'textarea', 'rows' => '3', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Note'))); ?>	
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
<!--End Modal -->
<!-- Content -->
<div class="row">   
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">
                    <?php echo $this->Form->create('Task', array('url' => array('controller' => 'tasks', 'action' => 'dashboard'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm1')); ?>
                    <div class="col-sm-4 form-group">
                        <h1><?php echo __('My Task'); ?></h1>
                    </div>
                    <div class="col-sm-4 form-group">
                        <?php echo $this->Form->input('Task.motive', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $this->Common->motivesList(), 'empty' => __('All'), 'id' => 'TaskMotiveF')); ?> 
                    </div>
                    <div class="col-sm-2 form-group">                                    
                        <?php echo $this->Form->Submit(__('Filter'), array('class' => 'btn btn-primary blue')); ?>
                    </div>
                    <div class="col-sm-1 btn-group">
                        <button type="button" class="btn btn-primary btn-sm active" ref='popover' data-content="Pipeline view"><i class="fa fa-th-large"></i></button>
                        <a href="<?php echo $this->Html->url(array("controller" => "tasks", "action" => "index")); ?>" class="btn btn-white btn-sm" ref='popover' data-content="List view"><i class="fa fa-bars"></i></a>                
                    </div>
                    <div class="col-sm-1 pull-right top-page-ui">                      
                        <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#addM">
                            <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Add Task'); ?>
                        </a>
                    </div>
                    <?php echo $this->Form->end(); ?>	
                    <?php echo $this->Js->writeBuffer(); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">					  
                    <div class="main-box-body clearfix">
                        <div class="row task-dashboard">
                            <div class="stage-div">
                                <!--Stage Box Title-->
                                <div class="stage-name">
                                    <h2><?php echo __('Missed'); ?> <span class="badge badge-warning"><?php echo count($missedTask); ?></span></h2>
                                </div>
                                <!--Stage Box Content-->
                                <div class="stage-inner" data-id="1">
                                    <ul id="1" class="droppable sortable stage-ul">
                                        <?php foreach ($missedTask as $row) : ?>
                                            <li class="ui-state-default <?= $this->Common->priorityClass($row['Task']['priority']); ?>" id="<?= h($row['Task']['id']); ?>">   
                                                <div class="task-title task-name">
                                                    <span class="pull-right"><?= $this->Common->motives($row['Task']['motive']); ?></span>
                                                    <span class="checkbox-nice task-input pull-left">
                                                        <input type="checkbox" class="task-checkbox" id="todo-<?= h($row['Task']['id']); ?>">
                                                        <label for="todo-<?= h($row['Task']['id']); ?>"></label>
                                                    </span><?= h($row['Task']['task']); ?>
                                                </div> 
                                                <div class="task-module">
                                                    <span><i class="fa fa-rocket"></i>  <?php echo $this->Html->link(h($row['Deal']['name']), array('controller' => 'deals', 'action' => 'view', h($row['Task']['deal_id']))); ?></span>
                                                    <span class="pull-right text-right"><i class="fa fa-calendar"></i> <label class="task-date"><?= date($this->Common->dateShow(), strtotime($row['Task']['date'])); ?></label> <?= date($this->Common->timeShow(), strtotime($row['Task']['time'])); ?></span>                                                                                          
                                                </div>

                                            </li>
                                        <?php endforeach; ?>    
                                    </ul>
                                </div> 
                                <!--/Stage Box Content-->
                            </div>  
                            <div class="stage-div">
                                <!--Stage Box Title-->
                                <div class="stage-name">
                                    <h2><?php echo __('Today'); ?> <span class="badge badge-warning"><?php echo count($todayTask); ?></span></h2>
                                </div>
                                <!--Stage Box Content-->
                                <div class="stage-inner" data-id="1">
                                    <ul id="2" class="droppable sortable stage-ul">
                                        <?php foreach ($todayTask as $row) : ?>
                                            <li class="ui-state-default <?= $this->Common->priorityClass($row['Task']['priority']); ?>" id="<?= h($row['Task']['id']); ?>">   
                                                <div class="task-title task-name">
                                                    <span class="pull-right"><?= $this->Common->motives($row['Task']['motive']); ?></span>
                                                    <span class="checkbox-nice task-input pull-left">
                                                        <input type="checkbox" class="task-checkbox" id="todo-<?= h($row['Task']['id']); ?>">
                                                        <label for="todo-<?= h($row['Task']['id']); ?>"></label>
                                                    </span><?= h($row['Task']['task']); ?>
                                                </div>  
                                                <div class="task-module">
                                                    <span><i class="fa fa-rocket"></i>  <?php echo $this->Html->link(h($row['Deal']['name']), array('controller' => 'deals', 'action' => 'view', h($row['Task']['deal_id']))); ?></span>
                                                    <span class="pull-right"><i class="fa fa-calendar"></i> <label class="task-date"><?= date($this->Common->dateShow(), strtotime($row['Task']['date'])); ?></label> <?= date($this->Common->timeShow(), strtotime($row['Task']['time'])); ?></span>                                                                                          
                                                </div>
                                            </li>
                                        <?php endforeach; ?>    
                                    </ul>
                                </div> 
                                <!--/Stage Box Content-->
                            </div>  
                            <div class="stage-div">
                                <!--Stage Box Title-->
                                <div class="stage-name">
                                    <h2><?php echo __('Tommorow'); ?> <span class="badge badge-warning"><?php echo count($tomorrowTask); ?></span></h2>
                                </div>
                                <!--Stage Box Content-->
                                <div class="stage-inner" data-id="1">
                                    <ul id="3" class="droppable sortable stage-ul">
                                        <?php foreach ($tomorrowTask as $row) : ?>
                                            <li class="ui-state-default <?= $this->Common->priorityClass($row['Task']['priority']); ?>" id="<?= h($row['Task']['id']); ?>">   
                                                <div class="task-title task-name">
                                                    <span class="pull-right"><?= $this->Common->motives($row['Task']['motive']); ?></span>
                                                    <span class="checkbox-nice task-input pull-left">
                                                        <input type="checkbox" class="task-checkbox" id="todo-<?= h($row['Task']['id']); ?>">
                                                        <label for="todo-<?= h($row['Task']['id']); ?>"></label>
                                                    </span><?= h($row['Task']['task']); ?>
                                                </div> 
                                                <div class="task-module">
                                                    <span><i class="fa fa-rocket"></i>  <?php echo $this->Html->link(h($row['Deal']['name']), array('controller' => 'deals', 'action' => 'view', h($row['Task']['deal_id']))); ?></span>
                                                    <span class="pull-right"><i class="fa fa-calendar"></i> <label class="task-date"><?= date($this->Common->dateShow(), strtotime($row['Task']['date'])); ?> </label> <?= date($this->Common->timeShow(), strtotime($row['Task']['time'])); ?></span>                                                                                          
                                                </div>
                                            </li>
                                        <?php endforeach; ?>    
                                    </ul>
                                </div> 
                                <!--/Stage Box Content-->
                            </div>  
                            <div class="stage-div">
                                <!--Stage Box Title-->
                                <div class="stage-name">
                                    <h2><?php echo __('Later'); ?> <span class="badge badge-warning"><?php echo count($tasks); ?></span></h2>
                                </div>
                                <!--Stage Box Content-->
                                <div class="stage-inner" data-id="1">
                                    <ul id="4" class="droppable sortable stage-ul">
                                        <?php foreach ($tasks as $row) : ?>
                                            <li class="ui-state-default <?= $this->Common->priorityClass($row['Task']['priority']); ?>" id="<?= h($row['Task']['id']); ?>">   
                                                <div class="task-title task-name">
                                                    <span class="pull-right"><?= $this->Common->motives($row['Task']['motive']); ?></span>
                                                    <span class="checkbox-nice task-input pull-left">
                                                        <input type="checkbox" class="task-checkbox" id="todo-<?= h($row['Task']['id']); ?>">
                                                        <label for="todo-<?= h($row['Task']['id']); ?>"></label>
                                                    </span><?= h($row['Task']['task']); ?>
                                                </div> 
                                                <div class="task-module">
                                                    <span><i class="fa fa-rocket"></i>  <?php echo $this->Html->link(h($row['Deal']['name']), array('controller' => 'deals', 'action' => 'view', h($row['Task']['deal_id']))); ?></span>
                                                    <span class="pull-right"><i class="fa fa-calendar"></i> <label class="task-date"><?= date($this->Common->dateShow(), strtotime($row['Task']['date'])); ?></label> <?= date($this->Common->timeShow(), strtotime($row['Task']['time'])); ?></span>                                                                                          
                                                </div>
                                            </li>
                                        <?php endforeach; ?>    
                                    </ul>
                                </div> 
                                <!--/Stage Box Content-->
                            </div>  

                        </div>
                        <!--End Coming Tasks -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>
<!-- /Content -->