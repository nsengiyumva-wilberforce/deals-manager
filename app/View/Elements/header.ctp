<?php
/**
 * Header of application.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<header class="navbar" id="header-navbar">
    <div class="container">
        <!-- Logo/Title -->
        <a href="<?php echo $this->Html->url(array('controller' => 'admins', 'action' => 'index')); ?>" id="logo" class="navbar-brand">
            <?php $this->Common->logo(); ?>
        </a>
        <!-- End Logo/Title -->
        <div class="clearfix">
            <!-- Sidebar Toggle button -->
            <button class="navbar-toggle" data-target=".navbar-ex1-collapse" data-toggle="collapse" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="fa fa-bars"></span>
            </button>
            <!--End Sidebar Toggle button -->
            <!-- Left Navigation -->
            <div class="nav-no-collapse navbar-left pull-left notf-menu">
                <ul class="nav navbar-nav pull-left">
                    <li>
                        <a class="btn" id="make-small-nav"><i class="fa fa-bars"></i></a>
                    </li>  
                    <?php if ($this->Common->isAdminStaff()): ?>
                        <li class="dropdown hidden-xs task-notification ">
                            <a data-toggle="dropdown" class="btn dropdown-toggle">
                                <i class="fa fa-bell"></i>
                                <span class="m-total"></span>
                            </a>
                            <ul class="dropdown-menu notifications-list">
                                <li class="pointer">
                                    <div class="pointer-inner">
                                        <div class="arrow"></div>
                                    </div>
                                </li> 
                                <li class="item-footer">
                                    <a href="<?php echo $this->Html->url(array('controller' => 'tasks', 'action' => 'index')); ?>"><?php echo __('View all Tasks'); ?></a>
                                </li>                            
                            </ul>
                        </li>
                    <?php endif; ?>

                    <li class="dropdown hidden-xs message-notification">
                        <a data-toggle="dropdown" class="btn dropdown-toggle">
                            <i class="fa fa-envelope-o"></i>
                            <span class="m-total"></span>
                        </a>
                        <ul class="dropdown-menu notifications-list messages-list">                          
                            <li class="pointer">
                                <div class="pointer-inner">
                                    <div class="arrow"></div>
                                </div>
                            </li>                            
                            <li class="item-footer">
                                <a href="<?php echo $this->Html->url(array('controller' => 'messages', 'action' => 'index')); ?>">
                                    <?php echo __('View all messages'); ?>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown hidden-xs">
                        <a href="<?php echo $this->Html->url(array('controller' => 'notes', 'action' => 'index')); ?>" class="btn <?= ($this->params['controller'] == 'notes') ? 'active' : '' ?>">
                            <i class="fa fa-thumb-tack"></i>
                            <span class="m-total"></span>
                        </a>
                    </li>
                    <li class="dropdown hidden-xs">
                        <a href="<?php echo $this->Html->url(array('controller' => 'todos', 'action' => 'index')); ?>" class="btn <?= ($this->params['controller'] == 'todos') ? 'active' : '' ?>">
                            <i class="fa fa-check-square-o"></i>
                            <span class="m-total"></span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- End Left Navigation -->
            <!-- Right Navigation -->
            <div class="nav-no-collapse pull-right" id="header-nav">
                <ul class="nav navbar-nav pull-right">
                    <li class="dropdown language-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="hidden-xs"><?php echo $this->Html->image('country/' . $this->Session->read('Auth.User.language') . '.png', array('alt' => 'language-image', 'class' => 'language-image')); ?></span> <b class="caret"></b>
                        </a>                      
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="javascript:void(0)" class="language-li" data-lng="zho"><?php echo $this->Html->image('country/zho.png', array('alt' => 'language-image', 'class' => 'language-image')); ?><span><?php echo __('Chinese'); ?></span></a></li>
                            <li><a href="javascript:void(0)" class="language-li" data-lng="nld"><?php echo $this->Html->image('country/nld.png', array('alt' => 'language-image', 'class' => 'language-image')); ?><span><?php echo __('Dutch'); ?></span></a></li>
                            <li><a href="javascript:void(0)" class="language-li" data-lng="en"><?php echo $this->Html->image('country/en.png', array('alt' => 'language-image', 'class' => 'language-image')); ?><span><?php echo __('English'); ?></span></a> </li>   
                            <li><a href="javascript:void(0)" class="language-li" data-lng="fra"><?php echo $this->Html->image('country/fra.png', array('alt' => 'language-image', 'class' => 'language-image')); ?><span><?php echo __('French'); ?></span></a></li>
                            <li><a href="javascript:void(0)" class="language-li" data-lng="deu"><?php echo $this->Html->image('country/deu.png', array('alt' => 'language-image', 'class' => 'language-image')); ?><span><?php echo __('German'); ?></span></a></li>
                            <li><a href="javascript:void(0)" class="language-li" data-lng="ell"><?php echo $this->Html->image('country/ell.png', array('alt' => 'language-image', 'class' => 'language-image')); ?><span><?php echo __('Greek'); ?></span></a></li>
                            <li><a href="javascript:void(0)" class="language-li" data-lng="ita"><?php echo $this->Html->image('country/ita.png', array('alt' => 'language-image', 'class' => 'language-image')); ?><span><?php echo __('Italian'); ?></span></a></li>
                            <li><a href="javascript:void(0)" class="language-li" data-lng="jpn"><?php echo $this->Html->image('country/jpn.png', array('alt' => 'language-image', 'class' => 'language-image')); ?><span><?php echo __('Japanese'); ?></span></a></li>
                            <li><a href="javascript:void(0)" class="language-li" data-lng="nor"><?php echo $this->Html->image('country/nor.png', array('alt' => 'language-image', 'class' => 'language-image')); ?><span><?php echo __('Norwegian'); ?></span></a></li>
                            <li><a href="javascript:void(0)" class="language-li" data-lng="por"><?php echo $this->Html->image('country/por.png', array('alt' => 'language-image', 'class' => 'language-image')); ?><span><?php echo __('Portuguese'); ?></span></a></li>
                            <li><a href="javascript:void(0)" class="language-li" data-lng="pol"><?php echo $this->Html->image('country/pol.png', array('alt' => 'language-image', 'class' => 'language-image')); ?><span><?php echo __('Polish'); ?></span></a></li>
                            <li><a href="javascript:void(0)" class="language-li" data-lng="rus"><?php echo $this->Html->image('country/rus.png', array('alt' => 'language-image', 'class' => 'language-image')); ?><span><?php echo __('Russian'); ?></span></a></li>
                            <li><a href="javascript:void(0)" class="language-li" data-lng="spa"><?php echo $this->Html->image('country/spa.png', array('alt' => 'language-image', 'class' => 'language-image')); ?><span><?php echo __('Spanish'); ?></span></a></li>                        
                        </ul>                       
                    </li>
                    <li class="dropdown profile-dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php echo $this->Html->image('avatar/thumb/' . $this->Session->read('Auth.User.picture')); ?>
                            <span class="hidden-xs"><?php echo $this->Session->read('Auth.User.name'); ?></span> <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'profile')); ?>"><i class='fa fa-user'></i><?php echo __('Profile'); ?></a> </li>
                            <li><a href="<?php echo $this->Html->url(array('controller' => 'messages', 'action' => 'index')); ?>"><i class='fa fa-envelope-o'></i><span><?php echo __('Messages'); ?></span></a></li>
                            <li><a href="<?php echo $this->Html->url(array('controller' => 'users', 'action' => 'logout')); ?>"><i class='fa fa-power-off'></i><span><?php echo __('Logout'); ?></span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- End Right Navigation -->
        </div>
    </div>
</header>