<?php
/**
 * View for message home page
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div class="row" >
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <h1><?php echo __('Messages'); ?></h1>
            </div>
        </div>
        <div id="user-profile" class="row">
            <div class="col-lg-3 col-md-3 col-sm-3">
                <div class="main-box clearfix">
                    <ul class="widget-users message-users row">
                        <?php
                        foreach ($users as $row):
                            if ($this->Session->read('Auth.User.id') != $row['User']['id']) :

                                ?>
                                <li>
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
                            <?php endif; ?>
                        <?php endforeach; ?>														
                    </ul>
                </div>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9">
                <div class="main-box clearfix">
                    <div class="row manager-index">
                        <?php echo $this->Html->image('message.png'); ?>
                        <h1><?php echo __('Select member to message'); ?></h1>  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>