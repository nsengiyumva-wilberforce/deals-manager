<?php
/**
 * view for pipelines home page for admin
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Add pipeline Modal --> 
<div class="modal fade" id="pipelineM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Add Pipeline'); ?></h4>
            </div>
            <?php echo $this->Form->create('Pipeline', array('url' => array('controller' => 'Pipelines', 'action' => 'add'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
            <div class="modal-body">													
                <div class="form-group">
                    <?php echo $this->Form->input('Pipeline.name', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Pipeline Name'), 'label' => false)); ?>	
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
<!-- Delete pipeline modal -->
<div class="modal fade" id="delPipeM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('Pipeline', array('url' => array('action' => 'delete'))); ?>
            <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p> <?php echo __('Are you sure to delete this Pipeline ? Make Sure Pipeline have no active deal.If have active deal move or delete that deals before delete pipeline.'); ?></p>
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
                    <h1 class="pull-left"><?php echo __('Pipeline'); ?></h1>
                    <div class="pull-right top-page-ui">
                        <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#pipelineM">
                            <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Add Pipeline'); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">					  
                    <div class="main-box-body clearfix">
                        <!-- Pipeline List -->
                        <div class="table-responsive">
                            <div class="table-scrollable">
                                <table class="table table-hover dataTable table-striped dataTables">
                                    <thead>
                                        <tr>
                                            <th><?php echo __('Name'); ?></th>
                                            <th><i class="fa fa-bars"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($pipelines)) :
                                            foreach ($pipelines as $row) :

                                                ?>
                                                <tr  id="<?php echo 'row' . h($row['Pipeline']['id']); ?>">
                                                    <td>
                                                        <a href="javascript:void(0)" ref="popover" data-content="Edit Name"  data-type="text" data-pk="<?php echo h($row['Pipeline']['id']); ?>" data-url="pipelines/edit"  class="editable editable-click vEdit"><?php echo h($row['Pipeline']['name']); ?></a>
                                                    </td>
                                                    <td> <?php if ($row['Pipeline']['id'] == $setting['Setting']['pipeline']) { ?>	
                                                            <a class="label label-warning manager-white" href="javascript:void(0)">
                                                                <?php echo __('Default Active'); ?>
                                                            </a>
                                                        <?php } else { ?>
                                                            <a class="label label-primary manager-white" href="<?php echo $this->Html->url(array("controller" => "pipelines", "action" => "permission", h($row['Pipeline']['id']))); ?>">
                                                                <i class="fa fa-unlock"></i>  <?php echo __('Permission'); ?>
                                                            </a>
                                                            <a class="table-link danger" href="#" data-toggle="modal" data-target="#delPipeM" ref="popover" data-content="Delete Pipeline" onclick="fieldU('PipelineId',<?php echo h($row['Pipeline']['id']); ?>)">
                                                                <i class="fa fa-trash-o"></i>
                                                            </a>
                                                        <?php } ?>

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
                        <!--End Pipeline List -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>