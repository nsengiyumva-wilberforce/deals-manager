<?php
/**
 * List sources in deal detail page.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div class="row">
    <div class="input-group col-md-12">
        <?php echo $this->Form->input('Source.name', array('type' => 'text', 'class' => 'form-control input-lg typeahead blank', 'data-provide' => 'typeahead', 'label' => false, 'div' => false, 'Placeholder' => __('Search Source'), 'id' => 'sources', 'label' => '', 'autocomplete' => 'off', 'required' => true)); ?>
    </div>
</div>
<div class="row top-margin">
    <div class="table-responsive">
        <div class="table-scrollable">
            <table class="table table-hover dataTable table-striped">
                <thead>
                    <tr>
                        <th><?php echo __('Name'); ?></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!empty($sources)) :
                        foreach ($sources as $row) :

                            ?>
                            <tr id="<?php echo 'row' . h($row['Source']['id']); ?>">
                                <td>
                                    <a href="<?php echo $this->Html->url(array("controller" => "sources", "action" => "view", h($row['Source']['id']))); ?>"><?= h($row['Source']['name']); ?></a>
                                </td>
                                <td>		
                                    <a class="table-link danger" href="#" data-toggle="modal" data-target="#delM"  data-title="<?php echo __('Delete Source'); ?>" data-action="sources" data-id="<?= $row['Source']['id']; ?>" >
                                        <i class="fa fa-trash-o"></i></span>
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
    </div>
</div>