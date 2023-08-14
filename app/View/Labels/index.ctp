<?php
/**
 * View for labels home page
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!--Add label Modal -->                             
<div class="modal fade" id="labelM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Add Label'); ?></h4>
            </div>
            <?php echo $this->Form->create('Label', array('url' => array('controller' => 'Labels', 'action' => 'add'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
            <div class="modal-body">													
                <div class="form-group">
                    <label></label>
                    <?php echo $this->Form->input('Label.name', array('type' => 'text', 'class' => 'form-control input-inline input-medium input-color', 'Placeholder' => __('Label Name'), 'label' => false)); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('Pipeline'); ?></label>
                    <?php echo $this->Form->input('Label.pipeline_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array($this->Common->getPipelineList()), 'label' => false)); ?>	
                </div>
                <div class="form-group color-button" data-toggle="buttons">
                    <label class="btn btn-1 active"><input type="radio" name="data[Label][color]" value="label-one" checked></label>
                    <label class="btn btn-2"><input type="radio" name="data[Label][color]" value="label-two"></label>
                    <label class="btn btn-3"><input type="radio" name="data[Label][color]" value="label-three"></label>
                    <label class="btn btn-4"><input type="radio" name="data[Label][color]" value="label-four"></label>
                    <label class="btn btn-5"><input type="radio" name="data[Label][color]" value="label-five"></label>
                    <label class="btn btn-6"><input type="radio" name="data[Label][color]" value="label-six"></label>
                    <label class="btn btn-7"><input type="radio" name="data[Label][color]" value="label-seven"></label>
                    <label class="btn btn-8"><input type="radio" name="data[Label][color]" value="label-eight"></label>
                    <label class="btn btn-9"><input type="radio" name="data[Label][color]" value="label-nine"></label>
                    <label class="btn btn-10"><input type="radio" name="data[Label][color]" value="label-ten"></label>
                    <label class="btn btn-11"><input type="radio" name="data[Label][color]" value="label-elev"></label>
                    <label class="btn btn-12"><input type="radio" name="data[Label][color]" value="label-tw"></label>
                    <label class="btn btn-13"><input type="radio" name="data[Label][color]" value="label-tr"></label>
                    <label class="btn btn-14"><input type="radio" name="data[Label][color]" value="label-fr"></label>
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
<!-- Delete label modal -->
<div class="modal fade" id="delLabelM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('Label', array('url' => array('action' => 'delete'))); ?>
            <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p> <?php echo __('Are you sure to delete this label ? Assign this label to deals also delete.'); ?></p>
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
                    <h1 class="pull-left"><?php echo __('Labels'); ?></h1>
                    <div class="pull-right top-page-ui">
                        <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#labelM">
                            <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Add Label'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">	
                    <div class="tabs-wrapper tabs-no-header manager-labels">
                        <!-- Pipelines -->
                        <ul class="nav nav-tabs manager-tabs">
                            <?php foreach ($pipelines as $row): ?>
                                <li class=""><a data-toggle="tab" href="#tab-home<?= h($row['Pipeline']['id']); ?>"><?= h($row['Pipeline']['name']); ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                        <!--End Pipelines -->
                        <div class="tab-content">
                            <!-- General Tab -->
                            <div id="tab-home" class="tab-pane fade active in">
                                <div class="row manager-index">
                                    <?php echo $this->Html->image('label.png'); ?>
                                    <h1><?php echo __('Select Pipeline to Label'); ?></h1>  
                                </div>
                            </div>
                            <!--End General Tab -->

                            <?php foreach ($pipelines as $row): ?>
                                <!-- Pipelines wise labels -->
                                <div id="tab-home<?= h($row['Pipeline']['id']); ?>" class="tab-pane fade">
                                    <div class="row">
                                        <table class="table table-hover dataTable">
                                            <tbody>
                                                <?php foreach ($row['Label'] as $label): ?>
                                                    <tr id="item-<?= h($label['Label']['id']); ?>">
                                                        <td><span class="label <?= h($label['Label']['color']); ?>"><a data-type="text" data-pk="<?= h($label['Label']['id']); ?>" data-url="labels/edit"  class="vEdit"  ref="popover" data-content="Edit Label Name"><?= h($label['Label']['name']); ?></a></span></td>
                                                        <td> 
                                                            <a class="table-link danger" href="#" data-toggle="modal" data-target="#delLabelM" onclick="fieldU('LabelId',<?= h($label['Label']['id']); ?>)"  ref="popover" data-content="Delete Label">
                                                                <i class="fa fa-trash-o"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!--End Pipelines wise labels -->
                            <?php endforeach; ?>     
                        </div>
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>