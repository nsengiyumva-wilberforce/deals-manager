<?php
/**
 * List products in deal detail page.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div class="row">
    <div class="input-group col-md-12">
        <?php echo $this->Form->input('Product.name', array('type' => 'text', 'class' => 'form-control input-lg typeahead', 'data-provide' => 'typeahead', 'label' => false, 'div' => false, 'Placeholder' => __('Search Product'), 'id' => 'products', 'label' => false, 'autocomplete' => 'off')); ?>
    </div>
</div>
<div class="row top-margin">
    <div class="table-responsive">
        <div class="table-scrollable">
            <table class="table table-hover dataTable table-striped">
                <thead>
                    <tr>
                        <th><?php echo __('Name'); ?></th>
                        <th><?php echo __('Price'); ?></th>
                        <th><?php echo __('Quantity'); ?></th>
                        <th><?php echo __('Discount'); ?></th>
                        <th><?php echo __('Sum'); ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($products)) :
                        foreach ($products as $row) :

                            ?>
                            <tr  id="<?php echo 'row' . h($row['Product']['id']); ?>">
                                <td> <a href="<?php echo $this->Html->url(array("controller" => "products", "action" => "view", $row['Product']['id'])); ?>"><?= h($row['Product']['name']); ?></a> </td>
                                <td> <?= h($this->Session->read('Auth.User.currency_symbol')); ?><?= h($row['Product']['price']); ?></td>
                                <td> <?= h($row['ProductDeal']['quantity']); ?>  </td>
                                <td> <?= h($row['ProductDeal']['discount']); ?>% </td>
                                <td> <?= h($this->Session->read('Auth.User.currency_symbol')); ?><?= h($row['ProductDeal']['price']); ?> </td>
                                <td>
                                    <a class="table-link" href="#" data-toggle="modal" data-target="#uDealSM"   data-name="products" data-id="<?= $row['ProductDeal']['id']; ?>">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a class="table-link danger" href="#" data-toggle="modal" data-target="#delM"  data-title="<?php echo __('Delete Product'); ?>" data-action="products" data-id="<?= $row['Product']['id']; ?>">
                                        <i class="fa fa-trash-o"></i></span>
                                    </a>					
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
</div>