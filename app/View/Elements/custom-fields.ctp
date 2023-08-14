<?php
/**
 * List custom fields.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div class="row top-margin">
    <div class="table-responsive">
        <div class="table-scrollable">
            <table class="table table-hover dataTable">
                <thead>
                    <tr>
                        <th><?php echo __('Field'); ?></th>
                        <th><?php echo __('Value'); ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($custom)) :
                        foreach ($custom as $row) :

                            ?>
                            <tr>                               
                                <td><strong><?= h($row['Custom']['name']); ?></strong></td>
                                <td><a href="javascript:void(0)"  data-type="text" data-pk="<?php echo h($row['CustomDeal']['id']); ?>" data-url="<?php echo $this->Html->url(array('controller' => 'customs', 'action' => 'deal')); ?>"  class="editable editable-click vEdit" ><?= h($row['CustomDeal']['value']); ?></a></td>
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