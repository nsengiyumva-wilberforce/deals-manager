<?php
/**
 * Calender modal data for actions 
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Task View -->
<?php
if (!empty($task)) :
    $row = $task;

    ?>
    <div class="row modal-table">
        <div class="col-md-12 modal-task">
            <span class="task-details-text">
                <?= $this->Common->motives($row['Task']['motive']); ?>
            </span> 
            <?= h($row['Task']['task']); ?>
        </div>
        <table class="table table-striped">
            <tbody>
                <tr>
                    <td><i class="fa fa-globe"></i> <?php echo __('Priority'); ?></td>
                    <td><?= $this->Common->priority($row['Task']['priority']); ?></td>
                </tr>
                <tr>
                    <td><i class="fa fa-calendar"></i> <?php echo __('Date'); ?></td>
                    <td><?= date($this->Common->dateShow(), strtotime($row['Task']['date'])); ?></td>
                </tr>
                <tr>
                    <td><i class="fa fa-clock-o"></i> <?php echo __('Time'); ?></td>
                    <td><?= date($this->Common->timeShow(), strtotime($row['Task']['time'])); ?></td>
                </tr>
                <tr>
                    <td><i class="fa fa-rocket"></i> <?php echo __('Deal'); ?></td>
                    <td><?php echo $this->Html->link(h($row['Deal']['name']), array('controller' => 'deals', 'action' => 'view', h($row['Task']['deal_id']))); ?></td>
                </tr>
            </tbody>
        </table> 
        <?php if ($row['Task']['note']): ?>
            <div class="col-md-12 modal-note">          
                <?= h($row['Task']['note']); ?>
            </div>
        <?php endif; ?>
    </div>   
<?php endif; ?>
<!-- End Task View -->
<!-- Event View -->
<?php if (!empty($event)) : ?>
    <div class="table-responsive event-view">
        <div class="col-md-12">
            <h4><?php echo h($event['Event']['title']); ?>      </h4>
        </div>

        <div class="col-md-12">
            <blockquote class="event-desc"><?php echo h($event['Event']['description']); ?></blockquote>
        </div>
        <div class="col-md-12 event-date">
            <i class="fa fa-calendar"></i> <?php echo date($this->Common->dateShow(), strtotime($event['Event']['start_date'])) . ' - ' . date($this->Common->dateShow(), strtotime($event['Event']['end_date'])); ?>
        </div>          
        <div class="col-md-12">
            <span>
                <?php echo $this->Html->image('avatar/thumb/' . $event['User']['picture'], array('class' => 'img-circle avatar')); ?>
            </span>
            <span>
                <?php echo h($event['User']['first_name']) . ' ' . h($event['User']['last_name']); ?>
            </span> 
            <?php
            $userId = $this->Session->read('Auth.User.id');
            if ($event['Event']['user_id'] == $userId):

                ?>
                <span class="closeit pull-right table-link danger" data-id="<?php echo h($event['Event']['id']); ?>"><i class="fa fa-trash-o"></i></span>
                <?php endif; ?>
        </div>    
    </div>
<?php endif; ?>
<!-- End Event View -->