<?php
/**
 * History of deal
 * 
 * @author:   AnkkSoft.com
 * Copyright: AnkkSoft 2020
 * Website:   http://www.ankksoft.com
 * CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div class="row manager-deal"> 
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">                 
                    <div class="col-lg-4 col-sm-6 col-xs-12">
                        <h1 class="pull-left deal-title"> <?= h($deal['Deal']['name']); ?></h1>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-12 deal-view-colum">
                        <?php foreach ($labels as $row): ?>
                            <span class="label label-default deal-view-label <?= h($row['Label']['color']); ?>"><?= h($row['Label']['name']); ?></span>
                        <?php endforeach; ?>
                    </div>                                                                                 
                    <?php echo $this->Form->input('id', array('type' => 'hidden', 'id' => 'dealid', 'value' => h($deal['Deal']['id']))); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">	
                    <div class="tabs-wrapper tabs-no-header">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs deal-tab">
                            <li class="active"><a data-toggle="tab" href="#tab-general"><?php echo __('General'); ?></a></li>                                                                                              
                        </ul>
                        <!--End Tabs -->
                        <!-- Tabs Content -->
                        <div class="tab-content">
                            <!-- General Tab -->
                            <div id="tab-general" class="tab-pane fade in active">
                                <div class="row">
                                    <?php if ($this->Common->isAdmin() || $this->Common->isStaff()): ?>
                                        <div class="row">
                                            <div class="col-lg-12 col-sm-12 col-xs-12">
                                                <div class="main-box deal-detail">
                                                    <span ><strong><i class="fa fa-money"></i></strong> <?= h($this->Session->read('Auth.User.currency_symbol')); ?><?= ($deal['Deal']['price']) ? h($deal['Deal']['price']) : '0'; ?></span>
                                                    <span><strong><i class="fa fa-filter"></i></strong> <?= h($Pipe['Pipeline']['name']); ?></span>
                                                    <span><strong><?php echo __('Stage'); ?>: </strong><?= h($stage['Stage']['name']); ?></span>
                                                    <?php if ($company): ?> <span><strong><?php echo __('Client'); ?>: </strong><a href="<?php echo $this->Html->url(array("controller" => "companies", "action" => "view", h($company['Company']['id']))); ?>"><?= h($company['Company']['name']); ?></a></span> <?php endif; ?>
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
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="main-box">
                                                    <header class="main-box-header clearfix">
                                                        <h2 class="pull-left"><?php echo __('Members'); ?></h2>                                                 
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
                                                                        <tr>
                                                                            <td>
                                                                                <a href="<?php echo $this->Html->url(array("controller" => "products", "action" => "view", h($row['Product']['id']))); ?>"><?= h($row['Product']['name']); ?></a>
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
                                                                                <a href="<?php echo $this->Html->url(array("controller" => "sources", "action" => "view", h($row['Source']['id']))); ?>"><?= h($row['Source']['name']); ?></a>
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
                                                                            <td><?php echo $this->Html->link($row['AppFile']['name'], array('controller' => 'Files', 'action' => 'download', $row['AppFile']['deal_id'], $row['AppFile']['name']), array('escape' => false)); ?></td>
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
                                        </div>
                                        <div class="row row-eq-height">
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                <div class="main-box">
                                                    <header class="main-box-header clearfix">
                                                        <h2 class="pull-left"><?php echo __('Tasks'); ?></h2>
                                                    </header>

                                                    <div class="main-box-body">
                                                        <div class="table-scrollable">
                                                            <table class="table table-hover dataTable table-tasks">
                                                                <tbody>
                                                                    <?php
                                                                    if (!empty($tasks)) {
                                                                        foreach ($tasks as $row) {

                                                                            ?>
                                                                            <tr  id="<?php echo 'row' . h($row['Task']['id']); ?>" class="<?= $this->Common->priorityClass($row['Task']['priority']); ?>">
                                                                                <td>
                                                                                    <div class="task-name <?php echo ($row['Task']['status'] == '1') ? 'task-line' : ''; ?>">
                                                                                        <?php
                                                                                        if ($row['Task']['status'] == 1) {
                                                                                            echo "<i class='fa fa-check fa-2x'></i>";
                                                                                        } else {

                                                                                            ?>
                                                                                        <?php } ?>
                                                                                        <span> <?= h($row['Task']['task']); ?> </span>&nbsp;
                                                                                        <?= $this->Common->priority($row['Task']['priority']); ?>
                                                                                    </div >
                                                                                    <div class="task-details">                                      
                                                                                        <span class="task-details-text task-padding-left">
                                                                                            <?= $this->Common->motives($row['Task']['motive']); ?>
                                                                                        </span>                                  
                                                                                        <span class="task-details-text">
                                                                                            <i class="fa fa-clock-o"></i> <?= date($this->Common->timeShow(), strtotime($row['Task']['time'])); ?>
                                                                                        </span>
                                                                                        <span class="task-details-text">
                                                                                            <i class="fa fa-calendar"></i> <?= date($this->Common->dateShow(), strtotime($row['Task']['date'])); ?>
                                                                                        </span>
                                                                                        <span class="task-details-text">
                                                                                            <i class="fa fa-user"></i> <?= h($row['User']['first_name']) . ' ' . h($row['User']['last_name']); ?>
                                                                                        </span>
                                                                                    </div>
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
                                            </div> 
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                <div class="main-box">
                                                    <header class="main-box-header clearfix">
                                                        <h2 class="pull-left"><?php echo __('Contacts'); ?></h2>
                                                    </header>

                                                    <div class="main-box-body tasks-inner">
                                                        <div class="row top-margin contact-list">
                                                            <?php
                                                            if (!empty($contacts)) :
                                                                foreach ($contacts as $row) :

                                                                    ?>
                                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="<?php echo 'row' . h($row['Contact']['id']); ?>">
                                                                        <div class="main-box clearfix profile-box-contact">
                                                                            <div class="main-box-body clearfix">
                                                                                <a href="<?php echo $this->webroot; ?>contacts/view/<?= h($row['Contact']['id']); ?>">
                                                                                    <div class="profile-box-header contact-box-list clearfix">
                                                                                        <div class="col-sm-6">
                                                                                            <div class="text-center">
                                                                                                <?php $cImage = ($row['Contact']['picture']) ? $row['Contact']['picture'] : 'user.png'; ?>    
                                                                                                <?= $this->Html->image('contact/thumb/' . $cImage, array('class' => 'img-circle m-t-xs ')); ?>
                                                                                                <div class="m-t-xs font-bold"><h5><?= h($row['Contact']['title']); ?></h5></div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-sm-6">
                                                                                            <h2><?php echo h($row['Contact']['name']); ?></h2>
                                                                                            <ul class="contact-details">                                   
                                                                                                <li>
                                                                                                    <?php echo ($row['Contact']['email']) ? '<i class="fa fa-envelope"></i> ' . h($row['Contact']['email']) : ''; ?>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <?php echo ($row['Contact']['phone']) ? ' <i class="fa fa-phone"></i> ' . h($row['Contact']['phone']) : ''; ?>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <?php echo ($row['Contact']['location']) ? ' <i class="fa fa-map-marker"></i> ' . h($row['Contact']['location']) : ''; ?>
                                                                                                </li>
                                                                                                <li>
                                                                                                    <?php echo ($row['Contact']['address']) ? ' <i class="fa fa-home"></i> ' . h($row['Contact']['address']) : ''; ?>
                                                                                                </li>
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="contact-box-footer clearfix">
                                                                                        <div class="col-md-3 col-xs-3 border-right contact-social">
                                                                                            <a href="<?php echo ($row['Contact']['facebook']) ? 'http://' . h($row['Contact']['facebook']) : '#'; ?>"> <i class="fa fa-facebook-square"></i>  </a>
                                                                                        </div>
                                                                                        <div class="col-md-3 col-xs-3 border-right contact-social">
                                                                                            <a href="<?php echo ($row['Contact']['twitter']) ? 'http://' . h($row['Contact']['twitter']) : '#'; ?>">  <i class="fa fa-twitter-square"></i>  </a>
                                                                                        </div>
                                                                                        <div class="col-md-3 col-xs-3 border-right contact-social">
                                                                                            <a href="<?php echo ($row['Contact']['linkedIn']) ? 'http://' . h($row['Contact']['linkedIn']) : '#'; ?>">  <i class="fa fa-linkedin-square"></i> </a>  
                                                                                        </div>
                                                                                        <div class="col-md-3 col-xs-3 contact-social">
                                                                                            <a href="<?php echo ($row['Contact']['skype']) ? 'http://' . h($row['Contact']['skype']) : '#'; ?>">  <i class="fa fa-skype"></i>  </a>

                                                                                        </div>
                                                                                    </div>   
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                endforeach;
                                                            endif;

                                                            ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                                <div class="main-box">
                                                    <header class="main-box-header clearfix">
                                                        <h2 class="pull-left"><?php echo __('Activity'); ?></h2>
                                                    </header>
                                                    <div class="main-box-body clearfix tasks-inner">
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
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="main-box">
                                                    <header class="main-box-header clearfix">
                                                        <h2 class="pull-left"><?php echo __('Discussion'); ?></h2>                                                 
                                                    </header>
                                                    <div class="main-box-body tasks-inner">
                                                        <div class="tabs-wrapper profile-tabs">
                                                            <div class="conversation-wrapper">
                                                                <div class="conversation-content">
                                                                    <div>
                                                                        <div class="conversation-inner">
                                                                            <?php foreach ($Discussions as $row): ?>
                                                                                <div class="discussion-row" id="<?php echo 'row' . h($row['Discussion']['id']); ?>">
                                                                                    <div class="conversation-item  clearfix item-left">
                                                                                        <div class="conversation-user">
                                                                                            <?php
                                                                                            echo $this->Html->image('avatar/thumb/' . $row['User']['picture'], array('class' => 'img-responsive center-block'));

                                                                                            ?>
                                                                                        </div>
                                                                                        <div class="conversation-body discuss-body">
                                                                                            <div class="name"> 
                                                                                                <?php echo h($row['User']['first_name']) . ' ' . h($row['User']['last_name']); ?>
                                                                                            </div>
                                                                                            <div class="time hidden-xs"> <?= $this->Time->format($this->Common->dateTime(), h($row['Discussion']['created'])); ?> </div>
                                                                                            <div class="text"><?= h($row['Discussion']['message']); ?></div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <?php
                                                                                    if (!empty($row['childs'])) :
                                                                                        foreach ($row['childs'] as $row):

                                                                                            ?>
                                                                                            <div id="<?php echo 'row' . h($row['Discussion']['id']); ?>">
                                                                                                <div class="conversation-item  clearfix discuss-reply-message">
                                                                                                    <div class="conversation-user">
                                                                                                        <?php echo $this->Html->image('avatar/thumb/' . $row['User']['picture'], array('class' => 'img-responsive center-block')); ?>
                                                                                                    </div>
                                                                                                    <div class="conversation-body">
                                                                                                        <div class="name"> 
                                                                                                            <?php echo h($row['User']['first_name']) . ' ' . h($row['User']['last_name']); ?>
                                                                                                        </div>
                                                                                                        <div class="time hidden-xs"> <?= $this->Time->format($this->Common->dateTime(), h($row['Discussion']['created'])); ?> </div>
                                                                                                        <div class="text"><?= h($row['Discussion']['message']); ?></div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <?php
                                                                                        endforeach;
                                                                                    endif

                                                                                    ?>
                                                                                </div>
                                                                            <?php endforeach; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>     
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="main-box">
                                                    <header class="main-box-header clearfix">
                                                        <h2 class="pull-left"><?php echo __('Invoices'); ?></h2>                                                 
                                                    </header>
                                                    <div class="main-box-body clearfix tasks-inner">
                                                        <table class="table table-hover dataTable">
                                                            <thead>
                                                                <tr>
                                                                    <th><?php echo __('Invoice'); ?></th>
                                                                    <th><?php echo __('Issue Date'); ?></th>
                                                                    <th><?php echo __('Due Date'); ?></th>
                                                                    <th><?php echo __('Value'); ?></th>
                                                                    <th><?php echo __('Status'); ?></th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                if (!empty($invoices)) :
                                                                    foreach ($invoices as $row) :

                                                                        ?>
                                                                        <tr  id="<?php echo 'row' . h($row['Invoice']['id']); ?>">
                                                                            <td><a class="table-link" href="<?php echo $this->Html->url(array("controller" => "invoices", "action" => "view", h($row['Invoice']['id']))); ?>">
                                                                                    <?php echo "INV" . sprintf("%04d", h($row['Invoice']['id'])); ?>
                                                                                </a>
                                                                            </td>
                                                                            <td><?php echo $this->Time->format($this->Common->dateShow(), h($row['Invoice']['issue_date'])); ?></td>
                                                                            <td><?php echo $this->Time->format($this->Common->dateShow(), h($row['Invoice']['due_date'])); ?></td>
                                                                            <td><?php echo h($row['Invoice']['currency']) . '' . h($row['Invoice']['amount']); ?></td>
                                                                            <td><?php $this->Common->invoice_status($row['Invoice']['status']); ?></td>                       
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
                                        </div>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="main-box">
                                                    <header class="main-box-header clearfix">
                                                        <h2 class="pull-left"><?php echo __('Customer Feedback'); ?></h2>                                                 
                                                    </header>
                                                    <div class="main-box-body clearfix tasks-inner">

                                                        <div class="tabs-wrapper profile-tabs">
                                                            <div class="conversation-wrapper">
                                                                <div class="conversation-content">
                                                                    <div>
                                                                        <div class="conversation-inner">
                                                                            <?php foreach ($feedback as $row): ?>
                                                                                <div class="discussion-row" id="<?php echo 'row' . h($row['Discussion']['id']); ?>">
                                                                                    <div class="conversation-item  clearfix item-left">
                                                                                        <div class="conversation-user">
                                                                                            <?php
                                                                                            echo $this->Html->image('avatar/thumb/' . $row['User']['picture'], array('class' => 'img-responsive center-block'));

                                                                                            ?>
                                                                                        </div>
                                                                                        <div class="conversation-body discuss-body">
                                                                                            <div class="name"> 
                                                                                                <?php echo h($row['User']['first_name']) . ' ' . h($row['User']['last_name']); ?>
                                                                                            </div>
                                                                                            <div class="time hidden-xs"> <?= $this->Time->format($this->Common->dateTime(), h($row['Discussion']['created'])); ?> </div>
                                                                                            <div class="text"><?= h($row['Discussion']['message']); ?></div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <?php
                                                                                    if (!empty($row['childs'])) {
                                                                                        foreach ($row['childs'] as $row):

                                                                                            ?>
                                                                                            <div id="<?php echo 'row' . h($row['Discussion']['id']); ?>">
                                                                                                <div class="conversation-item  clearfix discuss-reply-message">
                                                                                                    <div class="conversation-user">
                                                                                                        <?php echo $this->Html->image('avatar/thumb/' . $row['User']['picture'], array('class' => 'img-responsive center-block')); ?>
                                                                                                    </div>
                                                                                                    <div class="conversation-body">
                                                                                                        <div class="name"> 
                                                                                                            <?php echo h($row['User']['first_name']) . ' ' . h($row['User']['last_name']); ?>
                                                                                                        </div>
                                                                                                        <div class="time hidden-xs"> <?= $this->Time->format($this->Common->dateTime(), h($row['Discussion']['created'])); ?> </div>
                                                                                                        <div class="text"><?= h($row['Discussion']['message']); ?></div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <?php
                                                                                        endforeach;
                                                                                    }

                                                                                    ?>
                                                                                </div>
                                                                            <?php endforeach; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>     
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="main-box">
                                                    <header class="main-box-header clearfix">
                                                        <h2 class="pull-left"><?php echo __('Custom Fields'); ?></h2>                                                 
                                                    </header>
                                                    <div class="main-box-body tasks-inner">
                                                        <div class="table-responsive">
                                                            <div class="table-scrollable">
                                                                <table class="table table-hover dataTable">
                                                                    <thead>
                                                                        <tr>
                                                                            <th><?php echo __('Field'); ?></th>
                                                                            <th><?php echo __('Value'); ?></th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        if (!empty($custom)) {
                                                                            foreach ($custom as $row) :

                                                                                ?>
                                                                                <tr>                               
                                                                                    <td><strong><?= h($row['Custom']['name']); ?></strong></td>
                                                                                    <td><a href="javascript:void(0)"  data-type="text" data-pk="<?php echo h($row['CustomDeal']['id']); ?>" data-url="<?php echo $this->Html->url(array('controller' => 'customs', 'action' => 'deal')); ?>"  class="editable editable-click vEdit" ><?= h($row['CustomDeal']['value']); ?></a></td>
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
                                <?php else: ?>
                                    <?php echo $this->element('deal-general-client'); ?>
                                <?php endif; ?>
                            </div>                                             

                        </div>
                        <!--End Tabs Content -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>