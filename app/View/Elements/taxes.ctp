<?php
/**
 * List all taxes
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div id="uTax" >
    <?php echo $this->element('paginator', array('updateDivId' => 'uTax')); ?>	
    <div class="table-scrollable">
        <table class="table table-hover dataTable dataTables">
            <thead>
                <tr>
                    <th><?php echo $this->Paginator->sort('Tax.name', __('Tax Rate Name')); ?></th>
                    <th><?php echo $this->Paginator->sort('Tax.name', __('Tax Rate %')); ?></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($taxes)) :
                    $page = $this->request->params['paging']['Tax']['page'];
                    $limit = $this->request->params['paging']['Tax']['limit'];
                    $i = ($page - 1) * $limit;
                    foreach ($taxes as $row) :
                        $i++;

                        ?>
                        <tr  id="<?php echo 'row' . h($row['Tax']['id']); ?>">
                            <td>
                                <a href="javascript:void(0)"  data-type="text" data-pk="<?php echo h($row['Tax']['id']); ?>" data-url="edit_tax"  class="editable editable-click vEdit" ><?php echo h($row['Tax']['name']); ?></a>                                
                            </td>
                            <td>
                                <a href="javascript:void(0)"  data-type="text" data-pk="<?php echo h($row['Tax']['id']); ?>" data-url="edit_tax"  class="editable editable-click vEdit" ><?php echo h($row['Tax']['rate']) . '%'; ?></a>                                
                            </td>
                            <td>

                                <?php if ($this->Common->isAdmin()): ?>
                                    <a class="table-link danger" href="#" data-toggle="modal" data-target="#delTaxM" onclick="fieldU('TaxId',<?php echo h($row['Tax']['id']); ?>)">
                                        <span class="fa-stack">
                                            <i class="fa fa-square fa-stack-2x"></i><i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                        </span>
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
    <?php
    if (!empty($taxes)):
        echo $this->element('pagination');
    endif;

    ?>
</div>