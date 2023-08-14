<?php
/**
 *  List all expenses.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div  id="uDiv" >
    <?php echo $this->element('paginator', array('updateDivId' => 'uDiv')); ?>	
    <div class="table-scrollable">
        <table class="table table-hover dataTable">
            <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('Expense.id', __('ID')); ?></th>
                    <th><?php echo $this->Paginator->sort('Expense.description', __('Description')); ?></th>
                    <th><?php echo $this->Paginator->sort('Expense.category_id', __('Category')); ?></th>
                    <th><?php echo $this->Paginator->sort('Expense.date', __('Date')); ?></th>
                    <th><?php echo $this->Paginator->sort('Expense.amount', __('Amount')); ?></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($expenses)) :
                    $page = $this->request->params['paging']['Expense']['page'];
                    $limit = $this->request->params['paging']['Expense']['limit'];
                    $i = ($page - 1) * $limit;
                    foreach ($expenses as $row) :
                        $i++;

                        ?>
                        <tr  id="<?php echo 'row' . h($row['Expense']['id']); ?>">
                            <td><?php echo 'Exp                                                                                                                                                                                                                                                                                             ' . $row['Expense']['id']; ?></td>
                            <td>  <?php
                                if ($row['Expense']['file']):
                                    echo $this->Html->link('<span class="fa-stack"><i class="fa fa-paperclip"></i></span>', array('controller' => 'expenses', 'action' => 'download', $row['Expense']['file']), array('escape' => false));
                                endif;

                                ?>
                                <?php echo h($row['Expense']['description']); ?></td>
                            <td><span class="label label-active"><?php echo h($row['ExpenseCategory']['name']); ?></span></td>                     
                            <td><?php echo $this->Time->format($this->Common->dateShow(), $row['Expense']['date']); ?></td>
                            <td><?= $this->Session->read('Auth.User.currency_symbol'); ?><?php echo h($row['Expense']['amount']); ?></td>
                            <td>	                             
                                <?php if ($this->Common->isAdmin()): ?>
                                    <a class="modal-form" href="#" data-title="Edit Expenses" data-cont="expenses" data-id="<?php echo h($row['Expense']['id']); ?>">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="table-link danger" href="#" data-toggle="modal" data-target="#delProductM" onclick="fieldU('ExpenseId',<?php echo h($row['Expense']['id']); ?>)">
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
    <?php
    if (!empty($expenses)):
        echo $this->element('pagination');
    endif;

    ?>
</div>