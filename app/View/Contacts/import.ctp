<?php
/**
 * View for import contact page
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
            <div class="col-lg-12">
                <div class="clearfix">
                    <h1 class="pull-left"><?php echo __('Import Contacts'); ?></h1>               
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">					  
                    <div class="main-box-body clearfix">
                        <div class="alert alert-success">  <?php echo __('Your CSV data should be in the format below. The first line of your CSV file should be the column headers as in the table example. Also make sure that your file is UTF-8 to avoid unnecessary encoding problems.'); ?></div>
                        <div class="table-responsive import-table">
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th class="bold"><span class="text-danger">*</span><?php echo __('Name'); ?> </th>
                                        <th class="bold"><span class="text-danger">*</span><?php echo __('Title'); ?></th>
                                        <th class="bold"><?php echo __('Email'); ?>  </th>
                                        <th class="bold"><?php echo __('Phone'); ?>  </th>
                                        <th class="bold"><?php echo __('Address'); ?>  </th>
                                        <th class="bold"><?php echo __('City'); ?>  </th>
                                        <th class="bold"><?php echo __('State'); ?>  </th>
                                        <th class="bold"><?php echo __('Zip-Code'); ?>  </th>
                                        <th class="bold"><?php echo __('Country'); ?>  </th>
                                        <th class="bold"><?php echo __('Location'); ?>  </th>
                                        <th class="bold"><?php echo __('Description'); ?> </th>
                                        <th class="bold"><?php echo __('Website'); ?>  </th>
                                        <th class="bold"><?php echo __('Facebook'); ?>  </th>
                                        <th class="bold"><?php echo __('Twitter'); ?></th>
                                        <th class="bold"><?php echo __('LinkedIn'); ?></th>
                                        <th class="bold"><?php echo __('Skype'); ?></th>
                                        <th class="bold"><?php echo __('You-Tube'); ?></th>
                                        <th class="bold"><?php echo __('Google-Plus'); ?></th>
                                        <th class="bold"><?php echo __('Pinterest'); ?></th>
                                        <th class="bold"><?php echo __('Tumblr'); ?></th>
                                        <th class="bold"><?php echo __('instagram'); ?></th>
                                        <th class="bold"><?php echo __('Git-Hub'); ?></th>
                                        <th class="bold"><?php echo __('Digg'); ?></th>                                   
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo __('Sample Data'); ?></td>
                                        <td><?php echo __('Sample Data'); ?></td>
                                        <td><?php echo __('Sample Data'); ?></td>
                                        <td><?php echo __('Sample Data'); ?></td>
                                        <td><?php echo __('Sample Data'); ?></td>
                                        <td><?php echo __('Sample Data'); ?></td>
                                        <td><?php echo __('Sample Data'); ?></td>
                                        <td><?php echo __('Sample Data'); ?></td>
                                        <td><?php echo __('Sample Data'); ?></td>
                                        <td><?php echo __('Sample Data'); ?></td>
                                        <td><?php echo __('Sample Data'); ?></td>
                                        <td><?php echo __('Sample Data'); ?></td>
                                        <td><?php echo __('Sample Data'); ?></td>
                                        <td><?php echo __('Sample Data'); ?></td>
                                        <td><?php echo __('Sample Data'); ?></td>
                                        <td><?php echo __('Sample Data'); ?></td>
                                        <td><?php echo __('Sample Data'); ?></td>
                                        <td><?php echo __('Sample Data'); ?></td>
                                        <td><?php echo __('Sample Data'); ?></td>
                                        <td><?php echo __('Sample Data'); ?></td>
                                        <td><?php echo __('Sample Data'); ?></td>
                                        <td><?php echo __('Sample Data'); ?></td>
                                        <td><?php echo __('Sample Data'); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <?php echo $this->Form->create('Contact', array('type' => 'file', 'url' => array('controller' => 'contacts', 'action' => 'import'), 'inputDefaults' => array('label' => false, 'div' => false))); ?>
                        <div class="form-group">
                            <?php echo $this->Form->input('Contact.csv_file', array('type' => 'file', 'class' => 'btn btn-primary', 'label' => false)); ?>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-upload" aria-hidden="true"></i> <?php echo __('Import'); ?></button>
                        </div>
                        <?php echo $this->Form->end(); ?>	
                        <?php echo $this->Js->writeBuffer(); ?>
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>