<?php
/**
 * View for Maintenance Logs home page.
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
                <div class="main-box no-header clearfix">
                    <div class="main-box-body clearfix">
                        <!-- Product List -->
                        <div class="table-responsive">
                            <div class="table-scrollable">
                                <table class="table table-hover dataTable table-striped dataTables">
                                    <thead>
                                        <tr>
                                            <th>
                                                <?php echo __('Product'); ?>
                                            </th>
                                            <th>
                                                <?php echo __('Performed By'); ?>
                                            </th>
                                            <th>
                                                <?php echo __('Description'); ?>
                                            </th>
                                            <th>
                                                <?php echo __('Date'); ?>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($maintenanceLogs)):

                                            foreach ($maintenanceLogs as $row):

                                                ?>
                                                <tr id="<?php echo 'row' . h($row['Maintenance']['id']); ?>">
                                                    <td>
                                                        <?php if ($this->Common->isStaffPermission('33')): ?>
                                                            <a href="javascript:void(0)" data-type="text"
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
                                                                
                                                                ref="popover"><?php echo h($row['Maintenance']['performed_by']); ?></a>
                                                            <?php
                                                        else:
                                                            echo h($row['Maintenance']['performed_by']);
                                                        endif;

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($this->Common->isStaffPermission('33')): ?>
                                                            <a href="javascript:void(0)" data-type="text"
                                                            
                                                                ref="popover"><?php echo h($row['Maintenance']['description']); ?></a>
                                                            <?php
                                                        else:
                                                            echo h($row['Maintenance']['description']);
                                                        endif;

                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php if ($this->Common->isStaffPermission('33')): ?>
                                                            <a href="javascript:void(0)" data-type="text"
                                                                
                                                                ref="popover"><?php echo h($row['Maintenance']['created']); ?></a>
                                                            <?php
                                                        else:
                                                            echo h($row['Maintenance']['created']);
                                                        endif;

                                                        ?>
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