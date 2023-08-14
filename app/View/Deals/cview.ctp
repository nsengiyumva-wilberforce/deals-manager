<?php
/**
 * View for deal details page to clients only
 * 
 * @author:   AnkkSoft.com
 * Copyright: AnkkSoft 2020
 * Website:   https://www.ankksoft.com
 * CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div class="row manager-deal"> 
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">                    
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <h1 class="pull-left deal-title"> <?= h($deal['Deal']['name']); ?></h1>                    
                    </div>
                    <?php echo $this->Form->input('id', array('type' => 'hidden', 'id' => 'dealid', 'value' => h($deal['Deal']['id']))); ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box clearfix">	
                    <div class="tabs-wrapper tabs-no-header">
                        <!-- Tabs -->
                        <ul class="nav nav-tabs deal-tab">
                            <li class="active"><a data-toggle="tab" href="#tab-general"><?php echo __('General'); ?></a></li>
                            <?php if (in_array(1, $dealPermission)): ?>
                                <li><a data-toggle="tab" href="#tab-tasks" ><?php echo __('Tasks'); ?></a></li>
                                <?php
                            endif;
                            if (in_array(2, $dealPermission)):

                                ?>
                                <li><a data-toggle="tab" href="#tab-products" ><?php echo __('Products'); ?></a></li> 
                                <?php
                            endif;
                            if (in_array(3, $dealPermission)):

                                ?>
                                <li><a data-toggle="tab" href="#tab-sources" ><?php echo __('Sources'); ?></a></li>
                                <?php
                            endif;
                            if (in_array(4, $dealPermission)):

                                ?>
                                <li><a data-toggle="tab" href="#tab-contacts"><?php echo __('Contacts'); ?></a></li>
                                <?php
                            endif;
                            if (in_array(5, $dealPermission)):

                                ?>
                                <li><a data-toggle="tab" href="#tab-files"><?php echo __('Files'); ?></a></li>
                                <?php
                            endif;
                            if (in_array(6, $dealPermission)):

                                ?>
                                <li><a data-toggle="tab" href="#tab-discussions" class="tab-load" data-type="1" data-action="discussions"><?php echo __('Discussion'); ?></a></li>
                            <?php endif; ?>
                            <li><a data-toggle="tab" href="#tab-feedback" class="tab-load" data-type="2" data-action="discussions"><?php echo __('Customer Feedback'); ?></a></li>
                            <li><a data-toggle="tab" href="#tab-notes"><?php echo __('Notes'); ?></a></li>
                            <?php if (in_array(7, $dealPermission)): ?>
                                <li><a data-toggle="tab" href="#tab-invoices" class="tab-load" data-type="3" data-action="invoices"><?php echo __('Invoices'); ?></a></li> 
                                <?php
                            endif;
                            if (in_array(8, $dealPermission)):

                                ?>
                                <li><a data-toggle="tab" href="#tab-custom" ><?php echo __('Custom Fields'); ?></a></li> 
                            <?php endif; ?>
                        </ul>
                        <!--End Tabs -->
                        <!-- Tabs Content -->
                        <div class="tab-content">
                            <!-- General Tab -->
                            <div id="tab-general" class="tab-pane fade in active">
                                <div class="row">
                                    <?php echo $this->element('deal-general-client'); ?>
                                </div>
                            </div>
                            <!-- Task Tab -->
                            <?php if (in_array(1, $dealPermission)): ?>
                                <div id="tab-tasks" class="tab-pane fade">
                                    <div class="row top-margin">
                                        <div class="table-scrollable">
                                            <table class="table table-hover dataTable table-tasks">
                                                <tbody>
                                                    <?php
                                                    if (!empty($tasks)) {
                                                        foreach ($tasks as $row) {

                                                            ?>
                                                            <tr  id="<?php echo 'row' . h($row['Task']['id']); ?>" class="<?= $this->Common->priorityClass($row['Task']['priority']); ?>">
                                                                <td>
                                                                    <div class="task-name <?php echo ($row['Task']['status'] == '1') ? 'task-line' : ''; ?>">

                                                                        <span> <?= h($row['Task']['task']); ?> </span>&nbsp;
                                                                        <?= $this->Common->priority($row['Task']['priority']); ?>
                                                                    </div >
                                                                    <div class="task-details">                                      
                                                                        <span class="task-details-text task-padding-left">
                                                                            <?= $this->Common->motives($row['Task']['motive']); ?>
                                                                        </span>                                  
                                                                        <span class="task-details-text">
                                                                            <i class="fa fa-clock-o"></i> <?= date($this->Common->timeShow(), strtotime($row['Task']['time'])); ?>
                                                                        </span>
                                                                        <span class="task-details-text">
                                                                            <i class="fa fa-calendar"></i> <?= date($this->Common->dateShow(), strtotime($row['Task']['date'])); ?>
                                                                        </span>
                                                                        <span class="task-details-text">
                                                                            <i class="fa fa-user"></i> <?= h($row['User']['first_name']) . ' ' . h($row['User']['last_name']); ?>
                                                                        </span>
                                                                    </div>
                                                                </td>                                                 
                                                            </tr>
                                                            <?php
                                                        }
                                                    }

                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <!-- Product Tab -->
                            <?php if (in_array(2, $dealPermission)): ?>
                                <div id="tab-products" class="tab-pane fade">
                                    <div class="row top-margin">
                                        <div class="table-responsive">
                                            <div class="table-scrollable">
                                                <table class="table table-hover dataTable table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th><?php echo __('Name'); ?></th>
                                                            <th><?php echo __('Price'); ?></th>
                                                            <th><?php echo __('Quantity'); ?></th>
                                                            <th><?php echo __('Discount'); ?></th>
                                                            <th><?php echo __('Sum'); ?></th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (!empty($products)) :
                                                            foreach ($products as $row) :

                                                                ?>
                                                                <tr  id="<?php echo 'row' . h($row['Product']['id']); ?>">
                                                                    <td><?= h($row['Product']['name']); ?> </td>
                                                                    <td> <?= h($this->Session->read('Auth.User.currency_symbol')); ?><?= h($row['Product']['price']); ?></td>
                                                                    <td> <?= h($row['ProductDeal']['quantity']); ?>  </td>
                                                                    <td> <?= h($row['ProductDeal']['discount']); ?>% </td>
                                                                    <td> <?= h($this->Session->read('Auth.User.currency_symbol')); ?><?= h($row['ProductDeal']['price']); ?> </td>                                                     
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
                                </div>
                            <?php endif; ?>
                            <!-- Sources Tab -->
                            <?php if (in_array(3, $dealPermission)): ?>
                                <div id="tab-sources" class="tab-pane fade">
                                    <div class="row top-margin">
                                        <div class="table-responsive">
                                            <div class="table-scrollable">
                                                <table class="table table-hover dataTable table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th><?php echo __('Name'); ?></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        if (!empty($sources)) {
                                                            foreach ($sources as $row) {

                                                                ?>
                                                                <tr id="<?php echo 'row' . h($row['Source']['id']); ?>">
                                                                    <td><?= h($row['Source']['name']); ?></td>                                                      
                                                                </tr>
                                                                <?php
                                                            }
                                                        } else {

                                                            ?>
                                                            <tr>
                                                                <td> <?php echo __('No Source Added in Deal, Search Source to Add.'); ?></td>
                                                            </tr> 
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            <?php endif; ?>

                            <!-- Contacts Tab -->
                            <?php if (in_array(4, $dealPermission)): ?>
                                <div id="tab-contacts" class="tab-pane fade">
                                    <div class="row top-margin contact-list">
                                        <?php
                                        if (!empty($contacts)) {
                                            foreach ($contacts as $row) :

                                                ?>
                                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="<?php echo 'row' . h($row['Contact']['id']); ?>">
                                                    <div class="main-box clearfix profile-box-contact">
                                                        <div class="main-box-body clearfix">
                                                            <a href="<?php echo $this->webroot; ?>contacts/view/<?= h($row['Contact']['id']); ?>">
                                                                <div class="profile-box-header contact-box-list clearfix">
                                                                    <div class="col-sm-6">
                                                                        <div class="text-center">
                                                                            <?php $cImage = ($row['Contact']['picture']) ? $row['Contact']['picture'] : 'user.png'; ?>    
                                                                            <?= $this->Html->image('contact/thumb/' . $cImage, array('class' => 'img-circle m-t-xs ')); ?>
                                                                            <div class="m-t-xs font-bold"><h5><?= h($row['Contact']['title']); ?></h5></div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <h2><?php echo h($row['Contact']['name']); ?></h2>
                                                                        <ul class="contact-details">                                   
                                                                            <li>
                                                                                <?php echo ($row['Contact']['email']) ? '<i class="fa fa-envelope"></i> ' . h($row['Contact']['email']) : ''; ?>
                                                                            </li>
                                                                            <li>
                                                                                <?php echo ($row['Contact']['phone']) ? ' <i class="fa fa-phone"></i> ' . h($row['Contact']['phone']) : ''; ?>
                                                                            </li>
                                                                            <li>
                                                                                <?php echo ($row['Contact']['location']) ? ' <i class="fa fa-map-marker"></i> ' . h($row['Contact']['location']) : ''; ?>
                                                                            </li>
                                                                            <li>
                                                                                <?php echo ($row['Contact']['address']) ? ' <i class="fa fa-home"></i> ' . h($row['Contact']['address']) : ''; ?>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="contact-box-footer clearfix">
                                                                    <div class="col-md-3 col-xs-3 border-right contact-social">
                                                                        <a href="<?php echo ($row['Contact']['facebook']) ? 'http://' . h($row['Contact']['facebook']) : '#'; ?>"> <i class="fa fa-facebook-square"></i>  </a>
                                                                    </div>
                                                                    <div class="col-md-3 col-xs-3 border-right contact-social">
                                                                        <a href="<?php echo ($row['Contact']['twitter']) ? 'http://' . h($row['Contact']['twitter']) : '#'; ?>">  <i class="fa fa-twitter-square"></i>  </a>
                                                                    </div>
                                                                    <div class="col-md-3 col-xs-3 border-right contact-social">
                                                                        <a href="<?php echo ($row['Contact']['linkedIn']) ? 'http://' . h($row['Contact']['linkedIn']) : '#'; ?>">  <i class="fa fa-linkedin-square"></i> </a>  
                                                                    </div>
                                                                    <div class="col-md-3 col-xs-3 contact-social">
                                                                        <a href="<?php echo ($row['Contact']['skype']) ? 'http://' . h($row['Contact']['skype']) : '#'; ?>">  <i class="fa fa-skype"></i>  </a>                                                            
                                                                    </div>
                                                                </div>   
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            endforeach;
                                        }

                                        ?>

                                    </div>                               
                                </div>
                            <?php endif; ?>
                            <!-- Files Tab -->
                            <?php if (in_array(5, $dealPermission)): ?>
                                <div id="tab-files" class="tab-pane fade">
                                    <?php if (in_array(10, $dealPermission)): ?>
                                        <div class="row">
                                            <?php echo $this->Form->create('Files', array('url' => array('controller' => 'Files', 'action' => 'add'), 'class' => 'dropzone', 'id' => 'my-dropzone', 'type' => 'file')); ?>
                                            <?php echo $this->Form->input('AppFile.deal_id', array('type' => 'hidden', 'value' => h($deal['Deal']['id']))); ?>
                                            <?php echo $this->Form->end(); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="row top-margin">
                                        <div class="table-scrollable">
                                            <table class="table table-hover dataTable">
                                                <thead>
                                                    <tr>
                                                        <th><?php echo __('File Name'); ?></th>
                                                        <th><?php echo __('Description'); ?></th>
                                                        <th><?php echo __('Uploaded By'); ?></th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (!empty($files)) :
                                                        foreach ($files as $row) :

                                                            ?>
                                                            <tr  id="<?php echo 'row' . h($row['AppFile']['id']); ?>">
                                                                <td> <?= h($row['AppFile']['name']); ?> </td>
                                                                <td>
                                                                    <a href="#"  data-type="text" data-pk="<?php echo h($row['AppFile']['id']); ?>" data-url="<?php echo $this->Html->url(array('controller' => 'files', 'action' => 'edit')) ?>"  class="editable editable-click vEdit"><?= h($row['AppFile']['description']); ?></a>
                                                                </td>
                                                                <td>
                                                                    <?= h($row['User']['first_name']) . ' ' . h($row['User']['last_name']); ?>
                                                                </td>
                                                                <td>	
                                                                    <?php echo $this->Html->link('<span class="fa-stack"><i class="fa fa-download"></i></span>', array('controller' => 'Files', 'action' => 'download', $row['AppFile']['deal_id'], $row['AppFile']['name']), array('escape' => false)); ?>                                                    				
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
                            <?php endif; ?>
                            <!-- Discussion Tab -->
                            <?php if (in_array(6, $dealPermission)): ?>
                                <div id="tab-discussions" class="tab-pane fade"></div>
                            <?php endif; ?>
                            <!-- Customer Feedback Tab -->
                            <div id="tab-feedback" class="tab-pane fade"></div>
                            <!-- Notes Tab -->
                            <div id="tab-notes" class="tab-pane fade">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <i class="fa fa-sticky-note"></i> <?php echo __('Notes (Private)'); ?>
                                    </div>
                                    <div class="panel-body">
                                        <?php echo $this->Form->create('Note', array('url' => array('controller' => 'Notes', 'action' => 'add'), 'class' => 'vForm1')); ?>
                                        <?php echo $this->Form->input('NoteDeal.deal_id', array('type' => 'hidden', 'value' => h($deal['Deal']['id']))); ?>
                                        <?php echo $this->Form->input('NoteDeal.id', array('type' => 'hidden', 'value' => (isset($note['NoteDeal']['id'])) ? h($note['NoteDeal']['id']) : '')); ?>
                                        <div class="input-group col-md-12">
                                            <h4 class="pull-left"><?php echo __('Notes (Private)'); ?></h4>
                                            <button class="btn btn-success btn-sm pull-right" type="submit"><i class="fa fa-check-circle"></i> <?php echo __('Save'); ?></button>
                                        </div>
                                        <div class="input-group col-md-12">
                                            <?php echo $this->Form->input('NoteDeal.note', array('type' => 'textarea', 'class' => 'notebook', 'label' => false, 'div' => false, 'value' => (isset($note['NoteDeal']['note'])) ? h($note['NoteDeal']['note']) : '')); ?>
                                        </div>

                                        <?php echo $this->Form->end(); ?>
                                        <?php echo $this->Js->writeBuffer(); ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Invoices Tab -->
                            <?php if (in_array(7, $dealPermission)): ?>
                                <div id="tab-invoices" class="tab-pane fade"></div>
                            <?php endif; ?>
                            <!-- Custom Field Tab -->
                            <?php if (in_array(8, $dealPermission)): ?>
                                <div id="tab-custom" class="tab-pane fade">
                                    <?php echo $this->element('custom-fields'); ?>
                                </div>      
                            <?php endif; ?>
                        </div>
                        <!--End Tabs Content -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>