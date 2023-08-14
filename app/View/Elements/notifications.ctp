<?php
/**
 * get message notification in header
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<?php foreach ($messages as $row): ?>
    <li class="item">
        <a href="<?php echo $this->Html->url(array('controller' => 'messages', 'action' => 'read', h($row['Message']['message_by']))); ?>">
            <?php echo $this->Html->image('avatar/thumb/' . $row['User']['picture'], array('class' => 'img-circle')); ?>
            <span class="content">
                <span class="content-headline">
                    <?php echo h($row['User']['first_name']) . ' ' . h($row['User']['last_name']); ?>
                </span>
                <span class="content-text">
                    <?php echo __(' Send you a message'); ?> 
                </span>
            </span>
            <span class="time"><i class="fa fa-clock-o"></i><?php echo h($row['Message']['created']); ?></span>
        </a>
    </li>
<?php endforeach; ?>