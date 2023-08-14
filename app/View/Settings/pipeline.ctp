<?php
/**
 * View for pipeline setting page.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Content -->
<div class="row"> 
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">
                    <h1 class="pull-left"><?php echo __('Pipeline Settings'); ?></h1>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Setting Sidebar -->
            <div class="col-sm-3">
                <?php echo $this->element('settings-sidebar'); ?>
            </div>
            <!-- /Setting Sidebar -->
            <div class="col-sm-9">
                <div class="main-box no-header clearfix">					  
                    <div class="main-box-body clearfix">
                        <?php echo $this->Form->create('Setting', array('url' => array('controller' => 'Settings', 'action' => 'pipeline'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'form-horizontal vForm', 'enctype' => 'multipart/form-data')); ?>                                               
                        <div class="form-group">
                            <label class="col-lg-3 control-label" ><?php echo __('Pipeline (Active)'); ?></label>
                            <div class="col-lg-9">                                       
                                <?php echo $this->Form->input('Setting.pipeline', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $this->Common->getPipelineList())); ?>
                            </div>
                        </div>
                        <div class="text-center">
                            <?php echo $this->Form->Submit(__('Save Changes'), array('class' => 'btn btn-primary blue', 'id' => 'addUserSubmitBtn', 'div' => false)); ?>					
                        </div>
                        <?php echo $this->Form->end(); ?>	
                        <?php echo $this->Js->writeBuffer(); ?>
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>
<!-- /Content -->