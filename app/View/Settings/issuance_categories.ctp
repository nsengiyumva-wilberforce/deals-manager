<?php
/**
 * View for setting issuance page.
 * 
 * @author:   impactoutsourcing.com
 * @Copyright: impact outsourcing 2023
 * @Website:   https://www.impactoutsourcing.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Add issuance category modal -->
<div class="modal fade" id="addM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo __('Add Issuance Category'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="error-Msg"></div>
                <?php echo $this->Form->create('Issuance', array('url' => array('controller' => 'products', 'action' => 'add_issuance_category'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm1')); ?>
                <div class="form-group">          
                    <?php echo $this->Form->input('IssuanceCategory.name', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Category Name'))); ?>	
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('IssuanceCategory.description', array('type' => 'textarea', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Category Description'))); ?>	
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
<!-- Delete Issuance category modal -->
<div class="modal fade" id="delM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('Product', array('url' => array('action' => 'remove_issuance'))); ?>
            <?php echo $this->Form->input('IssuanceCategory.id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p><?php echo __('Are you sure to delete this issuance category ? Make sure issuance category have no active issuances.'); ?> </p>
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
                    <h1 class="pull-left"><?php echo __('Issuances Category'); ?></h1>
                    <div class="pull-right top-page-ui">
                        <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#addM">
                            <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Add Issuance Category'); ?>
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
                                            <th><?php echo __('Category Name'); ?></th>									 
                                            <th><?php echo __('Description'); ?></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($issuancesC)) {
                                            foreach ($issuancesC as $row):

                                                ?>
                                                <tr  id="<?php echo 'row' . h($row['IssuanceCategory']['id']); ?>">
                                                    <td>
                                                        <a href="#"  data-type="text" data-pk="<?= h($row['IssuanceCategory']['id']); ?>" data-name="name" data-url="<?php echo $this->Html->url(array('controller' => 'issuances', 'action' => 'update')); ?>"  class="vEdit"> <?= h($row['IssuanceCategory']['name']); ?></a>
                                                    </td>
                                                    <td>
                                                        <a href="#"  data-type="textarea" data-pk="<?= h($row['IssuanceCategory']['id']); ?>" data-name="description" data-url="<?php echo $this->Html->url(array('controller' => 'issuances', 'action' => 'update')); ?>"  class="vEdit">   <?= h($row['IssuanceCategory']['description']); ?></a>
                                                    </td>
                                                    <td>	                                                             
                                                        <a class="table-link danger" href="#" data-toggle="modal"  data-target="#delM" onclick="fieldU('IssuanceCategoryId',<?php echo h($row['IssuanceCategory']['id']); ?>)">
                                                            <i class="fa fa-trash-o"></i>
                                                            </span>
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