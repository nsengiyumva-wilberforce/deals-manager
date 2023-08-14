<?php
/**
 * View for announcement home page
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Add Announcement Modal --> 
<div class="modal fade" id="addM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Add Announcement'); ?></h4>
            </div>
            <?php echo $this->Form->create('Announcement', array('url' => array('controller' => 'announcements', 'action' => 'add'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
            <div class="modal-body tab-modal">               
                <div class="form-group">
                    <label></label>
                    <?php echo $this->Form->input('Announcement.title', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Announcement Title'))); ?>	
                </div>                    
                <div class="form-group">
                    <?php echo $this->Form->input('Announcement.description', array('type' => 'textarea', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Description'))); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('Start Date'); ?></label>
                    <?php echo $this->Form->input('Announcement.start_date', array('type' => 'text', 'class' => 'form-control datepickerDateT', 'id' => 'StartDate', 'autocomplete' => 'off')); ?>
                </div>
                <div class="form-group">
                    <label><?php echo __('End Date'); ?></label>
                    <?php echo $this->Form->input('Announcement.end_date', array('type' => 'text', 'class' => 'form-control datepickerDate', 'id' => 'EndDate', 'autocomplete' => 'off')); ?>
                </div> 
                <div class="form-group">
                    <label><?php echo __('Share With'); ?></label>
                    <?php echo $this->Form->input('Announcement.permission', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array(1 => 'Team Members', 2 => 'Clients', 3 => 'Team Members & Clients'))); ?>
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
<!-- Update Announcement modal -->
<div class="modal fade" id="uM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Update Announcement'); ?></h4>
            </div>
            <?php echo $this->Form->create('Announcement', array('url' => array('controller' => 'announcements', 'action' => 'edit'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vFormN')); ?>
            <div class="modal-update">
                <div class="modal-body">						
                </div>
                <div class="modal-footer">
                    <button class="btn default" data-dismiss="modal" type="button"><i class="fa fa-times"></i> <?php echo __('Close'); ?></button>
                </div>
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
            <?php echo $this->Form->create('Announcement', array('url' => array('action' => 'delete'))); ?>
            <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p><?php echo __('Are you sure to delete this announcement ?'); ?></p>
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
                    <h1 class="pull-left"><?php echo __('Announcements'); ?></h1>
                    <?php if ($this->Common->isAdmin()): ?>
                        <div class="pull-right top-page-ui">
                            <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#addM">
                                <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Add Announcement'); ?>
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
                        <!-- Announcement List -->
                        <div class="table-responsive">
                            <div class="table-scrollable">
                                <table class="table table-hover dataTable table-striped dataTables">
                                    <thead>
                                        <tr>
                                            <th><?php echo __('Title'); ?></th>
                                            <th><?php echo __('Start Date'); ?></th>
                                            <th><?php echo __('End Date'); ?></th>
                                            <th><?php echo __('Created By'); ?></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($announcements)) :

                                            foreach ($announcements as $row) :
                                                $i++;

                                                ?>
                                                <tr  id="<?php echo 'row' . h($row['Announcement']['id']); ?>">
                                                    <td> <?php echo h($row['Announcement']['title']); ?></td>
                                                    <td> <?php echo $this->Time->format($this->Common->dateShow(), h($row['Announcement']['start_date'])); ?> </td>
                                                    <td> <?php echo $this->Time->format($this->Common->dateShow(), h($row['Announcement']['end_date'])); ?> </td>
                                                    <td> <?php echo $this->Html->image('avatar/thumb/' . h($row['User']['picture']), array('class' => 'img-circle sm-img', 'ref' => 'popover', 'data-content' => h($row['User']['first_name']) . ' ' . h($row['User']['last_name']))); ?> </td>
                                                    <td>
                                                        <a class="table-link" href="<?php echo $this->Html->url(array("controller" => "announcements", "action" => "view", h($row['Announcement']['id']))); ?>" ref="popover" data-content="<?php echo __('View'); ?>">
                                                            <i class="fa fa-eye"></i> 
                                                        </a>
                                                        <a class="table-link vUpdate" href="#" data-toggle="modal" data-target="#uM" data-id="<?php echo $row['Announcement']['id']; ?>" data-cont="announcements" ref="popover" data-content="<?php echo __('Edit'); ?>">                            
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a class="table-link danger" href="#" data-toggle="modal" data-target="#delM" onclick="fieldU('AnnouncementId',<?php echo h($row['Announcement']['id']); ?>)" ref="popover" data-content="<?php echo __('Delete'); ?>">
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
                        <!--End Announcement List -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>