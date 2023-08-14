<?php
/**
 * Notes modal
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<?php echo $this->Form->create('Note', array('url' => array('controller' => 'notes', 'action' => 'save'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'form-horizontal ajaxValidation')); ?>
<div class="modal-body">
    <?php echo $this->Form->input('Note.id', array('type' => 'hidden', 'class' => 'form-control')); ?>
    <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('Title'); ?>:</label>
        <div class="col-sm-10">
            <?php echo $this->Form->input('Note.title', array('type' => 'text', 'class' => 'form-control', 'label' => false, 'div' => false)); ?>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-2 control-label"><?php echo __('Note'); ?>:</label>
        <div class="col-sm-10">
            <?php echo $this->Form->input('Note.description', array('type' => 'textarea', 'class' => 'form-control', 'value' => $note['Note']['description'], 'label' => false, 'div' => false)); ?>
        </div>
    </div> 
    <div class="form-group"> 
        <label class="col-sm-2 control-label"></label>
        <div class="col-sm-10">
            <div class="form-group color-button" data-toggle="buttons">
                <?php $color = $this->request->data['Note']['color']; ?>
                <label class="btn btn-1<?php echo ($color == 'btn-1')?' active':''; ?>"><input type="radio" name="data[Note][color]" value="btn-1" checked></label>
                <label class="btn btn-2<?php echo ($color == 'btn-2')?' active':''; ?>"><input type="radio" name="data[Note][color]" value="btn-2" ></label>
                <label class="btn btn-3<?php echo ($color == 'btn-3')?' active':''; ?>"><input type="radio" name="data[Note][color]" value="btn-3"></label>
                <label class="btn btn-4<?php echo ($color == 'btn-4')?' active':''; ?>"><input type="radio" name="data[Note][color]" value="btn-4"></label>
                <label class="btn btn-5<?php echo ($color == 'btn-5')?' active':''; ?>"><input type="radio" name="data[Note][color]" value="btn-5"></label>
                <label class="btn btn-6<?php echo ($color == 'btn-6')?' active':''; ?>"><input type="radio" name="data[Note][color]" value="btn-6"></label>
                <label class="btn btn-7<?php echo ($color == 'btn-7')?' active':''; ?>"><input type="radio" name="data[Note][color]" value="btn-7"></label>
                <label class="btn btn-8<?php echo ($color == 'btn-8')?' active':''; ?>"><input type="radio" name="data[Note][color]" value="btn-8"></label>
                <label class="btn btn-9<?php echo ($color == 'btn-9')?' active':''; ?>"><input type="radio" name="data[Note][color]" value="btn-9"></label>
                <label class="btn btn-10<?php echo ($color == 'btn-10')?' active':''; ?>"><input type="radio" name="data[Note][color]" value="btn-10"></label>
                <label class="btn btn-11<?php echo ($color == 'btn-11')?' active':''; ?>"><input type="radio" name="data[Note][color]" value="btn-11"></label>
                <label class="btn btn-12<?php echo ($color == 'btn-12')?' active':''; ?>"><input type="radio" name="data[Note][color]" value="btn-12"></label>
                <label class="btn btn-13<?php echo ($color == 'btn-13')?' active':''; ?>"><input type="radio" name="data[Note][color]" value="btn-13"></label>
                <label class="btn btn-14<?php echo ($color == 'btn-14')?' active':''; ?>"><input type="radio" name="data[Note][color]" value="btn-14"></label>
            </div>
        </div>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label"><?php echo __('Text Color'); ?>:</label>
        <div class="col-sm-9">
            <?php echo $this->Form->input('Note.text_color', array('type' => 'select', 'class' => 'select-box-search full-width', 'options' => array('dm-black' => __('Black'), 'dm-white' => __('White')))); ?>	
        </div>
    </div>
</div>
<div class="modal-footer">              	
    <button type="submit" class="btn btn-primary btn-sm" ><i class="fa fa-check"></i> <?php echo __('Save'); ?></button>
    <button type="button" class="btn btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo __('Close'); ?></button>
</div>
<?php echo $this->Form->end(); ?>
<?php echo $this->Js->writeBuffer(); ?> 