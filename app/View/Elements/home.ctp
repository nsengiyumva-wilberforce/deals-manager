<?php
/**
 * Update Home Dashboard modal etc content.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Load Labels -->
<?php if (!empty($Labels)) { ?>
    <?php echo $this->Form->create('Label', array('url' => array('controller' => 'labels', 'action' => 'deal'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm1 label-popup table-responsive')); ?>
    <?php echo $this->Form->input('Label.control', array('type' => 'hidden', 'value' => $control)); ?>
    <?php echo $this->Form->input('Label.deal_id', array('type' => 'hidden', 'value' => $dealId)); ?>
    <table class="table table-hover dataTable">
        <tbody>
            <?php foreach ($Labels as $row): ?>
                <tr>
                    <td>
                        <span class="label <?= h($row['Label']['color']); ?>"><?= h($row['Label']['name']); ?></span>         </td>
                    <td>
                        <div class="onoffswitch">
                            <input type="checkbox"  id="myonoffswitch<?= h($row['Label']['id']); ?>" class="onoffswitch-checkbox"  name="data[Label][labels][]" value="<?= h($row['Label']['id']); ?>"  <?php
                            if (in_array($row['Label']['id'], $labelsDeal)) {
                                echo 'checked';
                            }

                            ?>>
                            <label for="myonoffswitch<?= $row['Label']['id']; ?>" class="onoffswitch-label">
                                <div class="onoffswitch-inner"></div>
                                <div class="onoffswitch-switch"></div>
                            </label>
                        </div>
                    </td>

                </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="2" class="text-center"><?php echo $this->Form->Submit(__('Save Changes'), array('class' => 'btn btn-primary blue', 'div' => false)); ?></td>
            </tr>
        </tbody>
    </table>

    <?php echo $this->Form->end(); ?>	
    <?php echo $this->Js->writeBuffer(); ?>
<?php } ?>

<!-- Load deals on dashboard stage scroll down. -->
<?php
if (!empty($deals)) {
    foreach ($deals as $row):

        ?>
        <li class="ui-state-default" id="<?= h($row['Deal']['id']); ?>">
            <div class="deal-labels">
                <?php foreach ($row['Labels'] as $label): ?>
                    <div class="deal-label <?= h($label['Label']['color']); ?>">
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="deal-name">
                <?php echo $this->Html->link(h($row['Deal']['name']), array('controller' => 'deals', 'action' => 'view', $row['Deal']['id']), array('escape' => false)); ?>
            </div>
            <div class="deal-price">
                <div class="manager-half">
                    <?= $this->Session->read('Auth.User.currency_symbol'); ?><?= ($row['Deal']['price']) ? h($row['Deal']['price']) : '0'; ?>
                </div>
                <div class="manager-half">  
                    <span class="pull-left" data-target="#uDealM" data-toggle="modal" data-id="<?= h($row['Deal']['id']); ?>" data-name="tasks">
                        <i class="fa fa-list"></i>
                    </span>
                    <span class="pull-right" data-target="#uDealM" data-toggle="modal" data-id="<?= h($row['Deal']['id']); ?>" data-name="contacts">
                        <i class="fa fa-paw"></i>
                    </span>   
                </div>
            </div>
            <div class="deal-user">
                <?php
                if (!empty($row['Users'])) {
                    foreach ($row['Users'] as $user):
                        echo $this->Html->image('avatar/thumb/' . $user['User']['picture'], array('class' => 'img-circle'));
                    endforeach;
                }

                ?>
                <span class="pull-right dv-label" data-target="#uDealSM" data-toggle="modal" data-id="<?= h($row['Deal']['id']); ?>" data-name="Labels">
                    <i class="fa fa-tag"></i>
                </span> 

            </div>
        </li>
        <?php
    endforeach;
    $dealCount = count($deals);
    if ($dealCount == 10):

        ?>
        <li class="load-li"><button class="load_more label label-primary" data-id="<?= $stageId; ?>"><?php echo __('Load More'); ?></button>
            <div class="animation_image"><?php echo $this->Html->image('ajax-loader.gif'); ?> <?php echo __('Loading'); ?>...</div>
        </li>
        <?php
    endif;
}

?>
<!-- Product details update -->
<?php if (!empty($ProductDeal)) { ?>
    <?php echo $this->Form->create('Product', array('url' => array('controller' => 'products', 'action' => 'discount'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'vForm1 table-responsive')); ?>
    <?php echo $this->Form->input('ProductDeal.id', array('type' => 'hidden', 'value' => h($ProductDeal['ProductDeal']['id']))); ?>
    <div class="form-group">
        <label><?php echo __('Quantity'); ?></label>
        <?php echo $this->Form->input('ProductDeal.quantity', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'value' => h($ProductDeal['ProductDeal']['quantity']))); ?>	
    </div>
    <div class="form-group">
        <label><?php echo __('Discount'); ?></label>
        <div class="input-group">
            <?php echo $this->Form->input('ProductDeal.discount', array('type' => 'text', 'class' => 'form-control input-inline input-medium', 'value' => h($ProductDeal['ProductDeal']['discount']))); ?>	
            <span class="input-group-addon">%</span>
        </div>
    </div>
    <?php echo $this->Form->Submit(__('Save Changes'), array('class' => 'btn btn-primary blue', 'div' => false)); ?>			
    <?php echo $this->Form->end(); ?>	
    <?php echo $this->Js->writeBuffer(); ?>
<?php } ?>