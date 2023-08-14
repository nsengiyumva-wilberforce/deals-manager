<?php
/**
 * Error page layout
 * 
 * @author:   AnkkSoft.com
 * Copyright: AnkkSoft 2020
 * Website:   https://www.ankksoft.com
 * CodeCanyon User:  https://codecanyon.net/user/codeloop  
 */

?>
<!DOCTYPE html>
<html lang="en">
    <head> 
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <title><?php echo $this->Session->read('Company.name'); ?></title>
        <!-- Favicon -->
        <link type="image/x-icon" href="<?php echo $this->webroot; ?>img/favicon.gif" rel="shortcut icon"/>
        <!-- Theme style --> 
        <?php
        echo $this->Html->css('bootstrap.min.css');
        echo $this->Html->css('font-awesome.css');
        echo $this->Html->css('style.css');
        echo $this->fetch('meta');
        echo $this->fetch('css');

        ?>
    </head>
    <body id="error-page">
        <!-- Main Content -->
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div id="error-box">
                        <div class="row">
                            <div class="col-xs-12">
                                <!-- Error Image --> 
                                <div id="error-box-inner">                                  
                                    <?php echo $this->Html->image('error.png'); ?>
                                </div>
                                <!-- End Error Image --> 
                                <!-- Error Message --> 
                                <h1><?php __('ERROR'); ?> </h1>                                 
                                <?php echo $this->fetch('content'); ?>
                                <p>
                                    Go back to <a href="<?php echo $this->Html->url(array("controller" => "users", "action" => "login")); ?>">Homepage</a>.
                                </p>
                                <!--End  Error Message --> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>	
        <!-- End Main Content -->
    </body>
</html>