<?php
/**
 * View for forgot password page
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <!-- Login Box-->
            <div id="login-box">
                <div id="login-box-holder">
                    <div class="row">
                        <div class="col-xs-12">
                            <!-- Logo/Title Section -->
                            <header id="login-header">
                                <div id="login-logo"><?php $this->Common->logo(h($settings['Setting']['title']), h($settings['Setting']['title_logo']), h($settings['Setting']['title_text'])); ?></div>
                            </header>
                            <!--End Logo/Title Section -->
                            <div id="login-box-inner">                                
                                <?php if ($this->session->check('Message.flash')) { ?>
                                    <!-- Alert Message -->
                                    <div role="alert" class="alert alert-info">
                                        <?php echo $this->Session->flash(); ?>
                                    </div>
                                    <!--End Alert Message -->
                                <?php } ?>                              
                                <h4>Forgot your password?</h4>
                                <p>Enter your email address to recover your password.</p>
                                <!-- Forgot Password Form -->
                                <?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'forgotPassword'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'form-horizontal', 'id' => 'UserLoginForm'), array('role' => 'form', 'method' => 'post')); ?>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                                    <?php echo $this->Form->input('User.email', array('type' => 'text', 'class' => 'form-control', 'Placeholder' => 'Email Address')); ?>
                                </div>	
                                <div class="row">
                                    <div class="col-xs-12">
                                        <button type="submit" class="btn btn-success col-xs-12">Reset password</button>
                                    </div>
                                    <div class="col-xs-12">
                                        <br>
                                        <?php echo $this->Html->link('Back to login', array('controller' => 'users', 'action' => 'login'), array('class' => 'forgot-link col-xs-12', 'id' => 'login-forget-link')); ?>  
                                    </div>
                                </div>
                                <?php $this->Form->end(); ?>
                                <!-- End Forgot Password Form -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End Login Box-->
        </div>
    </div>
</div>