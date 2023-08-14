<?php
/**
 * Setting page Side-bar for application
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div class="sidebar-nav">
    <div class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <span class="visible-xs navbar-brand"> <?php echo __('Settings'); ?></span>
        </div>
        <div class="navbar-collapse collapse sidebar-navbar-collapse">
            <ul class="nav navbar-nav">        
                <li class="<?= ($this->params['controller'] == 'settings' && ($this->params['action'] == 'index')) ? 'active' : '' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'settings', 'action' => 'index')); ?>"><span class="badge"><i class="fa fa-desktop"></i></span> <?php echo __('System settings'); ?></a></li>
                <li class="<?= ($this->params['controller'] == 'settings' && ($this->params['action'] == 'company')) ? 'active' : '' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'settings', 'action' => 'company')); ?>"><span class="badge"><i class="fa  fa-bolt"></i></span> <?php echo __('Company Details'); ?></a></li>
                <li class="<?= ($this->params['controller'] == 'users' && ($this->params['action'] == 'group')) ? 'active' : '' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'group')); ?>"><span class="badge"><i class="fa fa-windows"></i></span> <?php echo __('Groups'); ?></a></li>
                <li class="<?= ($this->params['controller'] == 'users' && ($this->params['action'] == 'role')) ? 'active' : '' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'role')); ?>"><span class="badge"><i class="fa fa-arrows"></i></span> <?php echo __('Roles'); ?></a></li>
                <li class="<?= ($this->params['controller'] == 'settings' && ($this->params['action'] == 'emails')) ? 'active' : '' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'settings', 'action' => 'emails')); ?>"><span class="badge"><i class="fa fa-envelope"></i></span> <?php echo __('Email Settings'); ?></a></li>
                <li class="<?= ($this->params['controller'] == 'customs' && ($this->params['action'] == 'index')) ? 'active' : '' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'customs', 'action' => 'index')); ?>"><span class="badge"><i class="fa fa-random"></i></span> <?php echo __('Custom Fields'); ?></a></li>
                <li class="<?= ($this->params['controller'] == 'settings' && ($this->params['action'] == 'ticket')) ? 'active' : '' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'settings', 'action' => 'ticket')); ?>"><span class="badge"><i class="fa fa-ticket"></i></span> <?php echo __('Ticket Departments'); ?></a></li>
                <li class="<?= ($this->params['controller'] == 'settings' && ($this->params['action'] == 'pipeline')) ? 'active' : '' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'settings', 'action' => 'pipeline')); ?>"><span class="badge"><i class="fa fa-filter"></i></span> <?php echo __('Pipeline'); ?></a></li>
                <li class="<?= ($this->params['controller'] == 'settings' && ($this->params['action'] == 'payment')) ? 'active' : '' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'settings', 'action' => 'payment')); ?>"><span class="badge"><i class="fa fa-shopping-cart"></i></span> <?php echo __('Payment Methods'); ?></a></li>
                <li class="<?= ($this->params['controller'] == 'settings' && ($this->params['action'] == 'expenses')) ? 'active' : '' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'settings', 'action' => 'expenses')); ?>"><span class="badge"><i class="fa fa-money"></i></span> <?php echo __('Expenses Category'); ?></a></li>
                <li class="<?= ($this->params['controller'] == 'settings' && ($this->params['action'] == 'backup')) ? 'active' : '' ?>"><a href="<?php echo $this->Html->url(array('controller' => 'settings', 'action' => 'backup')); ?>"><span class="badge"><i class="fa fa-database"></i></span> <?php echo __('Database Backup'); ?></a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</div>