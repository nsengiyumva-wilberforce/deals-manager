<?php
/**
 * View for setting ticket page.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Add Ticket department modal -->
<div class="modal fade" id="typeM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo __('Add Ticket Department'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="error-Msg"></div>
                <?php echo $this->Form->create('Ticket', array('url' => array('controller' => 'tickets', 'action' => 'type'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm1')); ?>
                <div class="form-group">          
                    <?php echo $this->Form->input('TicketType.name', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Ticket Type'))); ?>	
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('TicketType.description', array('type' => 'textarea', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Ticket Description'))); ?>	
                </div>
            </div>
            <div class="modal-footer">			
                <?php echo $this->Form->Submit(__('Save'), array('class' => 'btn btn-primary blue', 'id' => 'addUserSubmitBtn', 'div' => false)); ?>					
            </div>
            <?php echo $this->Form->end(); ?>	
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!-- Delete ticket department modal -->
<div class="modal fade" id="typedM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('Ticket', array('url' => array('action' => 'remove'))); ?>
            <?php echo $this->Form->input('TicketType.id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p><?php echo __('Are you sure to delete this Ticket Department ? Make Sure Ticket Department have no active tickets.If have tickets delete that tickets before delete Ticket Department.'); ?> </p>
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
                    <h1 class="pull-left"><?php echo __('Ticket Departments'); ?></h1>
                    <div class="pull-right top-page-ui">
                        <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#typeM">
                            <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Add Department'); ?>
                        </a> 
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Setting Sidebar -->
            <div class="col-sm-3">
                <?php echo $this->element('settings-sidebar'); ?>
            </div>
            <!-- /Setting Sidebar -->
            <div class="col-sm-9">
                <div class="main-box no-header clearfix">					  
                    <div class="main-box-body clearfix">                                              
                        <div  class="row">
                            <div class="table-scrollable">
                                <table class="table table-hover dataTables">
                                    <thead>
                                        <tr>
                                            <th><?php echo __('Department Name'); ?></th>									 
                                            <th><?php echo __('Description'); ?></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($ticketTypes)) {
                                            foreach ($ticketTypes as $row):

                                                ?>
                                                <tr  id="<?php echo 'row' . h($row['TicketType']['id']); ?>">
                                                    <td>
                                                        <a href="#"  data-type="text" data-pk="<?= h($row['TicketType']['id']); ?>" data-name="name" data-url="<?php echo $this->Html->url(array('controller' => 'tickets', 'action' => 'update')); ?>"  class="vEdit"> <?= h($row['TicketType']['name']); ?></a>
                                                    </td>
                                                    <td>
                                                        <a href="#"  data-type="textarea" data-pk="<?= h($row['TicketType']['id']); ?>" data-name="description" data-url="<?php echo $this->Html->url(array('controller' => 'tickets', 'action' => 'update')); ?>"  class="vEdit">   <?= h($row['TicketType']['description']); ?></a>
                                                    </td>
                                                    <td>	                                                             
                                                        <a class="table-link danger" href="#" ref="popover" data-content="Delete Department" data-toggle="modal"  data-target="#typedM" onclick="fieldU('TicketTypeId',<?php echo h($row['TicketType']['id']); ?>)">
                                                            <i class="fa fa-trash-o"></i>
                                                        </a>					
                                                    </td>
                                                </tr>
                                                <?php
                                            endforeach;
                                        }

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>                         
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>
<!-- /Content -->