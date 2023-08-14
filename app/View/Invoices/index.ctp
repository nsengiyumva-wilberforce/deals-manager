<?php
/**
 * List of invoices
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Add Invoice Modal --> 
<div class="modal fade" id="invoiceM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Add Invoice'); ?></h4>
            </div>
            <?php echo $this->Form->create('Invoice', array('url' => array('controller' => 'invoices', 'action' => 'add'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label><?php echo __('REFERENCE ID'); ?>*</label>
                    <div class="input-group">
                        <span class="input-group-addon"><?= __('INV'); ?></span>
                        <?php echo $this->Form->input('Invoice.custom_id', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'value' => h($lastId))); ?>	
                    </div>
                </div>
                <div class="form-group">
                    <label><?php echo __('CLIENT'); ?></label>
                    <?php echo $this->Form->input('Invoice.client_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array($companies), 'empty' => __('Select Client'))); ?>	                      	
                </div>
                <div class="form-group">
                    <label><?php echo __('DEAL'); ?></label>
                    <?php echo $this->Form->input('Invoice.deal_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array($deals), 'empty' => __('Select Deal'))); ?>	                      	

                </div>
                <div class="form-group">
                    <label><?php echo __('ISSUE DATE'); ?></label>
                    <?php echo $this->Form->input('Invoice.issue_date', array('type' => 'text', 'class' => 'form-control input-inline input-medium datepickerDateT', 'id' => 'StartDate')); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('DUE DATE'); ?></label>
                    <?php echo $this->Form->input('Invoice.due_date', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'id' => 'datepickerDate')); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('CURRENCY'); ?></label>
                    <?php echo $this->Form->input('Invoice.currency', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'value' => $this->Session->read('Auth.User.currency_symbol'))); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('DISCOUNT'); ?></label>
                    <?php echo $this->Form->input('Invoice.discount', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'value' => '0')); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('Tax (%)'); ?></label>
                    <select class="select-box-search full-width" name="data[Invoice][custom_tax]">
                        <option value=""><?php echo __('Select Tax'); ?></option>
                        <?php foreach ($taxes as $tax): ?>
                            <option value="<?php echo h($tax['Tax']['id']); ?>"> <?php echo h($tax['Tax']['name']) . ' (' . h($tax['Tax']['rate']) . ')'; ?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label><?php echo __('TERMS'); ?></label>
                    <?php echo $this->Form->input('Invoice.note', array('type' => 'textarea', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Thank you for your business.'))); ?>	
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
<!-- Delete product modal -->
<div class="modal fade" id="delM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('Invoice', array('url' => array('action' => 'delete'))); ?>
            <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p><?php echo __('Are you sure to delete this invoice ?'); ?>  </p>
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
                    <h1 class="pull-left"><?php echo __('Invoices'); ?></h1>
                    <?php if ($this->Common->isAdmin() || $this->Common->isStaffPermission('52')): ?>
                        <div class="pull-right top-page-ui">
                            <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#invoiceM">
                                <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Add Invoice'); ?>
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
                        <!-- Invoice List -->
                        <div class="table-responsive">
                            <div class="table-scrollable">
                                <table class="table table-hover table-striped dataTables">
                                    <thead>
                                        <tr>
                                            <th><?php echo __('Invoice'); ?></th>
                                            <th><?php echo __('Client'); ?></th>
                                            <th><?php echo __('Deal'); ?></th>
                                            <th><?php echo __('Issue Date'); ?></th>
                                            <th><?php echo __('Due Date'); ?></th>
                                            <th><?php echo __('Value'); ?></th>
                                            <th><?php echo __('Status'); ?></th>
                                            <?php if ($this->Common->isAdmin() || $this->Common->isStaffPermission('54')): ?>
                                                <th></th>
                                            <?php endif; ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($invoices)) :

                                            foreach ($invoices as $row) :

                                                ?>
                                                <tr  id="<?php echo 'row' . h($row['Invoice']['id']); ?>">
                                                    <td><a class="table-link" href="<?php echo $this->Html->url(array("controller" => "invoices", "action" => "view", h($row['Invoice']['id']))); ?>" ref="popover" data-content="View Invoice"><?php
                                                            echo "INV" . sprintf("%04d", h($row['Invoice']['custom_id']));
                                                            ;

                                                            ?></a></td>
                                                    <td><?php echo h($row['Company']['name']); ?></td>
                                                    <td><a class="table-link" href="<?php echo $this->Html->url(array("controller" => "deals", "action" => "view", h($row['Deal']['id']))); ?>" ref="popover" data-content="View Deal"><?php echo h($row['Deal']['name']); ?></a></td>
                                                    <td><?php echo $this->Time->format($this->Common->dateShow(), h($row['Invoice']['issue_date'])); ?></td>
                                                    <td><?php echo $this->Time->format($this->Common->dateShow(), h($row['Invoice']['due_date'])); ?></td>
                                                    <td><?php echo h($row['Invoice']['currency']) . '' . h($row['Invoice']['amount']); ?></td>
                                                    <td><?php $this->Common->invoice_status($row['Invoice']['status']); ?></td>
                                                    <?php if ($this->Common->isAdmin() || $this->Common->isStaffPermission('54')): ?>
                                                        <td>	                                                                       
                                                            <a class="table-link danger" href="#" ref="popover" data-content="Delete Invoice" data-toggle="modal" data-target="#delM" onclick="fieldU('InvoiceId',<?php echo h($row['Invoice']['id']); ?>)">
                                                                <i class="fa fa-trash-o"></i>
                                                            </a>
                                                        </td>
                                                    <?php endif; ?>
                                                </tr>
                                                <?php
                                            endforeach;
                                        endif;

                                        ?>
                                    </tbody>
                                </table>
                            </div>	
                        </div>
                        <!--End Invoice List -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>