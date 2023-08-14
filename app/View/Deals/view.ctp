<?php
/**
 * View for deal details page
 * 
 * @author:   AnkkSoft.com
 * Copyright: AnkkSoft 2020
 * Website:   https://www.ankksoft.com
 * CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Edit Deal Modal --> 
<div class="modal fade" id="editM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Edit Deal'); ?></h4>
            </div>
            <?php echo $this->Form->create('Deal', array('url' => array('controller' => 'Deals', 'action' => 'edit'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
            <?php echo $this->Form->input('Deal.id', array('type' => 'hidden', 'value' => h($deal['Deal']['id']))); ?>
            <div class="modal-body tab-modal">
                <div class="form-group">
                    <label><?php echo __('Name'); ?></label>
                    <?php echo $this->Form->input('Deal.name', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Deal Name'), 'value' => h($deal['Deal']['name']))); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('Price'); ?></label>
                    <div class="input-group">
                        <span class="input-group-addon"> <?= $this->Session->read('Auth.User.currency_symbol'); ?></span>
                        <?php echo $this->Form->input('Deal.price', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Deal Price'), 'value' => h($deal['Deal']['price']))); ?>
                    </div>
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
<!-- Delete modal -->
<div class="modal fade" id="delM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('Deal', array('url' => array('action' => 'delete'), 'id' => 'confirm-form')); ?>
            <?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => h($deal['Deal']['id']))); ?>
            <?php echo $this->Form->input('Item.id', array('type' => 'hidden')); ?>
            <?php echo $this->Form->input('Deal.action', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p> <?php echo __('Are you sure to delete ?'); ?></p>
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
<!-- Won deal modal -->
<div class="modal fade" id="wonM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('Deal', array('url' => array('action' => 'won'), 'class' => 'vForm1')); ?>
            <?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => h($deal['Deal']['id']))); ?>
            <div class="modal-body">						
                <p><strong> <?php echo __('Are you sure to make deal won ?'); ?></strong></p>
                <div class="form-group">
                    <label></label>
                    <?php echo $this->Form->input('History.reason', array('type' => 'textarea', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Won Reason'), 'div' => false, 'label' => false, 'rows' => '4')); ?>	
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
<!-- Loss deal modal -->
<div class="modal fade" id="lossM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('Deal', array('url' => array('action' => 'loss'), 'class' => 'vForm1')); ?>
            <?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => h($deal['Deal']['id']))); ?>
            <div class="modal-body">						
                <p><strong> <?php echo __('Are you sure to make deal loss ?'); ?></strong></p>
                <div class="form-group">
                    <label></label>
                    <?php echo $this->Form->input('History.reason', array('type' => 'textarea', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Loss Reason'), 'div' => false, 'label' => false, 'rows' => '4')); ?>	
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
<!-- Label Modal -->
<div class="modal fade" id="uDealSM" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-sm label-modal">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Update'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="row" id="mBody">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Delete deal modal -->
<div class="modal fade" id="dealDM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('Deal', array('url' => array('action' => 'delete'), 'class' => 'vForm1')); ?>
            <?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => h($deal['Deal']['id']))); ?>
            <div class="modal-body">						
                <p> <?php echo __('Are you sure to delete this deal? All the data related to this deal also deleted like task, notes, files, discussion.'); ?></p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary"  type="submit"><?php echo __('Yes'); ?></button>
                <button class="btn default" data-dismiss="modal" type="button"><?php echo __('No'); ?></button>
            </div>
            <?php echo $this->Form->end(); ?>
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!-- Task Model -->
<div class="modal fade" id="TaskM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Update Task'); ?></h4>
            </div>
            <?php echo $this->Form->create('Task', array('url' => array('controller' => 'tasks', 'action' => 'edit'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'edit-task')); ?>
            <div class="modal-body">													
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
<!-- Update Pipeline Modal --> 
<div class="modal fade" id="pipelineM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Change Pipeline'); ?></h4>
            </div>
            <?php echo $this->Form->create('Deal', array('url' => array('controller' => 'Deals', 'action' => 'update_pipeline'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'form-horizontal')); ?>
            <?php echo $this->Form->input('id', array('type' => 'hidden', 'value' => h($deal['Deal']['id']))); ?>
            <div class="modal-body">		
                <div class="form-group">
                    <label class="col-lg-3"><?php echo __('Pipeline'); ?></label>
                    <div class="col-lg-9">
                        <?php echo $this->Form->input('Deal.pipeline_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array($this->Common->getPipelineList()), 'empty' => __('Select Pipeline'))); ?>	
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3"><?php echo __('Stage'); ?></label>
                    <div class="col-lg-9">
                        <?php echo $this->Form->input('Deal.stage_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array(), 'empty' => __('Select Pipeline'))); ?>		
                    </div>
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
<!-- Add member modal -->
<div class="modal fade" id="memberM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Add Member'); ?></h4>
            </div> 
            <?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'deal'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'form-horizontal')); ?>
            <?php echo $this->Form->input('User.deal_id', array('type' => 'hidden', 'value' => h($deal['Deal']['id']))); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label><?php echo __('Members'); ?></label>
                    <select class="select-tags form-control w100" multiple="multiple" name="data[Deal][User][]">
                        <?php foreach ($groupMembers as $key => $value): ?>
                            <option value="<?php echo h($key); ?>"><?php echo h($value); ?></option>
                        <?php endforeach; ?> 
                    </select>
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
<!--  Task Details modal -->
<div class="modal fade" id="taskDM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Task Details'); ?></h4>
            </div>
            <div class="modal-body">						
            </div>
            <div class="modal-footer">
                <button class="btn default" data-dismiss="modal" type="button"><i class="fa fa-times"></i> <?php echo __('Close'); ?></button>
            </div>
            <?php echo $this->Form->end(); ?>
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!--  /modal -->
<!--  Content -->
<div class="row manager-deal"> 
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">
                    <?php if ($this->Common->isAdmin() || $this->Common->isStaff()) { ?>
                        <div class="col-lg-4 col-sm-6 col-xs-12">
                            <h1 class="pull-left deal-title"> <?= h($deal['Deal']['name']); ?></h1>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-xs-12 deal-view-colum">
                            <?php foreach ($labels as $row): ?>
                                <span class="label label-default deal-view-label <?= h($row['Label']['color']); ?>"><?= h($row['Label']['name']); ?></span>
                            <?php endforeach; ?>
                        </div>                                           
                        <div class="col-lg-4 col-sm-6 col-xs-12 deal-view-colum">
                            <div class="deal-right text-right">
                                <a class="btn btn-primary" href="#" data-name="labels" data-id="<?= h($deal['Deal']['id']); ?>"  data-toggle="modal" data-target="#uDealSM">
                                    <i class="fa fa-tag"></i> <?php echo __('Label'); ?>
                                </a>
                                <a class="btn btn-primary" href="#"   data-toggle="modal" data-target="#pipelineM">
                                    <i class="fa fa-filter"></i> <?php echo __('Pipeline'); ?>
                                </a>
                                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#editM">
                                    <i class="fa fa-pencil"></i> <?php echo __('Edit Deal'); ?>
                                </a>
                                <a class="btn btn-primary" href="#" data-toggle="modal" data-target="#wonM">
                                    <i class="fa fa-thumbs-up"></i>
                                </a>&nbsp;
                                <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#lossM">
                                    <i class="fa fa-thumbs-down"></i>
                                </a>
                                <a class="label label-success" href="#" data-toggle="modal" data-target="#dealDM" data-action="deals">
                                    <?php echo __('Delete'); ?>
                                </a>
                            </div>
                        </div>
                    <?php } else { ?>
                        <div class="col-lg-3 col-sm-6 col-xs-12">
                            <h1 class="pull-left deal-title"> <?= h($deal['Deal']['name']); ?></h1>                    
                        </div>
                    <?php } ?>
                    <?php echo $this->Form->input('id', array('type' => 'hidden', 'id' => 'dealid', 'value' => h($deal['Deal']['id']))); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">	
                    <div class="tabs-wrapper tabs-no-header">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs deal-tab">
                            <li class="active"><a data-toggle="tab" href="#tab-general"><?php echo __('General'); ?></a></li>                            
                            <?php if ($this->Common->isAdmin() || $this->Common->isStaff()): ?>
                                <li><a data-toggle="tab" href="#tab-tasks" ><?php echo __('Tasks'); ?></a></li>
                                <li><a data-toggle="tab" href="#tab-products" ><?php echo __('Products'); ?></a></li> 
                                <li><a data-toggle="tab" href="#tab-sources" ><?php echo __('Sources'); ?></a></li>
                                <li><a data-toggle="tab" href="#tab-contacts"><?php echo __('Contacts'); ?></a></li>
                            <?php endif; ?>
                            <li><a data-toggle="tab" href="#tab-files"><?php echo __('Files'); ?></a></li>                           
                            <li><a data-toggle="tab" href="#tab-discussions" class="tab-load" data-type="1" data-action="discussions"><?php echo __('Discussion'); ?></a></li>
                            <li><a data-toggle="tab" href="#tab-feedback" class="tab-load" data-type="2" data-action="discussions"><?php echo __('Customer Feedback'); ?></a></li>
                            <li><a data-toggle="tab" href="#tab-notes"><?php echo __('Notes'); ?></a></li>
                            <li><a data-toggle="tab" href="#tab-invoices" class="tab-load" data-type="3" data-action="invoices"><?php echo __('Invoices'); ?></a></li>
                            <?php if ($this->Common->isAdmin() || $this->Common->isStaff()): ?>   
                                <li><a data-toggle="tab" href="#tab-custom" ><?php echo __('Custom Fields'); ?></a></li>
                                <li><a data-toggle="tab" href="#tab-settings" ><?php echo __('Permission'); ?></a></li>
                            <?php endif; ?>
                        </ul>
                        <!--End Tabs -->
                        <!-- Tabs Content -->
                        <div class="tab-content">
                            <!-- General Tab -->
                            <div id="tab-general" class="tab-pane fade in active">
                                <div class="row">
                                    <?php if ($this->Common->isAdmin() || $this->Common->isStaff()): ?>
                                        <?php echo $this->element('deal-general'); ?>	
                                    <?php else: ?>
                                        <?php echo $this->element('deal-general-client'); ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <!-- Task Tab -->
                            <div id="tab-tasks" class="tab-pane fade">
                                <?php echo $this->element('deal-task'); ?>
                            </div>
                            <!-- Product Tab -->
                            <div id="tab-products" class="tab-pane fade">
                                <?php echo $this->element('deal-product'); ?>                                
                            </div>
                            <!-- Sources Tab -->
                            <div id="tab-sources" class="tab-pane fade">
                                <?php echo $this->element('deal-source'); ?> 
                            </div>
                            <!-- Files Tab -->
                            <div id="tab-files" class="tab-pane fade">
                                <div class="row">
                                    <?php echo $this->Form->create('Files', array('url' => array('controller' => 'Files', 'action' => 'add'), 'class' => 'dropzone', 'id' => 'my-dropzone', 'type' => 'file')); ?>
                                    <?php echo $this->Form->input('AppFile.deal_id', array('type' => 'hidden', 'value' => h($deal['Deal']['id']))); ?>
                                    <?php echo $this->Form->end(); ?>
                                </div>
                                <div class="row top-margin">
                                    <div class="table-scrollable">
                                        <table class="table table-hover dataTable">
                                            <thead>
                                                <tr>
                                                    <th><?php echo __('File Name'); ?></th>
                                                    <th><?php echo __('Description'); ?></th>
                                                    <th><?php echo __('Uploaded By'); ?></th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($files)) :
                                                    foreach ($files as $row) :

                                                        ?>
                                                        <tr  id="<?php echo 'row' . h($row['AppFile']['id']); ?>">
                                                            <td> <?= h($row['AppFile']['name']); ?> </td>
                                                            <td>
                                                                <a href="#"  data-type="text" data-pk="<?php echo h($row['AppFile']['id']); ?>" data-url="<?php echo $this->Html->url(array('controller' => 'files', 'action' => 'edit')) ?>"  class="editable editable-click vEdit"><?= h($row['AppFile']['description']); ?></a>
                                                            </td>
                                                            <td>
                                                                <?= h($row['User']['first_name']) . ' ' . h($row['User']['last_name']); ?>
                                                            </td>
                                                            <td>	
                                                                <?php echo $this->Html->link('<span class="fa-stack"><i class="fa fa-download"></i></span>', array('controller' => 'Files', 'action' => 'download', $row['AppFile']['deal_id'], $row['AppFile']['name']), array('escape' => false)); ?>							
                                                                <a class="table-link danger" href="#" data-toggle="modal" data-target="#delM"  data-title="Delete File" data-action="files" data-id="<?= h($row['AppFile']['id']); ?>" >
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
                            </div>
                            <!-- Contacts Tab -->
                            <div id="tab-contacts" class="tab-pane fade">
                                <?php echo $this->element('deal-contact'); ?>                               
                            </div>
                            <!-- Discussion Tab -->
                            <div id="tab-discussions" class="tab-pane fade"></div>
                            <!-- Customer Feedback Tab -->
                            <div id="tab-feedback" class="tab-pane fade"></div>
                            <!-- Notes Tab -->
                            <div id="tab-notes" class="tab-pane fade">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <i class="fa fa-sticky-note"></i> <?php echo __('Notes (Private)'); ?>
                                    </div>
                                    <div class="panel-body">
                                        <?php echo $this->Form->create('Note', array('url' => array('controller' => 'Notes', 'action' => 'add'), 'class' => 'vForm1')); ?>
                                        <?php echo $this->Form->input('NoteDeal.deal_id', array('type' => 'hidden', 'value' => h($deal['Deal']['id']))); ?>
                                        <?php echo $this->Form->input('NoteDeal.id', array('type' => 'hidden', 'value' => (isset($note['NoteDeal']['id'])) ? h($note['NoteDeal']['id']) : '')); ?>
                                        <div class="input-group col-md-12">
                                            <h4 class="pull-left"><?php echo __('Notes (Private)'); ?></h4>
                                            <button class="btn btn-success btn-sm pull-right" type="submit"><i class="fa fa-check-circle"></i> <?php echo __('Save'); ?></button>
                                        </div>
                                        <div class="input-group col-md-12">
                                            <?php echo $this->Form->input('NoteDeal.note', array('type' => 'textarea', 'class' => 'notebook', 'label' => false, 'div' => false, 'value' => (isset($note['NoteDeal']['note'])) ? h($note['NoteDeal']['note']) : '')); ?>
                                        </div>

                                        <?php echo $this->Form->end(); ?>
                                        <?php echo $this->Js->writeBuffer(); ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Custom Field Tab -->
                            <div id="tab-invoices" class="tab-pane fade"></div>
                            <!-- Custom Field Tab -->
                            <div id="tab-custom" class="tab-pane fade">
                                <?php echo $this->element('custom-fields'); ?>
                            </div>
                            <!-- Settings Tab -->
                            <div id="tab-settings" class="tab-pane fade">
                                <?php echo $this->element('deal-settings'); ?>
                            </div>
                        </div>
                        <!--End Tabs Content -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>
<!--Theme Jquery -->
<?php echo $this->Html->css('fullcalendar.css'); ?>
<?php echo $this->Html->script('fullcalendar.min.js'); ?>
<!--End Theme Jquery -->
<script>
    $(document).ready(function () {
        var getUrl = $('#base_url').val();
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var calendar = $('#calendar').fullCalendar({
            disableDragging: true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: ''
            },
            editable: true,
            buttonText: {
                prev: '<i class="fa fa-chevron-left"></i>',
                next: '<i class="fa fa-chevron-right"></i>'
            },
            events: <?php echo $task_cal; ?>,
            eventRender: function (event, element) {
                if (event.icon) {
                    element.find(".fc-event-title").prepend("<i class='fa fa-" + event.icon + "'></i> ");
                }
            },
            eventClick: function (event) {
                if (event.icon) {
                    $.ajax({
                        type: "POST",
                        url: getUrl + "calenders/task/" + event.id,
                        success: function (data) {
                            $('#taskDM').modal('show');
                            $('#taskDM .modal-body').html(data);
                        }
                    });
                }
            }
        });
    });
</script>