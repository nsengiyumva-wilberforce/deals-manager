<?php
/**
 * View for company home card list page
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   http://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?> 
<!-- Add company modal -->
<div class="modal fade" id="compM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Add Company'); ?></h4>
            </div>
            <?php echo $this->Form->create('Company', array('url' => array('controller' => 'Companies', 'action' => 'add'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
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
                        <div class="form-group">
                            <?php if ($this->Common->isAdmin()) : ?>
                                <label><?php echo __('Assign Group'); ?></label>
                                <select class="select-tags form-control w100" multiple="multiple" name="data[Company][groups][]">
                                    <?php foreach ($groups as $key => $value): ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php endforeach; ?> 
                                </select>
                                <?php
                            else:
                                echo $this->Form->input('Company.groups', array('type' => 'hidden', 'value' => $this->Session->read('Auth.User.group_id')));
                            endif;

                            ?>
                        </div>

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
                                <?php echo $this->Form->input('Custom.value' . $row['Custom']['id'], array('type' => ($row['Custom']['type'] == '2') ? 'textarea' : 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => '')); ?>	
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
<!-- Delete modal -->
<div class="modal fade" id="delM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('Company', array('url' => array('action' => 'delete'))); ?>
            <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p> <?php echo __('Are you sure to delete this company ?'); ?></p>
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
<!-- /Delete modal -->
<!-- Content -->
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">
                    <div class="col-md-3 col-xs-12">
                        <h1 class="pull-left"><?php echo __('Companies'); ?></h1>
                    </div>
                    <div class="col-md-4 col-xs-12">
                        <?php if ($this->Common->isAdmin()) : ?>
                            <a class="btn btn-sm btn-warning" href="<?php echo $this->Html->url(array("controller" => "companies", "action" => "import")); ?>" >
                                <i class="fa fa-upload"></i> <?php echo __('Import Company'); ?>
                            </a> 
                        <?php endif; ?>
                        <div class="btn-group pull-right" role="group">
                            <button type="button" class="btn btn-primary btn-sm active mr-1" ref='popover' data-content="<?php echo __('Card View'); ?>"><i class="fa fa-th-large"></i></button>
                            <a href="<?php echo $this->Html->url(array("controller" => "companies", "action" => "lists")); ?>" class="btn btn-white btn-sm" ref='popover' data-content="<?php echo __('List View'); ?>"><i class="fa fa-bars"></i></a>                
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <?php echo $this->Form->input('company_id', array('type' => 'text', 'class' => 'form-control search-data', 'placeholder' => __('Search Companies'), 'data-name' => 'companies', 'label' => false, 'div' => false)); ?>            
                    </div>
                    <div class="col-md-2 col-xs-12">
                        <div class="pull-right top-page-ui">
                            <?php if ($this->Common->isStaffPermission('22')): ?>
                                <a class="btn btn-sm btn-primary" href="#" data-toggle="modal" data-target="#compM">
                                    <i class="fa fa-plus-circle"></i> <?php echo __('Add Company'); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="clearfix">
                    <ul class="contact-letters">
                        <li><a href="javascript:void(0)" class="contact-letter" data-id="companies"><?php echo __('All'); ?></a></li>
                        <?php foreach (range('A', 'Z') as $char): ?>
                            <li><a href="javascript:void(0)" class="contact-letter" data-id="companies"><?php echo h($char); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12" id="contacts-div">             
                <!-- Company List -->                            
                <div class="contact-list">
                    <?php echo $this->element('company'); ?>
                </div>
                <?php echo $this->Form->input('letter', array('type' => 'hidden', 'value' => h($letter))); ?>
                <?php echo $this->Form->input('number', array('type' => 'hidden', 'value' => 2)); ?>
                <?php echo $this->Form->input('totalPages', array('type' => 'hidden', 'value' => h($total_pages))); ?>
                <!--End Company List -->
                <?php if (count($companies) == 15): ?>
                    <div class="manager-bottom">
                        <button class="load_contact btn btn-primary" data-id="companies"><?php echo __('Load More'); ?></button>
                        <div class="animation_image"><?php echo $this->Html->image('ajax-loader.gif'); ?><?php echo __('Loading'); ?>...</div>
                    </div>
                <?php endif; ?>
            </div>
        </div>						
    </div>
</div>