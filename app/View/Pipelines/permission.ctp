<?php
/**
 * view for pipeline permission page to user
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div class="row">											
    <div class="col-lg-12">
        <div class="row">            
            <div class="clearfix">
                <h1 class="pull-left"><?php echo h($pipeline['Pipeline']['name']) . ' - ' . __('Permission'); ?></h1>                  
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">					  
                    <div class="main-box-body clearfix">
                        <div class="table-responsive">
                            <table class="table table-hover dataTable">
                                <thead>
                                    <tr>
                                        <th><?php echo __('To'); ?> </th>
                                        <th><?php echo __('Permission'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $row) : ?>
                                        <tr>                                           
                                            <td class="col-md-6"><?= h($row['User']['name']); ?> &nbsp;<label class="label label-warning"><?= h($row['User']['job_title']); ?></label></td>
                                            <td class="col-md-6">                                              
                                                <div class="onoffswitch">
                                                    <input type="checkbox" value="<?= h($row['User']['id']); ?>"  id="myonoffswitch<?php echo h($row['User']['id']); ?>" class="onoffswitch-checkbox user-perm" <?= ($row['PipelinePermission']['id']) ? '' : 'checked'; ?> >
                                                    <label for="myonoffswitch<?= h($row['User']['id']); ?>" class="onoffswitch-label">
                                                        <div class="onoffswitch-inner"></div>
                                                        <div class="onoffswitch-switch"></div>
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <input type="hidden" value="<?= $this->params['pass'][0]; ?>" id="pipeinput">
                        </div>
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>