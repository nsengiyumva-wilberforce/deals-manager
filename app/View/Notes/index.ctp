<?php
/**
 * View for notes
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>

<!-- Content -->
<div class="row">											
    <div class="col-lg-12">
        <div class="row">
            <h1 class="pull-left"><?php echo __('Notes'); ?></h1>
            <div class="pull-right top-page-ui">
                <a class="btn btn-primary add-btn" data-title="<?php echo __('Add Note'); ?>" data-cont="notes" data-action="getModal">
                    <i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Add Note'); ?>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="main-box no-header clearfix">					  
                <div class="main-box-body clearfix">                       
                    <ul class="dm-notes"  id="note-section">
                        <?php foreach ($notes as $row): ?>
                            <li id="row<?php echo $row['Note']['id']; ?>">
                                <div class="<?php echo h($row['Note']['color']); ?>">
                                    <small class="<?php echo $row['Note']['text_color']; ?>"><?php echo $this->Time->format($this->Common->dateShow(), h($row['Note']['created'])); ?></small>
                                    <h4 class="<?php echo $row['Note']['text_color']; ?>"><?php echo $row['Note']['title']; ?></h4>
                                    <p class="<?php echo $row['Note']['text_color']; ?>"><?php echo $row['Note']['description']; ?></p>
                                    <span class="note-action">
                                        <a class="pull-left add-btn dm-action"  data-id="<?php echo $row['Note']['id']; ?>" data-title="<?php echo __('Edit Note'); ?>" data-cont="notes" data-action="getModal"><i class="fa fa-edit"></i></a>
                                        <a class="pull-right dm-action danger" data-toggle="modal" data-target="#ajaxdelM" data-title="<?php echo __('Delete Note'); ?>" data-cont="notes" data-action="delete" data-id="<?php echo $row['Note']['id']; ?>"><i class="fa fa-trash-o"></i></a>
                                    </span>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>