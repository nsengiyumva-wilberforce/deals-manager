<?php
/**
 * View for ticket detail page
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!--Ticket Type Modal -->
<div class="modal fade" id="typeM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo __('Change Type'); ?></h4>
            </div>
            <div class="modal-body">                
                <?php echo $this->Form->create('Ticket', array('url' => array('controller' => 'Tickets', 'action' => 'edit'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
                <?php echo $this->Form->input('Ticket.id', array('type' => 'hidden', 'value' => h($ticket['Ticket']['id']))); ?>	
                <div class="form-group">
                    <label></label>
                    <?php echo $this->Form->input('Ticket.type_id', array('options' => $ticketTypes, 'class' => 'select-box-search full-width', 'default' => h($ticket['Ticket']['type_id']))); ?>	
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
<!--Ticket Status Modal -->
<div class="modal fade" id="statusM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo __('Change Status'); ?></h4>
            </div>
            <div class="modal-body">                
                <?php echo $this->Form->create('Ticket', array('url' => array('controller' => 'Tickets', 'action' => 'edit'), 'inputDefaults' => array('label' => false, 'div' => false))); ?>
                <?php echo $this->Form->input('Ticket.id', array('type' => 'hidden', 'value' => h($ticket['Ticket']['id']))); ?>	             
                <div class="form-group">
                    <label></label>				
                    <?php echo $this->Form->input('Ticket.status', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array('1' => __('Open'), '2' => __('In Progress'), '3' => __('On Hold'), '4' => __('Reopened'), '5' => __('Closed')), 'default' => $ticket['Ticket']['status'])); ?>
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
<!--Ticket Assign Modal -->
<div class="modal fade" id="assignM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo __('Assign To'); ?></h4>
            </div>
            <div class="modal-body">                
                <?php echo $this->Form->create('Ticket', array('url' => array('controller' => 'Tickets', 'action' => 'edit'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => '')); ?>
                <?php echo $this->Form->input('Ticket.id', array('type' => 'hidden', 'value' => h($ticket['Ticket']['id']))); ?>	             
                <div class="form-group">
                    <label></label>				
                    <?php echo $this->Form->input('Ticket.assign', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array($assign), 'empty' => 'Assign to', 'default' => $ticket['Ticket']['assign'])); ?>
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
<!-- /.modal -->
<!-- Content -->
<div class="row ticket-view">
    <div class="col-lg-12">
        <!--Ticket Details -->
        <div class="col-lg-3 col-md-4 col-sm-4  ticket-sidebar">
            <div class="main-box clearfix">
                <div class="ticket-details">
                    <i class="fa fa-info-circle"></i> <?php echo __('Ticket Details'); ?>
                </div> 
                <table class="table table-striped">
                    <tr>
                        <td><?php echo __('Ticket Number'); ?></td>
                        <td>#<?= $ticket['Ticket']['id']; ?></td>
                    </tr>
                    <tr>
                        <td><?php echo __('Type'); ?></td>
                        <td><?= h($ticket['TicketType']['name']); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo __('Status'); ?></td>
                        <td><?= $this->Common->ticket_status($ticket['Ticket']['status']); ?></td>
                    </tr>
                    <tr>
                        <td><?php echo __('From'); ?></td>
                        <td><?= h($ticket['User']['first_name']) . ' ' . h($ticket['User']['last_name']); ?></td>
                    </tr>
                    <?php if ($ticket['Company']['name']): ?>
                        <tr>
                            <td><?php echo __('Company'); ?></td>
                            <td><?= h($ticket['Company']['name']); ?></td>
                        </tr>
                    <?php endif; ?>
                    <?php if ($ticket['Ticket']['assign']): ?>
                        <tr>
                            <td><?php echo __('Assign To'); ?></td>
                            <td><?= h($ticket['Assign']['first_name']) . ' ' . h($ticket['Assign']['last_name']); ?></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td><?php echo __('Created'); ?></td>
                        <td><?php echo $this->Time->format($this->Common->dateTime(), h($ticket['Ticket']['created'])); ?></td>
                    </tr>
                </table>

            </div>
        </div>
        <!--End Ticket Details -->
        <!--Ticket Messages -->
        <div class="col-lg-9 col-md-8 col-sm-8">
            <div class="row">
                <div class="ticket-action">
                    <button type="button" id="discuss-button" class="btn btn-primary btn-xs">
                        <i class="fa fa-reply"></i> <?php echo __('Reply'); ?>
                    </button> 
                    <?php if ($this->Common->isAdminStaff()): ?>    
                        <a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target="#statusM">
                            <?php echo __('Status'); ?>                      
                        </a>
                        <a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target="#typeM">
                            <?php echo __('Type'); ?>                      
                        </a>
                    <?php endif; ?>
                    <?php if ($this->Common->isAdminManager()): ?>
                        <a class="btn btn-primary btn-xs" href="#" data-toggle="modal" data-target="#assignM">
                            <?php echo __('Assign'); ?>                      
                        </a>  
                    <?php endif; ?>     
                </div>
            </div>
            <div class="main-box clearfix">
                <div class="ticket-details">
                    #<?= h($ticket['Ticket']['id']); ?> - <?= h($ticket['Ticket']['subject']); ?>

                </div>
                <div class="newsfeed">
                    <div class="story">
                        <div class="story-user">
                            <a href="#">
                                <?php echo $this->Html->image('avatar/thumb/' . $ticket['User']['picture']); ?>  </a>
                        </div>
                        <div class="story-content">
                            <header class="story-header">
                                <div class="story-subject"> <?= h($ticket['User']['first_name']) . ' ' . h($ticket['User']['last_name']); ?>
                                </div>
                                <div class="story-time">
                                    <i class="fa fa-clock-o"></i> <?php echo $this->Time->format($this->Common->dateTime(), h($ticket['Ticket']['created'])); ?>
                                </div>
                            </header>
                            <div class="story-inner-content">
                                <?= strip_tags($ticket['Ticket']['message']); ?>
                                <?php
                                if ($ticket['Ticket']['attachment']):
                                    echo '<br>' . $this->Html->link('<i class="fa fa-file"></i> <span>' . $ticket['Ticket']['attachment'] . '</span>', array('controller' => 'tickets', 'action' => 'download', $ticket['Ticket']['attachment']), array('escape' => false));
                                endif;

                                ?>
                            </div>                                                                  
                        </div>
                    </div>	
                </div>
                <?php foreach ($messages as $row): ?>
                    <div class="newsfeed">
                        <div class="story">
                            <div class="story-user">
                                <a href="#">
                                    <?php echo $this->Html->image('avatar/thumb/' . $row['User']['picture']); ?> </a>
                            </div>
                            <div class="story-content">
                                <header class="story-header">
                                    <div class="story-subject">
                                        <?= h($row['User']['first_name']) . ' ' . h($row['User']['last_name']); ?>                                                                         </div>
                                    <div class="story-time">
                                        <i class="fa fa-clock-o"></i> <?php echo $this->Time->format($this->Common->dateTime(), $row['TicketMessage']['created']); ?> 
                                    </div>
                                </header>
                                <div class="story-inner-content">
                                    <?= strip_tags($row['TicketMessage']['message']); ?>
                                    <?php
                                    if ($row['TicketMessage']['attachment']):
                                        echo '<br>' . $this->Html->link('<i class="fa fa-file"></i> <span>' . $row['TicketMessage']['attachment'] . '</span>', array('controller' => 'tickets', 'action' => 'download', $row['TicketMessage']['attachment']), array('escape' => false));
                                    endif;

                                    ?>
                                </div>                                                                  
                            </div>
                        </div>	
                    </div>
                <?php endforeach; ?>


                <div class="discuss-add">
                    <div class="row ticket-message">

                        <div class="col-lg-12 col-md-12 col-sm-12 ">
                            <?php echo $this->Form->create('TicketMessage', array('type' => 'file', 'url' => array('controller' => 'Tickets', 'action' => 'reply', $ticket['Ticket']['id']), 'class' => 'vForm1', 'inputDefaults' => array('label' => false, 'div' => false))); ?>					
                            <div class="form-group">                                                           
                                <?php echo $this->Form->input('TicketMessage.message', array('type' => 'textarea', 'class' => 'form-control', 'Placeholder' => __('Message Reply'), 'rows' => '10', 'id' => 'summernote')); ?>
                            </div>
                            <div class="form-group">

                                <?php echo $this->Form->input('TicketMessage.attachment', array('type' => 'file', 'class' => '', 'title' => 'Browse File')); ?>
                            </div>
                            <div class="clearfix">
                                <button class="btn btn-success pull-right btn-sm" type="submit"><i class="fa fa-paper-plane"></i> <?php echo __('Message'); ?></button>
                            </div>
                            <?php echo $this->Form->end(); ?>	
                            <?php echo $this->Js->writeBuffer(); ?>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <!--End Ticket Messages -->

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
<!--End Theme css/jquery -->
