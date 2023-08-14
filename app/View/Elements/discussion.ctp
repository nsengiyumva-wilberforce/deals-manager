<?php
/**
 * Display for discussion in deal view
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="clearfix">
            <div class="tabs-wrapper profile-tabs">
                <div class="conversation-wrapper">
                    <div class="conversation-content">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <button class="btn btn-primary btn-xs pull-right" id="discuss-button" type="button">
                                    <i class="fa fa-send"></i> <?php echo __('New Message'); ?>
                                </button> 
                            </div>
                        </div>
                        <div class="conversation-new-message discuss-add">
                            <?php echo $this->Form->create('Discussion', array('url' => array('controller' => 'discussions', 'action' => 'add', h($deal['Deal']['id'])), 'class' => 'vForm1')); ?>	
                            <?php echo $this->Form->input('Discussion.type', array('type' => 'hidden', 'value' => 1)); ?>
                            <div class="form-group">                                      
                                <?php echo $this->Form->input('Discussion.message', array('type' => 'textarea', 'class' => 'form-control', 'Placeholder' => __('Message'), 'rows' => '2', 'label' => false, 'error' => '')); ?>
                            </div>                                  
                            <div class="clearfix">
                                <button class="btn btn-success btn-sm pull-right" type="submit"><i class="fa fa-share"></i> <?php echo __('Send message'); ?></button>
                            </div>
                            <?php echo $this->Form->end(); ?>	
                            <?php echo $this->Js->writeBuffer(); ?>
                        </div>
                        <div>
                            <div class="conversation-inner">
                                <?php foreach ($Discussions as $row): ?>
                                    <div class="discussion-row" id="<?php echo 'row' . h($row['Discussion']['id']); ?>">
                                        <div class="conversation-item  clearfix item-left">
                                            <div class="conversation-user">
                                                <?php
                                                echo $this->Html->image('avatar/thumb/' . $row['User']['picture'], array('class' => 'img-responsive center-block'));

                                                ?>
                                            </div>
                                            <div class="conversation-body discuss-body">
                                                <div class="name"> 
                                                    <?php echo h($row['User']['first_name']) . ' ' . h($row['User']['last_name']);

                                                    ?></div>
                                                <div class="time hidden-xs"> <?= $this->Time->format($this->Common->dateTime(), $row['Discussion']['created']); ?> </div>
                                                <div class="text"><?= h($row['Discussion']['message']); ?></div>
                                            </div>
                                        </div>
                                        <div class="discuss-actions">
                                            <span class="label label-primary discuss-reply-button" id="<?php echo h($row['Discussion']['id']); ?>"><i class="fa fa-reply"></i> <?php echo __('Reply'); ?></span> 
                                            <?php if ($this->Common->isAdmin()): ?>
                                                <a class="table-link danger pull-right" href="#" data-toggle="modal" data-target="#delM"  data-title="Delete Discussion" data-action="discussions" data-id="<?= $row['Discussion']['id']; ?>"><i class="fa fa-trash-o"></i></a>
                                            <?php endif; ?>
                                        </div>

                                        <div class="conversation-new-message discuss-reply discuss-reply-<?php echo $row['Discussion']['id']; ?>" >
                                            <?php echo $this->Form->create('Discussion', array('url' => array('controller' => 'Discussions', 'action' => 'add', h($deal['Deal']['id'])), 'class' => 'vForm1')); ?>	
                                            <?php echo $this->Form->input('Discussion.parent', array('type' => 'hidden', 'value' => h($row['Discussion']['id']))); ?>
                                            <?php echo $this->Form->input('Discussion.type', array('type' => 'hidden', 'value' => 1)); ?>
                                            <div class="form-group">                                      
                                                <?php echo $this->Form->input('Discussion.message', array('type' => 'textarea', 'class' => 'form-control', 'Placeholder' => __('Message Reply'), 'rows' => '2', 'label' => false, 'error' => '')); ?>
                                            </div>                                  
                                            <div class="clearfix">
                                                <button class="btn btn-success btn-sm pull-right" type="submit"><i class="fa fa-reply"></i> <?php echo __('Post Reply'); ?></button>
                                            </div>
                                            <?php echo $this->Form->end(); ?>	
                                            <?php echo $this->Js->writeBuffer(); ?>
                                        </div>
                                        <!-- Discussion Child Reply -->
                                        <?php
                                        if (!empty($row['childs'])) :
                                            foreach ($row['childs'] as $row):

                                                ?>
                                                <div id="<?php echo 'row' . h($row['Discussion']['id']); ?>">
                                                    <div class="conversation-item  clearfix discuss-reply-message">
                                                        <div class="conversation-user">
                                                            <?php echo $this->Html->image('avatar/thumb/' . $row['User']['picture'], array('class' => 'img-responsive center-block')); ?>                                     </div>
                                                        <div class="conversation-body">
                                                            <div class="name"> 
                                                                <?php echo h($row['User']['first_name']) . ' ' . h($row['User']['last_name']); ?>
                                                            </div>
                                                            <div class="time hidden-xs"> <?= $this->Time->format($this->Common->dateTime(), $row['Discussion']['created']); ?> </div>
                                                            <div class="text"><?= h($row['Discussion']['message']); ?></div>
                                                        </div>
                                                    </div>
                                                    <?php if ($this->Common->isAdmin()): ?>
                                                        <div class="discuss-actions">                                          
                                                            <a class="table-link danger pull-right" href="#" data-toggle="modal" data-target="#delM"  data-title="Delete Discussion" data-action="discussions" data-id="<?= $row['Discussion']['id']; ?>"><i class="fa fa-trash-o"></i></a>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                                <?php
                                            endforeach;
                                        endif;

                                        ?>
                                        <!-- End Discussion Child Reply -->
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>     
                </div>
            </div>
        </div>
    </div>
</div>