<?php
/**
 * view for group list page for admin
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Add Staff Role Modal --> 
<div class="modal fade" id="addM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Add Group'); ?></h4>
            </div>
            <?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'add_group'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm form-y')); ?>
            <div class="modal-body">													
                <div class="form-group">
                    <?php echo $this->Form->input('UserGroup.name', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Group Name'), 'label' => false)); ?>	
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

<!-- Delete Role modal -->
<div class="modal fade" id="delM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>       
            <?php echo $this->Form->create('User', array('url' => array('action' => 'delete_group'))); ?>
            <?php echo $this->Form->input('UserGroup.id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p> <?php echo __('Are you sure to delete this Group ?'); ?></p>
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
                    <h1 class="pull-left"><?php echo __('Groups'); ?></h1>
                    <div class="pull-right top-page-ui">
                        <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#addM">
                            <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Add Group'); ?>
                        </a>

                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Setting sidebar -->
            <div class="col-sm-3">
                <?php echo $this->element('settings-sidebar'); ?>
            </div>
            <!-- /Setting Sidebar  -->
            <div class="col-sm-9">
                <div class="main-box no-header clearfix">					  
                    <div class="main-box-body clearfix">
                        <!-- Group List -->
                        <div class="table-responsive">
                            <div class="table-scrollable">
                                <table class="table table-hover dataTables  table-striped table-half">
                                    <thead>
                                        <tr>
                                            <th><?php echo __('Name'); ?></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($groups)) :

                                            foreach ($groups as $row) :

                                                ?>
                                                <tr  id="<?php echo 'row' . h($row['UserGroup']['id']); ?>">
                                                    <td>
                                                        <?php if ($this->Common->isAdmin()) { ?>
                                                            <a href="javascript:void(0)"  data-type="text" data-pk="<?php echo h($row['UserGroup']['id']); ?>" data-url="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'edit_group')); ?>"  class="editable editable-click vEdit" ><?php echo h($row['UserGroup']['name']); ?></a>
                                                            <?php
                                                        } else {
                                                            echo h($row['UserGroup']['name']);
                                                        }

                                                        ?>
                                                    </td>
                                                    <td><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'member', h($row['UserGroup']['id']))); ?>" class="label label-primary manager-white"><i class="fa fa-users"></i> <?php echo __('View Members'); ?></a>
                                                        <a class="table-link danger" href="#" ref="popover" data-content="Delete Group"  data-toggle="modal" data-target="#delM" onclick="fieldU('UserGroupId',<?php echo h($row['UserGroup']['id']); ?>)">
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
                        <!--End Group List -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>
<!-- /Content -->