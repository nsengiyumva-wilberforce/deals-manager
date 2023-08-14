<?php
/**
 * View for user profile page for all user.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<?php $user = $this->request->data; ?>
<!-- Send Email Modal -->
<div class="modal fade" id="sendM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Send Message'); ?></h4>
            </div>
            <div class="modal-body">
                <?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'send_message'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm1')); ?>
                <div class="form-group">
                    <label><?php echo __('To') . ':'; ?></label>
                    <?php echo $this->Html->image('avatar/thumb/' . $user['User']['picture'], array('class' => 'img-circle circle-border modal-img')); ?>
                    <?= h($user['User']['first_name']) . ' ' . h($user['User']['last_name']); ?>
                    <?php echo $this->Form->input('Mail.to', array('type' => 'hidden', 'value' => $user['User']['email'])); ?>	
                </div>
                <div class="form-group">	
                    <?php echo $this->Form->input('Mail.subject', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Subject'))); ?>
                </div>
                <div class="form-group">									
                    <?php echo $this->Form->input('Mail.message', array('type' => 'textarea', 'class' => 'form-control', 'Placeholder' => __('Write a message'))); ?>
                </div>		
            </div>
            <div class="modal-footer">	
                <button type="submit" class="btn btn-primary blue"><i class='fa fa-envelope'></i> <?php echo __('Send'); ?></button>				
            </div>
            <?php echo $this->Form->end(); ?>	
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!-- /.modal -->

<!-- Content Section -->
<div class="profile-content">
    <div class="row profile-top">
        <div class="col-md-5">
            <div class="profile-image">
                <?php echo $this->Html->image('avatar/thumb/' . $user['User']['picture'], array('class' => 'img-circle circle-border m-b-md')); ?>                     
            </div>
            <div class="profile-info">
                <div>
                    <div>
                        <h2 class="no-margins">
                            <?= h($user['User']['first_name']) . ' ' . h($user['User']['last_name']); ?>
                        </h2>
                        <h4><label class="label label-warning"><?= h($user['User']['job_title']); ?></label></h4>
                        <!--small> Social Icons </small-->
                        <ul class="profile-social"> 
                            <?php if (!empty($user['UserDetail']['skype'])) : ?><li><a href="<?php echo h($user['UserDetail']['skype']); ?>" target="_blank"><i class="fa fa-skype fa-2x"></i></a></li><?php endif; ?>       
                            <?php if (!empty($user['UserDetail']['facebook'])) : ?><li><a href="<?php echo h($user['UserDetail']['facebook']); ?>" target="_blank"><i class="fa fa-facebook-square fa-2x"></i> </a></li> <?php endif; ?>
                            <?php if (!empty($user['UserDetail']['twitter'])) : ?><li><a href="<?php echo h($user['UserDetail']['twitter']); ?>" target="_blank"><i class="fa fa-twitter-square fa-2x"></i>  </a></li><?php endif; ?>
                            <?php if (!empty($user['UserDetail']['google_plus'])) : ?><li><a href="<?php echo h($user['UserDetail']['google_plus']); ?>" target="_blank"><i class="fa fa-google-plus-square fa-2x"></i> </a></li><?php endif; ?>
                            <?php if (!empty($user['UserDetail']['linkedin'])) : ?><li><a href="<?php echo h($user['UserDetail']['linkedin']); ?>" target="_blank"><i class="fa fa-linkedin-square fa-2x"></i>  </a></li><?php endif; ?>                          
                            <?php if (!empty($user['UserDetail']['youtube'])) : ?><li><a href="<?php echo h($user['UserDetail']['youtube']); ?>" target="_blank"><i class="fa fa-youtube-square fa-2x"></i> </a></li><?php endif; ?>
                            <?php if (!empty($user['UserDetail']['pinterest'])) : ?><li><a href="<?php echo h($user['UserDetail']['pinterest']); ?>" target="_blank"><i class="fa fa-pinterest-square fa-2x"></i> </a></li><?php endif; ?>   
                            <?php if (!empty($user['UserDetail']['tumblr'])) : ?><li><a href="<?php echo h($user['UserDetail']['tumblr']); ?>" target="_blank"><i class="fa fa-tumblr-square fa-2x"></i> </a></li><?php endif; ?>   
                            <?php if (!empty($user['UserDetail']['github'])) : ?><li><a href="<?php echo h($user['UserDetail']['github']); ?>" target="_blank"><i class="fa fa-github-square fa-2x"></i> </a></li><?php endif; ?>  
                            <?php if (!empty($user['UserDetail']['instagram'])) : ?><li><a href="<?php echo h($user['UserDetail']['instagram']); ?>" target="_blank"><i class="fa  fa-instagram fa-2x"></i> </a></li><?php endif; ?>    
                            <?php if (!empty($user['UserDetail']['digg'])) : ?><li><a href="<?php echo h($user['UserDetail']['digg']); ?>" target="_blank"><i class="fa fa-digg fa-2x"></i> </a></li><?php endif; ?> 
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <ul>                                   
                <li><i class="fa fa-envelope"></i> <?php echo h($user['User']['email']); ?> </li>
                <li><i class="fa fa-phone"></i> <?php echo h($user['UserDetail']['cellphone']); ?></li>
                <li><i class="fa fa-home"></i> <?php echo h($user['UserDetail']['location']); ?> </li>
                <li></li>
            </ul>                
        </div>
        <div class="col-md-2">
            <table class="table small m-b-xs">
                <tbody>
                    <tr>
                        <td><strong><?php echo $deals - ($wonDeals + $lossDeals); ?></strong> <?php echo __('Active Deals'); ?></td>
                    </tr>
                    <tr>
                        <td> <strong><?php echo $wonDeals; ?></strong> <?php echo __('Won Deals'); ?> </td>
                    </tr>
                    <tr>
                        <td><strong><?php echo $lossDeals; ?></strong> <?php echo __('Loss Deals'); ?> </td>

                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-2">
            <table class="table small m-b-xs">
                <tbody>
                    <tr><td><a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#sendM"><i class="fa fa-envelope"></i> <?php echo __('Send Email'); ?></a></td></tr>                 
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-7">
            <div class="main-box clearfix">
                <div class="tabs-wrapper profile-tabs">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#tab-profile"><?php echo __('General'); ?></a></li>
                        <li><a data-toggle="tab" href="#tab-picture"><?php echo __('Picture'); ?></a></li>                      
                        <li><a data-toggle="tab" href="#tab-social"><?php echo __('Social Links'); ?></a></li>
                        <li><a data-toggle="tab" href="#tab-password"><?php echo __('Change Password'); ?></a></li>
                    </ul>
                    <div class="tab-content">
                         <!-- Profile Tab -->
                        <div id="tab-profile" class="tab-pane clearfix fade active in">
                            <?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'profile'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm1')); ?>
                            <?php echo $this->Form->hidden('id'); ?>
                            <?php echo $this->Form->hidden('UserDetail.id'); ?>
                            <div class="form-group">
                                <label class="control-label"><?php echo __('First Name'); ?><span>*</span></label>
                                <?php echo $this->Form->input('first_name', array('class' => 'form-control')); ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?php echo __('Last Name'); ?><span>*</span></label>
                                <?php echo $this->Form->input('last_name', array('class' => 'form-control')); ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?php echo __('Job Title'); ?><span>*</span></label>
                                <?php echo $this->Form->input('job_title', array('class' => 'form-control')); ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?php echo __('About'); ?></label>
                                <?php echo $this->Form->input('UserDetail.about', array('class' => 'form-control')); ?>
                            </div>                                
                            <div class="form-group">
                                <label class="control-label"><?php echo __('Mobile Number'); ?></label>
                                <?php echo $this->Form->input('UserDetail.cellphone', array('class' => 'form-control', 'placeholder' => 'Cell Phone')); ?>					
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?php echo __('Gender'); ?></label>
                                <?php echo $this->Form->input('UserDetail.gender', array('type' => 'select', 'options' => array(1 => 'Male', 2 => 'Female'), 'class' => 'select-box-search full-width')); ?>					
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?php echo __('Location'); ?></label>
                                <?php echo $this->Form->input('UserDetail.location', array('class' => 'form-control')); ?>					
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?php echo __('Web Page'); ?></label>
                                <?php echo $this->Form->input('UserDetail.web_page', array('type' => 'text', 'class' => 'form-control')); ?>					
                            </div>
                            <?php if ($this->Common->isAdmin()) : ?>
                                <div class="form-group">
                                    <label class="control-label"><?php echo __('Status'); ?></label>
                                    <?php echo $this->Form->input('User.active', array('options' => array(1 => 'Active', 0 => 'Inactive'), 'class' => 'select-box-search full-width')); ?>
                                </div>
                                <div class="form-group">
                                    <label class="control-label"><?php echo __('Role'); ?></label>
                                    <?php echo $this->Form->input('User.role', array('options' => array($roles), 'class' => 'select-box-search full-width', 'empty' => __('Select Role'))); ?>
                                </div>
                            <?php endif; ?>
                            <div class="margiv-top-10">
                                <?php echo $this->Form->Submit(__('Save Changes'), array('class' => 'btn btn-primary blue')); ?>
                            </div>
                            <?php echo $this->Form->end(); ?>
                            <?php echo $this->Js->writeBuffer(); ?>
                        </div>
                        <!-- Change Picture Tab -->
                        <div id="tab-picture" class="tab-pane fade">
                            <?php echo $this->Form->create('User', array('url' => array('action' => 'picture'), 'type' => 'file')); ?>
                            <?php echo $this->Form->hidden('id', array('id' => 'userPicId')); ?>
                            <div class="form-group">
                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                    <div class="fileinput-new thumbnail thumb" >
                                        <?= $this->Html->image('avatar/thumb/' . $user['User']['picture']); ?>
                                    </div>
                                    <div class="fileinput-preview fileinput-exists thumbnail thumb profile-img">
                                    </div>
                                    <div>
                                        <span class="btn default btn-file">
                                            <span class="fileinput-new">
                                                <?php echo __('Select image'); ?>
                                            </span>
                                            <span class="fileinput-exists">
                                                <?php echo __('Change'); ?>
                                            </span>
                                            <input type="file" name="data[User][picture]" >
                                        </span>
                                        <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
                                            <?php echo __('Remove'); ?>
                                        </a>
                                    </div>
                                </div>	

                            </div>
                            <div class="margin-top-10">
                                <?php echo $this->Form->Submit(__('Save Picture'), array('class' => 'btn btn-primary blue')); ?>													
                            </div>
                            <?php echo $this->Form->end(); ?>
                            <?php echo $this->Js->writeBuffer(); ?>
                        </div>                       
                        <!-- Social Tab -->
                        <div id="tab-social" class="tab-pane clearfix fade">
                            <?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'profile'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm1', 'id' => 'userSocial')); ?>
                            <?php echo $this->Form->hidden('id', array('id' => 'userSocialId')); ?>
                            <?php echo $this->Form->hidden('UserDetail.id', array('id' => 'userDetId')); ?>
                            <div class="form-group">
                                <label class="control-label"><?php echo __('Skype'); ?></label>
                                <?php echo $this->Form->input('UserDetail.skype', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'smith.demo')); ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?php echo __('Facebook'); ?></label>
                                <?php echo $this->Form->input('UserDetail.facebook', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'https://facebook.com/')); ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?php echo __('Twitter'); ?></label>
                                <?php echo $this->Form->input('UserDetail.twitter', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'https://twitter.com/')); ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?php echo __('Google plus'); ?></label>
                                <?php echo $this->Form->input('UserDetail.google_plus', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'https://plus.google.com/')); ?>				   </div>                                
                            <div class="form-group">
                                <label class="control-label"><?php echo __('Linkedin'); ?></label>
                                <?php echo $this->Form->input('UserDetail.linkedin', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'http://linkedin.com/')); ?>					
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?php echo __('Youtube'); ?></label>
                                <?php echo $this->Form->input('UserDetail.youtube', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'http://youtube.com/')); ?>						
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?php echo __('Pinterest'); ?></label>
                                <?php echo $this->Form->input('UserDetail.pinterest', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'http://pinterest.com/')); ?>					
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?php echo __('Tumblr'); ?></label>
                                <?php echo $this->Form->input('UserDetail.tumblr', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'http://tumblr.com/')); ?>					
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?php echo __('Digg'); ?></label>
                                <?php echo $this->Form->input('UserDetail.digg', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'http://digg.com/')); ?>					
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?php echo __('Github'); ?></label>
                                <?php echo $this->Form->input('UserDetail.github', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'https://github.com/')); ?>					
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?php echo __('Instagram'); ?></label>
                                <?php echo $this->Form->input('UserDetail.instagram', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'https://instagram.com/')); ?>					
                            </div>
                            <div class="margiv-top-10">
                                <?php echo $this->Form->Submit('Save Changes', array('class' => 'btn btn-primary blue')); ?>
                            </div>
                            <?php echo $this->Form->end(); ?>
                            <?php echo $this->Js->writeBuffer(); ?>
                        </div>
                        <!-- Change Password Tab -->
                        <div id="tab-password" class="tab-pane fade">
                            <?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'cPassword'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
                            <?php echo $this->Form->hidden('id', array('id' => 'userPassId')); ?>
                            <div class="form-group">
                                <label class="control-label"><?php echo __('New Password'); ?></label>
                                <?php echo $this->Form->input('password', array('type' => 'password', 'class' => 'form-control', 'value' => '', 'autocomplete' => 'off')); ?>
                            </div>
                            <div class="form-group">
                                <label class="control-label"><?php echo __('Re-type New Password'); ?></label>
                                <?php echo $this->Form->input('cPassword', array('type' => 'password', 'class' => 'form-control')); ?>
                            </div>
                            <div class="margin-top-10">
                                <?php echo $this->Form->Submit('Change Password', array('class' => 'btn btn-primary blue')); ?>	
                            </div>
                            <?php echo $this->Form->end(); ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="main-box">
                <header class="main-box-header clearfix">
                    <h2 class="pull-left"><?php echo __('Activity'); ?></h2>
                </header>
                <div class="main-box-body clearfix profile-activity">
                    <div class="row">
                        <section class="cd-container" id="cd-timeline">
                            <?php echo $this->element('activity'); ?>
                        </section>
                        <?php echo $this->Form->input('totalTimeline', array('type' => 'hidden', 'value' => $total_pages)); ?>
                    </div>
                    <?php if (count($activity) == 10): ?>
                        <div class="load_button">
                            <button class="load_more btn btn-primary load_moreU"><i class="fa fa-arrow-down"></i> <?php echo __('Show More'); ?></button>
                            <div class="animation_image"><?php echo $this->Html->image('ajax-loader.gif'); ?> <?php echo __('Loading'); ?>...</div>

                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Content Section -->
<!--Theme jasny Jquery -->
<?php echo $this->Html->css('jasny-bootstrap.min.css'); ?>
<?php echo $this->Html->script('jasny-bootstrap.min.js'); ?>
<!-- End Theme jasny Jquery -->