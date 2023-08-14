<?php
/**
 * View for Contact details page
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   http://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Edit Contact Modal --> 
<div class="modal fade modal-colum" id="editM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Edit Contact'); ?></h4>
            </div>
            <?php echo $this->Form->create('Contact', array('url' => array('controller' => 'contacts', 'action' => 'edit'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
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
                            <?php echo $this->Form->input('Contact.name', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Company Name'))); ?>	
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                                <?php echo $this->Form->input('Contact.phone', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Phone'))); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                <?php echo $this->Form->input('Contact.email', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Email'))); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Contact.title', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Title'))); ?>	
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Contact.address', array('type' => 'textarea', 'rows' => '3', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Address'))); ?>	
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Contact.city', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('City'))); ?>	
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Contact.state', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('State'))); ?>	
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Contact.zip_code', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Zip Code'))); ?>	
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Contact.country', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Country'))); ?>	
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Contact.location', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Location'))); ?>	
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Contact.company_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $companies, 'empty' => __('Select Company'))); ?>	
                        </div>
                        <div class="form-group">
                            <?php echo $this->Form->input('Contact.description', array('type' => 'textarea', 'rows' => '3', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Description'))); ?>	
                        </div>
                    </div>
                    <!-- Social Tab -->
                    <div id="tab-social" class="tab-pane fade"> 
                        <div class="form-group">
                            <label></label>
                            <?php echo $this->Form->input('Contact.website', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Contact Website'))); ?>	
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa  fa-facebook"></i></span>
                                <?php echo $this->Form->input('Contact.facebook', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'placeholder' => 'https://facebook.com/')); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-skype"></i></span>
                                <?php echo $this->Form->input('Contact.skype', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'placeholder' => 'demo.user')); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-linkedin"></i></span>
                                <?php echo $this->Form->input('Contact.linkedIn', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'placeholder' => 'http://linkedin.com/')); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-twitter"></i></span>
                                <?php echo $this->Form->input('Contact.twitter', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'placeholder' => 'https://twitter.com/')); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-youtube-square"></i></span>
                                <?php echo $this->Form->input('Contact.youtube', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'placeholder' => 'http://youtube.com/')); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-google-plus-square"></i></span>
                                <?php echo $this->Form->input('Contact.google_plus', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'placeholder' => 'https://plus.google.com/')); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-pinterest-square"></i></span>
                                <?php echo $this->Form->input('Contact.pinterest', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'placeholder' => 'http://pinterest.com/')); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-tumblr-square"></i></span>
                                <?php echo $this->Form->input('Contact.tumblr', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'placeholder' => 'http://tumblr.com/')); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-instagram"></i></span>
                                <?php echo $this->Form->input('Contact.instagram', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'placeholder' => 'https://instagram.com/')); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-github-square"></i></span>
                                <?php echo $this->Form->input('Contact.github', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'placeholder' => 'https://github.com/')); ?>	
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-digg"></i></span>
                                <?php echo $this->Form->input('Contact.digg', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'placeholder' => 'http://digg.com/')); ?>	
                            </div>
                        </div>
                    </div>
                    <!-- Deal Custom Field Tab -->
                    <div id="tab-custom" class="tab-pane fade">
                        <?php foreach ($custom as $row): ?>
                            <div class="form-group">
                                <label><?= h($row['Custom']['name']); ?></label>
                                <?php echo $this->Form->input('Custom.' . h($row['CustomContact']['id']), array('type' => ($row['Custom']['type'] == '2') ? 'textarea' : 'text', 'class' => 'form-control input-inline input-medium', 'value' => $row['CustomContact']['value'])); ?>	
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
<!-- Content -->
<div class="row company-view">
    <div class="col-lg-10">
        <div class="row">
            <div class="main-box no-header clearfix">	
                <div class="main-box-body clearfix">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="clearfix">
                                <h1 class="pull-left"><?= h($contact['Contact']['name']); ?></h1>
                                <?php if ($this->Common->isStaffPermission('13')): ?>
                                    <div class="pull-right top-page-ui">
                                        <a data-target="#editM" data-toggle="modal" href="#" class="btn btn-primary">
                                            <i class="fa fa-edit"></i> <?php __('Edit'); ?></a> 
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">                     
                        <div class="col-lg-5">
                            <dl class="dl-horizontal">
                                <dt><?php echo __('Title'); ?>:</dt> <dd><span class="label label-warning"><?= h($contact['Contact']['title']); ?></span></dd>
                                <dt><?php echo __('Email'); ?>:</dt> <dd><?= h($contact['Contact']['email']); ?></dd>
                                <dt><?php echo __('Address'); ?>:</dt> <dd>  <?= h($contact['Contact']['address']); ?></dd>
                                <dt><?php echo __('City'); ?>:</dt> <dd> <?= h($contact['Contact']['city']); ?> </dd>
                                <dt><?php echo __('State'); ?>:</dt> <dd> <?= h($contact['Contact']['state']); ?> </dd>
                                <dt><?php echo __('Zip Code'); ?>:</dt> <dd><?= h($contact['Contact']['zip_code']); ?> </dd>
                                <dt><?php echo __('Country'); ?>:</dt> <dd> <?= h($contact['Contact']['country']); ?> </dd>
                                <dt><?php echo __('Location'); ?>:</dt> <dd> <?= h($contact['Contact']['location']); ?> </dd>
                            </dl>
                        </div>
                        <div id="cluster_info" class="col-lg-7">
                            <dl class="dl-horizontal">
                                <dt><?php echo __('Phone'); ?>:</dt> <dd><?= h($contact['Contact']['phone']); ?></dd>
                                <dt><?php echo __('Website'); ?>:</dt> <dd> <?= h($contact['Contact']['website']); ?> </dd>
                                <!-- Custom Fields -->
                                <?php foreach ($custom as $row): ?>
                                    <dt><?php echo h($row['Custom']['name']); ?>:</dt> <dd> 	<?php echo h($row['CustomContact']['value']); ?> </dd>                     
                                <?php endforeach; ?>
                                <!-- /Custom Fields -->
                            </dl>
                        </div>
                        <div class="col-lg-12">
                            <ul class="company-view-social">
                                <?php if (!empty($contact['Contact']['skype'])) : ?> <li> <a href="<?php echo h($contact['Contact']['skype']); ?>" target="_blank"><i class="fa fa-skype fa-3x"></i>  </a></li><?php endif; ?>       
                                <?php if (!empty($contact['Contact']['facebook'])) : ?><li><a href="<?php echo h($contact['Contact']['facebook']); ?>" target="_blank"><i class="fa fa-facebook-square fa-3x"></i> </a> </li><?php endif; ?>
                                <?php if (!empty($contact['Contact']['twitter'])) : ?><li><a href="<?php echo h($contact['Contact']['twitter']); ?>" target="_blank"><i class="fa fa-twitter-square fa-3x"></i>  </a></li><?php endif; ?>
                                <?php if (!empty($contact['Contact']['google_plus'])) : ?><li><a href="<?php echo h($contact['Contact']['google_plus']); ?>" target="_blank"><i class="fa fa-google-plus-square fa-3x"></i> </a></li><?php endif; ?>
                                <?php if (!empty($contact['Contact']['linkedIn'])) : ?><li><a href="<?php echo h($contact['Contact']['linkedIn']); ?>" target="_blank"><i class="fa fa-linkedin-square fa-3x"></i>  </a></li><?php endif; ?>                          
                                <?php if (!empty($contact['Contact']['youtube'])) : ?><li><a href="<?php echo h($contact['Contact']['youtube']); ?>" target="_blank"><i class="fa fa-youtube-square fa-3x"></i> </a></li><?php endif; ?>
                                <?php if (!empty($contact['Contact']['pinterest'])) : ?><li><a href="<?php echo h($contact['Contact']['pinterest']); ?>" target="_blank"><i class="fa fa-pinterest-square fa-3x"></i> </a></li><?php endif; ?>   
                                <?php if (!empty($contact['Contact']['tumblr'])) : ?><li><a href="<?php echo h($contact['Contact']['tumblr']); ?>" target="_blank"><i class="fa fa-tumblr-square fa-3x"></i> </a></li><?php endif; ?>   
                                <?php if (!empty($contact['Contact']['github'])) : ?><li><a href="<?php echo h($contact['Contact']['github']); ?>" target="_blank"><i class="fa fa-github-square fa-3x"></i> </a></li><?php endif; ?>  
                                <?php if (!empty($contact['Contact']['instagram'])) : ?><li><a href="<?php echo h($contact['Contact']['instagram']); ?>" target="_blank"><i class="fa  fa-instagram fa-3x"></i> </a></li><?php endif; ?>    
                                <?php if (!empty($contact['Contact']['digg'])) : ?><li><a href="<?php echo h($contact['Contact']['digg']); ?>" target="_blank"><i class="fa fa-digg fa-3x"></i> </a></li><?php endif; ?> 
                            </ul>   
                        </div>    
                    </div>
                    <div class="row m-t-sm">
                        <div class="col-lg-12">
                            <div class="panel blank-panel">
                                <div class="panel-heading">
                                    <div class="panel-options">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#tab-1" aria-expanded="true"><?php echo __('Deals'); ?></a></li>
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
                                                        <th><?php echo __('Pipeline'); ?></th>
                                                        <th><?php echo __('Stage'); ?></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($deals as $row) : ?>
                                                        <tr>
                                                            <td><a href="<?php echo $this->Html->url(array('controller' => 'deals', 'action' => 'view', h($row['Deal']['id']))); ?>">  <?= h($row['Deal']['name']); ?></a></td>
                                                            <td><?= h($row['Pipeline']['name']); ?></td>
                                                            <td><?= h($row['Stage']['name']); ?></td>
                                                            <td><?php $this->Common->status($row['Deal']['status']); ?></td>
                                                        </tr>
                                                    <?php endforeach; ?>
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
    <div class="col-lg-2">
        <div class="wrapper wrapper-content contact-image-box">
            <?php echo $this->Form->create('Contact', array('type' => 'file', 'url' => array('action' => 'picture'), 'class' => 'text-center')); ?>
            <?php echo $this->Form->hidden('id', array('value' => h($contact['Contact']['id']))); ?>
            <div class="fileinput fileinput-new" data-provides="fileinput">
                <div class="fileinput-new" >
                    <?php $cImage = ($contact['Contact']['picture']) ? $contact['Contact']['picture'] : 'user.png'; ?>    
                    <?= $this->Html->image('contact/thumb/' . $cImage); ?>
                </div> 
                <div class="fileinput-preview fileinput-exists">
                </div>
                <?php if ($this->Common->isStaffPermission('13')): ?>
                    <div>
                        <span class="btn default btn-file">
                            <span class="fileinput-new"><?php echo __('Select image'); ?></span>
                            <span class="fileinput-exists"><?php echo __('Change'); ?></span>
                            <input type="file" name="data[Contact][picture]" >
                        </span>
                        <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput"><?php echo __('Remove'); ?></a>
                    </div>
                <?php endif; ?>
            </div>
            <?php if ($this->Common->isStaffPermission('13')): ?>
                <?php echo $this->Form->Submit(__('Change'), array('class' => 'btn btn-primary blue', 'id' => 'PicSubmitBtn')); ?>
            <?php endif; ?>
            <?php echo $this->Form->end(); ?>
            <?php echo $this->Js->writeBuffer(); ?>
            <br>
            <h4><?php echo __('Contact description'); ?> </h4>
            <p class="small"><?= $contact['Contact']['description']; ?></p>
        </div>     
    </div>
</div>
<!--Theme Jquery -->
<?php echo $this->Html->css('jasny-bootstrap.min.css'); ?>
<?php echo $this->Html->script('jasny-bootstrap.min.js'); ?>
<!--End Theme Jquery -->