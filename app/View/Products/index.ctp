<?php
/**
 * View for product home page.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Add Product Modal --> 
<div class="modal fade" id="productM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo __('Add Product'); ?></h4>
            </div>
            <?php echo $this->Form->create('Product', array('url' => array('controller' => 'Products', 'action' => 'add'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
            <div class="modal-body">													
                <div class="form-group">
                    <label><?php echo __('Name'); ?></label>
                    <?php echo $this->Form->input('Product.name', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Product Name'))); ?>	
                </div>
                <div class="form-group">
                    <label><?php echo __('Price'); ?></label>
                    <div class="input-group">
                        <span class="input-group-addon"><?= $this->Session->read('Auth.User.currency_symbol'); ?></span>
                        <?php echo $this->Form->input('Product.price', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Product Price'), 'value' => 0)); ?>	
                    </div>
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
<!-- Delete product modal -->
<div class="modal fade" id="delProductM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('Product', array('url' => array('action' => 'delete'))); ?>
            <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p><?php echo __('Are you sure to delete this Product ?'); ?>  </p>
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
                    <div class="col-lg-6 col-sm-12 col-xs-12">
                        <h1 class="pull-left"><?php echo __('Products'); ?></h1>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-6">
                        <?php echo $this->Form->input('product_id', array('type' => 'text', 'class' => 'form-control search-data module-search', 'placeholder' => __('Quick Search Products'), 'data-name' => 'products', 'label' => false, 'div' => false)); ?>

                    </div>
                    <div class="col-lg-2 col-sm-6 col-xs-6">
                        <div class="pull-right top-page-ui">
                            <?php if ($this->Common->isStaffPermission('32')): ?>                    
                                <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#productM">
                                    <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Add Product'); ?>
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
                                            <th><?php echo __('Name'); ?></th>
                                            <th><?php echo __('Price'); ?></th>
                                            <th class="text-center"><i class="fa fa-bars" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($products)) :

                                            foreach ($products as $row) :

                                                ?>
                                                <tr  id="<?php echo 'row' . h($row['Product']['id']); ?>">
                                                    <td>
                                                        <?php if ($this->Common->isStaffPermission('33')) : ?>
                                                            <a href="javascript:void(0)"  data-type="text" data-pk="<?php echo h($row['Product']['id']); ?>" data-name="name" data-url="products/edit"  class="editable editable-click vEdit" ref="popover" data-content="Edit Name" ><?php echo h($row['Product']['name']); ?></a>
                                                            <?php
                                                        else :
                                                            echo h($row['Product']['name']);
                                                        endif;

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($this->Common->isStaffPermission('33')) : ?>
                                                            <span class="blue-color"><?= h($this->Session->read('Auth.User.currency_symbol')); ?></span><a href="javascript:void(0)"  data-type="text" data-pk="<?php echo h($row['Product']['id']); ?>" data-name="price" data-url="products/edit"  class="editable editable-click vEdit" ref="popover" data-content="Edit Price" ><?php echo h($row['Product']['price']); ?></a>
                                                            <?php
                                                        else :
                                                            echo $this->Session->read('Auth.User.currency_symbol') . '' . h($row['Product']['price']);
                                                        endif;

                                                        ?>
                                                    </td>
                                                    <td class="text-center">	
                                                        <a class="table-link" ref="popover" data-content="View Product" href="<?php echo $this->Html->url(array("controller" => "products", "action" => "view", h($row['Product']['id']))); ?>" ref="popover" data-content="View Product" >
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                        <?php if ($this->Common->isStaffPermission('34')): ?>
                                                            <a class="table-link danger" href="#" ref="popover" data-content="Delete Product" data-toggle="modal" data-target="#delProductM" onclick="fieldU('ProductId',<?php echo h($row['Product']['id']); ?>)" ref="popover" data-content="Delete Product" >
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