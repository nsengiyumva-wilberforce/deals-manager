<?php
/**
 * View Payment List Page
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
                    <h1 class="pull-left"><?php echo __('Payments'); ?></h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">					  
                    <div class="main-box-body clearfix">
                        <!-- Payment List -->
                        <div class="table-responsive">
                            <div class="table-scrollable">
                                <table class="table table-hover dataTables">
                                    <thead>
                                        <tr>
                                            <th><?php echo __('Payment ID'); ?></th>
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
                                            foreach ($payments as $row) :

                                                ?>
                                                <tr  id="<?php echo 'row' . h($row['Payment']['id']); ?>">
                                                    <td><?php echo '#' . h($row['Payment']['transaction_id']); ?> </td>
                                                    <td><a class="table-link" href="<?php echo $this->Html->url(array("controller" => "invoices", "action" => "view", h($row['Invoice']['id']))); ?>" ref="popover" data-content="View Invoice"><?php echo "INV" . sprintf("%04d", $row['Invoice']['id']); ?></a></td>
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
                        </div>
                        <!--End Payment List -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>