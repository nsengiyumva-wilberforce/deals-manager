<?php
/**
 * View for list deals page
 * 
 * @author:   AnkkSoft.com
 * Copyright: AnkkSoft 2020
 * Website:   https://www.ankksoft.com
 * CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Add Deal Modal --> 
<div class="modal fade" id="dealM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Add Deal'); ?></h4>
            </div>
            <?php echo $this->Form->create('Deal', array('url' => array('controller' => 'Deals', 'action' => 'add'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
            <?php echo $this->Form->input('actions', array('type' => 'hidden', 'value' => 'list')); ?>
            <div class="modal-body tab-modal">                
            </div>
            <div class="modal-footer">			
                <button class="btn btn-primary blue btn-sm" type="submit"><i class="fa fa-check"></i> <?php echo __('Save'); ?></button>
                <button class="btn default btn-sm" data-dismiss="modal" type="button"><i class="fa fa-times"></i> <?php echo __('Close'); ?></button>
            </div>
            <?php echo $this->Form->end(); ?>	
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!-- Delete Deal modal -->
<div class="modal fade" id="delDealM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('Deal', array('url' => array('action' => 'delete'))); ?>
            <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
            <?php echo $this->Form->input('actions', array('type' => 'hidden', 'value' => 'list')); ?>
            <div class="modal-body">						
                <p><?php echo __('Are you sure to delete this Deal ? All the data related to this deal also deleted like task, notes, files, discussion.'); ?> </p>
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
<!-- /Delete modal -->
<!-- Content -->
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">                                                                
                    <div class="col-sm-6">
                        <h1><?php echo __('Deals'); ?></h1>
                    </div>   
                    <?php if ($this->Common->isAdminStaff()): ?>
                        <div class="col-sm-2 form-group">
                            <?php echo $this->Form->input('deal_id', array('type' => 'text', 'class' => 'form-control search-data', 'placeholder' => __('Quick Search Deals'), 'data-name' => 'deals', 'label' => false, 'div' => false)); ?> 
                        </div>
                        <div class="col-sm-2 col-xs-6 btn-group">
                            <a href="<?php echo $this->Html->url(array("controller" => "admins", "action" => "index")); ?>" class="btn btn-white btn-sm mr-1" ref='popover' data-content="Pipeline View"><i class="fa fa-th-large"></i></a>
                            <button type="button"  class="btn btn-primary btn-sm active" ref='popover' data-content="List View"><i class="fa fa-bars"></i></button>                
                        </div>
                        <div class="col-sm-2 col-xs-6 form-group"> 
                            <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#dealM">
                                <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Add Deal'); ?>
                            </a>                         
                        </div> 
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">					  
                    <div class="main-box-body clearfix">
                        <!-- Deal List -->
                        <div class="table-responsive">
                            <?php if ($this->Common->isAdminStaff()): ?>
                                <div class="col-sm-12">
                                    <?php echo $this->Form->create('Deal', array('url' => array('controller' => 'deals', 'action' => 'index'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => '')); ?>
                                    <div class="col-lg-4 form-group">                                                      
                                        <?php echo $this->Form->input('pipeline_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array($this->Common->getPipelineList()), 'empty' => 'All Pipeline', 'default' => $pipelineId, 'onchange' => "this.form.submit()")); ?>
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <select id="AdminLabelId" class="select-box-label full-width" name="data[Deal][label_id]" onchange="this.form.submit()">
                                            <option value="0"><?php echo __('All Labels'); ?></option>
                                            <?php foreach ($labels as $label): ?> 
                                                <option value="<?= h($label['Label']['id']); ?>" <?php
                                                if ($label['Label']['id'] == $this->Session->read('LabelList.id')) {
                                                    echo 'selected="selected"';
                                                }

                                                ?> data-color="<?= h($label['Label']['color']); ?>">
                                                            <?= h($label['Label']['name']); ?>
                                                </option>
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
                            <?php endif; ?>
                            <div class="table-scrollable">
                                <table class="table table-hover dataTables deals-list table-striped">
                                    <thead>
                                        <tr>
                                            <th><?php echo __('Name'); ?></th>
                                            <th><?php echo __('Price'); ?></th>
                                            <th><?php echo __('Pipeline'); ?></th>
                                            <th><?php echo __('Stage'); ?></th>
                                            <th><?php echo __('Members'); ?></th>
                                            <th><?php echo __('Client'); ?></th>
                                            <th><?php echo __('Task'); ?></th>
                                            <th><?php echo __('Product'); ?></th>
                                            <th><?php echo __('Source'); ?></th>
                                            <th><?php echo __('Contact'); ?></th> 
                                            <th><?php echo __('Created'); ?></th> 
                                            <th><?php echo __('At'); ?></th>
                                            <th><i class="fa fa-bars"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($deals)) :

                                            foreach ($deals as $row) :

                                                ?>
                                                <tr  id="<?php echo 'row' . h($row['Deal']['id']); ?>">
                                                    <td> <a  href="<?php echo $this->Html->url(array("controller" => "deals", "action" => "view", h($row['Deal']['id']))); ?>" ref="popover" data-content="View Deal"><?= h($row['Deal']['name']); ?></a></td>
                                                    <td><?= h($this->Session->read('Auth.User.currency_symbol')); ?><?= ($row['Deal']['price']) ? h($row['Deal']['price']) : '0'; ?></td>
                                                    <td><?= h($row['Pipeline']['name']); ?></td>
                                                    <td><?= h($row['Stage']['name']); ?></td>
                                                    <td><?php
                                                        foreach ($row['Users'] as $user):
                                                            echo $this->Html->image('avatar/thumb/' . $user['User']['picture'], array('class' => 'img-circle', 'ref' => 'popover', 'data-content' => h($user['User']['first_name']) . ' ' . h($user['User']['last_name'])));
                                                        endforeach;

                                                        ?>                            
                                                    </td>
                                                    <td><?= h($row['Company']['name']); ?></td>
                                                    <td><?= h($row['Tasks']); ?></td>
                                                    <td><?= h($row['Products']); ?></td>
                                                    <td><?= h($row['Sources']); ?></td>
                                                    <td><?= h($row['Contacts']); ?></td>
                                                    <td> <?= h($row['User']['first_name']) . ' ' . h($row['User']['last_name']); ?></td>
                                                    <td><?php echo $this->Time->format($this->Common->dateTime(), h($row['Deal']['created'])); ?></td>                           
                                                    <td>	                              
                                                        <a class="table-link danger" href="#" ref="popover" data-content="Delete Deal" data-toggle="modal" data-target="#delDealM" onclick="fieldU('DealId',<?php echo h($row['Deal']['id']); ?>)">
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
                        </div>
                        <!--End Deal List -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>