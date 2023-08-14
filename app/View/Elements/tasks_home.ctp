<?php
/**
 * List tasks on home page 
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<table class="table table-hover dataTable">
    <tbody>
        <?php
        if (!empty($tasks)) {
            foreach ($tasks as $row) {

                ?>
                <tr  id="<?php echo 'row' . h($row['Task']['id']); ?>">
                    <td>
                        <div class="task-name <?php echo ($row['Task']['status'] == '1') ? 'task-line' : ''; ?>">
                            <?php if (isset($calender)) : ?>
                            <?php else : ?>
                                <span class="checkbox-nice task-input" >
                                    <input type="checkbox"  id="todo-<?= h($row['Task']['id']); ?>" class="task-checkbox" <?php echo ($row['Task']['status'] == '1') ? 'checked' : ''; ?>>
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
                                <i class="fa fa-clock-o"></i> <?= date($this->Common->timeShow(), strtotime($row['Task']['time'])); ?>
                            </span>
                            <span class="task-details-text">
                                <i class="fa fa-calendar"></i> <?= date($this->Common->dateShow(), strtotime($row['Task']['date'])); ?>
                            </span>                
                        </div>
                    </td>

                </tr>
                <?php
            }
        } else {
            echo "<span class='contact-blank'>" . __('No Task added') . "</span>";
        }

        ?>
    </tbody>
</table>