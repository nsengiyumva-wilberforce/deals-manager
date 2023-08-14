<?php
/**
 * View for reports home page.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div class="row"> 
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">
                    <h1 class="pull-left"><?php echo __('Reports'); ?></h1>                  
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">					  
                    <div class="main-box-body clearfix">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="main-box no-header clearfix">					  
                                    <div class="main-box-body clearfix">
                                        <!--Filter form -->
                                        <?php echo $this->Form->create('Report', array('url' => array('controller' => 'Reports', 'action' => 'index'), 'inputDefaults' => array('label' => false, 'div' => false), 'id' => 'report-form')); ?>
                                        <div class="row">
                                            <div class="col-sm-3 form-group">
                                                <?php echo $this->Form->input('Report.pipeline_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array($this->Common->getPipelineList()), 'selected' => $pipelineId)); ?> 
                                            </div>
                                            <div class="col-sm-3 form-group">
                                                <?php echo $this->Form->input('Report.motive', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array('1' => __('Number of Active Deals'), '2' => __('Won Deals'), '3' => __('Lost Deals'), '4' => __('Price of Active Deals'), '5' => __('Price of Won Deals'), '6' => __('Price of Loss Deals')))); ?> 
                                            </div>
                                            <div class="col-sm-3 form-group">
                                                <?php echo $this->Form->input('Report.user_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $Users, 'empty' => __('All Users'))); ?> 
                                            </div>

                                            <div class="col-sm-3 form-group">
                                                <?php echo $this->Form->input('Report.product_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $Products, 'empty' => __('All Products'))); ?> 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-3 form-group">
                                                <?php echo $this->Form->input('Report.source_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $Sources, 'empty' => __('All Sources'))); ?> 
                                            </div>                                          
                                            <div class="col-sm-3 form-group">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                    <?php
                                                    $defaultDate = date("m/d/Y", strtotime("-1 month"));
                                                    echo $this->Form->input('Report.fromDate', array('type' => 'text', 'class' => 'form-control datepickerDates', 'id' => 'fromDate', 'value' => $defaultDate));

                                                    ?> 
                                                </div>
                                            </div>
                                            <div class="col-sm-3 form-group">
                                                <div class="input-group">    
                                                    <?php
                                                    $today = date("m/d/Y");
                                                    echo $this->Form->input('Report.toDate', array('type' => 'text', 'class' => 'form-control datepickerDate', 'id' => 'toDate', 'value' => $today));

                                                    ?> 
                                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                                </div>
                                            </div>
                                            <div class="col-sm-3 form-group">                                    
                                                <?php echo $this->Form->Submit(__('Report'), array('class' => 'btn btn-primary blue')); ?>
                                            </div>
                                        </div> 
                                        <?php echo $this->Form->end(); ?>	
                                        <?php echo $this->Js->writeBuffer(); ?>
                                        <!--End Filter form -->
                                        <!--Reports -->
                                        <div class="table-scrollable" id="report-div">
                                            <?php echo $this->element('reports'); ?>	
                                        </div>  
                                        <div class="alert alert-info">
                                            <?php echo __('Active deal calculated according to date deal created.'); ?> 
                                        </div>
                                        <!--End Reports -->
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
<!--Theme Chart Jquery -->
<?php echo $this->Html->script('highcharts.js'); ?>
<?php echo $this->Html->script('exporting.js'); ?>
<!--End Theme Chart Jquery -->