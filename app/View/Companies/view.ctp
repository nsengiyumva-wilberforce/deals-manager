<?php
/**
 * View for company details page
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Add Company Modal --> 
<div class="modal fade" id="compM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Edit Company'); ?></h4>
            </div>
            <?php echo $this->Form->create('Company', array('url' => array('controller' => 'Companies', 'action' => 'edit'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
            <div class="modal-body tab-modal">
                <!-- Tabs -->
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#tab-contact"><?php echo __('Basic Details'); ?></a></li>
                    <li><a data-toggle="tab" href="#tab-social"><?php echo __('Social'); ?></a></li>
                    <li><a data-toggle="tab" href="#tab-custom"><?php echo __('Custom Fields'); ?></a></li>
                </ul>
                <div class="tab-content">
                    <!-- company details Tab -->
                    <div id="tab-contact" class="tab-pane fade active in">
                        <div class="form-group">
                            <label></label>
                            <?php echo $this->Form->input('Company.name', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Company Name'))); ?>	
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <?php echo $this->Form->input('Company.phone', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Phone'))); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <?php echo $this->Form->input('Company.email', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Email'))); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Company.address', array('type' => 'textarea', 'rows' => '3', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Address'))); ?>	
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Company.city', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('City'))); ?>	
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Company.state', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('State'))); ?>	
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Company.zip_code', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Zip Code'))); ?>	
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Company.country', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Country'))); ?>	
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Company.description', array('type' => 'textarea', 'rows' => '3', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Description'))); ?>	
                        </div>
                        <?php if ($this->Common->isAdmin()): ?>
                            <div class="form-group">
                                <?php $gps = explode(',', $company['Company']['groups']); ?>
                                <label><?php echo __('Assign Group'); ?></label>
                                <select class="select-tags form-control w100" multiple="multiple" name="data[Company][groups][]">
                                    <?php foreach ($groups as $key => $value): ?>
                                        <option value="<?php echo h($key); ?>" <?php
                                        if (in_array($key, $gps)) {
                                            echo 'selected';
                                        }

                                        ?> ><?php echo h($value); ?></option>
                                            <?php endforeach; ?> 
                                </select>
                            </div>
                        <?php endif; ?>
                    </div>
                    <!-- Social Tab -->
                    <div id="tab-social" class="tab-pane fade"> 
                        <div class="form-group">
                            <label></label>
                            <?php echo $this->Form->input('Company.website', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Company Website'))); ?>	
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa  fa-facebook"></i></span>
                                <?php echo $this->Form->input('Company.facebook', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'placeholder' => 'https://facebook.com/')); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-skype"></i></span>
                                <?php echo $this->Form->input('Company.skype', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'placeholder' => 'demo.user')); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-linkedin"></i></span>
                                <?php echo $this->Form->input('Company.linkedIn', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'placeholder' => 'http://linkedin.com/')); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-twitter"></i></span>
                                <?php echo $this->Form->input('Company.twitter', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'placeholder' => 'https://twitter.com/')); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-youtube-square"></i></span>
                                <?php echo $this->Form->input('Company.youtube', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'placeholder' => 'http://youtube.com/')); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-google-plus-square"></i></span>
                                <?php echo $this->Form->input('Company.google_plus', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'placeholder' => 'https://plus.google.com/')); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-pinterest-square"></i></span>
                                <?php echo $this->Form->input('Company.pinterest', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'placeholder' => 'http://pinterest.com/')); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tumblr-square"></i></span>
                                <?php echo $this->Form->input('Company.tumblr', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'placeholder' => 'http://tumblr.com/')); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-instagram"></i></span>
                                <?php echo $this->Form->input('Company.instagram', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'placeholder' => 'https://instagram.com/')); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-github-square"></i></span>
                                <?php echo $this->Form->input('Company.github', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'placeholder' => 'https://github.com/')); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-digg"></i></span>
                                <?php echo $this->Form->input('Company.digg', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'placeholder' => 'http://digg.com/')); ?>	
                            </div>
                        </div>
                    </div>
                    <!-- Deal Custom Field Tab -->
                    <div id="tab-custom" class="tab-pane fade">
                        <?php foreach ($custom as $row): ?>
                            <div class="form-group">
                                <label><?= h($row['Custom']['name']); ?></label>
                                <?php echo $this->Form->input('Custom.' . h($row['CustomCompany']['id']), array('type' => ($row['Custom']['type'] == '2') ? 'textarea' : 'text', 'class' => 'form-control input-inline input-medium', 'value' => h($row['CustomCompany']['value']))); ?>	
                            </div>
                        <?php endforeach; ?>                      
                    </div> 
                </div> 

            </div>
            <div class="modal-footer">			
                <button class="btn btn-primary blue btn-sm" type="submit"><i class="fa fa-check"></i> <?php echo __('Save'); ?></button>
                <button class="btn default btn-sm" data-dismiss="modal" type="button"><i class="fa fa-times"></i> <?php echo __('Close'); ?></button>
            </div>
            <?php echo $this->Form->end(); ?>	
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!-- /.modal -->
<!-- Add Client Modal -->
<div class="modal fade" id="addM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Add Client'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="error-Msg"></div>
                <?php echo $this->Form->create('User', array('url' => array('controller' => 'users', 'action' => 'add'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'userForm')); ?>
                <?php echo $this->Form->input('user_group_id', array('type' => 'hidden', 'value' => '4')); ?>
                <?php echo $this->Form->input('User.company_id', array('type' => 'hidden', 'value' => h($company['Company']['id']))); ?>
                <?php echo $this->Form->input('User.job_title', array('type' => 'hidden', 'value' => 'Client')); ?>
                <div class="form-group">
                    <label><?php echo __('First Name'); ?></label>
                    <?php echo $this->Form->input('User.first_name', array('type' => 'text', 'class' => 'form-control input-inline input-medium')); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('Last Name'); ?></label>
                    <?php echo $this->Form->input('User.last_name', array('type' => 'text', 'class' => 'form-control input-inline input-medium')); ?>
                </div>
                <div class="form-group">
                    <label><?php echo __('Email'); ?></label>
                    <?php echo $this->Form->input('User.email', array('type' => 'text', 'class' => 'form-control')); ?>
                </div>
                <div class="form-group">
                    <label><?php echo __('Password'); ?></label>
                    <?php echo $this->Form->input('User.password', array('type' => 'password', 'class' => 'form-control')); ?>
                </div>
            </div>
            <div class="modal-footer">			
                <button class="btn btn-primary blue btn-sm" type="submit"><i class="fa fa-check"></i> <?php echo __('Save'); ?></button>
                <button class="btn default btn-sm" data-dismiss="modal" type="button"><i class="fa fa-times"></i> <?php echo __('Close'); ?></button>
            </div>
            <?php echo $this->Form->end(); ?>	
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!-- /.modal -->
<!-- Delete Client modal -->
<div class="modal fade" id="delM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('User', array('url' => array('action' => 'delete'))); ?>
            <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p><?php echo __('Are you sure to delete this client ? All data related to this user also deleted.'); ?> </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary delSubmit"  type="button"><?php echo __('Yes'); ?></button>
                <button class="btn default" data-dismiss="modal" type="button"><?php echo __('No'); ?></button>               
            </div>
            <?php echo $this->Form->end(); ?>
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!-- Content -->
<div class="row company-view">
    <div class="col-lg-9">
        <div class="row">
            <div class="main-box no-header clearfix">	
                <div class="main-box-body clearfix">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="clearfix">
                                <h1 class="pull-left"><?= h($company['Company']['name']); ?></h1>
                                <?php if ($this->Common->isStaffPermission('23')): ?>
                                    <div class="pull-right top-page-ui">
                                        <a data-target="#addM" data-toggle="modal" href="#" class="btn btn-primary ">
                                            <i class="fa fa-plus"></i> <?php echo __('Add Client'); ?></a>
                                        <a data-target="#compM" data-toggle="modal" href="#" class="btn btn-primary">
                                            <i class="fa fa-edit"></i> <?php echo __('Edit'); ?></a> 
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5">
                            <dl class="dl-horizontal">
                                <dt><?php echo __('Email'); ?>:</dt> <dd><?= h($company['Company']['email']); ?></dd>
                                <dt><?php echo __('Address'); ?>:</dt> <dd>  <?= h($company['Company']['address']); ?></dd>
                                <dt><?php echo __('City'); ?>:</dt> <dd> <?= h($company['Company']['city']); ?> </dd>
                                <dt><?php echo __('State'); ?>:</dt> <dd> <?= h($company['Company']['state']); ?> </dd>
                                <dt><?php echo __('Zip Code'); ?>:</dt> <dd><?= h($company['Company']['zip_code']); ?> </dd>
                                <dt><?php echo __('Country'); ?>:</dt> <dd> <?= h($company['Company']['country']); ?> </dd>
                                <?php if ($this->Common->isAdmin()): ?>
                                    <dt><?php echo __('Groups'); ?>:</dt> <dd>
                                        <?php
                                        foreach ($groups as $key => $value):
                                            if (in_array($key, $gps)) :
                                                echo '<span class="label label-sm label-warning">' . h($value) . '</span>&nbsp;';
                                            endif;
                                        endforeach;

                                        ?>
                                    </dd>
                                <?php endif; ?>
                            </dl>
                        </div>
                        <div id="cluster_info" class="col-lg-7">
                            <dl class="dl-horizontal">
                                <dt><?php echo __('Phone'); ?>:</dt> <dd><?= h($company['Company']['phone']); ?></dd>
                                <dt><?php echo __('Website'); ?>:</dt> <dd> <?= h($company['Company']['website']); ?> </dd>
                                <!-- Custom Fields -->
                                <?php foreach ($custom as $row): ?>
                                    <dt><?php echo h($row['Custom']['name']); ?>:</dt> <dd> 	<?php echo h($row['CustomCompany']['value']); ?> </dd>                     
                                <?php endforeach; ?>
                                <!-- /Custom Fields -->

                            </dl>
                        </div>
                        <div class="col-lg-12">
                            <ul class="company-view-social">
                                <?php if (!empty($company['Company']['skype'])) : ?> <li> <a href="<?php echo h($company['Company']['skype']); ?>" target="_blank"><i class="fa fa-skype fa-3x"></i>  </a></li><?php endif; ?>       
                                <?php if (!empty($company['Company']['facebook'])) : ?><li><a href="<?php echo h($company['Company']['facebook']); ?>" target="_blank"><i class="fa fa-facebook-square fa-3x"></i> </a> </li><?php endif; ?>
                                <?php if (!empty($company['Company']['twitter'])) : ?><li><a href="<?php echo h($company['Company']['twitter']); ?>" target="_blank"><i class="fa fa-twitter-square fa-3x"></i>  </a></li><?php endif; ?>
                                <?php if (!empty($company['Company']['google_plus'])) : ?><li><a href="<?php echo h($company['Company']['google_plus']); ?>" target="_blank"><i class="fa fa-google-plus-square fa-3x"></i> </a></li><?php endif; ?>
                                <?php if (!empty($company['Company']['linkedIn'])) : ?><li><a href="<?php echo h($company['Company']['linkedIn']); ?>" target="_blank"><i class="fa fa-linkedin-square fa-3x"></i>  </a></li><?php endif; ?>                          
                                <?php if (!empty($company['Company']['youtube'])) : ?><li><a href="<?php echo h($company['Company']['youtube']); ?>" target="_blank"><i class="fa fa-youtube-square fa-3x"></i> </a></li><?php endif; ?>
                                <?php if (!empty($company['Company']['pinterest'])) : ?><li><a href="<?php echo h($company['Company']['pinterest']); ?>" target="_blank"><i class="fa fa-pinterest-square fa-3x"></i> </a></li><?php endif; ?>   
                                <?php if (!empty($company['Company']['tumblr'])) : ?><li><a href="<?php echo h($company['Company']['tumblr']); ?>" target="_blank"><i class="fa fa-tumblr-square fa-3x"></i> </a></li><?php endif; ?>   
                                <?php if (!empty($company['Company']['github'])) : ?><li><a href="<?php echo h($company['Company']['github']); ?>" target="_blank"><i class="fa fa-github-square fa-3x"></i> </a></li><?php endif; ?>  
                                <?php if (!empty($company['Company']['instagram'])) : ?><li><a href="<?php echo h($company['Company']['instagram']); ?>" target="_blank"><i class="fa  fa-instagram fa-3x"></i> </a></li><?php endif; ?>    
                                <?php if (!empty($company['Company']['digg'])) : ?><li><a href="<?php echo h($company['Company']['digg']); ?>" target="_blank"><i class="fa fa-digg fa-3x"></i> </a></li><?php endif; ?>
                            </ul>   
                        </div>    
                    </div>
                    <div class="row m-t-sm">
                        <div class="col-lg-12">
                            <div class="panel blank-panel">
                                <div class="panel-heading">
                                    <div class="panel-options">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"><?php echo __('Clients'); ?></a></li>
                                            <li class=""><a data-toggle="tab" href="#tab-2" aria-expanded="false"><?php echo __('Invoices'); ?></a></li>
                                            <li class=""><a data-toggle="tab" href="#tab-3" aria-expanded="false"><?php echo __('Deals'); ?></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="tab-content">
                                        <div id="tab-1" class="tab-pane active">
                                            <table class="table table-striped user-list">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo __('Name'); ?></th>
                                                        <th><?php echo __('Email'); ?></th>
                                                        <th><?php echo __('Status'); ?></th>
                                                        <th><?php echo __('Created'); ?></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($clients as $row) :

                                                        ?>
                                                        <tr  id="<?php echo 'row' . h($row['User']['id']); ?>">
                                                            <td>                               
                                                                <?php echo $this->Html->image('avatar/thumb/' . h($row['User']['picture'])); ?>
                                                                <?php echo $this->Html->link(h($row['User']['name']), array('controller' => 'users', 'action' => 'profile', h($row['User']['id'])), array('escape' => false, 'class' => 'user-link')); ?>
                                                            </td>
                                                            <td> <?= h($row['User']['email']); ?>	</td>
                                                            <td><?php echo ($row['User']['active'] == 1) ? "<span class='label label-sm label-success'>" . __('Active') . "</span>" : "<span class='label label-sm label-danger'>" . __('Inactive') . "</span>"; ?> </td>
                                                            <td><?php echo $this->Time->format($this->Common->dateTime(), h($row['User']['created'])); ?> </td>
                                                            <td>
                                                                <a class="table-link" href="<?php echo $this->Html->url(array("controller" => "users", "action" => "profile", h($row['User']['id']))); ?>"><i class="fa fa-eye fa-lg"></i></a>
                                                                <a class="table-link danger" href="#" data-toggle="modal" data-target="#delM" onclick="fieldU('UserId',<?php echo h($row['User']['id']); ?>)"><i class="fa fa-trash-o fa-lg"></i> </a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div id="tab-2" class="tab-pane">
                                            <table class="table table-striped user-list">
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
                                                    <?php foreach ($invoices as $row) :

                                                        ?>
                                                        <tr>
                                                            <td><a class="table-link" href="<?php echo $this->Html->url(array("controller" => "invoices", "action" => "view", h($row['Invoice']['id']))); ?>"><?php
                                                                    echo "INV" . sprintf("%04d", h($row['Invoice']['custom_id']));
                                                                    ;

                                                                    ?></a></td>
                                                            <td><?php echo $this->Time->format($this->Common->dateShow(), h($row['Invoice']['issue_date'])); ?></td>
                                                            <td><?php echo $this->Time->format($this->Common->dateShow(), h($row['Invoice']['due_date'])); ?></td>
                                                            <td><?php echo h($row['Invoice']['currency']) . '' . h($row['Invoice']['amount']); ?></td>
                                                            <td><?php $this->Common->invoice_status($row['Invoice']['status']); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div id="tab-3" class="tab-pane">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th><span><?php echo __('Name'); ?></span></th>
                                                        <th><span><?php echo __('Pipeline'); ?></span></th>
                                                        <th><span><?php echo __('Stage'); ?></span></th>
                                                        <th><span></span></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($deals):
                                                        foreach ($deals as $row):

                                                            ?>
                                                            <tr>
                                                                <td>
                                                                    <a href="<?php echo $this->Html->url(array('controller' => 'deals', 'action' => 'view', h($row['Deal']['id']))); ?>">  <?= h($row['Deal']['name']); ?></a>
                                                                </td>                                       
                                                                <td><?= h($row['Pipeline']['name']); ?></td>
                                                                <td><?= h($row['Stage']['name']); ?></td>
                                                                <td><?php $this->Common->status($row['Deal']['status']); ?></td>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>						
    </div>
    <div class="col-lg-3">
        <div class="wrapper wrapper-content project-manager">
            <h4><?php echo __('Company description'); ?></h4>
            <p class="small"><?= h($company['Company']['description']); ?></p>
            <h4><?php echo __('Contacts'); ?></h4>
            <?php
            if (!empty($contacts)) {
                foreach ($contacts as $row) {

                    ?>
                    <div class="col-lg-12" id="<?php echo 'row' . h($row['Contact']['id']); ?>">
                        <div class="main-box clearfix profile-box-contact">
                            <div class="main-box-body clearfix">
                                <a href="<?php echo $this->webroot; ?>contacts/view/<?= h($row['Contact']['id']); ?>">
                                    <div class="profile-box-header contact-box-list clearfix">
                                        <div class="col-sm-4">
                                            <div class="text-center">
                                                <?php $cImage = ($row['Contact']['picture']) ? h($row['Contact']['picture']) : 'user.png'; ?>    
                                                <?= $this->Html->image('contact/thumb/' . $cImage, array('class' => 'img-circle m-t-xs ')); ?>
                                                <div class="m-t-xs font-bold"><h5><?= h($row['Contact']['title']); ?></h5></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
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
                }
            }

            ?>  
        </div>
    </div>
</div>