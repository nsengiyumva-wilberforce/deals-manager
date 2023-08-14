<?php
/**
 * View for stages page
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Add stage modal -->                             
<div class="modal fade" id="stageM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Add Stage'); ?></h4>
            </div>
            <?php echo $this->Form->create('Stage', array('url' => array('controller' => 'Stages', 'action' => 'add'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
            <div class="modal-body">													
                <div class="form-group">
                    <label> <?php echo __('Name'); ?></label>
                    <?php echo $this->Form->input('Stage.name', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Stage Name'), 'label' => false)); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('Pipeline'); ?></label>
                    <?php echo $this->Form->input('Stage.pipeline_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array($this->Common->getPipelineList()), 'label' => false)); ?>	
                </div>

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
<!-- Delete stage modal -->
<div class="modal fade" id="delStageM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('Stage', array('url' => array('action' => 'delete'))); ?>
            <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p><?php echo __('Are you sure to delete this Stage ? Make sure stage have no active deal.If have active deal move or delete that deals before delete this stage.'); ?> </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary delSubmitS"  type="button"><?php echo __('Yes'); ?></button>
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
                    <h1 class="pull-left"><?php echo __('Stages'); ?></h1>
                    <div class="pull-right top-page-ui">
                        <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#stageM">
                            <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Add Stage'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">	
                    <div class="tabs-wrapper tabs-no-header">
                        <!-- Pipelines -->
                        <ul class="nav nav-tabs manager-tabs">
                            <?php foreach ($pipelines as $row): ?>
                                <li class=""><a data-toggle="tab" href="#tab-home<?= h($row['Pipeline']['id']); ?>"><?= h($row['Pipeline']['name']); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <!--End Pipelines -->
                        <div class="tab-content">
                            <!-- General tab -->
                            <div id="tab-home" class="tab-pane fade active in">
                                <div class="row manager-index">
                                    <?php echo $this->Html->image('stages.png'); ?>
                                    <h1><?php echo __('Select Pipeline for Stages'); ?></h1>  
                                </div>
                            </div>
                            <!--End General tab -->                           
                            <?php foreach ($pipelines as $row): ?>
                                <!-- Pipeline wise stages -->
                                <div id="tab-home<?= h($row['Pipeline']['id']); ?>" class="tab-pane fade">
                                    <div class="row">
                                        <ul id="sortable" class="sortabless">
                                            <?php $count = 1; ?>
                                            <?php foreach ($row['Stage'] as $stage): ?>
                                                <li class="ui-state-default dd-item dd-item-list stage-li"  id="item-<?= h($stage['id']); ?>">
                                                    <div class="dd-handle">
                                                        <a data-type="text" data-pk="<?= h($stage['id']); ?>" data-url="stages/edit"  class="editable editable-click vEdit"  ref="popover" data-content="Edit Stage Name"><?= h($stage['name']); ?></a>
                                                        <div class="nested-links">
                                                            <a class="nested-link" href="#"  data-toggle="modal" data-target="#delStageM" onclick="fieldU('StageId',<?= h($stage['id']); ?>)"><i class="fa fa-trash-o fa-red"></i></a>
                                                        </div>
                                                    </div>
                                                </li>
                                                <?php
                                                $count++;
                                            endforeach;

                                            ?>
                                        </ul>
                                    </div>
                                </div>
                                <!--End Pipeline wise stages -->
                                <?php
                                $count++;
                            endforeach;

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>
<!-- /Content -->