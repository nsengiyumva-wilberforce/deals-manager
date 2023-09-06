<?php
/**
 * View for targets home page.
 * 
 * @author:   Impact Outsourcing
 * @Copyright: impact Outsourcing 2023
 * @Website:   https://www.impactoutsourcing.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Add Target Modal -->
<div class="modal fade" id="targetM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
                    <?php echo __('Add Target'); ?>
                </h4>
            </div>
            <?php echo $this->Form->create('Target', array('url' => array('controller' => 'Targets', 'action' => 'add'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm')); ?>
            <div class="modal-body">
                <div class="form-group">
                    <label>
                        <?php echo __('Product'); ?>
                    </label>
                    <?php echo $this->Form->input('Target.product_id', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $productCategories, 'label' => false)); ?>
                </div>
                <div class="form-group">
                    <label>
                        <?php echo __('Target Owner'); ?>
                    </label>
                    <?php echo $this->Form->input('Target.target_owner', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => $users, 'label' => false)); ?>
                </div>
                <div class="form-group">
                    <label>
                        <?php echo __('Target'); ?>
                    </label>
                    <?php echo $this->Form->input('Target.target', array('type' => 'number', 'class' => 'form-control input-inline input-medium')); ?>
                </div>
                <div class="form-group">
                    <?php echo $this->Form->input('Target.description', array('type' => 'textarea', 'row' => 2, 'class' => 'form-control input-inline input-medium', 'placeholder' => __('Description'))); ?>
                </div>
                <div class="form-group">
                    <label>
                        <?php echo __('Deadline'); ?>
                    </label>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <?php echo $this->Form->input('Target.deadline', array('type' => 'text', 'class' => 'form-control datepickerDateT', 'autocomplete' => false)); ?>
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
<!-- Delete Target modal -->
<div class="modal fade" id="delTargetM">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button data-dismiss="modal" class="close" type="button">&times;</button>
                <h4 class="modal-title">
                    <?php echo __('Confirmation'); ?>
                </h4>
            </div>
            <?php echo $this->Form->create('Target', array('url' => array('action' => 'delete'))); ?>
            <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
            <div class="modal-body">
                <p>
                    <?php echo __('Are you sure to delete this Target ?'); ?>
                </p>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary delSubmitS" type="button">
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
                            <?php echo __('Targets'); ?>
                        </h1>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-xs-6">
                        <?php echo $this->Form->input('target_id', array('type' => 'text', 'class' => 'form-control search-data module-search', 'placeholder' => __('Quick Search Targets'), 'data-name' => 'targets', 'label' => false, 'div' => false)); ?>

                    </div>
                    <div class="col-lg-2 col-sm-6 col-xs-6">
                        <div class="pull-right top-page-ui">
                            <?php if ($this->Common->isStaffPermission('32')): ?>
                                <a class="btn btn-primary pull-right" href="#" data-toggle="modal" data-target="#targetM">
                                    <i class="fa fa-plus-circle fa-lg"></i>
                                    <?php echo __('Add Target'); ?>
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
                        <!-- target List -->
                        <div class="table-responsive">
                            <div class="table-scrollable">
                                <table class="table table-hover dataTable table-striped dataTables">
                                    <thead>
                                        <tr>
                                            <th>
                                                <?php echo __('Product'); ?>
                                            </th>
                                            <th>
                                                <?php echo __('Target Owner'); ?>
                                            </th>
                                            <th>
                                                <?php echo __('Target'); ?>
                                            </th>
                                            <th>
                                                <?php echo __('Description'); ?>
                                            </th>
                                            <th>
                                                <?php echo __('Deadline'); ?>
                                            </th>
                                            <th>
                                                <?php echo __('Actual'); ?>
                                            </th>
                                            <th class="text-center"><i class="fa fa-bars" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($targets)):
                                            foreach ($targets as $row):
                                                ?>
                                                <tr id="<?php echo 'item-' . h($row['Target']['id']); ?>">
                                                    <td>
                                                        <?php if ($this->Common->isStaffPermission('33')): ?>
                                                            <a href="javascript:void(0)" data-type="text"
                                                                data-pk="<?php echo h($row['Target']['id']); ?>" data-name="sku"
                                                                ref="popover" data-content="Edit SKU"><?php echo h($row['Product']['sku']); ?></a>
                                                            <?php
                                                        else:
                                                            echo h($row['Product']['sku']);
                                                        endif;

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($this->Common->isStaffPermission('33')): ?>
                                                            <a href="javascript:void(0)" data-type="text"
                                                                data-pk="<?php echo h($row['Target']['id']); ?>" data-name="username"
                                                                ref="popover" data-content="Edit Username"><?php echo h($row['User']['username']); ?></a>
                                                            <?php
                                                        else:
                                                            echo h($row['User']['username']);
                                                        endif;

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($this->Common->isStaffPermission('33')): ?>
                                                            <span class="blue-color">
                                                                <?= h($this->Session->read('Auth.User.currency_symbol')); ?>
                                                            </span>
                                                            <a href="javascript:void(0)" data-type="text"
                                                                data-pk="<?php echo h($row['Target']['id']); ?>" data-name="target"
                                                                ref="popover" data-content="Edit Target"><?php echo h($row['Target']['target']); ?></a>
                                                            <?php
                                                        else:
                                                            echo $this->Session->read('Auth.User.currency_symbol') . '' . h($row['Target']['target']);
                                                        endif;

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($this->Common->isStaffPermission('33')): ?>
                                                            <a href="javascript:void(0)" data-type="text"
                                                                data-content="Edit Description"><?php echo h($row['Target']['description']); ?></a>
                                                            <?php
                                                        else:
                                                            echo h($row['Target']['description']);
                                                        endif;

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($this->Common->isStaffPermission('33')): ?>
                                                            <a href="javascript:void(0)" data-type="text"
                                                                data-pk="<?php echo h($row['Target']['id']); ?>"
                                                                data-content="Edit Deadline"><?php echo h($row['Target']['deadline']); ?></a>
                                                            <?php
                                                        else:
                                                            echo h($row['Target']['deadline']);
                                                        endif;

                                                        ?>
                                                    </td>
                                                    <td>0</td>
                                                    <td class="text-center">
                                                        <?php if ($this->Common->isStaffPermission('34')): ?>
                                                            <a class="table-link danger" href="#" ref="popover"
                                                                data-content="Delete Target" data-toggle="modal"
                                                                data-target="#delTargetM"
                                                                onclick="fieldUT('TargetId',<?php echo h($row['Target']['id']); ?>)"
                                                                ref="popover" data-content="Delete Target">
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
                        <!--End Target List -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>