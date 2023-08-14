<?php
/**
 * View for company list page
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!--Add Company Modal --> 
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
                                        <option value="<?php echo h($key); ?>"><?php echo h($value); ?></option>
                                    <?php endforeach; ?> 
                                </select>
                                <?php
                            else:
                                echo $this->Form->input('Company.groups', array('type' => 'hidden', 'value' => h($this->Session->read('Auth.User.group_id'))));
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
                                <?php echo $this->Form->input('Custom.value' . h($row['Custom']['id']), array('type' => ($row['Custom']['type'] == '2') ? 'textarea' : 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => '')); ?>	
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
<div class="modal fade" id="delCompanyM">
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
                    <div class="col-md-4 col-xs-12">
                        <h1 class="pull-left"><?php echo __('Companies'); ?></h1>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <a class="btn btn-sm btn-warning" href="<?php echo $this->Html->url(array("controller" => "companies", "action" => "import")); ?>" >
                            <i class="fa fa-upload"></i> <?php echo __('Import Company'); ?>
                        </a> 
                        <div class="btn-group pull-right" role="group">
                            <a href="<?php echo $this->Html->url(array("controller" => "companies", "action" => "index")); ?>" class="btn btn-white btn-sm" ref='popover' data-content="<?php echo __('Card View'); ?>"><i class="fa fa-th-large"></i></a>                
                            <button type="button" class="btn btn-primary btn-sm active" ref='popover' data-content="<?php echo __('List View'); ?>"><i class="fa fa-bars"></i></button>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <?php echo $this->Form->input('company_id', array('type' => 'text', 'class' => 'form-control search-data', 'placeholder' => __('Quick Search Companies'), 'data-name' => 'companies', 'label' => false, 'div' => false)); ?>            
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
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">					  
                    <div class="main-box-body clearfix">
                        <!-- Company List -->
                        <div class="table-responsive">
                            <div class="table-scrollable">
                                <table class="table table-hover dataTable dataTables">
                                    <thead>
                                        <tr>
                                            <th><?php echo __('Name'); ?></th>
                                            <th><?php echo __('Phone'); ?></th>
                                            <th><?php echo __('Email'); ?></th>
                                            <th><?php echo __('Address'); ?></th>
                                            <th><?php echo __('Website'); ?></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($companies)) :

                                            foreach ($companies as $row) :

                                                ?>
                                                <tr id="<?php echo 'row' . h($row['Company']['id']); ?>">
                                                    <td><?= h($row['Company']['name']); ?></a></td>
                                                    <td><?= h($row['Company']['phone']); ?></a></td>
                                                    <td><?= h($row['Company']['email']); ?></a> </td>
                                                    <td><?= h($row['Company']['address']); ?></a> </td>
                                                    <td><?= h($row['Company']['website']); ?></a> </td>                   
                                                    <td> 
                                                        <a class="table-link" href="<?php echo $this->Html->url(array("controller" => "companies", "action" => "view", h($row['Company']['id']))); ?>">                                      
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <?php if ($this->Common->isStaffPermission('24')): ?>   
                                                            <a class="table-link danger" href="#" data-toggle="modal" data-target="#delCompanyM" onclick="fieldU('CompanyId',<?php echo h($row['Company']['id']); ?>)">
                                                                <i class="fa fa-trash-o"></i>  
                                                            </a>
                                                        <?php endif; ?>
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
                        <!--End Company List -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>