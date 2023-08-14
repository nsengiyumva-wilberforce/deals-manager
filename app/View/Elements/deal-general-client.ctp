<?php
/**
 * View for General detail for deal view page only clients
 * 
 * @author:   AnkkSoft.com
 * Copyright: AnkkSoft 2020
 * Website:   https://www.ankksoft.com
 * CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>

<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="main-box deal-detail">
            <span ><strong><i class="fa fa-money"></i></strong> <?= h($this->Session->read('Auth.User.currency_symbol')); ?><?= ($deal['Deal']['price']) ? h($deal['Deal']['price']) : '0'; ?></span>                     
            <span><strong><?php echo __('Created'); ?>:</strong> <?= date($this->Common->dateTime(), strtotime($deal['Deal']['created'])); ?></span>

        </div>
    </div>
    <!-- Notes -->
    <div class="col-md-6">
        <div class="main-box">
            <header class="main-box-header clearfix">
                <h2 class="pull-left"><?php echo __('Notes'); ?></h2>
            </header>
            <div class="main-box-body clearfix tasks-inner">
                <div class="row">
                    <?php echo $this->Form->input('NoteDeal.note', array('type' => 'textarea', 'class' => 'notebook full-width', 'label' => false, 'div' => false, 'value' => (isset($note['NoteDeal']['note'])) ? h($note['NoteDeal']['note']) : '', 'readonly' => 'readonly')); ?>
                </div>
            </div>
        </div>
    </div>
    <!-- End Notes -->
    <!-- Files -->
    <?php if (in_array(4, $dealPermission)): ?>
        <div class="col-md-6">
            <div class="main-box">
                <header class="main-box-header clearfix">
                    <h2 class="pull-left"><?php echo __('Files'); ?></h2>
                </header>
                <div class="main-box-body clearfix products-inner">
                    <table class="table table-hover dataTable">
                        <thead>
                            <tr>
                                <th><?php echo __('Name'); ?></th>
                                <th><?php echo __('Description'); ?></th>
                                <th><?php echo __('Uploaded By'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (!empty($files)) {
                                foreach ($files as $row) {

                                    ?>
                                    <tr>
                                        <td>                                                             
                                            <?php echo $this->Html->link(h($row['AppFile']['name']), array('controller' => 'Files', 'action' => 'download', $row['AppFile']['deal_id'], $row['AppFile']['name']), array('escape' => false)); ?>							
                                        </td>
                                        <td>
                                            <?= h($row['AppFile']['description']); ?>
                                        </td>
                                        <td>
                                            <?= h($row['User']['first_name']) . ' ' . h($row['User']['last_name']); ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }

                            ?>
                        </tbody>
                    </table>
                </div>               
            </div>
        </div>
    <?php endif; ?>
    <!-- End Files -->
    <!-- Members -->
    <?php if (in_array(9, $dealPermission)): ?>
        <div class="col-md-6">
            <div class="main-box">          
                <div class="main-box-body clearfix tasks-inner">
                    <div class="row" id="tab-users">
                        <ul class="widget-users row">
                            <?php
                            if (!empty($members)) :
                                foreach ($members as $row) :

                                    ?>
                                    <li class="col-md-12" id="<?php echo 'row' . h($row['User']['id']); ?>">
                                        <div class="img">
                                            <?php $cImage = ($row['User']['picture']) ? $row['User']['picture'] : 'user.jpg'; ?>
                                            <?php echo $this->Html->image('avatar/thumb/' . $cImage, array('class' => 'img-responsive')); ?>
                                        </div>
                                        <div class="details">
                                            <div class="name">
                                                <?= h($row['User']['name']); ?>
                                            </div>
                                            <div class="time">
                                                <?= ($row['User']['email']) ? '<i class="fa fa-envelope"></i> ' . h($row['User']['email']) : ''; ?>
                                            </div>
                                            <div class="type">
                                                <span class="label label-sm label-warning"><?php echo h($row['User']['job_title']); ?></span>                                                
                                                <?php if ($this->Common->isAdmin()): ?>
                                                    <a href="#" class="table-link danger pull-right"  data-toggle="modal" data-target="#delM"  data-title="<?php echo __('Delete Memeber'); ?>" data-action="users" data-id="<?= $row['User']['id']; ?>"><i class="fa fa-trash-o"></i></a>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </li>
                                    <?php
                                endforeach;
                            endif;

                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- End Members -->
    <!-- Activity -->
    <?php if (in_array(11, $dealPermission)): ?>
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="main-box">
                <header class="main-box-header clearfix">
                    <h2 class="pull-left"><?php echo __('Activity'); ?></h2>
                </header>
                <div class="main-box-body clearfix activity-inner">
                    <div class="row">
                        <section class="cd-container" id="cd-timeline">
                            <?php echo $this->element('activity'); ?>
                        </section>
                        <?php echo $this->Form->input('totalTimeline', array('type' => 'hidden', 'value' => $total_pages)); ?>
                    </div>
                    <?php if (count($activity) == 10): ?>
                        <div class="load_button">
                            <button class="load_more btn btn-primary load_moreT"><i class="fa fa-arrow-down"></i> <?php echo __('Show More'); ?></button>
                            <div class="animation_image"><?php echo $this->Html->image('ajax-loader.gif'); ?> <?php echo __('Loading'); ?>...</div>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <!-- End Activity -->
</div>