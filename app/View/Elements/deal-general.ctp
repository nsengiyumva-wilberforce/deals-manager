<?php
/**
 * View for General detail for deal view page
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
            <span><strong><i class="fa fa-filter"></i></strong> <?= h($deal['Pipeline']['name']); ?></span>
            <span><strong><?php echo __('Stage'); ?>: </strong><?= h($deal['Stage']['name']); ?></span>
            <span><strong><?php echo __('Group'); ?>: </strong><label class="label label-sm label-warning"><?= h($deal['UserGroup']['name']); ?></label></span>
            <?php if ($company): ?> <span><strong><?php echo __('Client'); ?>: </strong><a href="<?php echo $this->Html->url(array("controller" => "companies", "action" => "view", $company['Company']['id'])); ?>"><?= h($company['Company']['name']); ?></a></span> <?php endif; ?>
            <span><strong><?php echo __('Created'); ?>:</strong> <?= date($this->Common->dateTime(), strtotime($deal['Deal']['created'])); ?></span>

        </div>
    </div>
    <div class="col-lg-2 col-sm-4 col-xs-12">
        <div class="main-box infographic-box">
            <i class="fa fa fa-tasks  red-bg"></i>
            <span class="headline"><?php echo __('Task'); ?></span>
            <span class="value">
                <span  class="timer">
                    <?php echo count($tasks); ?>
                </span>
            </span>
        </div>
    </div>
    <div class="col-lg-2 col-sm-4 col-xs-12">
        <div class="main-box infographic-box">
            <i class="fa fa-users emerald-bg"></i>
            <span class="headline"><?php echo __('Contact'); ?></span>
            <span class="value">
                <span  class="timer">
                    <?php echo count($contacts); ?>
                </span>
            </span>
        </div>
    </div>
    <div class="col-lg-2 col-sm-4 col-xs-12">
        <div class="main-box infographic-box">
            <i class="fa fa-gift green-bg"></i>
            <span class="headline"><?php echo __('Product'); ?></span>
            <span class="value">
                <span class="timer">
                    <?php echo count($products); ?>
                </span>
            </span>
        </div>
    </div>
    <div class="col-lg-2 col-sm-4 col-xs-12">
        <div class="main-box infographic-box">
            <i class="fa fa-eye yellow-bg"></i>
            <span class="headline"><?php echo __('Source'); ?></span>
            <span class="value">
                <span class="timer">
                    <?php echo count($sources); ?>
                </span>
            </span>
        </div>
    </div>
    <div class="col-lg-2 col-sm-4 col-xs-12">
        <div class="main-box infographic-box">
            <i class="fa fa-file purple-bg"></i>
            <span class="headline"><?php echo __('Files'); ?></span>
            <span class="value">
                <span class="timer">
                    <?php echo count($files); ?>
                </span>
            </span>
        </div>
    </div>
    <div class="col-lg-2 col-sm-4 col-xs-12">
        <div class="main-box infographic-box">
            <i class="fa fa-shopping-cart emerald-bg"></i>
            <span class="headline"><?php echo __('Invoices'); ?></span>
            <span class="value">
                <span class="timer">
                    <?php echo count($files); ?>
                </span>
            </span>
        </div>
    </div>

</div>

<!-- Members -->
<div class="row">
    <div class="col-md-3">
        <div class="main-box">
            <header class="main-box-header clearfix">
                <h2 class="pull-left"><?php echo __('Members'); ?></h2>
                <?php if ($this->Common->isAdminManager()): ?>
                    <a  href="#" class="btn btn-primary pull-right btn-xs btn-member" data-toggle="modal" data-target="#memberM">
                        <i class="fa fa-user"></i> <?php echo __('Add Member'); ?>
                    </a>
                <?php endif; ?>
            </header>
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
    <!-- End Members -->
    <!-- Products -->
    <div class="col-md-2">
        <div class="main-box">
            <header class="main-box-header clearfix">
                <h2 class="pull-left"><?php echo __('Products'); ?></h2>
            </header>
            <div class="products-inner">
                <table class="table table-hover dataTable table-striped">
                    <tbody>
                        <?php
                        if (!empty($products)):
                            foreach ($products as $row):

                                ?>
                                <tr ><td>
                                        <a href="<?php echo $this->Html->url(array("controller" => "products", "action" => "view", $row['Product']['id'])); ?>"><?= h($row['Product']['name']); ?></a>
                                    </td></tr>
                                <?php
                            endforeach;
                        endif;

                        ?>
                    </tbody>
                </table>
            </div>               
        </div>
    </div>
    <!-- End Products -->
    <!-- Sources -->
    <div class="col-md-2">
        <div class="main-box">
            <header class="main-box-header clearfix">
                <h2 class="pull-left"><?php echo __('Sources'); ?></h2>
            </header>
            <div class="products-inner">
                <table class="table table-hover dataTable table-striped">
                    <tbody>
                        <?php
                        if (!empty($sources)) :
                            foreach ($sources as $row):

                                ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo $this->Html->url(array("controller" => "sources", "action" => "view", $row['Source']['id'])); ?>"><?= h($row['Source']['name']); ?></a>
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
    </div>
    <!-- Files -->
    <div class="col-md-2">
        <div class="main-box">
            <header class="main-box-header clearfix">
                <h2 class="pull-left"><?php echo __('Files'); ?></h2>
            </header>
            <div class="products-inner">
                <table class="table table-hover dataTable table-striped">
                    <tbody>
                        <?php
                        if (!empty($files)) :
                            foreach ($files as $row) :

                                ?>
                                <tr>
                                    <td><?php echo $this->Html->link(h($row['AppFile']['name']), array('controller' => 'Files', 'action' => 'download', $row['AppFile']['deal_id'], $row['AppFile']['name']), array('escape' => false)); ?></td>
                                </tr>
                                <?php
                            endforeach;
                        endif;

                        ?>
                    </tbody>
                </table>
            </div>               
        </div>
    </div>
    <!-- End Files -->
    <!-- Notes -->
    <div class="col-md-3">
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
</div>
<div class="row row-eq-height">
    <div class="col-lg-8 col-md-6 col-sm-6 col-xs-12">
        <div class="row ">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!-- Calender -->
                <div id="calendar"></div>
                <!--End Calender -->
            </div>
        </div>
    </div>    
    <!-- Activity -->
    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
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
    <!-- End Activity -->
</div>