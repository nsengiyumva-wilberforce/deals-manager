<?php
/**
 * View for contact list page
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Add Contact Modal -->                             
<div class="modal fade" id="contactM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Add Contact'); ?></h4>
            </div>
            <?php echo $this->Form->create('Contact', array('url' => array('controller' => 'Contacts', 'action' => 'add'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
            <div class="modal-body tab-modal">
                <!-- Tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-contact"><?php echo __('Basic Details'); ?></a></li> 
                    <li><a data-toggle="tab" href="#tab-social"><?php echo __('Social'); ?></a></li>
                    <li><a data-toggle="tab" href="#tab-custom"><?php echo __('Custom'); ?></a></li>
                </ul>
                <div class="tab-content">
                    <!-- contact details Tab -->
                    <div id="tab-contact" class="tab-pane fade active in">
                        <div class="form-group">
                            <label></label>
                            <?php echo $this->Form->input('Contact.name', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Contact Name'))); ?>	
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <?php echo $this->Form->input('Contact.email', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Email'))); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <?php echo $this->Form->input('Contact.phone', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Phone'))); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Contact.title', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Job Title'))); ?>	
                        </div>
                        <div class="form-group">                  
                            <?php echo $this->Form->input('Contact.address', array('type' => 'textarea', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Address'))); ?>	
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Contact.city', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('City'))); ?>	
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Contact.state', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('State'))); ?>	
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Contact.zip_code', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Zip Code'))); ?>	
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Contact.country', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Country'))); ?>	
                        </div>                       
                        <div class="form-group">
                            <?php echo $this->Form->input('Contact.location', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Location'))); ?>	
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Contact.company_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $companies, 'empty' => __('Select Company'))); ?>	
                        </div>
                    </div>
                    <!-- Social Tab -->
                    <div id="tab-social" class="tab-pane fade">                      
                        <div class="form-group">
                            <label></label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa  fa-facebook"></i></span>
                                <?php echo $this->Form->input('Contact.facebook', array('type' => 'text', 'class' => 'form-control input-inline input-medium')); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-skype"></i></span>
                                <?php echo $this->Form->input('Contact.skype', array('type' => 'text', 'class' => 'form-control input-inline input-medium')); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-linkedin"></i></span>
                                <?php echo $this->Form->input('Contact.linkedIn', array('type' => 'text', 'class' => 'form-control input-inline input-medium')); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-twitter"></i></span>
                                <?php echo $this->Form->input('Contact.twitter', array('type' => 'text', 'class' => 'form-control input-inline input-medium')); ?>	
                            </div>
                        </div>
                    </div>
                    <!-- Deal Custom Field Tab -->
                    <div id="tab-custom" class="tab-pane fade">
                        <?php foreach ($custom as $row): ?>
                            <div class="form-group">
                                <label><?= h($row['Custom']['name']); ?></label>
                                <?php echo $this->Form->input('Custom.value' . h($row['Custom']['id']), array('type' => ($row['Custom']['type'] == '2') ? 'textarea' : 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => '')); ?>	
                            </div>
                        <?php endforeach; ?>                      
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
            <?php echo $this->Form->create('Contact', array('url' => array('action' => 'delete'))); ?>
            <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p><?php echo __('Are you sure to delete this contact ?'); ?></p>
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
                    <div class="col-md-4 col-xs-12">
                        <h1 class="pull-left"><?php echo __('Contacts'); ?></h1>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <a class="btn btn-sm btn-warning" href="<?php echo $this->Html->url(array("controller" => "contacts", "action" => "import")); ?>" >
                            <i class="fa fa-upload"></i> <?php echo __('Import Contact'); ?>
                        </a> 
                        <div class="btn-group pull-right" role="group">
                            <a href="<?php echo $this->Html->url(array("controller" => "contacts", "action" => "index")); ?>" class="btn btn-white btn-sm" ref="popover" data-content="<?php echo __('Card View'); ?>"><i class="fa fa-th-large"></i></a>                
                            <button type="button" class="btn btn-primary btn-sm active" ref="popover" data-content="<?php echo __('List View'); ?>"><i class="fa fa-bars"></i></button>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <?php echo $this->Form->input('contact_id', array('type' => 'text', 'class' => 'form-control search-data module-search', 'placeholder' => __('Quick Search Contacts'), 'data-name' => 'contacts', 'label' => false, 'div' => false)); ?>
                    </div>
                    <div class="col-md-2 col-xs-12">
                        <div class="pull-right top-page-ui">
                            <?php if ($this->Common->isStaffPermission('12')): ?>                            
                                <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#contactM">
                                    <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Add Contact'); ?>
                                </a>                          
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">					  
                    <div class="main-box-body clearfix">
                        <!-- Company List -->
                        <div class="table-responsive">
                            <div class="table-scrollable">
                                <table class="table table-hover dataTables">
                                    <thead>
                                        <tr>
                                            <th><?php echo __('Name'); ?></th>
                                            <th><?php echo __('Phone'); ?></th>
                                            <th><?php echo __('Email'); ?></th>
                                            <th><?php echo __('Address'); ?></th>
                                            <th><?php echo __('Website'); ?></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($contacts)) :

                                            foreach ($contacts as $row) :

                                                ?>
                                                <tr id="<?php echo 'row' . h($row['Contact']['id']); ?>">
                                                    <td><?= h($row['Contact']['name']); ?></a></td>
                                                    <td><?= h($row['Contact']['phone']); ?></a></td>
                                                    <td><?= h($row['Contact']['email']); ?></a> </td>
                                                    <td><?= h($row['Contact']['address']); ?></a> </td>
                                                    <td><?= h($row['Contact']['website']); ?></a> </td>                   
                                                    <td> 
                                                        <a class="table-link" href="<?php echo $this->Html->url(array("controller" => "contacts", "action" => "view", h($row['Contact']['id']))); ?>">                                      
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <?php if ($this->Common->isStaffPermission('14')): ?>   
                                                            <a class="table-link danger" href="#" data-toggle="modal" data-target="#delM" onclick="fieldU('ContactId',<?php echo h($row['Contact']['id']); ?>)">
                                                                <i class="fa fa-trash-o"></i>  
                                                            </a>
                                                        <?php endif; ?>
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
                        <!--End Company List -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>