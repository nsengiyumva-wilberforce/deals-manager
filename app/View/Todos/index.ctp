<?php
/**
 * View for todo home page.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-3 col-xs-12">
                <h1 class="pull-left"><?php echo __('Todos'); ?></h1>
            </div>
        </div>
        <!-- Todo List -->
        <div class="row">
            <div id="todo-div"> 
                <div class="row justify-content-md-center" id="todo-section"> 
                    <div class="col-sm-10 todo-add col-md-offset-1">  
                        <?php echo $this->Form->create('Todo', array('url' => array('controller' => 'todos', 'action' => 'save'), 'inputDefaults' => array('label' => false, 'div' => false), 'class' => 'form-horizontal valForm')); ?>
                        <div class="input-group">
                            <?php echo $this->Form->input('Todo.todo', array('type' => 'text', 'class' => 'form-control', 'placeholder' => 'Add New Todo')); ?>
                            <span class="input-group-btn">   
                                <button type="submit" class="btn btn-primary todo"><i class="fa fa-plus-circle fa-lg"></i> <?php echo __('Add'); ?></button>
                            </span>        
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                    <div class="todo-inner col-lg-5 col-md-5 col-sm-12 col-md-offset-1">
                        <div class="todo-head">
                            <?php echo __('Pending Todo'); ?>
                        </div>
                        <div class="todo-content">
                            <ul>
                                <?php foreach ($todo as $row): ?>
                                    <li id="row<?php echo h($row['Todo']['id']); ?>">
                                        <div class="todo-title mb-2 custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input todo-input" id="todo-<?php echo h($row['Todo']['id']); ?>">
                                            <label class="custom-control-label" for="todo-<?php echo h($row['Todo']['id']); ?>"><?php echo h($row['Todo']['todo']); ?></label>
                                        </div>
                                        <span><i class="fe fe-clock"></i> <?php echo $this->Time->format($this->Common->dateTime(), h($row['Todo']['created'])); ?></span>
                                        <span class="pull-right"> 
                                            <a href="#!" class="danger" data-toggle="modal" data-target="#ajaxdelM" data-title="<?php echo __('Delete Todo'); ?>" data-cont="todos" data-action="delete" data-id="<?php echo $row['Todo']['id']; ?>"><i class="fa fa-trash-o"></i></a>
                                        </span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>  
                    </div>
                    <div class="todo-inner col-lg-5 col-md-5 col-sm-12">
                        <div class="todo-head">
                            <?php echo __('Completed Todo'); ?>
                        </div>
                        <div class="todo-content">
                            <ul>
                                <?php foreach ($completedTodo as $row): ?>
                                    <li id="row<?php echo h($row['Todo']['id']); ?>">
                                        <div class="todo-title mb-2"><?php echo h($row['Todo']['todo']); ?></div>
                                        <span><i class="fe fe-clock"></i> <?php echo $this->Time->format($this->Common->dateTime(), h($row['Todo']['created'])); ?></span>
                                        <span class="pull-right"> 
                                            <a href="#!" class="danger" data-toggle="modal" data-target="#ajaxdelM" data-title="<?php echo __('Delete Todo'); ?>" data-cont="todos" data-action="delete" data-id="<?php echo $row['Todo']['id']; ?>"><i class="fa fa-trash-o"></i></a>
                                        </span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>  
                    </div>
                </div>
            </div>	
        </div>
        <!-- End Todo List -->      
    </div>  
</div>