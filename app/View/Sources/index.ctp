<?php

/**
 * View for source page
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
?>
<div class="row">
    <!-- Add Source Modal --> 
    <div class="modal fade" id="sourceM">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?php echo __('Add Source'); ?></h4>
                </div>
                <?php echo $this->Form->create('Source', array('url' => array('controller' => 'Sources', 'action' => 'add'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
                <div class="modal-body">													
                    <div class="form-group">
                        <?php echo $this->Form->input('Source.name', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Source Name'))); ?>	
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
    <!-- Delete source modal -->
    <div class="modal fade" id="delSourceM">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button data-dismiss="modal" class="close" type="button">&times;</button>
                    <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
                </div>
                <?php echo $this->Form->create('Source', array('url' => array('action' => 'delete'))); ?>
                <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
                <div class="modal-body">						
                    <p><?php echo __('Are you sure to delete this Source?'); ?> </p>
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
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">
                    <div class="col-lg-6 col-sm-12 col-xs-12">
                        <h1 class="pull-left"><?php echo __('Sources'); ?></h1>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-6">
                        <?php echo $this->Form->input('source_id', array('type' => 'text', 'class' => 'form-control search-data module-search', 'placeholder' => __('Quick Search Sources'), 'data-name' => 'sources', 'label' => false, 'div' => false)); ?>
                    </div>
                    <div class="col-lg-2 col-sm-6 col-xs-6">
                        <div class="pull-right top-page-ui">
                            <?php if ($this->Common->isStaffPermission('42')): ?>                      
                            <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#sourceM">
                                <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Add Source'); ?>
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
                        <!-- Source List -->
                        <div class="table-responsive">
                            <div class="table-scrollable">
                                <table class="table table-hover table-striped dataTables">
                                    <thead>
                                        <tr>
                                            <th><?php echo __('Name'); ?></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($sources)) :

                                            foreach ($sources as $row) :
                                                ?>
                                        <tr  id="<?php echo 'row' . h($row['Source']['id']); ?>">
                                            <td>
                                                        <?php if ($this->Common->isStaffPermission('43')) : ?>
                                                <a href="javascript:void(0)"  data-type="text" data-pk="<?php echo h($row['Source']['id']); ?>" data-url="sources/edit"  class="editable editable-click vEdit" ref="popover" data-content="Edit Source Name" ><?php echo h($row['Source']['name']); ?></a>
                                                            <?php
                                                        else :
                                                            echo h($row['Source']['name']);
                                                        endif;
                                                        ?>
                                            </td>
                                            <td class="text-center">
                                                <a class="table-link" ref="popover" data-content="View Source"  href="<?php echo $this->Html->url(array("controller" => "sources", "action" => "view", h($row['Source']['id']))); ?>">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                        <?php if ($this->Common->isStaffPermission('44')): ?>
                                                <a class="table-link danger" ref="popover" data-content="Delete Source"  href="#" data-toggle="modal" data-target="#delSourceM" onclick="fieldU('SourceId',<?php echo h($row['Source']['id']); ?>)">
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
                        <!--End Source List -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
    <!-- /Content -->
</div>