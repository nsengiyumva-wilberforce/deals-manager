<?php
/**
 * get task notification in header
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Today Task List -->
<?php if ($todayTask): ?>
    <li class="item-header"><?php echo __('Today Task'); ?> <span class="badge badge-warning"><?php echo count($todayTask); ?></span></li>
    <?php foreach ($todayTask as $row): ?>
        <li class="item">
            <a href="<?php echo $this->Html->url(array('controller' => 'tasks', 'action' => 'index')); ?>">
                <i class="fa fa-tasks"></i>
                <span class="content"><?php echo h($row['Task']['task']); ?></span>
                <span class="time"><i class="fa fa-clock-o"></i><?php echo $this->Time->format($this->Common->timeShow(), h($row['Task']['time'])); ?></span>
            </a>
        </li>
        <?php
    endforeach;
endif;
if ($tasks):

    ?>
    <!-- Missed Task List -->
    <li class="item-header"><?php echo __('Missed Task'); ?> <span class="badge badge-warning"><?php echo count($tasks); ?></span></li>
    <?php foreach ($tasks as $row): ?>
        <li class="item">
            <a href="<?php echo $this->Html->url(array('controller' => 'tasks', 'action' => 'index')); ?>">
                <i class="fa fa-tasks"></i>
                <span class="content"><?php echo h($row['Task']['task']); ?></span>
                <span class="time"><i class="fa fa-clock-o"></i><?php echo $this->Time->format($this->Common->dateShow(), h($row['Task']['date'])); ?> <?php echo $this->Time->format($this->Common->timeShow(), h($row['Task']['time'])); ?></span>
            </a>
        </li>
        <?php
    endforeach;
endif;

?>