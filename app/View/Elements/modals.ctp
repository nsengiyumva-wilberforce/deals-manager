<?php
/**
 * Update user roles for admin & staff modal content.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- User Role For Staff Modal -->
<?php if (!empty($role)) { ?>
    <?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'permission'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm1 label-popup table-responsive form-y')); ?>
    <?php echo $this->Form->input('Role.id', array('type' => 'hidden', 'value' => $role['Role']['id'])); ?>
    <div class="table-responsive">
        <div class="modal-head"><?php echo $role['Role']['name']; ?></div>
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
                $permissions = explode(',', $role['Role']['permission']);
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
                                <input type="checkbox" name="module[]"  class="onoffswitch-checkbox" id="onoffs-<?= $view; ?>" value="<?= $view; ?>" <?= (in_array($view, $permissions)) ? 'checked' : ''; ?>>
                                <label class="onoffswitch-label" for="onoffs-<?= $view; ?>">
                                    <div class="onoffswitch-inner"></div>
                                    <div class="onoffswitch-switch"></div>
                                </label>
                            </div>
                        </td>
                        <td class="col-md-2">                                              
                            <div class="onoffswitch">
                                <input type="checkbox" name="module[]"  class="onoffswitch-checkbox" id="onoffs-<?= $add; ?>" value="<?= $add; ?>" <?= (in_array($add, $permissions)) ? 'checked' : ''; ?>>
                                <label class="onoffswitch-label" for="onoffs-<?= $add; ?>">
                                    <div class="onoffswitch-inner"></div>
                                    <div class="onoffswitch-switch"></div>
                                </label>
                            </div>
                        </td>
                        <td class="col-md-2">                                              
                            <div class="onoffswitch">
                                <input type="checkbox" name="module[]"  class="onoffswitch-checkbox" id="onoffs-<?= $edit; ?>" value="<?= $edit; ?>" <?= (in_array($edit, $permissions)) ? 'checked' : ''; ?>>
                                <label class="onoffswitch-label" for="onoffs-<?= $edit; ?>">
                                    <div class="onoffswitch-inner"></div>
                                    <div class="onoffswitch-switch"></div>
                                </label>
                            </div>
                        </td>
                        <td class="col-md-2">                                              
                            <div class="onoffswitch">
                                <input type="checkbox" name="module[]"  class="onoffswitch-checkbox" id="onoffs-<?= $delete; ?>" value="<?= $delete; ?>" <?= (in_array($delete, $permissions)) ? 'checked' : ''; ?>>
                                <label class="onoffswitch-label" for="onoffs-<?= $delete; ?>">
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
                <tr>
                    <td colspan="5" class="text-center"><?php echo $this->Form->Submit(__('Save Changes'), array('class' => 'btn btn-primary blue', 'div' => false)); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php echo $this->Form->end(); ?>	
    <?php echo $this->Js->writeBuffer(); ?>
<?php } ?>
<!-- Update Role Model For Admin -->
<?php if (!empty($admin)) { ?>
    <?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'permission'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm1 label-popup table-responsive form-y')); ?>
    <?php echo $this->Form->input('Role.id', array('type' => 'hidden', 'value' => $admin['Role']['id'])); ?>
    <div class="table-responsive">
        <div class="modal-head"><?php echo $admin['Role']['name']; ?></div>
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
                $permissions = explode(',', $admin['Role']['permission']);
                foreach ($modules as $row):
                    if ($i == '9') {
                        $i = '51';
                    }

                    ?>
                    <tr>                                           
                        <td class="col-md-4"><?php echo __($row); ?></td>
                        <td class="col-md-2">                                              
                            <div class="onoffswitch">
                                <input type="checkbox" name="module[]"  class="onoffswitch-checkbox" id="onoffs-<?= $i; ?>" value="<?= $i; ?>" <?= (in_array($i, $permissions)) ? 'checked' : ''; ?>>
                                <label class="onoffswitch-label" for="onoffs-<?= $i; ?>">
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
                <tr>
                    <td colspan="2" class="text-center"><?php echo $this->Form->Submit(__('Save Changes'), array('class' => 'btn btn-primary blue', 'div' => false)); ?></td>
                </tr>
            </tbody>                    
        </table>
    </div>
    <?php echo $this->Form->end(); ?>	
    <?php echo $this->Js->writeBuffer(); ?>
<?php } ?>
