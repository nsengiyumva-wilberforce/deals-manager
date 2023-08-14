<?php
/**
 * View for ticket home page,list tickets
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
?>
<!-- add ticket modal -->
<div class="modal fade" id="ticketM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo __('Add Ticket'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="error-Msg"></div>
                <?php echo $this->Form->create('Ticket', array('type' => 'file', 'url' => array('controller' => 'Tickets', 'action' => 'add'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
                <div class="form-group">
                    <label><?php echo __('Department'); ?></label>
                    <?php echo $this->Form->input('Ticket.type_id', array('options' => $ticketTypes, 'class' => 'select-box-search full-width')); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('Subject'); ?></label>				
                    <?php echo $this->Form->input('Ticket.subject', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Subject'))); ?>
                </div>
                <?php if ($this->Session->read('Auth.User.user_group_id') != '4'): ?>
                    <div class="form-group">
                        <label><?php echo __('Client'); ?></label>
                        <select id="TicketTypeId"  class="select-box-search full-width" name="data[Ticket][user_id]">
                            <option value=""><?php echo __('Select Client'); ?></option>
                            <?php foreach ($clients as $row): ?>
                                <option value="<?php echo h($row['User']['id']); ?>"><?php echo h($row['User']['name']) . ' [' . h($row['Company']['name']) . ']' ?></option>
                            <?php endforeach; ?>
                        </select>

                    </div>
                <?php endif; ?>
                <div class="form-group">
                    <label><?php echo __('Message'); ?></label>												
                    <?php echo $this->Form->input('Ticket.message', array('type' => 'textarea', 'class' => 'form-control', 'Placeholder' => '', 'id' => 'summernote')); ?>
                </div>                     		           
                <div class="form-group">                           				
                    <?php echo $this->Form->input('Ticket.attachment', array('type' => 'file')); ?>
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
<!-- /modal -->
<!-- Delete ticket modal -->
<div class="modal fade" id="delTicketM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('Ticket', array('url' => array('action' => 'delete'))); ?>
            <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p><?php echo __('Are you sure to delete this ticket ? All messages and files related to this ticket also deleted.'); ?> </p>
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
                <div class="clearfix">
                    <h1 class="pull-left"><?php echo __('Tickets'); ?></h1>
                    <div class="pull-right top-page-ui">
                        <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#ticketM">
                            <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Add Ticket'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">					  
                    <div class="main-box-body clearfix">
                        <div class="row">
                            <?php echo $this->Form->create('Ticket', array('url' => array('controller' => 'tickets', 'action' => 'index'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => '')); ?>
                            <div class="col-lg-6 form-group">
                                <?php echo $this->Form->input('Ticket.type_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $ticketTypes, 'empty' => 'All Department', 'onchange' => "this.form.submit()")); ?>
                            </div>
                            <div class="col-lg-6 form-group">
                                <?php echo $this->Form->input('Ticket.status', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array(1 => __('Open'), 2 => __('In Progress'), 3 => __('On Hold'), 4 => __('Reopened'), 5 => __('Closed')), 'empty' => 'All Status', 'onchange' => "this.form.submit()")); ?>
                            </div>
                            <?php echo $this->Form->end(); ?>
                            <?php echo $this->Js->writeBuffer(); ?>
                        </div>
                        <!--Ticket List -->
                        <div class="table-responsive">
                            <?php echo $this->element('tickets'); ?>	
                        </div>
                        <!--End Ticket List -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>
<!-- /Content -->
<!--Theme css/jquery -->
<?php echo $this->Html->css('summernote.css'); ?>
<?php echo $this->Html->script('summernote.min.js'); ?>
<?php echo $this->Html->script('bootstrap.file-input.js'); ?>
<script>
    $(document).ready(function () {
        $('input[type=file]').bootstrapFileInput();
        $('.file-inputs').bootstrapFileInput();
    });
    $('#summernote').summernote({
        height: 150,
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['insert', ['link']],
            ['fullscreen', ['fullscreen']],
        ]
    });
</script>
<!-- End Theme css/jquery -->