<?php
/**
 * Export view Page.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
?>
<!--Export Deal Modal  -->
<div class="modal fade" id="eDealM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Export Deals'); ?></h4>
            </div>
            <?php echo $this->Form->create('Export', array('url' => array('controller' => 'exports', 'action' => 'deals'), 'inputDefaults' => array('label' => false, 'div' => false))); ?>          
            <div class="modal-body">						
                <div class="form-group">
                    <label><?php echo __('Pipeline'); ?></label>
                    <?php echo $this->Form->input('Export.pipeline_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array($this->Common->getPipelineList()) )); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('Date Range'); ?></label>
                    <div class="row">                       
                        <div class="col-lg-6">
                            <?php echo $this->Form->input('Export.from_date', array('type' => 'text', 'class' => 'form-control input-inline input-medium datepickerDate')); ?>
                        </div>
                        <div class="col-lg-6">
                            <?php echo $this->Form->input('Export.to_date', array('type' => 'text', 'class' => 'form-control input-inline input-medium datepickerDate')); ?>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('Export.status', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array('' => __('All Deals'), '0' => __('Active Deals'), '1' => __('Won Deals'), '2' => __('Loss Deals') ))); ?>	
                </div>
            </div>
            <div class="modal-footer">
                <?php echo $this->Form->submit(__('Export'), array('class' => 'btn btn-primary')); ?>
            </div>
            <?php echo $this->Form->end(); ?>
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!--Export Task Modal  -->
<div class="modal fade" id="taskM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Export Task'); ?></h4>
            </div>
            <?php echo $this->Form->create('Export', array('url' => array('controller' => 'exports', 'action' => 'tasks'), 'inputDefaults' => array('label' => false, 'div' => false))); ?>          
            <div class="modal-body">
                 <?php if ($this->Common->isAdmin()): ?>
                <div class="form-group">
                    <label><?php echo __('Task Type'); ?></label>
                    <?php echo $this->Form->input('type', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array('1' => __('My Task'), '' => __('All Task') ))); ?>	
                </div>
                <?php  endif; ?>
                <div class="form-group">
                     <label><?php echo __('Date Range'); ?></label>
                <div class="row">                       
                    <div class="col-lg-6">
                        <?php echo $this->Form->input('Export.from_date', array('type' => 'text', 'class' => 'form-control input-inline input-medium datepickerDate','id'=>'datepickerDate-from')); ?>
                    </div>
                    <div class="col-lg-6">
                        <?php echo $this->Form->input('Export.to_date', array('type' => 'text', 'class' => 'form-control input-inline input-medium datepickerDate','id'=>'datepickerDate-to')); ?>
                    </div>

                </div> </div>
            </div>
            <div class="modal-footer">
                <?php echo $this->Form->submit(__('Export'), array('class' => 'btn btn-primary', 'div' => false)); ?>
            </div>
            <?php echo $this->Form->end(); ?>
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!--Export Contact Modal  -->
<div class="modal fade" id="contactM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Export Contacts'); ?></h4>
            </div>
            <?php echo $this->Form->create('Export', array('url' => array('controller' => 'exports', 'action' => 'contacts'))); ?>          
            <div class="modal-body">						
                <p><?php echo __('Export all contacts'); ?> </p>
            </div>
            <div class="modal-footer">
                <?php echo $this->Form->submit(__('Export'), array('class' => 'btn btn-primary', 'div' => false)); ?>
            </div>
            <?php echo $this->Form->end(); ?>
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!--Export Company Modal  -->
<div class="modal fade" id="companyM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Export Company'); ?></h4>
            </div>
            <?php echo $this->Form->create('Export', array('url' => array('controller' => 'exports', 'action' => 'company'))); ?>
            <div class="modal-body">						
                <p><?php echo __('Export all companies'); ?> </p>
            </div>
            <div class="modal-footer">
                <?php
                echo $this->Form->submit(__('Export'), array('class' => 'btn btn-primary', 'div' => false));
                ?>
            </div>
            <?php echo $this->Form->end(); ?>
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">
                    <h1 class="pull-left"><?php echo __('Export'); ?></h1>                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">					  
                    <div class="main-box-body clearfix">
                       <div class="row">
                        <!-- Export Deal Box -->
                        <div class="col-md-3 col-sm-6 col-xs-12 pricing-package col-md-offset-2">
                            <div class="pricing-package-inner">                             
                                <div class="package-content">
                                    <div class="package-price">   
                                        <span class="currency"><i class="fa fa-table"></i></span>
                                        <span class="price"><?php echo __('Deals'); ?></span>                                       
                                    </div>                                                                
                                    <div class="package-footer">
                                        <button class="btn btn-success" data-toggle="modal" data-target="#eDealM">
                                            <span class="fa fa-arrow-down fa-lg"></span> <?php echo __('Export'); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Export Deal Box -->
                        <!-- Export Task Box -->
                        <div class="col-md-3 col-sm-6 col-xs-12 pricing-package col-md-offset-1">
                            <div class="pricing-package-inner">                             
                                <div class="package-content">
                                    <div class="package-price green-bg"> 
                                        <span class="currency"><i class="fa fa-tasks"></i></span>
                                        <span class="price"><?php echo __('Task'); ?></span>                                       
                                    </div>                                                                
                                    <div class="package-footer">
                                        <button class="btn btn-success" data-toggle="modal" data-target="#taskM">
                                            <span class="fa fa-arrow-down fa-lg"></span> <?php echo __('Export'); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Export Task Box -->
                      </div>
                        <?php  if ($this->Common->isAdmin()): ?>
                        <div class="row">
                         <!-- Export Contact Box -->   
                        <div class="col-md-3 col-sm-6 col-xs-12 pricing-package col-md-offset-2">
                            <div class="pricing-package-inner">                             
                                <div class="package-content">
                                    <div class="package-price yellow-bg">
                                        <span class="currency"><i class="fa fa-users"></i></span>
                                        <span class="price"><?php echo __('Contacts'); ?></span>                                       
                                    </div>                                                                
                                    <div class="package-footer">
                                        <button class="btn btn-success" data-toggle="modal" data-target="#contactM">
                                            <span class="fa fa-arrow-down fa-lg"></span> <?php echo __('Export'); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Export Contact Box -->
                        <!-- Export Company Box -->
                        <div class="col-md-3 col-sm-6 col-xs-12 pricing-package col-md-offset-1">
                            <div class="pricing-package-inner">                             
                                <div class="package-content">
                                    <div class="package-price purple-bg">  
                                        <span class="currency"><i class="fa fa-building"></i></span>
                                        <span class="price"><?php echo __('Company'); ?></span>                                       
                                    </div>                                                                
                                    <div class="package-footer">
                                        <button class="btn btn-success" data-toggle="modal" data-target="#companyM">
                                            <span class="fa fa-arrow-down fa-lg"></span> <?php echo __('Export'); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--End Export Company Box -->
                      </div>                  
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>