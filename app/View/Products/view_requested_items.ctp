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
<!-- Content -->
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">
                    <div class="col-lg-6 col-sm-12 col-xs-12">
                        <h1 class="pull-left">
                            <?php echo __('Items Requests'); ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">
                    <div class="main-box-body clearfix">
                        <!-- Request List -->
                        <div class="table-responsive">
                            <div class="table-scrollable">
                                <table class="table table-hover dataTable table-striped dataTables">
                                    <thead>
                                        <tr>
                                            <th>
                                                <?php echo __('Item SKU'); ?>
                                            </th>
                                            <th>
                                                <?php echo __('Requester Name'); ?>
                                            </th>
                                            <th>
                                                <?php echo __('Purpose Of Issuance'); ?>
                                            </th>
                                            <th>
                                                <?php echo __('Quantity Requested'); ?>
                                            </th>
                                            <th>
                                                <?php echo __('Return Date'); ?>
                                            </th>
                                            <th>
                                                <?php echo __('Description'); ?>
                                            </th>
                                            <th>
                                                <?php echo __('Status'); ?>
                                            </th>
                                            <th class="text-center"><i class="fa fa-bars" aria-hidden="true"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($requests)):

                                            foreach ($requests as $row):

                                                ?>
                                                <tr id="<?php echo 'row' . h($row['Request']['id']); ?>">
                                                    <td>
                                                        <?php if ($this->Common->isStaffPermission('33')): ?>
                                                            <a href="javascript:void(0)" data-type="text"
                                                                data-pk="<?php echo h($row['Request']['id']); ?>" data-name="product_id"
                                                                ref="popover"><?php echo h($row['Product']['sku']); ?></a>
                                                            <?php
                                                        else:
                                                            echo h($row['Product']['sku']);
                                                        endif;

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($this->Common->isStaffPermission('33')): ?>
                                                            <a href="javascript:void(0)" data-type="text"
                                                                data-pk="<?php echo h($row['Request']['id']); ?>" data-name="product_id"
                                                                ref="popover"><?php echo h($row['User']['username']); ?></a>
                                                            <?php
                                                        else:
                                                            echo h($row['User']['username']);
                                                        endif;

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($this->Common->isStaffPermission('33')): ?>
                                                            <a href="javascript:void(0)" data-type="text"
                                                                data-pk="<?php echo h($row['Request']['id']); ?>" data-name="product_id"
                                                                ref="popover"><?php echo h($row['IssuanceCategory']['name']); ?></a>
                                                            <?php
                                                        else:
                                                            echo h($row['IssuanceCategory']['name']);
                                                        endif;

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($this->Common->isStaffPermission('33')): ?>
                                                            <a href="javascript:void(0)" data-type="text"
                                                                data-pk="<?php echo h($row['Request']['id']); ?>" data-name="product_id"
                                                                ref="popover"><?php echo h($row['Request']['quantity_requested']); ?></a>
                                                            <?php
                                                        else:
                                                            echo h($row['Request']['description']);
                                                        endif;

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($this->Common->isStaffPermission('33')): ?>
                                                            <a href="javascript:void(0)" data-type="text"
                                                                data-pk="<?php echo h($row['Request']['id']); ?>" data-name="product_id"
                                                                ref="popover"><?php echo ($row['Request']['return_date'])?h($row['Request']['return_date']):h("N/A"); ?></a>
                                                            <?php
                                                        else:
                                                            echo ($row['Request']['return_date'])?h($row['Request']['return_date']):h("N/A");
                                                        endif;

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($this->Common->isStaffPermission('33')): ?>
                                                            <a href="javascript:void(0)" data-type="text"
                                                                data-pk="<?php echo h($row['Request']['id']); ?>" data-name="product_id"
                                                                ref="popover"><?php echo h($row['Request']['description']); ?></a>
                                                            <?php
                                                        else:
                                                            echo h($row['Request']['description']);
                                                        endif;

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($this->Common->isStaffPermission('33')): ?>
                                                            <a href="javascript:void(0)" data-type="text"
                                                                data-pk="<?php echo h($row['Request']['id']); ?>" data-name="product_id"
                                                                ref="popover"><?php echo ($row['Request']['status'])?"Approved":"Pending"; ?></a>
                                                            <?php
                                                        else:
                                                            echo h($row['Request']['status']);
                                                        endif;

                                                        ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($this->Common->isStaffPermission('34')): ?>
                                                            <a class="table-link primary" href="<?php echo $this->Html->url(array("controller" => "products", "action" => "approve_request", h($row['Request']['id']))); ?>" 
                                                            ref="popover"
                                                                data-content="Approve Request" data-toggle="modal"
                                                                ref="popover" data-content="Approve Request">
                                                                <i class="fa fa-check"></i>
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