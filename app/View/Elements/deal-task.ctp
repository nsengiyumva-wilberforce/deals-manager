<?php
/**
 * List tasks in deal detail page.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div class="row">
    <div class="col-md-12">
        <?php echo $this->Form->create('Task', array('url' => array('controller' => 'tasks', 'action' => 'deal'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'task-form')); ?>
        <?php echo $this->Form->input('Task.deal_id', array('type' => 'hidden', 'value' => h($deal['Deal']['id']))); ?>
        <div class="form-group">                                  
            <?php echo $this->Form->input('Task.task', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Task'))); ?>	
        </div>
        <div class="form-group">
            <div class="col-sm-3 form-group"> 
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    <?php echo $this->Form->input('Task.date', array('type' => 'text', 'class' => 'form-control datepickerDateT')); ?>
                </div>	
            </div>
            <div class="col-sm-3 form-group"> 
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
                <?php echo $this->Form->Submit(__('Create'), array('class' => 'btn btn-primary blue')); ?>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>	
        <?php echo $this->Js->writeBuffer(); ?>
    </div>
</div>
<!-- Task LIst -->
<div class="row top-margin">
    <div class="table-scrollable">
        <table class="table table-hover dataTable table-tasks">
            <tbody>
                <?php
                if (!empty($tasks)) {
                    foreach ($tasks as $row) {

                        ?>
                        <tr  id="<?php echo 'row' . $row['Task']['id']; ?>" class="<?= $this->Common->priorityClass($row['Task']['priority']); ?>">
                            <td>
                                <div class="task-name <?php echo ($row['Task']['status'] == '1') ? 'task-line' : ''; ?>">
                                    <?php
                                    if ($row['Task']['status'] == 1) {
                                        echo "<i class='fa fa-check fa-2x'></i>";
                                    } else {

                                        ?>
                                        <span class="checkbox-nice task-input" >

                                            <input type="checkbox" id="todo-<?= $row['Task']['id']; ?>" class="task-checkbox" <?php echo ($row['Task']['status'] == '1') ? 'checked' : ''; ?>>
                                            <label for="todo-<?= $row['Task']['id']; ?>"></label>

                                        </span> <?php } ?>
                                    <span> <?= h($row['Task']['task']); ?> </span>&nbsp;
                                    <?= $this->Common->priority($row['Task']['priority']); ?>
                                </div >
                                <div class="task-details">                                      
                                    <span class="task-details-text task-padding-left">
                                        <?= $this->Common->motives($row['Task']['motive']); ?>
                                    </span>                                  
                                    <span class="task-details-text">
                                        <i class="fa fa-clock-o"></i> <?= date($this->Common->timeShow(), strtotime($row['Task']['time'])); ?>
                                    </span>
                                    <span class="task-details-text">
                                        <i class="fa fa-calendar"></i> <?= date($this->Common->dateShow(), strtotime($row['Task']['date'])); ?>
                                    </span>
                                    <span class="task-details-text">
                                        <i class="fa fa-user"></i> <?= h($row['User']['first_name']) . ' ' . h($row['User']['last_name']); ?>
                                    </span>
                                </div>
                            </td>
                            <td  class="text-right">
                                <a class="table-link" href="#"  data-toggle="modal" data-target="#TaskM"  onclick="loadmodal(<?= $row['Task']['id']; ?>)">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a class="table-link danger" href="#"  data-toggle="modal" data-target="#delM"  data-title="Delete Task" data-action="tasks" data-id="<?= $row['Task']['id']; ?>">
                                    <i class="fa fa-trash-o"></i>
                                </a> 
                            </td>
                        </tr>
                        <?php
                    }
                }

                ?>
            </tbody>
        </table>
    </div>
</div>
<!-- End Task List -->