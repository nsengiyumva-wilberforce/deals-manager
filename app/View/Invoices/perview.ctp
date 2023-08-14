<div class="invoice-preview">
    <div class="invoice-div">
        <table>
            <tbody>
                <tr>
                    <td class="w50">
                        <div class="w10">
                            <?php echo $this->Html->image($settings['Setting']['title_logo']); ?>
                        </div>
                    </td>
                    <td class="w50">
                        <div class="header-right">
                            <span><?php echo __('Invoice'); ?>: </span> <span class="invoice-id"> <?php echo "INV" . sprintf("%04d", h($Invoice['Invoice']['custom_id'])); ?> </span>
                            <div class="h10"></div>
                            <span><?php echo __('Bill Date'); ?>: <?php echo date($this->Common->dateShow(), strtotime($Invoice['Invoice']['issue_date'])); ?></span><br>
                            <span><?php echo __('Due Date'); ?>: <?php echo date($this->Common->dateShow(), strtotime($Invoice['Invoice']['due_date'])); ?></span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div><br><br>
    <div class="invoice-div">
        <table>
            <tbody>
                <tr>
                    <td class="w70">
                        <div><b><?php echo h($CompanyAdmin['SettingCompany']['name']); ?></b></div>
                        <span class="invoice-span">
                            <div><?php echo h($CompanyAdmin['SettingCompany']['address']); ?><br>
                                <?php echo h($CompanyAdmin['SettingCompany']['city']) . ',' . h($CompanyAdmin['SettingCompany']['state']) . " " . h($CompanyAdmin['SettingCompany']['zip_code']); ?><br>                                                    
                                <?php echo h($CompanyAdmin['SettingCompany']['country']); ?>
                                <div class="h25"><?php echo __('Phone'); ?>: <?php echo h($CompanyAdmin['SettingCompany']['telephone']); ?></div>
                            </div>
                        </span>
                    </td>                        
                    <td class="w30">
                        <div>
                            <div><strong><?php echo __('Bill To'); ?></strong></div>
                            <div class="invoice-comp"></div><br>
                            <div><?php echo h($Company['Company']['name']); ?></div>
                            <span class="invoice-span">
                                <div>
                                    <?php echo h($Company['Company']['address']); ?><br>
                                    <?php echo h($Company['Company']['city']) . ' ' . h($Company['Company']['state']) . " " . h($Company['Company']['zip_code']); ?><br>
                                    <?php echo h($Company['Company']['country']); ?> 
                                </div>
                            </span>
                        </div>  
                    </td>
                </tr>
            </tbody>
        </table>
    </div><br><br>
    <table class="tt invoice-products">            
        <tbody>
            <tr class="product-header">
                <th class="invoice-item"> <?php echo __('Item'); ?> </th>
                <th class="invoice-qty"> <?php echo __('Quantity'); ?></th>
                <th class="invoice-qty"> <?php echo __('Rate'); ?></th>
                <th class="invoice-total"> <?php echo __('Total'); ?></th>
            </tr>
            <?php
            $sum = 0;
            foreach ($invoiceProducts as $row) :

                ?>
                <tr class="product-bck">
                    <td class="product-name"><?php echo h($row['InvoiceProduct']['product_name']); ?><br>
                        <span class="product-desc"><?php echo h($row['InvoiceProduct']['product_description']); ?></span>
                    </td>
                    <td class="product-qty"> <?php echo h($row['InvoiceProduct']['product_quantity']); ?></td>
                    <td class="invoice-price"> <?php echo h($Invoice['Invoice']['currency']) . h($row['InvoiceProduct']['product_unit_price']); ?></td>
                    <td class="product-total"> <?php echo h($Invoice['Invoice']['currency']) . h($row['InvoiceProduct']['product_total']); ?></td>
                </tr>
                <?php
                $sum += $row['InvoiceProduct']['product_total'];
            endforeach;

            ?>
            <?php $tax = $Invoice['Invoice']['custom_tax'] / 100 * $sum; ?>
            <tr>
                <td colspan="3" class="invoice-right"><?php echo __('Total'); ?></td>
                <td class="invoice-cr">
                    <?php echo h($Invoice['Invoice']['currency']) . $sum; ?>        
                </td>
            </tr>
            <?php if ($Invoice['Invoice']['discount']): ?>
                <tr>
                    <td colspan="3" class="invoice-right"><?php echo __('Discount'); ?></td>
                    <td class="invoice-cr">
                        <?php
                        echo h($Invoice['Invoice']['currency']) . '' . h($Invoice['Invoice']['discount']);
                        $sum = $sum - h($Invoice['Invoice']['discount']);

                        ?>     
                    </td>
                </tr>
            <?php endif; ?>
            <tr>
                <td colspan="3" class="invoice-right"><?php echo __('Tax'); ?> (<?php echo h($Invoice['Invoice']['custom_tax']); ?>%)</td>
                <td class="invoice-cr">
                    <?php
                    $tax = $Invoice['Invoice']['custom_tax'] / 100 * $sum;
                    echo ($tax < 0) ? '-' . h($Invoice['Invoice']['currency']) . abs($tax) : h($Invoice['Invoice']['currency']) . abs($tax);

                    ?>       
                </td>
            </tr>
            <?php
            $pSum = 0;
            foreach ($payments as $row) :
                $pSum += $row['Payment']['amount'];
            endforeach;

            ?>
            <tr>
                <td colspan="3" class="invoice-right"><?php echo __('Paid'); ?></td>
                <td class="invoice-cr">
                    <?php echo h($Invoice['Invoice']['currency']) . $pSum; ?>           
                </td>
            </tr>
            <tr>
                <td colspan="3" class="invoice-right"><?php echo __('Balance Due'); ?></td>
                <td class="invoice-due">

                    <?php
                    $total = ($sum + $tax) - $pSum;
                    if ($total < 0) : 
                        echo '-' . h($Invoice['Invoice']['currency']) . abs($total);
                    else : 
                        echo h($Invoice['Invoice']['currency']) . $total;
                    endif;

                    ?>      </td>
            </tr>
        </tbody>
    </table>

    <br>
    <br>
    <div class="invoice-note">
        <div><?php echo h($Invoice['Invoice']['note']); ?></div>
    </div>

    <div class="mt15">
    </div>

</div>   
<!--Custom CSS -->
<?php echo $this->Html->css('invoice.css?' . rand); ?>
<!--End Custom CSS -->