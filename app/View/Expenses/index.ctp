<?php
/**
 * List of expenses
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Add Expense Modal --> 
<div class="modal fade" id="expenseM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Add Expense'); ?></h4>
            </div>
            <?php echo $this->Form->create('Expense', array('url' => array('controller' => 'expenses', 'action' => 'add'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm', 'type' => 'file')); ?>
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
                    <?php echo $this->Form->input('Expense.amount', array('type' => 'text', 'value' => '0.0', 'class' => 'form-control input-inline input-medium')); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('Date'); ?></label>
                    <?php echo $this->Form->input('Expense.date', array('type' => 'text', 'class' => 'form-control input-inline input-medium datepickerDateT')); ?>	
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
                    <label><?php echo __('Attachment'); ?></label>
                    <?php echo $this->Form->input('Expense.file', array('type' => 'file', 'class' => '')); ?>	
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
<!-- Edit Expense Modal --> 
<div class="modal fade" id="updateM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Edit Expense'); ?></h4>
            </div>
            <div class="modal-data">
                <div class="modal-body">
                </div>
                <div class="modal-footer">			
                    <button class="btn default" data-dismiss="modal" type="button"><?php echo __('Close'); ?></button>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- /.modal -->
<!-- Delete expense modal -->
<div class="modal fade" id="delProductM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('Expense', array('url' => array('action' => 'delete'))); ?>
            <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p><?php echo __('Are you sure to delete this expense ?'); ?>  </p>
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
                    <h1 class="pull-left"><?php echo __('Expenses'); ?></h1>
                    <?php if ($this->Common->isAdminStaff()): ?>
                        <div class="pull-right top-page-ui">
                            <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#expenseM">
                                <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Add Expense'); ?>
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
                        <!-- Expenses List -->
                        <div class="table-responsive">
                            <div class="table-scrollable">
                                <table class="table table-hover dataTables">
                                    <thead>
                                        <tr>
                                            <th><?php echo __('ID'); ?></th>
                                            <th><?php echo __('Description'); ?></th>
                                            <th><?php echo __('Category'); ?></th>
                                            <th><?php echo __('Deal'); ?></th>
                                            <th><?php echo __('Member'); ?></th>
                                            <th><?php echo __('Date'); ?></th>                                           
                                            <th><?php echo __('Amount'); ?></th>
                                            <th class="text-center"><i class="fa fa-bars"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($expenses)) :

                                            foreach ($expenses as $row) :

                                                ?>
                                                <tr  id="<?php echo 'row' . h($row['Expense']['id']); ?>">
                                                    <td><?php echo 'Exp ' . h($row['Expense']['id']); ?></td>
                                                    <td>  <?php
                                                        if ($row['Expense']['file']):
                                                            echo $this->Html->link('<span class="fa-stack" ref="popover" data-content="Download File"><i class="fa fa-paperclip"></i></span>', array('controller' => 'expenses', 'action' => 'download', $row['Expense']['file']), array('escape' => false));
                                                        endif;

                                                        ?>
                                                        <?php echo h($row['Expense']['description']); ?></td>
                                                    <td><span class="label label-active"><?php echo h($row['ExpenseCategory']['name']); ?></span></td> 
                                                    <td><a href="<?php echo $this->Html->url(array('controller' => 'deals', 'action' => 'view', h($row['Deal']['id']))); ?>"><?php echo h($row['Deal']['name']); ?></a></td>
                                                    <td><?php echo h($row['User']['first_name']) . ' ' . h($row['User']['last_name']); ?></td>
                                                    <td><?php echo $this->Time->format($this->Common->dateShow(), h($row['Expense']['date'])); ?></td>
                                                    <td><?= h($this->Session->read('Auth.User.currency_symbol')); ?><?php echo h($row['Expense']['amount']); ?></td>
                                                    <td class="text-center">	                             
                                                        <?php if ($this->Common->isAdmin()): ?>
                                                            <a class="modal-form table-link" href="javascript:void(0)"  ref="popover" data-content="Edit Expense" data-cont="expenses" data-id="<?php echo h($row['Expense']['id']); ?>">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            <a class="table-link danger" href="javascript:void(0)" ref="popover" data-content="Delete Expense" data-toggle="modal" data-target="#delProductM" onclick="fieldU('ExpenseId',<?php echo h($row['Expense']['id']); ?>)">
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
                        <!--End Expenses List -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>