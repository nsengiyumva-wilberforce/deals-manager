<?php
/**
 * List deals won and loss history
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>	
<div class="table-scrollable">
    <table class="table table-hover dataTable dataTables">
        <thead>
            <tr>
                <th><?php echo __('Name'); ?></th>
                <th><?php echo __('Pipeline'); ?></th>
                <th><?php echo __('Stage'); ?></th>
                <th><?php echo __('By'); ?></th>
                <th><?php echo __('Reason'); ?></th>
                <th><?php echo __('At'); ?></th>
                <th><?php echo __('Active Again'); ?></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($deals)) :
                foreach ($deals as $row) :

                    ?>
                    <tr  id="<?php echo 'row' . h($row['History']['id']); ?>">
                        <td><?= h($row['History']['deal_name']); ?></td>
                        <td><?= h($row['History']['pipeline']); ?></td>
                        <td> <?= h($row['History']['stage']); ?> </td>
                        <td> <?= h($row['History']['user']); ?> </td>
                        <td> <?= h($row['History']['reason']); ?> </td>
                        <td> <?php echo $this->Time->format($this->Common->dateTime(), $row['History']['created']); ?> </td>
                        <td> <?php echo $this->Html->link('Active', array('controller' => 'deals', 'action' => 'active', h($row['History']['id'])), array('escape' => false, 'class' => 'btn btn-primary btn-xs')); ?> </td>
                        <td>
                            <a class="table-link" href="<?php echo $this->Html->url(array("controller" => "deals", "action" => "history", h($row['History']['deal_id']))); ?>">
                                <i class="fa fa-eye"></i>
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