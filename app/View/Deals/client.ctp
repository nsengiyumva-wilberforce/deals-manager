<?php
/**
 * View for list deals page to clients
 * 
 * @author:   AnkkSoft.com
 * Copyright: AnkkSoft 2020
 * Website:   https://www.ankksoft.com
 * CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">                                                                
                    <div class="col-sm-8">
                        <h1><?php echo __('Deals'); ?></h1>
                    </div>                     
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">					  
                    <div class="main-box-body clearfix">
                        <!-- Deal List -->
                        <div class="table-responsive">                         
                            <div class="table-scrollable">
                                <table class="table table-hover dataTables deals-list table-striped">
                                    <thead>
                                        <tr>
                                            <th><?php echo __('Name'); ?></th>
                                            <th><?php echo __('Price'); ?></th>                                          
                                            <th><?php echo __('Client'); ?></th>                                           
                                            <th><?php echo __('Created'); ?></th> 
                                            <th><?php echo __('At'); ?></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($deals)) :

                                            foreach ($deals as $row) :

                                                ?>
                                                <tr  id="<?php echo 'row' . h($row['Deal']['id']); ?>">
                                                    <td> <a  href="<?php echo $this->Html->url(array("controller" => "deals", "action" => "cview", h($row['Deal']['id']))); ?>" ref="popover" data-content="View Deal"><?= h($row['Deal']['name']); ?></a></td>
                                                    <td><?= h($this->Session->read('Auth.User.currency_symbol')); ?><?= ($row['Deal']['price']) ? h($row['Deal']['price']) : '0'; ?></td>                                                                                   
                                                    <td><?= h($row['Company']['name']); ?></td>                                          
                                                    <td> <?= h($row['User']['first_name']) . ' ' . h($row['User']['last_name']); ?></td>
                                                    <td><?php echo $this->Time->format($this->Common->dateTime(), h($row['Deal']['created'])); ?></td>                           
                                                </tr>
                                                <?php
                                            endforeach;
                                        endif;

                                        ?>
                                    </tbody>
                                </table>
                            </div>		
                        </div>
                        <!--End Deal List -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>