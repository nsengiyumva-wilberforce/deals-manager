<?php
/**
 * Application layout
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!DOCTYPE html>
<html lang="en">
    <head>      
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <title><?php echo $this->Session->read('Company.name'); ?></title>
        <!-- Favicon -->
        <link type="image/x-icon" href="<?php echo $this->webroot; ?>img/favicon.gif" rel="shortcut icon"/>
        <!-- Theme style --> 
        <?php
        echo $this->Html->css('bootstrap.min.css?' . rand);
        echo $this->Html->css('font-awesome.css?' . rand);
        echo $this->Html->css('style.css?' . rand);
        echo $this->Html->css('application.css?' . rand);
        echo $this->Html->css('bootstrap-editable.css?' . rand);
        echo $this->Html->css('dropzone.css?' . rand);
        echo $this->Html->css('bootstrap-timepicker.css?' . rand);
        echo $this->Html->css('timeline.css?' . rand);
        echo $this->Html->css('select2.min.css?' . rand);
        echo $this->Html->css('jquery-ui.css?' . rand);
        echo $this->Html->css('bootstrap-tagsinput.css?' . rand);
        echo $this->Html->css('datatables.min.css?' . rand);

        ?>
        <!--End Theme style --> 
        <!-- Theme JQuery --> 
        <?php
        echo $this->Html->script('jquery.min.js?' . rand);
        echo $this->Html->script('bootstrap.min.js?' . rand);
        echo $this->Html->script('scripts.js?' . rand);
        echo $this->Html->script('jquery.nanoscroller.min.js?' . rand);
        echo $this->Html->script('select2.full.min.js?' . rand);
        echo $this->Html->script('bootstrap3-typeahead.js?' . rand);
        echo $this->Html->script('jquery.slimscroll.min.js?' . rand);
        echo $this->Html->script('datatables.min.js?' . rand);
        echo $this->fetch('meta');
        echo $this->fetch('css');
        echo $this->fetch('script');

        ?>       
    </head>
    <body class="theme-whbl  pace-done fixed-header">
        <div id="theme-wrapper">
            <!-- Header Section-->
            <?php echo $this->element('header'); ?>
            <!-- End Header Section-->
            <div class="container <?php
            if ($this->params['controller'] == 'deals' && $this->Common->isAdminStaff()) {
                echo 'nav-small';
            }

            ?>" id="page-wrapper">
                <div class="row">
                    <!-- Sidebar Section-->
                    <?php echo $this->element('sidebar'); ?> 
                    <!-- End Sidebar Section-->
                    <!-- Main Content -->
                    <div id="content-wrapper">                      
                        <div class="loader"></div>
                        <!--Alert Message-->
                        <?php
                        echo $this->Flash->render('fail');
                        echo $this->Flash->render('success');

                        ?> 
                        <!-- End Alert Message-->
                        <?php echo $this->Form->input('base_url', array('type' => 'hidden', 'value' => $this->webroot)); ?>
                        <?php echo $content_for_layout; ?> 
                        <!-- End Main Content -->
                        <!-- Footer Section -->
                        <footer class="row" id="footer-bar">
                            <p class="col-xs-12" id="footer-copyright">
                                Powered by <a href="https://www.ankksoft.com" >AnkkSoft</a>
                            </p>
                        </footer>
                        <!-- End Footer Section -->
                    </div>
                    <!-- End Main Content -->
                </div>
            </div>
        </div>
        <!-- Ajax Modal -->
        <div class="modal fade" id="ajaxM" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">                       
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"></h4>
                    </div>
                    <div class="ajaxMContent">
                        <div class="modal-body">
                            <div class="loader-modal"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> <?php echo __('Close'); ?></button>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <!-- Ajax Delete Modal -->
        <div class="modal fade" id="ajaxdelM" role="dialog">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title"><?php echo __('Delete'); ?></h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <?php echo $this->Form->create('Form', array('url' => array('action' => 'new'), 'id' => 'del-form')); ?>
                    <?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
                    <?php echo $this->Form->input('Item.id', array('type' => 'hidden')); ?>
                    <div class="modal-body">
                        <p> <?php echo __('Are you sure to delete ?'); ?></p>
                    </div>
                    <div class="modal-footer">              	
                        <button type="button" class="btn btn-primary del-btn" ><?php echo __('Yes'); ?></button>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><?php echo __('Close'); ?></button>
                    </div> 
                    <?php echo $this->Form->end(); ?>
                    <?php echo $this->Js->writeBuffer(); ?>
                </div>
            </div>
        </div>
        <!-- Theme JQuery -->
        <?php
        echo $this->Html->script('jquery.validate.min.js?' . rand);
        echo $this->Html->script('jquery.toaster.js?' . rand);
        echo $this->Html->script('bootstrap-editable.min.js?' . rand);
        echo $this->Html->script('dropzone.js?' . rand);
        echo $this->Html->script('bootstrap-timepicker.min.js?' . rand);
        echo $this->Html->script('jquery.nestable.js?' . rand);
        echo $this->Html->script('jquery-ui.js?' . rand);
        echo $this->Html->script('bootstrap-tagsinput.js?' . rand);
        echo $this->Html->script('application.js?q=123456' . rand);

        ?>
        <!--End Theme JQuery -->
    </body>
</html>