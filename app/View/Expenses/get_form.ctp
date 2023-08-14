<?php
/**
 * Show Expenses Form On Edit Button
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
?>
<?php echo $this->Form->create('Expense', array('url' => array('controller' => 'expenses', 'action' => 'edit'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm2', 'type' => 'file')); ?>             
<?php echo $this->Form->input('Expense.id', array('type' => 'hidden')); ?>
<div class="modal-body">
    <div class="form-group">
        <label><?php echo __('Category'); ?></label>
        <?php echo $this->Form->input('Expense.category_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array($categories))); ?>	                      	
    </div>
    <div class="form-group">
        <label><?php echo __('Description'); ?></label>
        <?php echo $this->Form->input('Expense.description', array('type' => 'textarea', 'rows' => 2, 'class' => 'form-control input-inline input-medium')); ?>	
    </div> 
    <div class="form-group">
        <label><?php echo __('Amount'); ?></label>
        <?php echo $this->Form->input('Expense.amount', array('type' => 'text', 'class' => 'form-control input-inline input-medium')); ?>	
    </div>
    <div class="form-group">
        <label><?php echo __('Date'); ?></label>
        <?php echo $this->Form->input('Expense.date', array('type' => 'text', 'class' => 'form-control input-inline input-medium datepickerDate')); ?>	
    </div>

    <div class="form-group">
        <label><?php echo __('Deal'); ?></label>
        <?php echo $this->Form->input('Expense.deal_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array($deals), 'empty' => __('Select Deal'))); ?>
    </div> 
    <div class="form-group">
        <label><?php echo __('Member'); ?></label>
        <?php echo $this->Form->input('Expense.user_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array($this->Common->getUserList()), 'empty' => __('Select Member'))); ?>
    </div> 
    <div class="form-group">
        <label><?php
            echo __('Attachment');
            echo '  ' . $this->request->data['Expense']['file'];

            ?></label>
        <?php echo $this->Form->input('Expense.file', array('type' => 'file', 'class' => '')); ?>	
    </div>
    <div class="modal-footer">
        <button class="btn btn-primary blue btn-sm submitBtn" type="submit"><i class="fa fa-check"></i> <?php echo __('Save'); ?></button>
        <button class="btn default btn-sm" data-dismiss="modal" type="button"><i class="fa fa-times"></i> <?php echo __('Close'); ?></button>
    </div>
    <?php echo $this->Form->end(); ?>	
    <?php echo $this->Js->writeBuffer(); ?>   

    <script type="text/javascript">
        $(document).ready(function () {
            $('.datepickerDate').datepicker({format: 'dd-mm-yyyy', autoclose: true}).datepicker("setDate", new Date());
            $('.select-box-search').select2();
        });
    </script>  