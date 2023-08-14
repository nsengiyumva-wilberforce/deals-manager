<?php
/**
 * View for custom field page.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Add custom field modal -->
<div class="modal fade" id="addM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo __('Add Custom Field'); ?></h4>
            </div>
            <div class="modal-body">
                <?php echo $this->Form->create('Custom', array('url' => array('controller' => 'customs', 'action' => 'add'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>                	             
                <div class="form-group">
                    <label><?php echo __('Field Name'); ?></label>
                    <?php echo $this->Form->input('Custom.name', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Field Name'))); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('Type'); ?></label>
                    <?php echo $this->Form->input('Custom.type', array('type' => 'select', 'options' => array('1' => __('Text Field'), '2' => __('Text Area')), 'class' => 'select-box-search full-width')); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('Module'); ?></label>
                    <?php echo $this->Form->input('Custom.module', array('type' => 'select', 'options' => array('1' => __('Deal'), '2' => __('Contact'), '3' => __('Company')), 'class' => 'select-box-search full-width')); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('Custom Field added to old deal or contact or company'); ?></label>
                    <?php echo $this->Form->input('Custom.old', array('type' => 'select', 'options' => array('1' => __('No'), '2' => __('Yes')), 'class' => 'select-box-search full-width')); ?>	
                </div>
            </div>
            <div class="modal-footer">			
                <?php echo $this->Form->Submit(__('Save'), array('class' => 'btn btn-primary blue', 'id' => 'addUserSubmitBtn', 'div' => false)); ?>
                <button class="btn default" data-dismiss="modal" type="button"><?php echo __('Close'); ?></button>
            </div>
            <?php echo $this->Form->end(); ?>	
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!-- Delete custom field modal -->
<div class="modal fade" id="delCM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('Custom', array('url' => array('action' => 'delete'))); ?>
            <?php echo $this->Form->input('Custom.id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p> <?php echo __('Are you sure to delete this custom field ? Data related to this custom field also deleted.'); ?></p>
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
<!-- /Delete  modal -->
<!-- Content -->
<div class="row"> 
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">
                    <h1 class="pull-left"><?php echo __('Custom Fields'); ?></h1>
                    <div class="pull-right top-page-ui">
                        <?php if ($this->Common->isStaffPermission('52')): ?> 
                            <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#addM">
                                <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Add Custom Field'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row"> 
            <div class="col-sm-3">
                <?php echo $this->element('settings-sidebar'); ?>
            </div>
            <div class="col-sm-9">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="main-box  clearfix">					  
                            <div class="tabs-wrapper tabs-no-header">
                                <!-- Custom Field tabs -->
                                <ul class="nav nav-tabs">
                                    <li class="active"><a data-toggle="tab" href="#tab-deal"><?php echo __('Deal'); ?></a></li>                           
                                    <li><a data-toggle="tab" href="#tab-contact"><?php echo __('Contact'); ?></a></li>
                                    <li><a data-toggle="tab" href="#tab-company"><?php echo __('Company'); ?></a></li>
                                </ul>
                                <!--End Custom Field tabs -->
                                <!-- Custom Field tabs Content-->
                                <div class="tab-content">
                                    <!-- Deal Custom Field Tab -->
                                    <div id="tab-deal" class="tab-pane fade active in">
                                        <div  class="row">
                                            <div class="table-scrollable">
                                                <table class="table table-hover dataTables">
                                                    <thead>
                                                        <tr>
                                                            <th><?php echo __('Name'); ?></th>									 
                                                            <th><?php echo __('Type'); ?></th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (!empty($dealFields)) {
                                                            foreach ($dealFields as $row):

                                                                ?>
                                                                <tr  id="<?php echo 'row' . h($row['Custom']['id']); ?>">
                                                                    <td>
                                                                        <?php if ($this->Common->isStaffPermission('53')): ?>
                                                                            <a href="#"  data-type="text" data-pk="<?= h($row['Custom']['id']); ?>" data-name="name" data-url="customs/edit"  class="vEdit"> <?= h($row['Custom']['name']); ?></a>
                                                                        <?php else: ?>
                                                                            <?= h($row['Custom']['name']); ?>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= ($row['Custom']['type'] == 1) ? __('Text') : __('Text Area'); ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php if ($this->Common->isStaffPermission('54')): ?> 
                                                                            <a class="table-link danger" href="#" ref="popover" data-content="Delete Field" data-toggle="modal"  data-target="#delCM" onclick="fieldU('CustomId',<?php echo h($row['Custom']['id']); ?>)">
                                                                                <i class="fa fa-trash-o"></i>
                                                                            </a>
                                                                        <?php endif; ?>
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
                                    <!--End Deal Custom Field Tab -->
                                    <!-- Contact Custom Field Tab -->
                                    <div id="tab-contact" class="tab-pane fade">
                                        <div  class="row">
                                            <div class="table-scrollable">
                                                <table class="table table-hover dataTables">
                                                    <thead>
                                                        <tr>
                                                            <th><?php echo __('Name'); ?></th>									 
                                                            <th><?php echo __('Type'); ?></th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (!empty($contactFields)) {
                                                            foreach ($contactFields as $row):

                                                                ?>
                                                                <tr  id="<?php echo 'row' . h($row['Custom']['id']); ?>">
                                                                    <td>
                                                                        <?php if ($this->Common->isStaffPermission('53')): ?>
                                                                            <a href="#"  data-type="text" data-pk="<?= h($row['Custom']['id']); ?>" data-name="name" data-url="customs/edit"  class="vEdit"> <?= h($row['Custom']['name']); ?></a>
                                                                        <?php else: ?>
                                                                            <?= h($row['Custom']['name']); ?>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= ($row['Custom']['type'] == 1) ? __('Text') : __('Text Area'); ?>
                                                                    </td>
                                                                    <td>	
                                                                        <?php if ($this->Common->isStaffPermission('54')): ?>
                                                                            <a class="table-link danger" href="#" ref="popover" data-content="Delete Field" data-toggle="modal"  data-target="#delCM" onclick="fieldU('CustomId',<?php echo h($row['Custom']['id']); ?>)">
                                                                                <i class="fa fa-trash-o"></i>
                                                                                </span>
                                                                            </a>
                                                                        <?php endif; ?>
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
                                    <!--End Contact Custom Field  Tab -->
                                    <!-- Company Custom Field  Tab -->
                                    <div id="tab-company" class="tab-pane fade">
                                        <div  class="row">
                                            <div class="table-scrollable">
                                                <table class="table table-hover dataTables">
                                                    <thead>
                                                        <tr>
                                                            <th><?php echo __('Name'); ?></th>									 
                                                            <th><?php echo __('Type'); ?></th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (!empty($companyFields)) {
                                                            foreach ($companyFields as $row):

                                                                ?>
                                                                <tr  id="<?php echo 'row' . h($row['Custom']['id']); ?>">
                                                                    <td>
                                                                        <?php if ($this->Common->isStaffPermission('53')): ?>
                                                                            <a href="#"  data-type="text" data-pk="<?= h($row['Custom']['id']); ?>" data-name="name" data-url="customs/edit"  class="vEdit"> <?= h($row['Custom']['name']); ?></a>
                                                                        <?php else: ?>
                                                                            <?= h($row['Custom']['name']); ?>
                                                                        <?php endif; ?>
                                                                    </td>
                                                                    <td>
                                                                        <?= ($row['Custom']['type'] == 1) ? __('Text') : __('Text Area'); ?>
                                                                    </td>
                                                                    <td>	
                                                                        <?php if ($this->Common->isStaffPermission('54')): ?>
                                                                            <a class="table-link danger" href="#" ref="popover" data-content="Delete Field" data-toggle="modal"  data-target="#delCM" onclick="fieldU('CustomId',<?php echo h($row['Custom']['id']); ?>)">
                                                                                <i class="fa fa-trash-o"></i>
                                                                            </a>
                                                                        <?php endif; ?>
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
                                    <!--End Company Custom Field Tab -->                        
                                </div> <!--End Custom Fields tabs Content-->
                            </div>
                        </div>
                    </div>
                </div>						
            </div>
        </div>
    </div>
</div>        