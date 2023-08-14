<?php
/**
 * view for user roles page
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Add Staff Role Modal --> 
<div class="modal fade" id="staffM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Add Manager & Staff Role'); ?></h4>
            </div>
            <?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'role'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm form-y')); ?>
            <?php echo $this->Form->input('Role.type', array('type' => 'hidden', 'value' => '2')); ?>
            <div class="modal-body">													
                <div class="form-group">
                    <?php echo $this->Form->input('Role.name', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Role Name'), 'label' => false)); ?>	
                </div>
                <div class="table-responsive">
                    <div class="modal-head"><?php echo __('Module Permission'); ?></div>
                    <table class="table table-hover dataTable">
                        <thead>
                            <tr>
                                <th> </th>
                                <th><?php echo __('View'); ?></th>
                                <th><?php echo __('Add'); ?></th>
                                <th><?php echo __('Edit'); ?></th>
                                <th><?php echo __('Delete'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $modules = array('Contacts', 'Clients', 'Products', 'Sources', 'Invoices');
                            $i = 1;
                            foreach ($modules as $row):
                                $view = $i . '1';
                                $add = $i . '2';
                                $edit = $i . '3';
                                $delete = $i . '4';

                                ?>
                                <tr>                                           
                                    <td class="col-md-4"><?php echo __($row); ?></td>
                                    <td class="col-md-2">                                              
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="module[]"  class="onoffswitch-checkbox" id="onoff-<?= $view; ?>" value="<?= $view; ?>" <?= ($view == '51' || $view == '61') ? '' : 'checked'; ?>>
                                            <label class="onoffswitch-label" for="onoff-<?= $view; ?>">
                                                <div class="onoffswitch-inner"></div>
                                                <div class="onoffswitch-switch"></div>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="col-md-2">                                              
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="module[]"  class="onoffswitch-checkbox" id="onoff-<?= $add; ?>" value="<?= $add; ?>">
                                            <label class="onoffswitch-label" for="onoff-<?= $add; ?>">
                                                <div class="onoffswitch-inner"></div>
                                                <div class="onoffswitch-switch"></div>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="col-md-2">                                              
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="module[]"  class="onoffswitch-checkbox" id="onoff-<?= $edit; ?>" value="<?= $edit; ?>">
                                            <label class="onoffswitch-label" for="onoff-<?= $edit; ?>">
                                                <div class="onoffswitch-inner"></div>
                                                <div class="onoffswitch-switch"></div>
                                            </label>
                                        </div>
                                    </td>
                                    <td class="col-md-2">                                              
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="module[]"  class="onoffswitch-checkbox" id="onoff-<?= $delete; ?>" value="<?= $delete; ?>">
                                            <label class="onoffswitch-label" for="onoff-<?= $delete; ?>">
                                                <div class="onoffswitch-inner"></div>
                                                <div class="onoffswitch-switch"></div>
                                            </label>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                                $i++;
                            endforeach;

                            ?>                                                  
                        </tbody>
                    </table>
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
<!-- Add Admin Role Modal --> 
<div class="modal fade" id="adminM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Add Admin Role'); ?></h4>
            </div>
            <?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'role'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vFormN form-y')); ?>
            <?php echo $this->Form->input('Role.type', array('type' => 'hidden', 'value' => '1')); ?>
            <div class="modal-body">													
                <div class="form-group">
                    <?php echo $this->Form->input('Role.name', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Role Name'), 'label' => false)); ?>	
                </div>
                <div class="table-responsive">
                    <div class="modal-head"><?php echo __('Module Permission'); ?></div>
                    <table class="table table-hover dataTable">
                        <thead>
                            <tr>
                                <th> </th>
                                <th><?php echo __('Permission'); ?></th>                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $modules = array('Pipelines', 'Stages', 'All Task', 'Users', 'Reports', 'Activity', 'Settings', 'Labels');
                            $i = 1;
                            foreach ($modules as $row):
                                if ($i == '9') {
                                    $i = '51';
                                }

                                ?>
                                <tr>                                           
                                    <td class="col-md-4"><?php echo __($row); ?></td>
                                    <td class="col-md-2">                                              
                                        <div class="onoffswitch">
                                            <input type="checkbox" name="module[]"  class="onoffswitch-checkbox" id="onoff-<?= $i; ?>" value="<?= $i; ?>" checked>
                                            <label class="onoffswitch-label" for="onoff-<?= $i; ?>">
                                                <div class="onoffswitch-inner"></div>
                                                <div class="onoffswitch-switch"></div>
                                            </label>
                                        </div>
                                    </td>                                                             
                                </tr>
                                <?php
                                $i++;
                            endforeach;

                            ?>                                                  
                        </tbody>
                    </table>
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
<!-- Update Role Modal -->
<div class="modal fade" id="uUserM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Update Permission'); ?></h4>
            </div>
            <div class="modal-body">

            </div>

        </div>
    </div>
</div>
<!-- Delete Role modal -->
<div class="modal fade" id="delRoleM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('User', array('url' => array('action' => 'role_delete'))); ?>
            <?php echo $this->Form->input('Role.id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p> <?php echo __('Are you sure to delete this Role ? Make Sure have no active user in this role.If have user move or delete that users before delete role.'); ?></p>
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
<!-- Content Section -->
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">
                    <h1 class="pull-left"><?php echo __('Roles'); ?></h1>
                    <div class="pull-right top-page-ui">
                        <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#staffM">
                            <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Staff Role'); ?>
                        </a>
                        <a class="btn btn-primary pull-right user-button" href="#" data-toggle="modal" data-target="#adminM">
                            <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Admin Role'); ?>
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
                        <!-- Role List -->
                            <?php echo $this->element('roles'); ?>		
                        <!--End Role List -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>
<!-- End Content Section -->