<?php
/**
 * List tasks for all task list by admin
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div  id="uTask" >
    <?php echo $this->element('paginator', array('updateDivId' => 'uTask')); ?>	

    <div class="table-scrollable">
        <table id="tasks-table" class="table table-hover dataTable task-list">             
            <tbody>
                <?php
                if (!empty($tasks)) :
                    foreach ($tasks as $row) :

                        ?>
                        <tr  id="<?php echo 'row' . h($row['Task']['id']); ?>">
                            <td>
                                <div class="task-name <?php echo ($row['Task']['status'] == '1') ? 'task-line' : ''; ?>">
                                    <span class="checkbox-nice task-input" >
                                        <input type="checkbox" id="todo-<?= h($row['Task']['id']); ?>"  class="task-checkbox" <?php echo ($row['Task']['status'] == '1') ? 'checked' : ''; ?>>
                                        <label for="todo-<?= h($row['Task']['id']); ?>"></label>
                                    </span>
                                    <span> <?= h($row['Task']['task']); ?> </span>&nbsp;
                                    <?= $this->Common->priority($row['Task']['priority']); ?>
                                </div >
                                <div class="task-details">                                      
                                    <span class="task-details-text task-padding-left">
                                        <?= $this->Common->motives($row['Task']['motive']); ?>
                                    </span>
                                    <span class="task-details-text">
                                        <?php echo $this->Html->link(h($row['Deal']['name']), array('controller' => 'deals', 'action' => 'view', $row['Task']['deal_id'])); ?>             
                                    </span>
                                    <span class="task-details-text">
                                        <i class="fa fa-filter"></i>  <?= h($row['Pipeline']['name']); ?>
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
                                <a class="table-link" href="#"  data-toggle="modal" data-target="#TaskM"  onclick="loadmodal(<?= h($row['Task']['id']); ?>)">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a class="table-link danger" href="#"  data-toggle="modal" data-target="#delTaskM" onclick="fieldU('TaskId',<?php echo h($row['Task']['id']); ?>)">
                                    <i class="fa fa-trash-o"></i>
                                </a> 
                            </td>
                        </tr>
                        <?php
                    endforeach;
                endif;

                ?>
            </tbody>
        </table>
    </div>     
    <?php
    echo $this->element('pagination');

    ?>
</div>