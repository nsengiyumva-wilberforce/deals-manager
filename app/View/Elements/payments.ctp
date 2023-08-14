<?php
/**
 * List all payments
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div id="uDiv" >
    <?php echo $this->element('paginator', array('updateDivId' => 'uDiv')); ?>	
    <div class="table-scrollable">
        <table class="table table-hover dataTable">
            <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('Tax.transaction_id', __('Payment ID')); ?></th>
                    <th><?php echo __('Invoice'); ?></th>
                    <th><?php echo __('Payment Date'); ?></th>
                    <th ><?php echo __('Payment Method'); ?></th>
                    <th ><?php echo __('Note'); ?></th>
                    <th ><?php echo __('Amount'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($payments)) :
                    $page = $this->request->params['paging']['Payment']['page'];
                    $limit = $this->request->params['paging']['Payment']['limit'];
                    $i = ($page - 1) * $limit;
                    foreach ($payments as $row) :
                        $i++;

                        ?>
                        <tr  id="<?php echo 'row' . h($row['Payment']['id']); ?>">
                            <td><?php echo '#' . h($row['Payment']['transaction_id']); ?> </td>
                            <td>
                                <a class="table-link" href="<?php echo $this->Html->url(array("controller" => "invoices", "action" => "view", h($row['Invoice']['id']))); ?>">
                                    <?php
                                    echo "INV" . sprintf("%04d", $row['Invoice']['id']);
                                    ?>
                                </a>
                            </td>
                            <td><?php echo h($row['Payment']['payment_date']); ?> </td>
                            <td><?php echo h($row['PaymentMethod']['name']); ?></td>
                            <td><?php echo h($row['Payment']['note']); ?></td>
                            <td> <?php echo h($row['Invoice']['currency']) . ' ' . h($row['Payment']['amount']); ?></td>
                        </tr>
                        <?php
                    endforeach;
                endif;

                ?>
            </tbody>
        </table>
    </div>
    <?php
    if (!empty($payments)):
        echo $this->element('pagination');
    endif;

    ?>
</div>