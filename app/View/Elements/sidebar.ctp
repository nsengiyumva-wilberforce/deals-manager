<?php
/**
 * Menu Side-bar for application
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div id="nav-col">
    <!-- Left sidebar Section -->
    <section class="col-left-nano" id="col-left">
        <!-- Left sidebar Menu Content -->
        <div class="col-left-nano-content" id="col-left-inner">
            <div id="sidebar-nav" class="collapse navbar-collapse navbar-ex1-collapse">
                <ul class="nav nav-pills nav-stacked">
                    <?php $action = !empty($this->params['controller']) ? $this->params['controller'] : null; ?>
                    <!-- if Admin/Staff  -->
                    <?php if ($this->Common->isAdmin()) { ?>
                        <li class="<?= ($action == 'admins') ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'index')); ?>"><i class='fa fa-dashboard'></i><span><?php echo __('Dashboard'); ?></span></a> </li>            
                        <li class="<?= ($action == 'deals' && ($this->params['action'] != 'view')) ? 'active' : 'nav-noactive' ?>">
                            <a class="dropdown-toggle" href="#"><i class="fa fa-rocket"></i><span><?php echo __('Deals'); ?></span><i class="fa fa-angle-right drop-icon"></i></a>
                            <ul class="submenu">
                                <li><a class="<?= ($action == 'deals' && ($this->params['action'] == 'index')) ? 'active' : 'nav-noactive' ?>" href="<?php echo $this->Html->url(array('controller' => 'deals', 'action' => 'index')); ?>"><i class='fa fa-list'></i> <span><?php echo __('List Deals'); ?></span></a></li>
                                <li><a class="<?= ($action == 'deals' && ($this->params['action'] == 'won')) ? 'active' : 'nav-noactive' ?>" href="<?php echo $this->Html->url(array('controller' => 'deals', 'action' => 'won')); ?>"><i class='fa fa-thumbs-up'></i> <span><?php echo __('Won Deals'); ?></span></a></li>
                                <li><a class="<?= ($action == 'deals' && ($this->params['action'] == 'loss')) ? 'active' : 'nav-noactive' ?>" href="<?php echo $this->Html->url(array('controller' => 'deals', 'action' => 'loss')); ?>"><i class='fa fa-thumbs-down'></i> <span><?php echo __('Loss Deals'); ?></span></a></li>
                            </ul>
                        </li>
                        <?php if ($this->Common->isAdminPermission('3')) : ?>
                            <li class="<?= ($action == 'tasks') ? 'active' : 'nav-noactive' ?>">
                                <a class="dropdown-toggle" href="#"><i class='fa fa-tasks'></i><span><?php echo __('Tasks'); ?></span><i class="fa fa-angle-right drop-icon"></i></a>
                                <ul class="submenu">
                                    <li><a class="<?= ($action == 'tasks' && ($this->params['action'] == 'index')) ? 'active' : 'nav-noactive' ?>" href="<?php echo $this->Html->url(array('controller' => 'tasks', 'action' => 'index')); ?>"><?php echo __('Task'); ?></a></li>
                                    <li><a class="<?= ($action == 'tasks' && ($this->params['action'] == 'lists')) ? 'active' : 'nav-noactive' ?>" href="<?php echo $this->Html->url(array('controller' => 'tasks', 'action' => 'lists')); ?>"><?php echo __('All Task'); ?></a></li>
                                </ul>
                            </li>
                        <?php else : ?>
                            <li class="<?= ($action == 'tasks') ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'tasks', 'action' => 'index')); ?>"><i class='fa fa-tasks'></i><span><?php echo __('Task'); ?></span></a> </li>
                        <?php endif; ?>
                        <li class="<?= ($action == 'calenders') ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'calenders', 'action' => 'index')); ?>"><i class='fa fa-calendar'></i><span><?php echo __('Calendar'); ?></span></a> </li>
                        <li class="<?= ($action == 'invoices' || $action == 'expenses') ? 'active' : 'nav-noactive' ?>">
                            <a class="dropdown-toggle" href="#"><i class='fa fa-shopping-cart'></i><span><?php echo __('Sales'); ?></span><i class="fa fa-angle-right drop-icon"></i></a>
                            <ul class="submenu">
                                <li><a class="<?= ($action == 'invoices' && ($this->params['action'] == 'index')) ? 'active' : 'nav-noactive' ?>" href="<?php echo $this->Html->url(array('controller' => 'invoices', 'action' => 'index')); ?>"><i class='fa fa-file-text-o'></i> <?php echo __('Invoices'); ?></a></li>
                                <li><a class="<?= ($action == 'expenses' && ($this->params['action'] == 'index')) ? 'active' : 'nav-noactive' ?>" href="<?php echo $this->Html->url(array('controller' => 'expenses', 'action' => 'index')); ?>"><i class='fa fa-money'></i> <?php echo __('Expenses'); ?></a></li>
                                <li><a class="<?= ($action == 'invoices' && ($this->params['action'] == 'payments')) ? 'active' : 'nav-noactive' ?>" href="<?php echo $this->Html->url(array('controller' => 'invoices', 'action' => 'payments')); ?>"><i class='fa fa-strikethrough'></i> <?php echo __('Payments'); ?></a></li>
                                <li><a class="<?= ($action == 'invoices' && ($this->params['action'] == 'tax')) ? 'active' : 'nav-noactive' ?>" href="<?php echo $this->Html->url(array('controller' => 'invoices', 'action' => 'tax')); ?>"><i class='fa fa-scissors'></i> <?php echo __('Tax Rates'); ?></a></li>                  
                            </ul>
                        </li>
                        <li class="<?= ($action == 'companies') ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'companies', 'action' => 'index')); ?>"><i class='fa fa-building'></i><span><?php echo __('Clients'); ?></span></a> </li>
                        <li class="<?= ($action == 'contacts') ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'contacts', 'action' => 'index')); ?>"><i class='fa fa-users'></i><span><?php echo __('Contacts'); ?></span></a> </li>

                        <?php if ($this->Common->isAdminPermission('5')) : ?>
                            <li class="<?= ($action == 'reports') ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'reports', 'action' => 'index')); ?>"><i class='fa fa-bar-chart-o'></i><span><?php echo __('Reports'); ?></span></a> </li>
                        <?php endif; ?>
                        <li class="<?= ($action == 'pipelines' || $action == 'stages' || $action == 'labels' || $action == 'sources' || $action == 'products' || $action == 'exports' || $action == 'timelines') ? 'active' : 'nav-noactive' ?>">
                            <a class="dropdown-toggle" href="#"><i class='fa fa-cog'></i><span><?php echo __('More'); ?></span><i class="fa fa-angle-right drop-icon"></i></a>
                            <ul class="submenu">
                                <?php if ($this->Common->isAdminPermission('1')) : ?>
                                    <li><a class="<?= ($action == 'pipelines') ? 'active' : 'nav-noactive' ?>" href="<?php echo $this->Html->url(array('controller' => 'pipelines', 'action' => 'index')); ?>"><i class='fa fa-filter'></i> <span><?php echo __('Pipelines'); ?></span></a> </li>
                                <?php endif; ?>
                                <?php if ($this->Common->isAdminPermission('2')) : ?>
                                    <li><a class="<?= ($action == 'stages') ? 'active' : 'nav-noactive' ?>" href="<?php echo $this->Html->url(array('controller' => 'stages', 'action' => 'index')); ?>"><i class='fa fa-sitemap'></i> <span><?php echo __('Stages'); ?></span></a> </li>
                                <?php endif; ?>
                                <?php if ($this->Common->isAdminPermission('8')) : ?>
                                    <li><a class="<?= ($action == 'labels' && ($this->params['action'] == 'index')) ? 'active' : 'nav-noactive' ?>" href="<?php echo $this->Html->url(array('controller' => 'labels', 'action' => 'index')); ?>"><i class='fa fa-tags'></i><span> <?php echo __('Labels'); ?></span></a> </li>
                                <?php endif; ?>
                                <li><a class="<?= ($action == 'sources' && ($this->params['action'] == 'index')) ? 'active' : 'nav-noactive' ?>" href="<?php echo $this->Html->url(array('controller' => 'sources', 'action' => 'index')); ?>"><i class='fa fa-eye'></i> <?php echo __('Sources'); ?></a></li>
                                <li><a class="<?= ($action == 'products' && ($this->params['action'] == 'index')) ? 'active' : 'nav-noactive' ?>" href="<?php echo $this->Html->url(array('controller' => 'products', 'action' => 'index')); ?>"><i class='fa fa-gift'></i> <?php echo __('Products'); ?></a></li>
                                <li><a class="<?= ($action == 'exports' && ($this->params['action'] == 'index')) ? 'active' : 'nav-noactive' ?>" href="<?php echo $this->Html->url(array('controller' => 'exports', 'action' => 'index')); ?>"><i class='fa fa-arrow-down'></i> <?php echo __('Exports'); ?></a></li>
                                <?php if ($this->Common->isAdminPermission('6')) : ?>
                                    <li><a class="<?= ($action == 'timelines') ? 'active' : 'nav-noactive' ?>" href="<?php echo $this->Html->url(array('controller' => 'timelines', 'action' => 'index')); ?>"><i class='fa fa-history'></i> <span><?php echo __('Activity'); ?></span></a> </li>
                                <?php endif; ?>
                                <li><a class="<?= ($action == 'notes' && ($this->params['action'] == 'index')) ? 'active' : 'nav-noactive' ?>" href="<?php echo $this->Html->url(array('controller' => 'notes', 'action' => 'index')); ?>"><i class='fa fa-thumb-tack'></i> <?php echo __('Notes'); ?></a></li>
                                <li><a class="<?= ($action == 'todos' && ($this->params['action'] == 'index')) ? 'active' : 'nav-noactive' ?>" href="<?php echo $this->Html->url(array('controller' => 'todos', 'action' => 'index')); ?>"><i class='fa fa-check-square-o'></i> <?php echo __('Todos'); ?></a></li>
                            </ul>
                        </li>
                        <li class="<?= ($action == 'messages') ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'messages', 'action' => 'index')); ?>"><i class='fa fa-envelope'></i><span><?php echo __('Messages'); ?></span></a></li>
                        <li class="<?= ($action == 'tickets') ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'tickets', 'action' => 'index')); ?>"><i class='fa fa-ticket'></i><span><?php echo __('Tickets'); ?></span></a></li>
                        <li class="<?= ($action == 'announcements') ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'announcements', 'action' => 'index')); ?>"><i class='fa fa-bullhorn'></i><span><?php echo __('Announcements'); ?></span></a></li>
                        <?php if ($this->Common->isAdminPermission('4')) : ?>
                            <li class="<?= ($action == 'users' && ($this->params['action'] == 'index' || $this->params['action'] == 'admin' || $this->params['action'] == 'manager' || $this->params['action'] == 'staff')) ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'index')); ?>"><i class='fa fa-user'></i><span><?php echo __('Members'); ?></span></a></li>
                        <?php endif; ?>
                        <?php if ($this->Common->isAdminPermission('7')) : ?>
                            <li class="<?= ($action == 'settings' || $action == 'customs' || ($this->params['action'] == 'role') || ($this->params['action'] == 'group')) ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'settings', 'action' => 'index')); ?>"><i class='fa fa-wrench'></i><span><?php echo __('Settings'); ?></span></a></li>
                        <?php endif; ?>
                        <!-- if staff -->
                    <?php } elseif ($this->Common->isStaff()) { ?>
                        <li class="<?= ($action == 'admins') ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'index')); ?>"><i class='fa fa-dashboard'></i><span><?php echo __('Dashboard'); ?></span></a> </li>
                        <li class="<?= ($action == 'deals' && ($this->params['action'] != 'view')) ? 'active' : '' ?>">
                            <a class="dropdown-toggle" href="#"><i class="fa fa-rocket"></i><span><?php echo __('Deals'); ?></span><i class="fa fa-angle-right drop-icon"></i></a>
                            <ul class="submenu">
                                <li><a class="<?= ($action == 'deals' && ($this->params['action'] == 'index')) ? 'active' : 'nav-noactive' ?>" href="<?php echo $this->Html->url(array('controller' => 'deals', 'action' => 'index')); ?>"><i class='fa fa-list'></i> <span><?php echo __('List Deals'); ?></span></a></li>
                                <li><a class="<?= ($action == 'deals' && ($this->params['action'] == 'won')) ? 'active' : 'nav-noactive' ?>" href="<?php echo $this->Html->url(array('controller' => 'deals', 'action' => 'won')); ?>"><i class='fa fa-thumbs-up'></i> <span><?php echo __('Won Deals'); ?></span></a></li>
                                <li><a class="<?= ($action == 'deals' && ($this->params['action'] == 'loss')) ? 'active' : 'nav-noactive' ?>" href="<?php echo $this->Html->url(array('controller' => 'deals', 'action' => 'loss')); ?>"><i class='fa fa-thumbs-down'></i> <span><?php echo __('Loss Deals'); ?></span></a></li>
                            </ul>
                        </li>
                        <?php if ($this->Common->isManager()) : ?>
                            <li class="<?= ($action == 'tasks') ? 'active' : 'nav-noactive' ?>">
                                <a class="dropdown-toggle" href="#"><i class='fa fa-tasks'></i><span><?php echo __('Tasks'); ?></span><i class="fa fa-angle-right drop-icon"></i></a>
                                <ul class="submenu">
                                    <li><a class="<?= ($action == 'tasks' && ($this->params['action'] == 'index')) ? 'active' : 'nav-noactive' ?>" href="<?php echo $this->Html->url(array('controller' => 'tasks', 'action' => 'index')); ?>"><?php echo __('My Task'); ?></a></li>
                                    <li><a class="<?= ($action == 'tasks' && ($this->params['action'] == 'lists')) ? 'active' : 'nav-noactive' ?>" href="<?php echo $this->Html->url(array('controller' => 'tasks', 'action' => 'lists')); ?>"><?php echo __('Group Task'); ?></a></li>
                                </ul>
                            </li>
                        <?php else : ?>
                            <li class="<?= ($action == 'tasks') ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'tasks', 'action' => 'index')); ?>"><i class='fa fa-tasks'></i><span><?php echo __('Task'); ?></span></a> </li>          
                        <?php endif; ?>
                        <li class="<?= ($action == 'calenders') ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'calenders', 'action' => 'index')); ?>"><i class='fa fa-calendar'></i><span><?php echo __('Calender'); ?></span></a> </li>                       
                        <li class="<?= ($action == 'invoices') ? 'active' : 'nav-noactive' ?>"><a  href="<?php echo $this->Html->url(array('controller' => 'invoices', 'action' => 'index')); ?>"><i class='fa fa-file-text-o'></i><span><?php echo __('Invoices'); ?></span></a></li>
                        <?php if ($this->Common->isStaffPermission('21') && $this->Common->isAdminManager()) : ?>
                            <li class="<?= ($action == 'companies') ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'companies', 'action' => 'index')); ?>"><i class='fa fa-building'></i><span><?php echo __('Clients'); ?></span></a> </li>
                        <?php endif; ?>
                        <?php if ($this->Common->isStaffPermission('11')) : ?>
                            <li class="<?= ($action == 'contacts') ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'contacts', 'action' => 'index')); ?>"><i class='fa fa-users'></i><span><?php echo __('Contacts'); ?></span></a> </li>
                        <?php endif; ?>

                        <?php if ($this->Common->isStaffPermission('41')) : ?>
                            <li class="<?= ($action == 'sources') ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'sources', 'action' => 'index')); ?>"><i class='fa fa-eye'></i><span><?php echo __('Sources'); ?></span></a> </li>
                        <?php endif; ?>
                        <?php if ($this->Common->isStaffPermission('31')) : ?>
                            <li class="<?= ($action == 'products') ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'products', 'action' => 'index')); ?>"><i class='fa fa-gift'></i><span><?php echo __('Products'); ?></span></a></li>
                        <?php endif; ?>
                        <li class="<?= ($action == 'messages') ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'messages', 'action' => 'index')); ?>"><i class='fa fa-envelope'></i><span><?php echo __('Messages'); ?></span></a></li>
                        <li class="<?= ($action == 'tickets') ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'tickets', 'action' => 'index')); ?>"><i class='fa fa-ticket'></i><span><?php echo __('Tickets'); ?></span></a></li>
                        <li class="<?= ($action == 'notes') ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'notes', 'action' => 'index')); ?>"><i class='fa fa-thumb-tack'></i><span><?php echo __('Notes'); ?></span></a></li>
                        <li class="<?= ($action == 'todos') ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'todos', 'action' => 'index')); ?>"><i class='fa fa-check-square-o'></i><span><?php echo __('Todos'); ?></span></a></li>                   
                        <!-- if client -->
                    <?php } else { ?>
                        <li class="<?= ($action == 'deals') ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'deals', 'action' => 'client')); ?>"><i class='fa fa-rocket'></i><span><?php echo __('Deals'); ?></span></a> </li>
                        <li class="<?= ($action == 'invoices') ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'invoices', 'action' => 'index')); ?>"><i class='fa fa-file-text-o'></i><span><?php echo __('Invoices'); ?></span></a> </li>
                        <li class="<?= ($action == 'messages') ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'messages', 'action' => 'index')); ?>"><i class='fa fa-envelope'></i><span><?php echo __('Messages'); ?></span></a></li>
                        <li class="<?= ($action == 'tickets') ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'tickets', 'action' => 'index')); ?>"><i class='fa fa-ticket'></i><span><?php echo __('Tickets'); ?></span></a></li>
                        <li class="<?= ($action == 'notes') ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'notes', 'action' => 'index')); ?>"><i class='fa fa-thumb-tack'></i><span><?php echo __('Notes'); ?></span></a></li>
                        <li class="<?= ($action == 'todos') ? 'active' : 'nav-noactive' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'todos', 'action' => 'index')); ?>"><i class='fa fa-check-square-o'></i><span><?php echo __('Todos'); ?></span></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <!--End Left sidebar Menu Content -->
    </section>
    <!-- End Left sidebar Section -->
    <div id="nav-col-submenu"></div>
</div>