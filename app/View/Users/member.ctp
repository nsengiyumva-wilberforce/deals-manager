<?php
/**
 * View for all members of group .
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
?>

<!-- Content Section -->
<div class="row">											
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">
                    <h1 class="pull-left"><?php echo __('Group').': '.h($group['UserGroup']['name']);  ?></h1>
                </div>
            </div>
        </div>
        <div class="row">
             <!-- Setting Sidebar -->
            <div class="col-sm-3">
                <?php echo $this->element('settings-sidebar'); ?>
            </div>
              <!-- /Setting Sidebar -->
            <div class="col-lg-9">
                <div class="main-box no-header clearfix">					  
                    <div class="main-box-body clearfix">
                        <!-- Managers List -->
                        <div class="clearfix">
                            <h1 class="pull-left"><?php echo __('Managers'); ?></h1>
                        </div>
                        <div class="table-responsive">
                            <div class="table-scrollable">
                                <table  class="table table-hover dataTable user-list">
                                    <thead>
                                        <tr>
                                            <th><?php echo __('Name'); ?></th>
                                            <th><?php echo __('Job Title'); ?></th>
                                            <th><?php echo __('Email'); ?> </th>
                                            <th><?php echo __('Role'); ?></th>
                                            <th><?php echo __('Created'); ?></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($managers)) :
                                            foreach ($managers as $row) :
                                                ?>
                                                <tr>
                                                    <td>                               
                                                        <?php echo $this->Html->image('avatar/thumb/' . $row['User']['picture']); ?>
                                                        <?php echo $this->Html->link(h($row['User']['name']), array('controller' => 'users', 'action' => 'profile', h($row['User']['id'])), array('escape' => false, 'class' => 'user-link')); ?>															
                                                        <span class="user-subhead"> <?php echo __('Manager'); ?>
                                                    </td>
                                                    <td> <span class='label label-sm label-warning'><?= h($row['User']['job_title']); ?></span></td>
                                                    <td> <?= h($row['User']['email']); ?></td>
                                                    <td><?= h($row['Role']['name']); ?></td>   
                                                    <td><?php echo $this->Time->format($this->Common->dateTime(), h($row['User']['created'])); ?> </td>                                             
                                                </tr>
                                                <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Staff List -->
                        <div class="clearfix">
                            <h1 class="pull-left"><?php echo __('Staff'); ?></h1>
                        </div>
                        <div class="table-responsive">
                            <div class="table-scrollable">
                                <table  class="table table-hover dataTable user-list">
                                    <thead>
                                        <tr>
                                            <th><?php echo __('Name'); ?></th>
                                            <th><?php echo __('Job Title'); ?></th>
                                            <th><?php echo __('Email'); ?> </th>
                                            <th><?php echo __('Role'); ?></th>
                                            <th><?php echo __('Created'); ?></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($staff)) :
                                            foreach ($staff as $row) :
                                                ?>
                                                <tr>
                                                    <td>                               
                                                        <?php echo $this->Html->image('avatar/thumb/' . $row['User']['picture']); ?>
                                                        <?php echo $this->Html->link($row['User']['name'], array('controller' => 'users', 'action' => 'profile', h($row['User']['id'])), array('escape' => false, 'class' => 'user-link')); ?>															
                                                        <span class="user-subhead"> <?php echo __('Staff'); ?>
                                                    </td>
                                                    <td> <span class='label label-sm label-warning'><?= h($row['User']['job_title']); ?></span></td>
                                                    <td> <?= h($row['User']['email']); ?>	</td>
                                                    <td><?= h($row['Role']['name']); ?></td>   
                                                    <td><?php echo $this->Time->format($this->Common->dateTime(), h($row['User']['created'])); ?> </td>                                                
                                                </tr>
                                                <?php
                                            endforeach;
                                        endif;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!--End Staff List -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>
<!-- End Content Section-->