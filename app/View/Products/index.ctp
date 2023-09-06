<?php
/**
 * View for product home page.
 * 
 * @author:   Impact Outsourcing
 * @Copyright: impact Outsourcing 2023
 * @Website:   https://www.impactoutsourcing.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Add Product Modal -->
<div class="modal fade" id="productM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    <?php echo __('Add Product'); ?>
                </h4>
            </div>
            <?php echo $this->Form->create('Product', array('url' => array('controller' => 'Products', 'action' => 'add'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label>
                        <?php echo __('SKU'); ?>
                    </label>
                    <?php echo $this->Form->input('Product.sku', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('SKU'))); ?>
                </div>
                <div class="form-group">
                    <label>
                        <?php echo __('Name'); ?>
                    </label>
                    <?php echo $this->Form->input('Product.name', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Product Name'))); ?>
                </div>
                <div class="form-group">
                    <label>
                        <?php echo __('Category'); ?>
                    </label>
                    <?php echo $this->Form->input('Product.category', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $productCategories, 'label' => false)); ?>
                </div>
                <div class="form-group">
                    <label>
                        <?php echo __('Brand'); ?>
                    </label>
                    <?php echo $this->Form->input('Product.brand', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $brandCategories, 'label' => false)); ?>
                </div>
                <div class="form-group">
                    <label>
                        <?php echo __('Unit'); ?>
                    </label>
                    <?php echo $this->Form->input('Product.unit', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $unitCategories, 'label' => false)); ?>
                </div>
                <div class="form-group">
                    <label>
                        <?php echo __('Quantity'); ?>
                    </label>
                    <?php echo $this->Form->input('Product.quantity', array('type' => 'number', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Quantity'))); ?>
                </div>
                <div class="form-group">
                    <label>
                        <?php echo __('Price'); ?>
                    </label>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <?= $this->Session->read('Auth.User.currency_symbol'); ?>
                        </span>
                        <?php echo $this->Form->input('Product.price', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Product Price'), 'value' => 0)); ?>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-primary blue btn-sm" type="submit"><i class="fa fa-check"></i>
                    <?php echo __('Save'); ?>
                </button>
                <button class="btn default btn-sm" data-dismiss="modal" type="button"><i class="fa fa-times"></i>
                    <?php echo __('Close'); ?>
                </button>
            </div>
            <?php echo $this->Form->end(); ?>
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>

<!-- Request Product Modal -->
<div class="modal fade" id="reqProductM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    <?php echo __('Request Item'); ?>
                </h4>
            </div>
            <div class="container">
                <div class="lead">
                    Name:<span id="productNameDisplay"></span>
                </div>
                <div class="lead">
                    SKU:<span id="productSkuDisplay"></span>
                </div>
                <div class="lead">
                    Units in stock:<span id="productQuantityDisplay"></span>
                </div>
            </div>
            <?php echo $this->Form->create('Request', array('url' => array('controller' => 'Products', 'action' => 'request_item'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm1')); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label>
                        <?php echo __('Purpose Of Issuance'); ?>
                    </label>
                    <?php echo $this->Form->input('Request.purpose_of_issuance', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $issuanceCategories, 'label' => false)); ?>
                </div>
                <div class="form-group">
                    <label>
                        <?php echo __('Quantity'); ?>
                    </label>
                    <?php echo $this->Form->input('Request.quantity_requested', array('type' => 'number', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Quantity'))); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('Request.description', array('type' => 'textarea', 'row' => 2, 'class' => 'form-control input-inline input-medium', 'placeholder' => __('Description'))); ?>
                </div>
                <div class="form-group">
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('Request.product_id', array('type' => 'hidden', 'value' => 1, 'label' => false, 'id' => 'productIdRequest')); ?>
                </div>
                <div class="form-group">
                    <label>
                        <?php echo __('Return Date(Optional)'); ?>
                    </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <?php echo $this->Form->input('Request.return_date', array('type' => 'text', 'class' => 'form-control datepickerDateI', 'autocomplete' => false)); ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary blue btn-sm" type="submit"><i class="fa fa-check"></i>
                    <?php echo __('Save'); ?>
                </button>
                <button class="btn default btn-sm" data-dismiss="modal" type="button"><i class="fa fa-times"></i>
                    <?php echo __('Close'); ?>
                </button>
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
                <h4 class="modal-title">
                    <?php echo __('Confirmation'); ?>
                </h4>
            </div>
            <?php echo $this->Form->create('Product', array('url' => array('action' => 'delete'))); ?>
            <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
            <div class="modal-body">
                <p>
                    <?php echo __('Are you sure to delete this Product ?'); ?>
                </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary delSubmit" type="button">
                    <?php echo __('Yes'); ?>
                </button>
                <button class="btn default" data-dismiss="modal" type="button">
                    <?php echo __('No'); ?>
                </button>
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
                    <div class="col-lg-6 col-sm-12 col-xs-12">
                        <h1 class="pull-left">
                            <?php echo __('Products'); ?>
                        </h1>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-6">
                        <?php echo $this->Form->input('product_id', array('type' => 'text', 'class' => 'form-control search-data module-search', 'placeholder' => __('Quick Search Products'), 'data-name' => 'products', 'label' => false, 'div' => false)); ?>

                    </div>
                    <div class="col-lg-2 col-sm-6 col-xs-6">
                        <div class="pull-right top-page-ui">
                            <?php if ($this->Common->isStaffPermission('32')): ?>
                                <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#productM">
                                    <i class="fa fa-plus-circle fa-lg"></i>
                                    <?php echo __('Add Product'); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">
                    <div class="main-box-body clearfix">
                        <!-- Product List -->
                        <div class="table-responsive">
                            <div class="table-scrollable">
                                <table class="table table-hover dataTable table-striped dataTables">
                                    <thead>
                                        <tr>
                                            <th>
                                                <?php echo __('Name'); ?>
                                            </th>
                                            <th>
                                                <?php echo __('SKU'); ?>
                                            </th>
                                            <th>
                                                <?php echo __('Price'); ?>
                                            </th>
                                            <th>
                                                <?php echo __('Unit'); ?>
                                            </th>
                                            <th>
                                                <?php echo __('Units in Stock'); ?>
                                            </th>
                                            <th>
                                                <?php echo __('Units Issued'); ?>
                                            </th>

                                            <th class="text-center"><i class="fa fa-bars" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($products)):

                                            foreach ($products as $row):

                                                ?>
                                                <tr id="<?php echo 'row' . h($row['Product']['id']); ?>">
                                                    <td>
                                                        <?php if ($this->Common->isStaffPermission('33')): ?>
                                                            <a href="javascript:void(0)" data-type="text"
                                                                data-pk="<?php echo h($row['Product']['id']); ?>" data-name="name"
                                                                data-url="products/edit" class="editable editable-click vEdit"
                                                                ref="popover" data-content="Edit Name"><?php echo h($row['Product']['name']); ?></a>
                                                            <?php
                                                        else:
                                                            echo h($row['Product']['name']);
                                                        endif;

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($this->Common->isStaffPermission('33')): ?>
                                                            <a href="javascript:void(0)" data-type="text"
                                                                data-pk="<?php echo h($row['Product']['id']); ?>" data-name="sku"
                                                                data-url="products/edit" class="editable editable-click vEdit"
                                                                ref="popover" data-content="Edit SKU"><?php echo h($row['Product']['sku']); ?></a>
                                                            <?php
                                                        else:
                                                            echo h($row['Product']['sku']);
                                                        endif;

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($this->Common->isStaffPermission('33')): ?>
                                                            <span class="blue-color">
                                                                <?= h($this->Session->read('Auth.User.currency_symbol')); ?>
                                                            </span><a href="javascript:void(0)" data-type="text"
                                                                data-pk="<?php echo h($row['Product']['id']); ?>" data-name="price"
                                                                data-url="products/edit" class="editable editable-click vEdit"
                                                                ref="popover" data-content="Edit Price"><?php echo h($row['Product']['price']); ?></a>
                                                            <?php
                                                        else:
                                                            echo $this->Session->read('Auth.User.currency_symbol') . '' . h($row['Product']['price']);
                                                        endif;

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($this->Common->isStaffPermission('33')): ?>
                                                            <a href="javascript:void(0)" data-type="text"
                                                                data-pk="<?php echo h($row['Product']['id']); ?>" data-name="unit"
                                                                data-url="products/edit" class="editable editable-click vEdit"
                                                                ref="popover" data-content="Edit Unit "><?php echo h($row['Product']['unit']); ?></a>
                                                            <?php
                                                        else:
                                                            echo h($row['Product']['unit']);
                                                        endif;

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($this->Common->isStaffPermission('33')): ?>
                                                            <a href="javascript:void(0)" data-type="text"
                                                                data-pk="<?php echo h($row['Product']['id']); ?>"
                                                                data-name="quantity" data-url="products/edit"
                                                                class="editable editable-click vEdit" ref="popover"
                                                                data-content="Edit Quantity"><?php echo h($row['Product']['quantity']-$approvedRequests); ?></a>
                                                            <?php
                                                        else:
                                                            echo h($row['Product']['quantity']);
                                                        endif;

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($this->Common->isStaffPermission('33')): ?>
                                                            <a href="javascript:void(0)" data-type="text"
                                                                data-pk="<?php echo h($row['Product']['id']); ?>"
                                                                data-name="quantity_issued" data-url="products/edit"
                                                                class="editable editable-click vEdit" ref="popover"
                                                                data-content="Edit Quantity Issued"><?php echo h($approvedRequests); ?></a>
                                                            <?php
                                                        else:
                                                            echo h($approvedRequests);
                                                        endif;

                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="table-link" ref="popover" data-content="View Product"
                                                            href="<?php echo $this->Html->url(array("controller" => "products", "action" => "view", h($row['Product']['id']))); ?>"
                                                            ref="popover" data-content="View Product">
                                                            <i class="fa fa-eye"></i>
                                                        </a>

                                                        <a class="table-link" ref="popover" data-content="View item Requests"
                                                            href="<?php echo $this->Html->url(array("controller" => "products", "action" => "view_requested_items")); ?>"
                                                            ref="popover" data-content="View Item Requests">
                                                            <i class="fa fa-quote-right"></i>
                                                        </a>
                                                        
                                                        <?php if ($this->Common->isStaffPermission('34')): ?>
                                                            <a class="table-link primary" href="#" ref="popover"
                                                                data-content="Request Item" data-toggle="modal"
                                                                data-target="#reqProductM"
                                                                onclick="fieldUR('ProductId',<?php echo h($row['Product']['id']); ?>, '<?php echo h($row['Product']['name']); ?>', <?php echo h($row['Product']['quantity']) ?>, '<?php echo h($row['Product']['sku']); ?>')"
                                                                ref="popover" data-content="Request Item">
                                                                <i class="fa fa-level-up"></i>
                                                            </a>

                                                            <a class="table-link danger" href="#" ref="popover"
                                                                data-content="Delete Item" data-toggle="modal"
                                                                data-target="#delProductM"
                                                                onclick="fieldU('ProductId',<?php echo h($row['Product']['id']); ?>)"
                                                                ref="popover" data-content="Delete Product">
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
                        <!--End Product List -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>