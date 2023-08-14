<?php
/**
 * Update task modal load this view
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<?php if (!empty($task)) { ?>
    <?php echo $this->Form->input('Task.id', array('type' => 'hidden', 'value' => h($task['Task']['id']))); ?>
    <?php echo $this->Form->input('Task.deal_id', array('type' => 'hidden', 'value' => h($task['Task']['deal_id']))); ?>
    <div class="form-group">
        <label><?php echo __('Task'); ?></label>
        <?php echo $this->Form->input('Task.task', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'value' => $task['Task']['task'], 'label' => false, 'div' => false)); ?>	
    </div>
    <div class="form-group">
        <div class="col-sm-6 form-group"> 
            <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <?php echo $this->Form->input('Task.date', array('type' => 'text', 'class' => 'form-control datepickerDateM', 'label' => false, 'div' => false, 'autocomplete' => false, 'value' => date('m/d/Y', strtotime($task['Task']['date'])))); ?>
            </div>	
        </div>
        <div class="col-sm-6 form-group"> 
            <div class="input-group input-append bootstrap-timepicker">                                        
                <?php echo $this->Form->input('Task.time', array('type' => 'text', 'class' => 'form-control timepickerM', 'label' => false, 'div' => false, 'autocomplete' => false, 'value' => date('H:i A', strtotime($task['Task']['time'])))); ?>	
                <span class="add-on input-group-addon"><i class="fa fa-clock-o"></i></span>
            </div>
        </div>    
    </div>
    <div class="form-group">
        <label><?php echo __('Category'); ?></label>
        <?php echo $this->Form->input('Task.motive', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $this->Common->motivesList(), 'value' => $task['Task']['motive'], 'label' => false, 'div' => false)); ?>	
    </div>
    <div class="form-group">
        <label><?php echo __('Priority'); ?></label>
        <?php echo $this->Form->input('Task.priority', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array('1' => __('Low Priority'), '2' => __('Medium Priority'), '3' => __('High Priority')), 'value' => $task['Task']['priority'], 'label' => false, 'div' => false)); ?>	
    </div>
    <div class="form-group">
        <label><?php echo __('Status'); ?></label>
        <?php echo $this->Form->input('Task.status', array('type' => 'select', 'label' => false, 'div' => false, 'class' => 'select-box-search full-width', 'options' => array(0 => 'Yet to Start', 1 => 'Completed'))); ?>	
    </div>
<?php } ?>

<?php if (!empty($announcement)) : ?>
    <!-- Announcements -->
    <?php echo $this->Form->input('Announcement.id', array('type' => 'hidden')); ?>
    <div class="modal-body">
        <div class="form-group">
            <label></label>
            <?php echo $this->Form->input('Announcement.title', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Announcement Title'), 'label' => false, 'div' => false)); ?>	
        </div>                    
        <div class="form-group">
            <?php echo $this->Form->input('Announcement.description', array('type' => 'textarea', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Description'), 'label' => false, 'div' => false)); ?>	
        </div>
        <div class="form-group">
            <label><?php echo __('Start Date'); ?></label>
            <?php echo $this->Form->input('Announcement.start_date', array('type' => 'text', 'class' => 'form-control datepickerDateM', 'Placeholder' => __('YYYY-MM-DD'), 'label' => false, 'div' => false)); ?>
        </div>
        <div class="form-group">
            <label><?php echo __('End Date'); ?></label>
            <?php echo $this->Form->input('Announcement.end_date', array('type' => 'text', 'class' => 'form-control datepickerDate', 'Placeholder' => __('YYYY-MM-DD'), 'label' => false, 'div' => false)); ?>
        </div>
        <div class="form-group">
            <label><?php echo __('Share With'); ?></label>
            <?php echo $this->Form->input('Announcement.permission', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array(1 => 'Team Members', 2 => 'Clients', 3 => 'Team Members & Clients'), 'label' => false, 'div' => false)); ?>
        </div>
    </div> 
    <div class="modal-footer">
        <button class="btn btn-primary blue btn-sm" type="submit"><i class="fa fa-check"></i> <?php echo __('Save'); ?></button>
        <button class="btn default btn-sm" data-dismiss="modal" type="button"><i class="fa fa-times"></i> <?php echo __('Close'); ?></button>   
    </div>
    <?php echo $this->Form->end(); ?>
    <?php echo $this->Js->writeBuffer(); ?>

<?php endif; ?>
<!-- Add Deal Modal -->
<?php if (!empty($box)) : ?>
    <!-- Tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#tab-deal"><?php echo __('Deal Details'); ?></a></li>                           
        <li><a data-toggle="tab" href="#tab-custom"><?php echo __('Custom Fields'); ?></a></li>
    </ul>
    <div class="tab-content">
        <!-- Deal details Tab -->
        <div id="tab-deal" class="tab-pane fade active in">
            <div class="form-group">
                <label></label>
                <?php echo $this->Form->input('Deal.name', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Deal Name'), 'label' => false, 'div' => false)); ?>	
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"> <?= $this->Session->read('Auth.User.currency_symbol'); ?></span>
                    <?php echo $this->Form->input('Deal.price', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Deal Price'), 'value' => 0, 'label' => false, 'div' => false)); ?>
                </div>
            </div>
            <div class="form-group">
                <?php echo $this->Form->input('Deal.pipeline_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array($this->Common->getPipelineList()), 'empty' => __('Select Pipeline'))); ?>	
            </div>
            <div class="form-group">
                <label><?php echo __('Stage'); ?></label>
                <?php echo $this->Form->input('Deal.stage_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array(), 'label' => false, 'div' => false)); ?>		
            </div>
            <?php if ($this->Common->isAdmin()) : ?>
                <div class="form-group">
                    <label><?php echo __('Group'); ?></label>
                    <?php echo $this->Form->input('Deal.group_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array($groups), 'empty' => __('Select Group'), 'label' => false, 'div' => false)); ?>	
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label><?php echo __('Client'); ?></label>
                <?php echo $this->Form->input('Deal.company_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array($companies), 'empty' => __('Select Company'), 'label' => false, 'div' => false)); ?>	
            </div>
            <div class="form-group">
                <label><?php echo __('Sources'); ?></label>
                <select class="select-tags form-control w100" multiple="multiple" name="data[Deal][sources][]">
                    <?php foreach ($sources as $row): ?>
                        <option value="<?php echo h($row['Source']['id']); ?>"><?php echo h($row['Source']['name']); ?></option>
                    <?php endforeach; ?> 
                </select>
            </div>
            <div class="form-group">
                <label><?php echo __('Products'); ?></label>
                <select class="select-tags form-control w100" multiple="multiple" name="data[Deal][products][]">
                    <?php foreach ($products as $row): ?>
                        <option value="<?php echo h($row['Product']['id']); ?>"><?php echo h($row['Product']['name']) . ' (' . $this->Session->read('Auth.User.currency_symbol') . $row['Product']['price'] . ')'; ?></option>
                    <?php endforeach; ?> 
                </select>
            </div>
            <div class="form-group">
                <label><?php echo __('Contacts'); ?></label>
                <select class="select-tags form-control w100" multiple="multiple" name="data[Deal][contacts][]">
                    <?php foreach ($contacts as $row): ?>
                        <option value="<?php echo $row['Contact']['id']; ?>"><?php
                            echo h($row['Contact']['name']);
                            if ($row['Contact']['email']) {
                                echo ' ( ' . h($row['Contact']['email']) . ' )';
                            }

                            ?></option>
                    <?php endforeach; ?>                
                </select>
            </div>
            <div class="form-group">
                <label><?php echo __('Notes (Private)'); ?></label>
                <?php echo $this->Form->input('Deal.notes', array('type' => 'textarea', 'rows' => '3', 'class' => 'form-control input-inline input-medium', 'row' => 3, 'label' => false, 'div' => false)); ?>	
            </div>


        </div>
        <!-- Deal Custom Field Tab -->
        <div id="tab-custom" class="tab-pane fade">
            <?php foreach ($custom as $row): ?>
                <div class="form-group">
                    <label><?= h($row['Custom']['name']); ?></label>
                    <?php echo $this->Form->input('Custom.value' . $row['Custom']['id'], array('type' => ($row['Custom']['type'] == '2') ? 'textarea' : 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => '', 'label' => false, 'div' => false)); ?>	
                </div>
            <?php endforeach; ?>                      
        </div>
    </div> 

<?php endif; ?>
<!-- Products -->
<?php
if (!empty($product)) :

    ?>
    <?php echo $this->Form->create('Invoice', array('url' => array('controller' => 'invoices', 'action' => 'update_product'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm1')); ?>
    <?php echo $this->Form->input('InvoiceProduct.id', array('type' => 'hidden')); ?>
    <?php echo $this->Form->input('InvoiceProduct.invoice_id', array('type' => 'hidden')); ?>
    <div class="modal-body">
        <div class="form-group">
            <label><?php echo __('Name'); ?></label>
            <?php echo $this->Form->input('InvoiceProduct.product_name', array('type' => 'text', 'class' => 'form-control input-inline input-medium')); ?>	                      	
        </div>
        <div class="form-group">
            <label><?php echo __('Quantity'); ?></label>
            <?php echo $this->Form->input('InvoiceProduct.product_quantity', array('type' => 'text', 'class' => 'form-control input-inline input-medium')); ?>	
        </div>
        <div class="form-group">
            <label><?php echo __('Unit Price'); ?></label>
            <?php echo $this->Form->input('InvoiceProduct.product_unit_price', array('type' => 'text', 'class' => 'form-control input-inline input-medium')); ?>	
        </div>
        <div class="form-group">
            <label><?php echo __('Description'); ?></label>
            <?php echo $this->Form->input('InvoiceProduct.product_description', array('type' => 'textarea', 'class' => 'form-control input-inline input-medium')); ?>	
        </div> 

    </div>
    <div class="modal-footer">			
        <button class="btn btn-primary blue btn-sm" type="submit"><i class="fa fa-check"></i> <?php echo __('Save'); ?></button>
        <button class="btn default btn-sm" data-dismiss="modal" type="button"><i class="fa fa-times"></i> <?php echo __('Close'); ?></button>						
    </div>
    <?php echo $this->Form->end(); ?>	
    <?php echo $this->Js->writeBuffer(); ?>
<?php endif; ?>
<!-- Payments -->
<?php if (!empty($payment)) : ?>
    <?php echo $this->Form->create('Invoice', array('url' => array('controller' => 'invoices', 'action' => 'update_payments'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm1')); ?>
    <?php echo $this->Form->input('Payment.id', array('type' => 'hidden')); ?>
    <?php echo $this->Form->input('Payment.invoice_id', array('type' => 'hidden')); ?>
    <div class="modal-body">
        <div class="form-group">
            <label><?php echo __('Amount'); ?></label>
            <?php echo $this->Form->input('Payment.amount', array('type' => 'text', 'class' => 'form-control input-inline input-medium')); ?>	
        </div>

        <div class="form-group">
            <label><?php echo __('Payment Date'); ?></label>
            <?php echo $this->Form->input('Payment.payment_date', array('type' => 'text', 'class' => 'form-control input-inline input-medium datepickerDateM')); ?>	
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
<?php endif; ?>
<!-- Custom Jquery -->
<script>
    $('select.select-box-search').select2();
    $(".select-tags").select2({
        tags: true,
        createTag: function (params) {
            return undefined;
        }
    });
    $('.datepickerDateM').datepicker({
        format: 'dd-mm-yyyy',
        setDate: new Date(),
        autoclose: true
    });

    $('.timepickerM').timepicker({
    }).focus(function () {
        $(this).next().trigger('click');
    });
    $('.datepickerDate').datepicker({format: 'dd-mm-yyyy', autoclose: true});
    $('#DealPipelineId').change(function () {
        $('#DealStageId').load(getUrl + 'Stages/lists/' + $(this).val());
    });
</script>
<!-- End Custom Jquery -->