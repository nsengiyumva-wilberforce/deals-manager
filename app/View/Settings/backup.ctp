<?php
/**
 * View for setting backup page.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>

<!-- Delete backup modal -->
<div class="modal fade" id="delFileM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('Setting', array('url' => array('action' => 'delete'))); ?>
            <?php echo $this->Form->input('Backup.id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p><?php echo __('Are you sure to delete this file backup ?'); ?> </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary delSubmitS"  type="button"><?php echo __('Yes'); ?></button>
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
                    <h1 class="pull-left"><?php echo __('Database Backup'); ?></h1>
                    <div class="pull-right top-page-ui">
                        <?php echo $this->Html->link(__('<i class="fa fa-plus-circle fa-lg"></i> Database Backup'), array('controller' => 'settings', 'action' => 'backup', 1), array('escape' => false, 'class' => 'btn btn-primary pull-right')); ?>
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
                                            <th><?php echo __('File Name'); ?></th>									 
                                            <th><?php echo __('Date Created'); ?></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($backups)) {
                                            foreach ($backups as $row):

                                                ?>
                                                <tr id="<?php echo 'item-' . h($row['Backup']['id']); ?>">
                                                    <td><?= h($row['Backup']['file_name']); ?></td>
                                                    <td>
                                                        <?php echo date($this->Common->dateShow(), strtotime($row['Backup']['created'])); ?> 
                                                    </td>
                                                    <td>	
                                                        <?php echo $this->Html->link('<i class="fa  fa-download"></i>', array('controller' => 'settings', 'action' => 'download', $row['Backup']['file_name'],), array('escape' => false)); ?>
                                                        <a class="table-link danger" href="#" data-toggle="modal" data-target="#delFileM" onclick="fieldU('BackupId',<?php echo h($row['Backup']['id']); ?>)">
                                                            <i class="fa fa-trash-o"></i>
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