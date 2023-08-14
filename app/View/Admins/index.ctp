<?php
/**
 * View for Dashboard or application home page
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!--Add Deal Modal --> 
<div class="modal fade" id="dealM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Add Deal'); ?></h4>
            </div>
            <?php echo $this->Form->create('Deal', array('url' => array('controller' => 'Deals', 'action' => 'add'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
            <div class="modal-body tab-modal"></div>
            <div class="modal-footer">			
                <button class="btn btn-primary blue btn-sm" type="submit"><i class="fa fa-check"></i> <?php echo __('Save'); ?></button>
                <button class="btn default btn-sm" data-dismiss="modal" type="button"><i class="fa fa-times"></i> <?php echo __('Close'); ?></button>
            </div>
            <?php echo $this->Form->end(); ?>	
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!--End Add Deal Modal -->
<!-- View contact,task modal -->
<div class="modal fade" id="uDealM" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="row deal-popup" id="mBody">                    
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
<!--End View contact,task modal -->
<!-- View label modal -->
<div class="modal fade" id="uDealSM" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <div class="row" id="mBody">
                </div>
            </div>
        </div>
    </div>
</div>
<!--End View label modal -->
<!--Content Section -->
<div class="row" >
    <div class="col-lg-12">
        <!-- Top section-->
        <div class="row">
            <div class="clearfix">  
                <?php foreach ($announcements as $row): ?>
                    <div class="alert alert-success fade in  an-alert">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button" data-id="<?php echo h($row['Announcement']['id']); ?>">×</button>
                        <i class="fa fa-bullhorn fa-fw fa-lg"></i>
                        <a href="<?php echo $this->Html->url(array("controller" => "Announcements", "action" => "view", h($row['Announcement']['id']))); ?>"> <?php echo h($row['Announcement']['title']); ?></a>
                    </div>
                <?php endforeach; ?>
                <div class="col-lg-2">
                    <h1 class="pull-left"><?= h($pipeline['Pipeline']['name']); ?></h1>
                </div>
                <div class="col-lg-5">
                    <?php echo $this->Form->create('Admin', array('url' => array('controller' => 'admins', 'action' => 'index'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => '')); ?>
                    <div class="col-lg-4 form-group">                                                      
                        <?php echo $this->Form->input('pipeline_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array($this->Common->getPipelineList()), 'default' => h($pipeline['Pipeline']['id']), 'onchange' => "this.form.submit()")); ?>
                    </div>
                    <div class="col-lg-4 form-group">
                        <select id="AdminLabelId" class="select-box-label full-width" name="data[Admin][label_id]" onchange="this.form.submit()">
                            <option value="0"><?php echo __('All Labels'); ?></option>
                            <?php foreach ($labels as $label): ?> 
                                <option value="<?= h($label['Label']['id']); ?>" <?php
                                if ($label['Label']['id'] == $this->Session->read('Label.id')) {
                                    echo 'selected="selected"';
                                }

                                ?> data-color="<?= h($label['Label']['color']); ?>"><?= h($label['Label']['name']); ?></option>
                                    <?php endforeach; ?>
                        </select>
                    </div>
                    <?php if ($this->Common->isAdmin() || $this->Common->isManager()): ?>
                        <div class="col-lg-4 form-group">
                            <?php echo $this->Form->input('user_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array($this->Common->getUserList()), 'empty' => __('All Users'), 'onchange' => "this.form.submit()")); ?>
                        </div>
                    <?php endif; ?>
                    <?php echo $this->Form->end(); ?>
                    <?php echo $this->Js->writeBuffer(); ?>
                </div>
                <div class="col-lg-2 form-group">
                    <?php echo $this->Form->input('deal_id', array('type' => 'text', 'class' => 'form-control search-data', 'placeholder' => __('Search Deals'), 'data-name' => 'deals')); ?>
                </div>
                <div class="col-lg-2 col-sm-6 col-xs-6 btn-group">
                    <button type="button" class="btn btn-primary btn-sm active mr-1" ref='popover' data-content="Pipeline View"><i class="fa fa-th-large"></i></button>
                    <a href="<?php echo $this->Html->url(array("controller" => "deals", "action" => "index")); ?>" class="btn btn-white btn-sm" ref='popover' data-content="List View"><i class="fa fa-bars"></i></a>                
                </div>
                <div class="col-lg-1 col-sm-6 col-xs-6 form-group">
                    <div class="pull-right top-page-ui">
                        <?php if ($this->Common->isAdmin() || $this->Common->isStaff()): ?>
                            <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#dealM" >
                                <i class="fa fa-plus-circle fa-lg"></i>  <?php echo __('Add Deal'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!--End Top section-->
        <!-- content box -->
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">
                    <div class="main-box-body clearfix stage-<?php echo count($stages); ?>">
                             <?php foreach ($stages as $stage): ?> 
                            <!--Stage Box-->
                            <div class="stage-div">
                                <!--Stage Box Title-->
                                <div class="stage-name">
                                    <h2><?= h($stage['Stage']['name']); ?></h2>
                                </div>
                                <!--End Stage Box Title-->
                                <!--Stage Box Content-->
                                <div class="stage-inner" data-id="<?= h($stage['Stage']['id']); ?>">
                                    <ul id="<?= h($stage['Stage']['id']); ?>" class="droppable sortable stage-ul"> 
                                        <?php $dealCount = count($stage['Deal']); ?>
                                        <?php foreach ($stage['Deal'] as $row): ?>
                                            <!--Deal Box-->
                                            <li class="ui-state-default" id="<?= h($row['Deal']['id']); ?>">
                                                <div class="deal-labels">
                                                    <?php foreach ($row['Labels'] as $label): ?>
                                                        <div class="deal-label <?= h($label['Label']['color']); ?>"  ref='popover' data-content='<?= h($label['Label']['name']); ?>'></div>
                                                    <?php endforeach; ?>
                                                </div>
                                                <div class="deal-name">
                                                    <i class="fa fa-eye"></i> <?php echo $this->Html->link(h($row['Deal']['name']), array('controller' => 'deals', 'action' => 'view', h($row['Deal']['id'])), array('escape' => false, 'ref' => 'popover', 'data-content' => 'View Deal')); ?>
                                                    <span class="pull-right dv-label" data-target="#uDealSM" data-toggle="modal" data-id="<?= h($row['Deal']['id']); ?>" data-name="Labels" ref = 'popover' data-content ='Labels'>
                                                        <i class="fa fa-tag"></i>
                                                    </span>
                                                </div>                                            
                                                <div class="deal-module">
                                                    <span> <?= h($row['files']); ?> <?php echo __('Files'); ?></span>
                                                    <span class="text-center"><?= h($row['tasks_u']) . '/' . h($row['tasks']); ?> <?php echo __('Tasks'); ?></span> 
                                                    <span class="text-right"><?= h($row['contacts']); ?> <?php echo __('Contacts'); ?></span>
                                                    <span class="text-right view-modal" data-target="#uDealM" data-toggle="modal" data-id="<?= h($row['Deal']['id']); ?>" data-name="view" data-deal="<?= h($row['Deal']['name']); ?>" ref = 'popover' data-content ='Edit Deal'>
                                                        <i class="fa fa-edit"></i>
                                                    </span>                                                                                           
                                                </div>
                                                <div class="deal-user">
                                                    <?php
                                                    if (!empty($row['Users'])) :
                                                        foreach ($row['Users'] as $user):
                                                            echo $this->Html->image('avatar/thumb/' . h($user['User']['picture']), array('class' => 'img-circle', 'ref' => 'popover', 'data-content' => h($user['User']['first_name']) . ' ' . h($user['User']['last_name'])));
                                                        endforeach;
                                                    endif;

                                                    ?>
                                                    <span class="pull-right">
                                                        <?= $this->Session->read('Auth.User.currency_symbol'); ?><?= ($row['Deal']['price']) ? h($row['Deal']['price']) : '0'; ?>
                                                    </span>
                                                </div>                                              
                                            </li>
                                            <!--End Deal Box-->
                                        <?php endforeach; ?>
                                        <?php if ($dealCount == 10): ?>
                                            <li class="load-li"><button class="load_more label label-primary" data-id="<?= h($stage['Stage']['id']); ?>"><?php echo __('Load More'); ?></button>
                                                <div class="animation_image"><?php echo $this->Html->image('ajax-loader.gif'); ?><?php echo __('Loading'); ?>...</div></li>
                                        <?php endif; ?>
                                    </ul>
                                    <input type="hidden" id="stage_<?= h($stage['Stage']['id']); ?>" value="1">                                  
                                </div>
                                <!--End Stage Box Content-->
                            </div>
                            <!--End Stage Box-->
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
        <!--End content box -->
    </div>
</div>
<!--End Content Section -->