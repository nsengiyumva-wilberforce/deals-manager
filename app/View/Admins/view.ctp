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

<div class="row manager-deal deal-popup"> 
    <div class="col-lg-12">

        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">	
                    <div class="tabs-wrapper tabs-no-header">
                        <?php echo $this->Form->input('id', array('type' => 'hidden', 'id' => 'dealid', 'value' => h($deal['Deal']['id']))); ?>
                        <!-- Tabs -->
                        <ul class="nav nav-tabs deal-tab">                                                                           
                            <li class="active"><a data-toggle="tab" href="#tab-tasks" ><?php echo __('Task'); ?></a></li>
                            <li><a data-toggle="tab" href="#tab-products" ><?php echo __('Product'); ?></a></li> 
                            <li><a data-toggle="tab" href="#tab-sources" ><?php echo __('Source'); ?></a></li>
                            <li><a data-toggle="tab" href="#tab-contacts"><?php echo __('Contacts'); ?></a></li>
                            <li><a data-toggle="tab" href="#tab-files"><?php echo __('Files'); ?></a></li>                           
                            <li><a data-toggle="tab" href="#tab-discussions"><?php echo __('Discussion'); ?></a></li>
                            <li><a data-toggle="tab" href="#tab-feedback"><?php echo __('Customer Feedback'); ?></a></li>
                            <li><a data-toggle="tab" href="#tab-notes"><?php echo __('Notes (Private)'); ?></a></li>                            
                            <li><a data-toggle="tab" href="#tab-customs"><?php echo __('Custom Fields'); ?></a></li>
                        </ul>
                        <!--End Tabs -->
                        <!-- Tabs Content -->
                        <div class="tab-content">                        
                            <!-- Task Tab -->
                            <div id="tab-tasks" class="tab-pane fade in active">
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
                                    <?php echo $this->Form->input('File.deal_id', array('type' => 'hidden', 'value' => h($deal['Deal']['id']))); ?>
                                    <?php echo $this->Form->end(); ?>
                                </div>
                                <div class="row top-margin">
                                    <div class="table-scrollable">
                                        <table class="table table-hover dataTable table-striped">
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
                                                if (!empty($files)) {
                                                    foreach ($files as $row) {

                                                        ?>
                                                        <tr  id="<?php echo 'row' . h($row['AppFile']['id']); ?>">
                                                            <td> <?= h($row['AppFile']['name']); ?> </td>
                                                            <td><?= h($row['AppFile']['description']); ?></td>
                                                            <td>
                                                                <?= h($row['User']['first_name']) . ' ' . h($row['User']['last_name']); ?>
                                                            </td>
                                                            <td>	
                                                                <?php echo $this->Html->link('<i class="fa fa-download"></i>', array('controller' => 'Files', 'action' => 'download', h($row['AppFile']['deal_id']), h($row['AppFile']['name'])), array('escape' => false)); ?>							
                                                                <a class="table-link danger" href="#" data-toggle="modal" data-target="#delM"  data-title="Delete File" data-action="files" data-id="<?= h($row['AppFile']['id']); ?>" >
                                                                    <i class="fa fa-trash-o"></i></span>
                                                                </a>					
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }

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
                            <div id="tab-discussions" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="clearfix">
                                            <div class="tabs-wrapper profile-tabs">
                                                <div class="conversation-wrapper">
                                                    <div class="conversation-content">
                                                        <div class="conversation-inner">
                                                            <?php foreach ($Discussions as $row): ?>
                                                                <div class="discussion-row" id="<?php echo 'row' . h($row['Discussion']['id']); ?>">
                                                                    <div class="conversation-item  clearfix item-left">
                                                                        <div class="conversation-user">
                                                                            <?php
                                                                            echo $this->Html->image('avatar/thumb/' . h($row['User']['picture']), array('class' => 'img-responsive center-block'));

                                                                            ?>
                                                                        </div>
                                                                        <div class="conversation-body discuss-body">
                                                                            <div class="name"> 
                                                                                <?php echo h($row['User']['first_name']) . ' ' . h($row['User']['last_name']);

                                                                                ?></div>
                                                                            <div class="time hidden-xs"> <?= $this->Time->format($this->Common->dateTime(), h($row['Discussion']['created'])); ?> </div>
                                                                            <div class="text"><?= h($row['Discussion']['message']); ?></div>
                                                                        </div>
                                                                    </div>                                                             
                                                                    <?php
                                                                    if (!empty($row['childs'])) {
                                                                        foreach ($row['childs'] as $row):

                                                                            ?>
                                                                            <div id="<?php echo 'row' . h($row['Discussion']['id']); ?>">
                                                                                <div class="conversation-item  clearfix discuss-reply-message">
                                                                                    <div class="conversation-user">
                                                                                        <?php echo $this->Html->image('avatar/thumb/' . h($row['User']['picture']), array('class' => 'img-responsive center-block')); ?>                                     </div>
                                                                                    <div class="conversation-body">
                                                                                        <div class="name"> 
                                                                                            <?php echo h($row['User']['first_name']) . ' ' . h($row['User']['last_name']);?>
                                                                                        </div>
                                                                                        <div class="time hidden-xs"> <?= $this->Time->format($this->Common->dateTime(), h($row['Discussion']['created'])); ?> </div>
                                                                                        <div class="text"><?= h($row['Discussion']['message']); ?></div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <?php
                                                                        endforeach;
                                                                    }

                                                                    ?>
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
                            <!-- Feedback Tab -->
                            <div id="tab-feedback" class="tab-pane fade">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="clearfix">
                                            <div class="tabs-wrapper profile-tabs">
                                                <div class="conversation-wrapper">
                                                    <div class="conversation-content">
                                                        <div class="conversation-inner">
                                                            <?php foreach ($feedback as $row): ?>
                                                                <div class="discussion-row">
                                                                    <div class="conversation-item  clearfix item-left">
                                                                        <div class="conversation-user">
                                                                            <?php
                                                                            echo $this->Html->image('avatar/thumb/' . h($row['User']['picture']), array('class' => 'img-responsive center-block'));

                                                                            ?>
                                                                        </div>
                                                                        <div class="conversation-body discuss-body">
                                                                            <div class="name"> 
                                                                                <?php echo h($row['User']['first_name']) . ' ' . h($row['User']['last_name']);

                                                                                ?></div>
                                                                            <div class="time hidden-xs"> <?= $this->Time->format($this->Common->dateTime(), h($row['Discussion']['created'])); ?> </div>
                                                                            <div class="text"><?= h($row['Discussion']['message']); ?></div>
                                                                        </div>
                                                                    </div>                                                                 
                                                                    <?php
                                                                    if (!empty($row['childs'])) {
                                                                        foreach ($row['childs'] as $row):

                                                                            ?>
                                                                            <div>
                                                                                <div class="conversation-item  clearfix discuss-reply-message">
                                                                                    <div class="conversation-user">
                                                                                        <?php echo $this->Html->image('avatar/thumb/' . h($row['User']['picture']), array('class' => 'img-responsive center-block')); ?>                                     </div>
                                                                                    <div class="conversation-body">
                                                                                        <div class="name"> 
                                                                                            <?php echo h($row['User']['first_name']) . ' ' . h($row['User']['last_name']);

                                                                                            ?></div>
                                                                                        <div class="time hidden-xs"> <?= $this->Time->format($this->Common->dateTime(), h($row['Discussion']['created'])); ?> </div>
                                                                                        <div class="text"><?= h($row['Discussion']['message']); ?></div>
                                                                                    </div>
                                                                                </div>

                                                                            </div>
                                                                            <?php
                                                                        endforeach;
                                                                    }

                                                                    ?>
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
                            <!-- Notes Tab -->
                            <div id="tab-notes" class="tab-pane fade">
                                <div class="row">

                                    <div class="input-group col-md-12">
                                        <?php echo $this->Form->input('NoteDeal.note', array('type' => 'textarea', 'class' => 'notebook', 'label' => false, 'div' => false, 'value' => (isset($note['NoteDeal']['note'])) ? h($note['NoteDeal']['note']) : '')); ?>
                                    </div>

                                </div>
                            </div>                                              
                            <div id="tab-customs" class="tab-pane fade">
                                <?php echo $this->element('custom-fields'); ?>
                            </div>

                        </div>
                        <!--End Tabs Content -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>
<!-- Jquery Library -->
<?php
echo $this->Html->css('select2.min.css?' . rand);
echo $this->Html->script('select2.full.min.js?' . rand);

?>
<!-- Custom Jquery -->
<script>
    $(document).ready(function () {
        $('#sources,#contacts,#products,#users').typeahead({
            source: function (query, process) {
                var currentId = this.$element.attr('id');
                return   $.ajax({
                    type: "POST",
                    url: getUrl + "" + currentId + "/search?name=" + query,
                    dataType: 'json',
                    success: function (data) {
                        if (data) {
                            sources = [];
                            deal = {};
                            $.each(data, function (i, source) {
                                deal[source.name] = source;
                                sources.push(source.name);
                            });
                            return  process(sources);
                        }
                    }
                });
            },
            updater: function (item) {
                $('.loader').show();
                var currentId = this.$element.attr('id');
                selectedSource = deal[item].name;
                itemId = deal[item].id;
                dealId = $('#dealid').val();
                $.ajax({
                    type: "POST",
                    url: getUrl + "" + currentId + "/deal",
                    cache: false,
                    data: {dealId: dealId, itemId: itemId},
                    success: function (data) {
                        $('.loader').hide();
                        if (data.module == 1) {
                            $('#tab-' + currentId + ' table tbody').prepend(data.html);
                        } else {
                            $('#tab-' + currentId + ' .contact-list').prepend(data.html);
                        }
                        $('input.blank').val('');
                    }
                });
            }


        });
        $('#delM').on('show.bs.modal', function (e) {
            $title = $(e.relatedTarget).attr('data-title');
            $(this).find('.modal-title').text($title);
            $action = $(e.relatedTarget).attr('data-action');
            $("#confirm-form").attr("action", getUrl + $action + "/unlink");
            $id = $(e.relatedTarget).attr('data-id');
            $('#ItemId').val($id);
            $('#DealAction').val($action);
        });

        $('.task-form').validate({
            errorClass: 'form-error',
            rules: {
                "data[Task][task]": "required",
            },
            submitHandler: function (form) {
                $('.loader').show();
                $.ajax({
                    type: "POST",
                    url: 'tasks/deal',
                    data: $(".task-form").serialize(),
                    success: function (data) {
                        $('.loader').hide();
                        $('#tab-tasks table tbody').prepend(data);
                    }
                });

            }
        });
    });
    $('.datepickerDateT').datepicker({format: 'dd-mm-yyyy', autoclose: true}).datepicker("setDate", new Date());
    $('#datepickerDate').datepicker({format: 'dd-mm-yyyy'});
    $('#timepicker').timepicker({
    }).focus(function () {
        $(this).next().trigger('click');
    });
    $('.select-box').select2({minimumResultsForSearch: Infinity});
    $('.select-box-search').select2();
    function loadmodal(id) {
        $('#TaskM .modal-body').html('<div class="loader-modal"></div>');
        $.ajax({
            type: "POST",
            url: getUrl + "tasks/update?id=" + id,
            success: function (data) {
                $('#TaskM .modal-body').html(data);

            }
        });
    }
    $('.edit-task').validate({
        errorClass: 'form-error',
        rules: {
            "data[Task][task]": "required",
        },
        submitHandler: function (form) {
            $('.loader').show();
            $.ajax({
                type: "POST",
                url: getUrl + 'tasks/edit',
                dataType: 'json',
                data: $(".edit-task").serialize(),
                success: function (data) {
                    $('.loader').hide();
                    $('#TaskM').modal('hide');
                    $("#tab-tasks tr#row" + data.vId).replaceWith(data.html);
                }
            });

        }
    });
</script>