<?php
/**
 * view for show messages of user, manager and admin
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Delete modal -->
<div class="modal fade" id="delMsgM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('Message', array('url' => array('action' => 'delete'))); ?>
            <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p><?php echo __('Are you sure to delete this message ?'); ?> </p>
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
        <div class="row">
            <div class="col-lg-12">
                <h1><?php echo __('Messages'); ?></h1>
            </div>
        </div>
        <!-- Uses List -->
        <div class="row manager-bottom">
            <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="main-box clearfix">
                    <ul class="widget-users message-users row">
                        <?php
                        foreach ($users as $row):
                            if ($this->Session->read('Auth.User.id') != $row['User']['id']) {

                                ?>
                                <li <?php
                                if ($active == $row['User']['id']) {
                                    echo "class='active'";
                                }

                                ?>>
                                    <div class="img">
                                        <?php echo $this->Html->image('avatar/thumb/' . $row['User']['picture'], array('class' => 'img-responsive center-block')); ?>
                                    </div>
                                    <div class="details">
                                        <div class="name">                                           
                                            <?php echo $this->Html->link(h($row['User']['name']), array('controller' => 'messages', 'action' => 'read', h($row['User']['id'])), array('escape' => false)); ?>
                                        </div>
                                        <div class="time">
                                            <i class="fa fa-user"></i> <?php echo $this->Common->user_type($row['User']['user_group_id']); ?> <br>
                                            <span class="label label-sm label-warning"><?php echo h($row['User']['job_title']); ?></span>
                                        </div>

                                    </div>
                                </li>
                            <?php } ?>
                        <?php endforeach; ?>	
                    </ul>
                </div>
            </div>
            <!--  Messages -->
            <div class="col-lg-9 col-md-9 col-sm-9">
                <div class="main-box clearfix">
                    <div class="tabs-wrapper">
                        <div class="conversation-wrapper">
                            <div class="conversation-content">
                                <div class="conversation-inner" id="message-inner">
                                    <?php foreach ($messages as $row): ?>
                                        <div class="conversation-item  clearfix <?php echo ($row['Message']['message_by'] != $this->Session->read('Auth.User.id')) ? 'item-right' : 'item-left'; ?>" id="<?php echo 'row' . $row['Message']['id']; ?>">
                                            <div class="conversation-user">
                                                <?php echo $this->Html->image('avatar/thumb/' . $row['User']['picture'], array('class' => 'img-responsive center-block')); ?>
                                            </div>
                                            <div class="conversation-body">
                                                <div class="name"> <?php echo h($row['User']['first_name']) . ' ' . h($row['User']['last_name']); ?></div>
                                                <div class="time hidden-xs"> <?php echo $this->Time->format($this->Common->dateTime(), h($row['Message']['created'])); ?>
                                                    <?php if ($this->Common->isAdmin()): ?>
                                                        <a onclick="fieldU('MessageId',<?php echo h($row['Message']['id']); ?>)" data-target="#delMsgM" data-toggle="modal" href="#"><i class="fa fa-trash-o"></i></a>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="text"><?= h($row['Message']['message']); ?></div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>   
                                <!-- New Message -->
                                <div class="conversation-new-message">
                                    <?php echo $this->Form->create('Message', array('type' => 'file', 'url' => array('controller' => 'messages', 'action' => 'read', $user), 'class' => 'vForm')); ?>	
                                    <?php echo $this->Form->input('Message.user_id', array('type' => 'hidden', 'value' => $user)); ?>
                                    <div class="form-group">
                                        <?php echo $this->Form->input('Message.message', array('type' => 'textarea', 'class' => 'form-control', 'Placeholder' => __('Message Reply'), 'rows' => '2', 'label' => false)); ?>
                                    </div>
                                    <div class="clearfix">
                                        <button class="btn btn-success pull-right btn-sm" type="submit"><i class="fa fa-send"></i> <?php echo __('Send message'); ?></button>
                                    </div>
                                    <?php echo $this->Form->end(); ?>	
                                    <?php echo $this->Js->writeBuffer(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>