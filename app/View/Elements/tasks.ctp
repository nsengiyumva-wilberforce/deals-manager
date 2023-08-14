<?php
/**
 * List tasks
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
if (!empty($tasks)) {
    foreach ($tasks as $row) {

        ?>
        <tr  id="<?php echo 'row' . h($row['Task']['id']); ?>" class="<?= $this->Common->priorityClass($row['Task']['priority']); ?>">
            <td>
                <div class="task-name <?php echo ($row['Task']['status'] == '1') ? 'task-line' : ''; ?>">
                    <?php if ($row['Task']['status'] == '1'): ?>
                        <i class="fa fa-check fa-lg"></i>
                    <?php else: ?>
                        <span class="checkbox-nice task-input" >
                            <input type="checkbox" id="todo-<?= h($row['Task']['id']); ?>" class="task-checkbox">
                            <label for="todo-<?= h($row['Task']['id']); ?>"></label>
                        </span>
                    <?php endif; ?>
                    <span> <?= h($row['Task']['task']); ?> </span>&nbsp;
                    <?= $this->Common->priority($row['Task']['priority']); ?>
                </div >
                <div class="task-details">                                      
                    <span class="task-details-text task-padding-left">
                        <?= $this->Common->motives($row['Task']['motive']); ?>
                    </span>
                    <span class="task-details-text">
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
                <a class="table-link" href="#"  data-toggle="modal" data-target="#TaskM"  onclick="loadmodal(<?= h($row['Task']['id']); ?>)">
                    <i class="fa fa-edit"></i>
                </a>
                <a class="table-link danger" href="#"  data-toggle="modal" data-target="#delTaskM" onclick="fieldU('TaskId',<?php echo h($row['Task']['id']); ?>)">
                    <i class="fa fa-trash-o"></i>
                </a> 
            </td>
        </tr>
        <?php
    }
}

?>