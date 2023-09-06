<?php
/**
 * View for setting brand page.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Add brand category modal -->
<div class="modal fade" id="addM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><?php echo __('Add Brand Category'); ?></h4>
            </div>
            <div class="modal-body">
                <div class="error-Msg"></div>
                <?php echo $this->Form->create('Brand', array('url' => array('controller' => 'products', 'action' => 'add_brand_category'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm1')); ?>
                <div class="form-group">          
                    <?php echo $this->Form->input('BrandCategory.name', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Category Name'))); ?>	
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('BrandCategory.description', array('type' => 'textarea', 'class' => 'form-control input-inline input-medium', 'Placeholder' => __('Category Description'))); ?>	
                </div>
            </div>
            <div class="modal-footer">			
                <?php echo $this->Form->Submit(__('Save'), array('class' => 'btn btn-primary blue', 'id' => 'addUserSubmitBtn', 'div' => false)); ?>					
                <button class="btn default" data-dismiss="modal" type="button"><?php echo __('Close'); ?></button>
            </div>
            <?php echo $this->Form->end(); ?>	
            <?php echo $this->Js->writeBuffer(); ?>
        </div>
    </div>
</div>
<!-- Delete brand category modal -->
<div class="modal fade" id="delM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title"><?php echo __('Confirmation'); ?></h4>
            </div>
            <?php echo $this->Form->create('Product', array('url' => array('action' => 'remove_brand'))); ?>
            <?php echo $this->Form->input('BrandCategory.id', array('type' => 'hidden')); ?>
            <div class="modal-body">						
                <p><?php echo __('Are you sure to delete this brand category ? Make sure brand category have no active brands.'); ?> </p>
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
<!-- Content -->
<div class="row"> 
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">
                    <h1 class="pull-left"><?php echo __('Brands Category'); ?></h1>
                    <div class="pull-right top-page-ui">
                        <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#addM">
                            <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Add Brand Category'); ?>
                        </a> 
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- Setting Sidebar -->
            <div class="col-sm-3">
                <?php echo $this->element('settings-sidebar'); ?>
            </div>
            <!-- /Setting Sidebar -->
            <div class="col-sm-9">
                <div class="main-box no-header clearfix">					  
                    <div class="main-box-body clearfix">                                              
                        <div  class="row">
                            <div class="table-scrollable">
                                <table class="table table-hover dataTables">
                                    <thead>
                                        <tr>
                                            <th><?php echo __('Category Name'); ?></th>									 
                                            <th><?php echo __('Description'); ?></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($brandsC)) {
                                            foreach ($brandsC as $row):

                                                ?>
                                                <tr  id="<?php echo 'row' . h($row['BrandCategory']['id']); ?>">
                                                    <td>
                                                        <a href="#"  data-type="text" data-pk="<?= h($row['BrandCategory']['id']); ?>" data-name="name" data-url="<?php echo $this->Html->url(array('controller' => 'brands', 'action' => 'update')); ?>"  class="vEdit"> <?= h($row['BrandCategory']['name']); ?></a>
                                                    </td>
                                                    <td>
                                                        <a href="#"  data-type="textarea" data-pk="<?= h($row['BrandCategory']['id']); ?>" data-name="description" data-url="<?php echo $this->Html->url(array('controller' => 'brands', 'action' => 'update')); ?>"  class="vEdit">   <?= h($row['BrandCategory']['description']); ?></a>
                                                    </td>
                                                    <td>	                                                             
                                                        <a class="table-link danger" href="#" data-toggle="modal"  data-target="#delM" onclick="fieldU('BrandCategoryId',<?php echo h($row['BrandCategory']['id']); ?>)">
                                                            <i class="fa fa-trash-o"></i>
                                                            </span>
                                                        </a>					
                                                    </td>
                                                </tr>
                                                <?php
                                            endforeach;
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
    </div>
</div>
<!-- /Content -->