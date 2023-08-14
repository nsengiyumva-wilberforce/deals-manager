<?php
/**
 *  Users  list.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div  class="dataTables_wrapper" id="uUser" >
    <div class="row">
        <?php echo $this->element('paginator', array('updateDivId' => 'uUser')); ?>
    </div>		
    <div class="table-scrollable">
        <table  class="table table-hover dataTable user-list table-striped">
            <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('User.first_name', __('Name')); ?></th>
                    <?php if (!isset($client)): ?>
                        <th><?php echo __('Job Title'); ?></th>
                    <?php endif; ?>
                    <th><?php echo $this->Paginator->sort('User.email', __('Email')); ?> </th>                  
                    <th><?php echo $this->Paginator->sort('User.email_verified', __('Status')); ?>  </th>
                    <?php if (!isset($admin)): ?>
                        <th><?php echo __('Group'); ?></th>
                    <?php endif; ?>
                    <?php if (!isset($client)): ?>
                        <th><?php echo __('Role'); ?></th>
                    <?php endif; ?>
                    <th><?php echo __('Created'); ?></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($users)) :
                    $page = $this->request->params['paging']['User']['page'];
                    $limit = $this->request->params['paging']['User']['limit'];
                    $i = ($page - 1) * $limit;
                    foreach ($users as $row) :
                        $i++;

                        ?>
                        <tr  id="<?php echo 'row' . h($row['User']['id']); ?>">
                            <td>                               
                                <?php echo $this->Html->image('avatar/thumb/' . $row['User']['picture']); ?>
                                <?php echo $this->Html->link(h($row['User']['name']), array('controller' => 'users', 'action' => 'profile', h($row['User']['id'])), array('escape' => false, 'class' => 'user-link')); ?>															
                                <span class="user-subhead"> <?php
                                    echo (($row['User']['user_group_id'] == 1) ? "Admin" :
                                        (($row['User']['user_group_id'] == 2) ? "Manager" :
                                            (($row['User']['user_group_id'] == 3) ? "Staff" : "Client")));

                                    ?>
                            </td>
                            <?php if (isset($client) != '1'): ?>
                                <td> <span class='label label-sm label-warning'><?= h($row['User']['job_title']); ?></span></td>
                            <?php endif; ?>
                            <td> <?= h($row['User']['email']); ?>	</td>
                            <td><?php echo ($row['User']['active'] == 1) ? "<span class='label label-sm label-success'>" . __('Active') . "</span>" : "<span class='label label-sm label-danger'>" . __('Inactive') . "</span>"; ?> </td>                            
                            <?php if (!isset($admin)): ?>
                                <td>
                                    <?php if ($row['User']['user_group_id'] == '2' || $row['User']['user_group_id'] == '3' || $row['User']['user_group_id'] == '4'): ?>
                                        <?= h($row['UserGroup']['name']); ?>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                            <?php if (!isset($client)): ?>
                                <td><?= h($row['Role']['name']); ?></td> 
                            <?php endif; ?>
                            <td><?php echo $this->Time->format($this->Common->dateTime(), h($row['User']['created'])); ?> </td>
                            <td>
                                <a class="table-link" href="<?php echo $this->Html->url(array("controller" => "users", "action" => "profile", h($row['User']['id']))); ?>" ref="popover" data-content="View Profile"><i class="fa fa-eye fa-lg"></i></a>
                                <?php if ($row['User']['id'] != $this->Session->read('Auth.User.id')) { ?>
                                    <a class="table-link danger" href="#" data-toggle="modal" data-target="#delUserM" onclick="fieldU('UserId',<?php echo h($row['User']['id']); ?>)" ref="popover" data-content="Delete User"><i class="fa fa-trash-o fa-lg"></i> </a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php
                    endforeach;
                endif;

                ?>
            </tbody></table></div>
    <?php
    if (!empty($users)) :
        echo $this->element('pagination');
    endif;

    ?>
</div>