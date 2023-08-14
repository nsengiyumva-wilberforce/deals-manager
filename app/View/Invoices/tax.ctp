<?php
/**
 * List of tax rates for invoices
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Add Tax Modal --> 
<div class="modal fade" id="taxM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Add Tax Rate'); ?></h4>
            </div>
            <?php echo $this->Form->create('Invoice', array('url' => array('controller' => 'invoices', 'action' => 'tax'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label><?php echo __('Tax Rate Name'); ?></label>
                    <?php echo $this->Form->input('Tax.name', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('VAT'))); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('Tax Rate'); ?>%</label>
                    <div class="input-group">

                        <?php echo $this->Form->input('Tax.rate', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('10'))); ?>	
                        <span class="input-group-addon"><?= __('%'); ?></span>
                    </div>
                </div>


            </div>
            <div class="modal-footer">			
                <?php echo $this->Form->Submit(__('Save'), array('class' => 'btn btn-primary blue', 'div' => false)); ?>
                <button class="btn default" data-dismiss="modal" type="button"><?php echo __('Close'); ?></button>
            </div>
            <?php echo $this->Form->end(); ?>	
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!-- /.modal -->
<!-- Delete tax modal -->
<div class="modal fade" id="delTaxM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('Invoice', array('url' => array('action' => 'delete_tax'))); ?>
            <?php echo $this->Form->input('Tax.id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p><?php echo __('Are you sure to delete this tax ?'); ?>  </p>
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
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">
                    <h1 class="pull-left"><?php echo __('Tax Rates'); ?></h1>
                    <?php if ($this->Common->isAdmin()): ?>
                        <div class="pull-right top-page-ui">
                            <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#taxM">
                                <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Add Tax Rate'); ?>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">					  
                    <div class="main-box-body clearfix">
                        <!-- Tax List -->
                        <div class="table-responsive">
                            <div class="table-scrollable">
                                <table class="table table-hover dataTables" >
                                    <thead>
                                        <tr>
                                            <th><?php echo __('Name'); ?></th>
                                            <th><?php echo __('Percentage %'); ?></th>
                                            <th class="text-center"><i class="fa fa-bars"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($taxes)) :
                                            foreach ($taxes as $row) :

                                                ?>
                                                <tr  id="<?php echo 'row' . h($row['Tax']['id']); ?>">
                                                    <td><a href="javascript:void(0)"  data-type="text" data-pk="<?php echo h($row['Tax']['id']); ?>" data-url="edit_tax"  class="editable editable-click vEdit" ref="popover" data-content="Edit Name" data-name="name"><?php echo h($row['Tax']['name']); ?></a></td>
                                                    <td><a href="javascript:void(0)"  data-type="text" data-pk="<?php echo h($row['Tax']['id']); ?>" data-url="edit_tax"  class="editable editable-click vEdit" ref="popover" data-content="Edit %"><?php echo h($row['Tax']['rate']); ?></a></td>
                                                    <td class="text-center">
                                                        <?php if ($this->Common->isAdmin()): ?>
                                                            <a class="table-link danger" href="#" ref="popover" data-content="Delete Tax Rate" data-toggle="modal" data-target="#delTaxM" onclick="fieldU('TaxId',<?php echo h($row['Tax']['id']); ?>)">
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
                        <!--End Tax List -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>