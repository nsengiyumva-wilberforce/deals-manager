<?php
/**
 * View for display my task page
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
                <button class="btn btn-primary blue btn-sm SubmitD" type="submit"><i class="fa fa-check"></i> <?php echo __('Save'); ?></button>
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
                <?php echo $this->Form->input('Task.page', array('type' => 'hidden', 'value' => 'index')); ?>
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
                    <?php echo $this->Form->create('Task', array('url' => array('controller' => 'tasks', 'action' => 'index'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm1')); ?>
                    <div class="col-sm-3 form-group">
                        <h1><?php echo __('My Task'); ?></h1>
                    </div>
                    <div class="col-sm-2 form-group">
                        <?php echo $this->Form->input('Task.pipeline_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array($this->Common->getPipelineList()), 'empty' => __('All Pipeline'))); ?> 
                    </div>
                    <div class="col-sm-2 form-group">
                        <?php echo $this->Form->input('Task.motive', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $this->Common->motivesList(), 'empty' => __('All'), 'id' => 'TaskMotiveF')); ?> 
                    </div>
                    <div class="col-sm-2 form-group">                                    
                        <?php echo $this->Form->Submit(__('Filter'), array('class' => 'btn btn-primary blue')); ?>
                    </div>
                    <div class="col-sm-2 btn-group">
                        <a href="<?php echo $this->Html->url(array("controller" => "tasks", "action" => "dashboard")); ?>" class="btn btn-white btn-sm" ref='popover' data-content="Pipeline View"><i class="fa fa-th-large"></i></a>                
                        <button type="button" class="btn btn-primary btn-sm active" ref='popover' data-content="List view"><i class="fa fa-bars"></i></button>
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
                        <?php if (!empty($todayTask)) { ?>
                            <!--Today Tasks -->
                            <div class="row manager-top">
                                <h1><?php echo __('Today'); ?> </h1>                             
                            </div>
                            <div class="table-scrollable">
                                <table  class="table table-hover dataTable task-list">             
                                    <tbody>
                                        <?php
                                        foreach ($todayTask as $row) :

                                            ?>
                                            <tr  id="<?php echo 'row' . h($row['Task']['id']); ?>" class="<?= $this->Common->priorityClass($row['Task']['priority']); ?>">
                                                <td>
                                                    <div class="task-name <?php echo ($row['Task']['status'] == '1') ? 'task-line' : ''; ?>">
                                                        <span class="checkbox-nice task-input" >
                                                            <input type="checkbox" id="todo-<?= $row['Task']['id']; ?>" class="task-checkbox" <?php echo ($row['Task']['status'] == '1') ? 'checked' : ''; ?>>
                                                            <label for="todo-<?= $row['Task']['id']; ?>"></label>
                                                        </span>
                                                        <span> <?= h($row['Task']['task']); ?> </span>&nbsp;
                                                        <?= $this->Common->priority($row['Task']['priority']); ?>
                                                    </div >
                                                    <div class="task-details">                                      
                                                        <span class="task-details-text task-padding-left">
                                                            <?= $this->Common->motives($row['Task']['motive']); ?>
                                                        </span>
                                                        <span class="task-details-text" ref="popover" data-content="View Deal">
                                                            <?php echo $this->Html->link(h($row['Deal']['name']), array('controller' => 'deals', 'action' => 'view', h($row['Task']['deal_id']))); ?>                                                           
                                                        </span>
                                                        <span class="task-details-text">
                                                            <i class="fa fa-filter"></i> <?= h($row['Pipeline']['name']); ?>
                                                        </span>
                                                        <span class="task-details-text">
                                                            <i class="fa fa-clock-o"></i> <?= date($this->Common->timeShow(), strtotime($row['Task']['time'])); ?>
                                                        </span>
                                                        <span class="task-details-text">
                                                            <i class="fa fa-calendar"></i> <?= date($this->Common->dateShow(), strtotime($row['Task']['date'])); ?>
                                                        </span>

                                                    </div>
                                                </td>
                                                <td  class="text-right">                                                    
                                                    <a class="table-link" href="#" ref="popover" data-content="Edit Task" data-toggle="modal" data-target="#TaskM"  onclick="loadmodal(<?= h($row['Task']['id']); ?>)">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a class="table-link danger" href="#" ref="popover" data-content="Delete Task"  data-toggle="modal" data-target="#delTaskM" onclick="fieldU('TaskId',<?php echo h($row['Task']['id']); ?>)">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>                                              
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                            <!--End Today Tasks -->
                        <?php } ?>
                        <!-- Missed Task -->
                        <?php if (!empty($missedTask)) { ?>
                            <div class="row manager-top">
                                <h1><?php echo __('Overdue Tasks'); ?></h1>                             
                            </div>
                            <div class="table-scrollable">
                                <table  class="table table-hover dataTable task-list">             
                                    <tbody>
                                        <?php
                                        foreach ($missedTask as $row) :

                                            ?>
                                            <tr id="<?php echo 'row' . h($row['Task']['id']); ?>" class="<?= $this->Common->priorityClass($row['Task']['priority']); ?>">
                                                <td>
                                                    <div class="task-name <?php echo ($row['Task']['status'] == '1') ? 'task-line' : ''; ?>">
                                                        <span class="checkbox-nice task-input" >
                                                            <input type="checkbox" id="todo-<?= h($row['Task']['id']); ?>" class="task-checkbox" <?php echo ($row['Task']['status'] == '1') ? 'checked' : ''; ?>>
                                                            <label for="todo-<?= h($row['Task']['id']); ?>"></label>
                                                        </span>
                                                        <span>  <?= h($row['Task']['task']); ?></span>&nbsp;
                                                        <?= $this->Common->priority($row['Task']['priority']); ?>
                                                    </div >
                                                    <div class="task-details">                                      
                                                        <span class="task-details-text task-padding-left">
                                                            <?= $this->Common->motives($row['Task']['motive']); ?>
                                                        </span>
                                                        <span class="task-details-text" ref="popover" data-content="View Deal">
                                                            <?php echo $this->Html->link(h($row['Deal']['name']), array('controller' => 'deals', 'action' => 'view', h($row['Task']['deal_id']))); ?>               
                                                        </span>
                                                        <span class="task-details-text">
                                                            <i class="fa fa-filter"></i> <?= h($row['Pipeline']['name']); ?>
                                                        </span>
                                                        <span class="task-details-text">
                                                            <i class="fa fa-clock-o"></i> <?= date($this->Common->timeShow(), strtotime($row['Task']['time'])); ?>
                                                        </span>
                                                        <span class="task-details-text">
                                                            <i class="fa fa-calendar"></i> <?= date($this->Common->dateShow(), strtotime($row['Task']['date'])); ?>
                                                        </span>

                                                    </div>
                                                </td>
                                                <td  class="text-right">
                                                    <a class="table-link" href="#" ref="popover" data-content="Edit Task"  data-toggle="modal" data-target="#TaskM"  onclick="loadmodal(<?= h($row['Task']['id']); ?>)">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                    <a class="table-link danger" href="#" ref="popover" data-content="Delete Task" data-toggle="modal" data-target="#delTaskM" onclick="fieldU('TaskId',<?php echo h($row['Task']['id']); ?>)">
                                                        <i class="fa fa-trash-o"></i>
                                                    </a>
                                                </td>
                                                </tr-->                                        
                                            <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php } ?>  
                        <!-- Coming Tasks -->
                        <?php if (!empty($tasks)) : ?>
                            <div class="row manager-top">
                                <h1><?php echo __('Later Tasks'); ?></h1>
                            </div>
                            <div class="table-scrollable">
                                <table id="tasks-table" class="table table-hover dataTable task-list">             
                                    <tbody>
                                        <?php echo $this->element('tasks'); ?>
                                        <?php echo $this->Form->input('totalP', array('type' => 'hidden', 'value' => $total_pages)); ?>
                                    </tbody>
                                </table>
                            </div>    
                            <?php if (count($tasks) == 5): ?>
                                <div class="load_button">
                                    <button class="load_more btn btn-primary "><?php echo __('Load More'); ?></button>
                                    <div class="animation_image"><?php echo $this->Html->image('ajax-loader.gif'); ?> <?php echo __('Loading'); ?>...</div>

                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                        <!--End Coming Tasks -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>
<!-- /Content -->