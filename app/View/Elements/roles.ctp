<?php
/**
 * List user roles .
 * 
 * @author:   AnkkSoft
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div id="uRole">
    <?php echo $this->element('paginator', array('updateDivId' => 'uRole')); ?>	
    <div class="table-scrollable">
        <table class="table table-hover dataTable">
            <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('Role.name', __('Name')); ?></th>
                    <th><?php echo $this->Paginator->sort('Role.type', __('For')); ?></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($roles)) :
                    $page = $this->request->params['paging']['Role']['page'];
                    $limit = $this->request->params['paging']['Role']['limit'];
                    $i = ($page - 1) * $limit;
                    foreach ($roles as $row) :
                        $i++;

                        ?>
                        <tr  id="<?php echo 'row' . h($row['Role']['id']); ?>">
                            <td>
                                <a href="javascript:void(0)"  data-type="text" data-pk="<?php echo h($row['Role']['id']); ?>" data-url="pipelines/edit"  class="editable editable-click vEdit"><?php echo h($row['Role']['name']); ?></a>
                            </td>
                            <td>
                                <?php echo ($row['Role']['type'] == '1') ? '<span class="label label-danger">' . __('Admin') : '<span class="label label-success">' . __('Manager & Staff'); ?></span>
                            </td>
                            <td class="w50">
                                <?php
                                if (!empty($row['Role']['permission'])):
                                    $permissions = explode(',', $row['Role']['permission']);
                                    foreach ($permissions as $permission):
                                        $this->Common->permissions($permission);
                                    endforeach;
                                endif;

                                ?>
                            </td>
                            <td> 
                                <a class="label label-primary manager-white" data-id="<?= h($row['Role']['id']); ?>" href="#" data-toggle="modal" data-target="#uUserM" ref="popover" data-content="<?php echo __('Update Permission'); ?>">
                                    <i class="fa fa-unlock"></i> <?php echo __('Permission'); ?>
                                </a>
                                <a class="table-link danger" href="#" data-toggle="modal" data-target="#delRoleM" onclick="fieldU('RoleId',<?php echo h($row['Role']['id']); ?>)">
                                    <span class="fa-stack" ref="popover" data-content="<?php echo __('Delete'); ?>">
                                        <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                    </span>
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
    <?php
    if (!empty($roles)):
        echo $this->element('pagination');
    endif;

    ?>
</div>