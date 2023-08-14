<?php
/**
 * Update deal view content
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!-- Sources List -->
<?php if (!empty($source)) : ?>
    <tr id="<?php echo 'row' . h($source['Source']['id']); ?>">
        <td>
            <a href="<?php echo $this->Html->url(array("controller" => "sources", "action" => "view", h($source['Source']['id']))); ?>"><?= h($source['Source']['name']); ?></a>
        </td>
        <td>		
            <a class="table-link danger" href="#" data-toggle="modal" data-target="#delM"  data-title="<?php echo __('Delete Source'); ?>" data-action="sources" data-id="<?= h($source['Source']['id']); ?>" >
                <i class="fa fa-trash-o"></i>
            </a>					
        </td>
    </tr>

<?php endif; ?>
<!-- End Sources List -->
<!-- Products List -->
<?php
if (!empty($product)) :
    $row = $product;

    ?>
    <tr  id="<?php echo 'row' . h($row['Product']['id']); ?>">
        <td> <a href="<?php echo $this->Html->url(array("controller" => "products", "action" => "view", h($row['Product']['id']))); ?>"><?= h($row['Product']['name']); ?></a> </td>
        <td> <?= h($this->Session->read('Auth.User.currency_symbol')); ?><?= h($row['Product']['price']); ?></td>
        <td> <?= h($row['ProductDeal']['quantity']); ?>  </td>
        <td> <?= h($row['ProductDeal']['discount']); ?>% </td>
        <td> <?= h($this->Session->read('Auth.User.currency_symbol')); ?><?= h($row['ProductDeal']['price']); ?> </td>
        <td>
            <a class="table-link" href="#" data-toggle="modal" data-target="#uDealSM"   data-name="products" data-id="<?= h($row['ProductDeal']['id']); ?>">
                <i class="fa fa-edit"></i>
            </a>
            <a class="table-link danger" href="#" data-toggle="modal" data-target="#delM"  data-title="<?php echo __('Delete Product'); ?>" data-action="products" data-id="<?= h($row['Product']['id']); ?>">
                <i class="fa fa-trash-o"></i>
            </a>					
        </td>
    </tr>
<?php endif; ?>
    <!-- End Products List -->
    <!-- Contacts List -->
<?php
if (!empty($contact)) :
    $row = $contact;

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
                            <?php if ($this->Common->isAdmin()): ?>
                                <a  href="#" class="contact-delete" data-toggle="modal" data-target="#delM" data-title="<?php echo __('Delete Contact'); ?>" data-action="contacts" data-id="<?= h($row['Contact']['id']); ?>"><i class="fa fa-trash-o"></i></a>
                            <?php endif; ?>
                        </div>
                    </div>   
                </a>
            </div>
        </div>
    </div>
<?php endif; ?>
<!-- End Contacts List -->
<!-- Task List -->
<?php
if (!empty($task)) :
    $row = $task;

    ?>  
    <tr  id="<?php echo 'row' . h($row['Task']['id']); ?>" class="<?= $this->Common->priorityClass($row['Task']['priority']); ?>">
        <td>
            <div class="task-name <?php echo ($row['Task']['status'] == '1') ? 'task-line' : ''; ?>">
                <?php if ($row['Task']['status'] == '1'): ?>
                    <i class="fa fa-check fa-lg"></i>
                <?php else: ?>
                    <span class="checkbox-nice task-input" >
                        <input type="checkbox" id="todo-<?= h($row['Task']['id']); ?>" class="task-checkbox" <?php echo ($row['Task']['status'] == '1') ? 'checked' : ''; ?>>
                        <label for="todo-<?= $row['Task']['id']; ?>"></label>
                    </span>
                <?php endif; ?>
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
        <td  class="text-right">
            <a class="table-link" href="#"  data-toggle="modal" data-target="#TaskM"  onclick="loadmodal(<?= h($row['Task']['id']); ?>)">
                <i class="fa fa-edit"></i>
            </a>
            <a class="table-link danger" href="#"  data-toggle="modal" data-target="#delM"  data-title="Delete Task" data-action="tasks" data-id="<?= h($row['Task']['id']); ?>">
                <i class="fa fa-trash-o"></i>
            </a> 
        </td>
    </tr>
<?php endif; ?> 
<!-- End Task List -->
<!-- File List -->
<?php
if (!empty($file)) :
    $row = $file;

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
            <?php echo $this->Html->link('<span class="fa-stack"><i class="fa fa-download"></i></span>', array('controller' => 'Files', 'action' => 'download', h($row['AppFile']['deal_id']), $row['AppFile']['name']), array('escape' => false)); ?>							
            <?php if($this->Common->isAdminStaff()): ?>
            <a class="table-link danger" href="#" data-toggle="modal" data-target="#delM"  data-title="Delete File" data-action="files" data-id="<?= h($row['AppFile']['id']); ?>" >
                <i class="fa fa-trash-o"></i>
            </a>
            <?php endif; ?>
        </td>
    </tr>
<?php endif; ?>
 <!-- End File List -->
 <!-- Invoice List -->
<?php if (!empty($invoices)) : ?>
    <table class="table table-hover dataTable">
        <thead>
            <tr>
                <th><?php echo __('Invoice'); ?></th>
                <th><?php echo __('Issue Date'); ?></th>
                <th><?php echo __('Due Date'); ?></th>
                <th><?php echo __('Value'); ?></th>
                <th><?php echo __('Status'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (!empty($invoices)) :
                foreach ($invoices as $row) :

                    ?>
                    <tr  id="<?php echo 'row' . h($row['Invoice']['id']); ?>">
                        <td>
                            <a class="table-link" href="<?php echo $this->Html->url(array("controller" => "invoices", "action" => "view", h($row['Invoice']['id']))); ?>">
                            <?php echo "INV" . sprintf("%04d", h($row['Invoice']['custom_id']));?>
                            </a>
                        </td>
                        <td><?php echo $this->Time->format($this->Common->dateShow(),h($row['Invoice']['issue_date'])); ?></td>
                        <td><?php echo $this->Time->format($this->Common->dateShow(),h($row['Invoice']['due_date'])); ?></td>
                        <td><?php echo h($row['Invoice']['currency']).''.h($row['Invoice']['amount']); ?></td>
                        <td><?php $this->Common->invoice_status($row['Invoice']['status']); ?></td>                       
                    </tr>
                    <?php
                endforeach;
            endif;

            ?>
        </tbody>
    </table>
<?php endif; ?>
<!-- End Invoice List -->