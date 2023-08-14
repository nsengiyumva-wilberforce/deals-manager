<?php
/**
 * Invoice view Page.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Update task modal -->
<div class="modal fade" id="upM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Update'); ?></h4>
            </div>
            <div class="modal-update">
                <div class="modal-body">													
                </div>
                <div class="modal-footer">	
                    <button class="btn default" data-dismiss="modal" type="button"><?php echo __('Close'); ?></button>            	
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Invoice Modal --> 
<div class="modal fade" id="invoiceM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Edit Invoice'); ?></h4>
            </div>
            <?php echo $this->Form->create('Invoice', array('url' => array('controller' => 'invoices', 'action' => 'edit'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
            <?php echo $this->Form->input('Invoice.id', array('type' => 'hidden', 'value' => $Invoice['Invoice']['id'])); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label><?php echo __('REFERENCE ID'); ?>*</label>
                    <div class="input-group">
                        <span class="input-group-addon"><?= __('INV'); ?></span>
                        <?php echo $this->Form->input('Invoice.custom_id', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'value' => sprintf("%04d", h($Invoice['Invoice']['custom_id'])))); ?>	
                    </div>
                </div>
                <div class="form-group">
                    <label><?php echo __('CLIENT'); ?></label>
                    <?php echo $this->Form->input('Invoice.client_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array($companies), 'empty' => __('Select Client'), 'value' => h($Invoice['Invoice']['client_id']))); ?>	                      	
                </div>
                <div class="form-group">
                    <label><?php echo __('DEAL'); ?></label>
                    <?php echo $this->Form->input('Invoice.deal_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array($deals), 'empty' => __('Select Deal'), 'value' => h($Invoice['Invoice']['deal_id']))); ?>                  
                </div>
                <div class="form-group">
                    <label><?php echo __('STATUS'); ?></label>
                    <?php echo $this->Form->input('Invoice.status', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array(0 => 'Open', 1 => 'Not Paid', 2 => 'Partialy Paid', 3 => 'Paid', 4 => 'Cancelled'), 'value' => h($Invoice['Invoice']['status']))); ?>                  
                </div>
                <div class="form-group">
                    <label><?php echo __('ISSUE DATE'); ?></label>
                    <?php echo $this->Form->input('Invoice.issue_date', array('type' => 'text', 'class' => 'form-control input-inline input-medium datepickerDateT', 'value' => h($Invoice['Invoice']['issue_date']), 'id' => 'StartDate')); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('DUE DATE'); ?></label>
                    <?php echo $this->Form->input('Invoice.due_date', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'id' => 'datepickerDate', 'value' => h($Invoice['Invoice']['due_date']))); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('CURRENCY'); ?></label>
                    <?php echo $this->Form->input('Invoice.currency', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'value' => h($Invoice['Invoice']['currency']))); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('DISCOUNT'); ?></label>
                    <?php echo $this->Form->input('Invoice.discount', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'value' => $Invoice['Invoice']['discount'])); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('TERMS'); ?></label>
                    <?php echo $this->Form->input('Invoice.note', array('type' => 'textarea', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Thank you for your business.'), 'value' => $Invoice['Invoice']['note'])); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('Tax (%)'); ?></label>
                    <?php echo $this->Form->input('Invoice.custom_tax', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'value' => $Invoice['Invoice']['custom_tax'])); ?>	
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

<!-- Add Payment Modal --> 
<div class="modal fade" id="payM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Add Payment'); ?></h4>
            </div>
            <?php echo $this->Form->create('Invoice', array('url' => array('controller' => 'invoices', 'action' => 'payments'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm1')); ?>
            <?php echo $this->Form->input('Invoice.id', array('type' => 'hidden', 'value' => h($Invoice['Invoice']['id']))); ?>
            <?php echo $this->Form->input('Payment.deal_id', array('type' => 'hidden', 'value' => h($Invoice['Invoice']['deal_id']))); ?>
            <div class="modal-body">
                <?php $transactionId = $Invoice['Invoice']['id'] . sprintf("%03d", count($payments) + 1); ?>
                <div class="form-group">
                    <label><?php echo __('Transaction ID'); ?></label>
                    <?php echo $this->Form->input('Payment.transaction_id', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'value' => $transactionId)); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('Amount'); ?></label>
                    <?php echo $this->Form->input('Payment.amount', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'value' => '10')); ?>	
                </div>

                <div class="form-group">
                    <label><?php echo __('Payment Date'); ?></label>
                    <?php echo $this->Form->input('Payment.payment_date', array('type' => 'text', 'class' => 'form-control input-inline input-medium datepickerDateT')); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('Payment Method'); ?></label>
                    <?php echo $this->Form->input('Payment.method', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $methods)); ?>	                      	

                </div>
                <div class="form-group">
                    <label><?php echo __('Notes'); ?></label>
                    <?php echo $this->Form->input('Payment.note', array('type' => 'textarea', 'class' => 'form-control input-inline input-medium')); ?>	
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
<!-- Delete payment modal -->
<div class="modal fade" id="delpayM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('Invoice', array('url' => array('action' => 'delete_payment'))); ?>
            <?php echo $this->Form->input('Payment.id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p><?php echo __('Are you sure to delete this payment ?'); ?>  </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary SubmitD"  type="button"><?php echo __('Yes'); ?></button>
                <button class="btn default" data-dismiss="modal" type="button"><?php echo __('No'); ?></button>
            </div>
            <?php echo $this->Form->end(); ?>
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!-- Add Product Modal --> 
<div class="modal fade" id="productM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Add Product'); ?></h4>
            </div>
            <?php echo $this->Form->create('Invoice', array('url' => array('controller' => 'invoices', 'action' => 'add_product', h($Invoice['Invoice']['id'])), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vFormN')); ?>
            <?php echo $this->Form->input('Invoice.id', array('type' => 'hidden', 'value' => h($Invoice['Invoice']['id']))); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label><?php echo __('Product'); ?></label>
                    <select class="select-box-search full-width" name="data[InvoiceProduct][product_id]" >
                        <?php foreach ($products as $row): ?>
                            <option value="<?php echo h($row['Product']['id']); ?>"><?php echo h($row['Product']['name']) . ' (' . h($this->Session->read('Auth.User.currency_symbol')) . h($row['Product']['price']) . ')'; ?></option>
                        <?php endforeach; ?> 
                    </select>
                </div>
                <div class="form-group">
                    <label><?php echo __('Quantity'); ?></label>
                    <?php echo $this->Form->input('InvoiceProduct.product_quantity', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'value' => '1')); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('Description'); ?></label>
                    <?php echo $this->Form->input('InvoiceProduct.product_description', array('type' => 'textarea', 'rows' => 3, 'class' => 'form-control input-inline input-medium')); ?>	
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
<div class="modal fade" id="delProductM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('Invoice', array('url' => array('action' => 'delete_product'))); ?>
            <?php echo $this->Form->input('InvoiceProduct.id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p><?php echo __('Are you sure to delete this Product ?'); ?>  </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary SubmitD"  type="button"><?php echo __('Yes'); ?></button>
                <button class="btn default" data-dismiss="modal" type="button"><?php echo __('No'); ?></button>
            </div>
            <?php echo $this->Form->end(); ?>
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!-- /Delete modal -->

<div class="row">
    <div class="col-md-12">
        <div class="clearfix" id="content-header">
            <div class="filter-block pull-right">
                <?php if ($this->Common->isAdmin() || $this->Common->isStaffPermission('53')): ?>                   
                    <a class="btn btn-sm btn-primary" href="#" data-toggle="modal" data-target="#invoiceM">
                        <i class="fa fa-edit"></i><?php echo __('Edit'); ?>
                    </a>
                    <a class="btn btn-sm btn-primary" href="#" data-toggle="modal" data-target="#productM">
                        <i class="fa fa-plus-circle"></i> <?php echo __('Add Product'); ?>
                    </a>
                    <a class="btn btn-sm btn-primary" href="#" data-toggle="modal" data-target="#payM">
                        <i class="fa fa-plus-circle"></i> <?php echo __('Add Payment'); ?>
                    </a>
                <?php endif; ?>
                <a class="btn btn-sm btn-primary" href="<?php echo $this->Html->url(array('controller' => 'invoices', 'action' => 'perview', h($Invoice['Invoice']['id']))); ?>" target = '_blank'>
                    <i class="fa fa fa-search"></i> <?php echo __('Preview'); ?>
                </a>
                <a class="btn btn-sm btn-primary" href="<?php echo $this->Html->url(array('controller' => 'invoices', 'action' => 'view_pdf', 'ext' => 'pdf', h($Invoice['Invoice']['id']))); ?>" >
                    <i class="fa fa-file-pdf-o"></i> <?php echo __('PDF'); ?>
                </a>
            </div>  
        </div>
    </div>
</div>  
<div class="main-box clearfix invoice-view">
    <header class="main-box-header clearfix">
        <span>
            <?php echo __('Status'); ?>: <?php $this->Common->invoice_status($Invoice['Invoice']['status']); ?>
        </span>
        <?php if ($Invoice['Deal']['name']): ?>
            <span class="ml20">
                <?php echo __('Deal'); ?>: <a href="<?php echo $this->Html->url(array('controller' => 'deals', 'action' => 'view', h($Invoice['Invoice']['deal_id']))); ?>"><?php echo h($Invoice['Deal']['name']); ?></a>
            </span>
        <?php endif ?>
<!--h2 class="pull-left">Invoice no. <?php echo "INV" . sprintf("%04d", h($Invoice['Invoice']['id'])); ?></h2-->
    </header>
    <div class="main-box-body clearfix">
        <div class="row" id="invoice-companies">
            <div class="col-sm-4 invoice-box">
                <div class="invoice-icon hidden-sm">
                    <i class="fa fa-home"></i> From
                </div>
                <div class="invoice-company">
                    <h4><?php echo h($CompanyAdmin['SettingCompany']['name']); ?></h4>
                    <p>
                        <?php echo h($CompanyAdmin['SettingCompany']['address']); ?><br>
                        <?php echo h($CompanyAdmin['SettingCompany']['city']) . ' ' . h($CompanyAdmin['SettingCompany']['state']) . " " . h($CompanyAdmin['SettingCompany']['zip_code']); ?><br>
                        <?php echo h($CompanyAdmin['SettingCompany']['country']); ?>
                    </p>
                </div>
            </div>
            <div class="col-sm-4 invoice-box">
                <div class="invoice-icon hidden-sm">
                    <i class="fa fa-truck"></i> To
                </div>
                <div class="invoice-company">
                    <?php if ($Company): ?>
                        <h4><a href="<?php echo $this->Html->url(array('controller' => 'companies', 'action' => 'view', h($Company['Company']['id']))); ?>"><?php echo h($Company['Company']['name']); ?></a></h4>
                        <p>
                            <?php echo h($Company['Company']['address']); ?><br>
                            <?php echo h($Company['Company']['city']) . ' ' . h($Company['Company']['state']) . " " . h($Company['Company']['zip_code']); ?><br>
                            <?php echo h($Company['Company']['country']); ?>
                        </p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-sm-4 invoice-box invoice-box-dates">
                <div class="invoice-dates">
                    <div class="invoice-number clearfix">
                        <strong><?php echo __('Invoice no.'); ?></strong>
                        <span class="pull-right"><?php
                            echo "INV" . sprintf("%04d", h($Invoice['Invoice']['custom_id']));
                            ;

                            ?></span>
                    </div>
                    <div class="invoice-date clearfix">
                        <strong><?php echo __('Invoice date'); ?></strong>
                        <span class="pull-right"><?php echo date($this->Common->dateShow(), strtotime($Invoice['Invoice']['issue_date'])); ?></span>
                    </div>
                    <div class="invoice-date invoice-due-date clearfix">
                        <strong><?php echo __('Due date'); ?></strong>
                        <span class="pull-right"><?php echo date($this->Common->dateShow(), strtotime($Invoice['Invoice']['due_date'])); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive invoice-products">
            <table class="table">
                <thead>
                    <tr> <?php if ($this->Common->isAdmin() || $this->Common->isStaffPermission('53')): ?>
                            <th></th>  
                        <?php endif; ?>
                        <th><span><?php echo __('Name'); ?></span></th>
                        <th ><span><?php echo __('Description'); ?></span></th>
                        <th ><span><?php echo __('Quantity'); ?></span></th>
                        <th ><span><?php echo __('Unit price'); ?></span></th>
                        <th class="text-right"><span><?php echo __('Total'); ?></span></th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sum = 0;
                    foreach ($invoiceProducts as $row) :

                        ?>
                        <tr id="<?php echo 'row' . h($row['InvoiceProduct']['id']); ?>">
                            <?php if ($this->Common->isAdmin() || $this->Common->isStaffPermission('53')): ?>
                                <td><a class="table-link" href="#"  data-toggle="modal" data-target="#upM"  onclick="loadcommon(<?= h($row['InvoiceProduct']['id']); ?>, 'invoices', 'update_product')" ref="popover" data-content="<?php echo __('Edit Product'); ?>">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="table-link danger" href="#" data-toggle="modal" data-target="#delProductM" onclick="fieldU('InvoiceProductId',<?php echo h($row['InvoiceProduct']['id']); ?>)" ref="popover" data-content="<?php echo __('Delete Product'); ?>">
                                        <i class="fa fa-trash-o"></i>
                                    </a>
                                </td>
                            <?php endif; ?>
                            <td><?php echo h($row['InvoiceProduct']['product_name']); ?> </td>
                            <td><?php echo h($row['InvoiceProduct']['product_description']); ?></td>
                            <td><?php echo h($row['InvoiceProduct']['product_quantity']); ?></td>
                            <td> <?php echo h($Invoice['Invoice']['currency']) . h($row['InvoiceProduct']['product_unit_price']); ?></td>
                            <td class="text-right"> <?php echo h($Invoice['Invoice']['currency']) . h($row['InvoiceProduct']['product_total']); ?></td>

                        </tr>
                        <?php
                        $sum += $row['InvoiceProduct']['product_total'];
                    endforeach;

                    ?>


                </tbody>
            </table>
        </div>
        <div class="invoice-box-total clearfix">
            <div class="row">
                <div class="col-sm-9 col-md-10 col-xs-6 text-right invoice-box-total-label"><?php echo __('Subtotal'); ?></div>
                <div class="col-sm-3 col-md-2 col-xs-6 text-right invoice-box-total-value"><?php echo h($Invoice['Invoice']['currency']) . $sum; ?></div>
            </div>
            <?php if ($Invoice['Invoice']['discount']): ?>
                <div class="row">
                    <div class="col-sm-9 col-md-10 col-xs-6 text-right invoice-box-total-label"><?php echo __('Discount'); ?></div>
                    <div class="col-sm-3 col-md-2 col-xs-6 text-right invoice-box-total-value"><?php
                        echo h($Invoice['Invoice']['currency']) . '' . $Invoice['Invoice']['discount'];
                        $sum = $sum - h($Invoice['Invoice']['discount']);

                        ?></div>
                </div>
<?php endif; ?>
            <div class="row">
                <div class="col-sm-9 col-md-10 col-xs-6 text-right invoice-box-total-label"><?php echo __('Tax'); ?> (<?php echo h($Invoice['Invoice']['custom_tax']); ?>%)</div>
                <div class="col-sm-3 col-md-2 col-xs-6 text-right invoice-box-total-value"><?php
                    $tax = $Invoice['Invoice']['custom_tax'] / 100 * $sum;
                    echo ($tax < 0) ? '-' . h($Invoice['Invoice']['currency']) . abs($tax) : h($Invoice['Invoice']['currency']) . abs($tax);

                    ?></div>
            </div>
            <div class="row">
                <div class="col-sm-9 col-md-10 col-xs-6 text-right invoice-box-total-label"><b><?php echo __('Total'); ?></b></div>
                <div class="col-sm-3 col-md-2 col-xs-6 text-right invoice-box-total-value"><b><?php echo (($sum + $tax) < 0) ? '-' . h($Invoice['Invoice']['currency']) . abs($sum + $tax) : h($Invoice['Invoice']['currency']) . ($sum + $tax); ?></b></div>
            </div>
            <div class="row">
                <?php
                $pSum = 0;
                foreach ($payments as $row) :
                    $pSum += $row['Payment']['amount'];
                endforeach;

                ?>
                <div class="col-sm-9 col-md-10 col-xs-6 text-right invoice-box-total-label"><?php echo __('Paid'); ?></div>
                <div class="col-sm-3 col-md-2 col-xs-6 text-right invoice-box-total-value"><?php echo h($Invoice['Invoice']['currency']) . $pSum; ?></div>
            </div>
            <div class="row grand-total">
                <div class="col-sm-9 col-md-10 col-xs-6 text-right invoice-box-total-label"><?php echo __('Balance Due'); ?></div>
                <div class="col-sm-3 col-md-2 col-xs-6 text-right invoice-box-total-value"> 
                    <?php
                    $total = ($sum + $tax) - $pSum;
                    if ($total < 0) : echo '-' . h($Invoice['Invoice']['currency']) . abs($total);
                    else : echo h($Invoice['Invoice']['currency']) . $total;
                    endif;

                    ?></div>
            </div>
        </div>
<?php if ($Invoice['Invoice']['note']): ?>
            <div class="invoice-summary row">
                <div class="col-md-3 col-sm-6 col-xs-12">
                    <div class="invoice-summary-item">
                        <div><?php echo h($Invoice['Invoice']['note']); ?></div>
                    </div>
                </div>
            </div>
<?php endif; ?>
    </div>
</div>
<?php if ($this->Common->isAdminStaff()) : ?>
    <div class="main-box invoice-payments clearfix">
        <header class="main-box-header clearfix">
            <h2 class="pull-left"><?php echo __('Payments'); ?></h2>

        </header>
        <div class="main-box-body clearfix">
            <div class="table-responsive invoice-products">
                <table class="table">
                    <thead>
                        <tr>    
                            <th><?php echo __('Transaction ID'); ?></th>
                            <th><?php echo __('Payment Date'); ?></th>
                            <th ><?php echo __('Payment Method'); ?></th>
                            <th ><?php echo __('Note'); ?></th>
                            <th ><?php echo __('Amount'); ?></th>
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $payment_sum = 0;
                        foreach ($payments as $row) :

                            ?>
                            <tr id="<?php echo 'row' . h($row['Payment']['id']); ?>"> 
                                <td><?php echo '#' . h($row['Payment']['transaction_id']); ?> </td>
                                <td><?php echo date($this->Common->dateShow(), strtotime($row['Payment']['payment_date'])); ?></td>
                                <td><?php echo h($row['PaymentMethod']['name']); ?></td>
                                <td><?php echo h($row['Payment']['note']); ?></td>
                                <td> <?php echo h($Invoice['Invoice']['currency']) . h($row['Payment']['amount']); ?></td>
        <?php if ($this->Common->isAdmin() || $this->Common->isStaffPermission('53')): ?>
                                    <td>
                                        <a class="table-link" href="#"  data-toggle="modal" data-target="#upM"  onclick="loadcommon(<?= h($row['Payment']['id']); ?>, 'invoices', 'update_payments')" ref="popover" data-content="<?php echo __('Edit Payment'); ?>">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a class="table-link danger" href="#" data-toggle="modal" data-target="#delpayM" onclick="fieldU('PaymentId',<?php echo h($row['Payment']['id']); ?>)" ref="popover" data-content="<?php echo __('Delete Payment'); ?>">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </td>
        <?php endif; ?>

                            </tr>

                            <?php
                            $payment_sum += $row['Payment']['amount'];
                        endforeach;

                        ?>
                        <tr>
                            <td colspan="4" class="text-right"><strong><?php echo __('Total'); ?></strong></td>
                            <td colspan="2"><strong><?php echo $Invoice['Invoice']['currency'] . $payment_sum; ?></strong></td>
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?>
<script>
    function loadcommon(id, cont, act) {
        $('#upM .modal-update').html('<div class="loader-modal"></div>');
        $.ajax({
            type: "GET",
            url: getUrl + cont + "/" + act + "/" + id,
            success: function (data) {
                $('#upM .modal-update').html(data);

            }
        });
    }
</script>