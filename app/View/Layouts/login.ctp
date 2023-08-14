<?php
/**
 * Login page layout.
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
        <title><?php echo $this->Session->read('Company.name'); ?></title>
        <!-- Favicon -->
        <link type="image/x-icon" href="<?php echo $this->webroot; ?>img/favicon.gif" rel="shortcut icon"/>
        <!-- Theme Style -->
        <?php
        echo $this->Html->css('bootstrap.min.css?' . rand);
        echo $this->Html->css('style.css?' . rand);
        echo $this->Html->css('application.css?' . rand);
        echo $this->Html->css('font-awesome.css?' . rand);
        echo $this->fetch('meta');
        echo $this->fetch('css');
        ?>
    </head>
    <body class="theme-whbl" id="login-page-full">
        <!-- Main Content -->
        <div id="login-full-wrapper">        
                     <?php echo $content_for_layout; ?>        
        </div>	
        <!--End Main Content -->
        <!-- Theme JQuery -->
             <?php echo $this->Html->script('jquery.min.js?' . rand); ?>
             <?php echo $this->Html->script('jquery.validate.min.js?' . rand); ?>
        <!--Jquery Validation-->
        <script>
            $('.login').validate({
                errorClass: 'validation-error',
                rules: {
                    "data[User][email]": {required: true, email: true},
                    "data[User][password]": {required: true, minlength: 5}
                },
                messages: {
                    "data[User][email]": {required: "Please provide a  Email Address."},
                    "data[User][password]": {required: "Please specify a password."}
                },
                errorPlacement: function (error, element) {
                    error.insertAfter(element.parent());
                }

            });
        </script>
        <!--End Jquery Validation-->
        <!-- End Theme JQuery -->
    </body>
</html>