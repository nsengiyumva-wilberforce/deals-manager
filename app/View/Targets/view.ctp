<?php
/**
 * View for product details page.
 * 
 * @author:   impactoutsourcing.com
 * @Copyright: Impact outsourcing 2022
 * @Website:   https://www.impactoutsourcing.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="main-box no-header clearfix">	
                <div class="main-box-body clearfix">
                    <div class="row" >                         
                        <div class="col-sm-12 contact-view-box text-center">
                            <h1><?= h($Product['Product']['name']); ?></h1>                           
                        </div>
                        <table class="table">
                            <tbody>
                            <tr>
                                    <td><strong><?php echo __('SKU'); ?></strong></td>
                                    <td><?= h($Product['Product']['sku']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo __('Name'); ?></strong></td>
                                    <td><?= h($Product['Product']['name']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo __('Category'); ?></strong></td>
                                    <td><?= h($Product['Product']['category']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo __('Brand'); ?></strong></td>
                                    <td><?= h($Product['Product']['brand']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo __('Price'); ?></strong></td>
                                    <td><?= h($this->Session->read('Auth.User.currency_symbol')); ?><?= h($Product['Product']['price']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo __('unit'); ?></strong></td>
                                    <td><?= h($Product['Product']['unit']); ?></td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo __('Qty'); ?></strong></td>
                                    <td><?= h($Product['Product']['quantity']); ?></td>
                                </tr>       
                            </tbody>
                        </table>
                    </div>                                           
                    <div class="row">
                        <div class="contact-box-heading">
                            <span><strong><?php echo __('Deals'); ?></strong></span>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="text-center"><span><?php echo __('Name'); ?></span></th>
                                    <th class="text-center"><span><?php echo __('Pipeline'); ?></span></th>
                                    <th class="text-center"><span><?php echo __('Stage'); ?></span></th>
                                    <th class="text-center"><span></span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($deals) {
                                    foreach ($deals as $row):

                                        ?>
                                        <tr>
                                            <td class="text-center">
                                                <a href="<?php echo $this->Html->url(array('controller' => 'deals', 'action' => 'view', h($row['Deal']['id']))); ?>">  <?= h($row['Deal']['name']); ?></a>
                                            </td>                                       
                                            <td class="text-center">
                                                <?= h($row['Pipeline']['name']); ?>
                                            </td>
                                            <td class="text-center">
                                                <?= h($row['Stage']['name']); ?>
                                            </td>
                                            <td class="text-center">
                                                <?php $this->Common->status($row['Deal']['status']); ?>
                                            </td>
                                        </tr>
                                        <?php
                                    endforeach;
                                } else {
                                    echo '<tr><td colspan="4" class="text-center">' . __('No deal in this product.') . '</td></tr>';
                                }

                                ?>                                  
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>