<?php
/**
 * Step 5 is view username and password and go to login.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop  
 */

?>
<!-- Install Steps --> 
<div class="steps-div">  
    <ul class="nav nav-wizard">
        <li class="disabled">              
            Welcome                 
        </li>
        <li class="disabled">              
            Server Requirements                
        </li> 
        <li class="disabled">             
            Directory Permissions                  
        </li>
        <li class="disabled">             
            Database                  
        </li>       
        <li class="active">                 
            Finish
        </li>
    </ul>
</div>
<!--End Install Steps --> 
<br>
<?php if ($_SERVER['REQUEST_METHOD'] === 'POST') { ?>
    <div class="alert alert-success fade in">
        <i class="fa fa-check-circle fa-fw fa-lg"></i>
        <strong>Congratulation!</strong> Installation has completed successfully.
    </div>

    <div class="alert alert-danger fade in">
        <i class="fa fa-times-circle fa-fw fa-lg"></i>
        <strong>You must now delete the /install folder </strong>
    </div>


    <div class="row wiz-center">
        <h4><b>You can login using the following credentials: </b></h4><br>
        Username: <b>admin@admin.com</b> <br>
        Password: <b>123456</b>
    </div>
    <br>
    <div class="alert alert-info fade in">
        <i class="fa fa-info-circle fa-fw fa-lg"></i>
        <strong>Heads up!</strong> Change your password after login..
    </div><br><br>
    <div class="wiz-center">
        <?php
        if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) || isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
            $protocol = 'https://';
        } else {
            $protocol = 'http://';
        }

        ?>
        <a href="<?php echo $protocol . $_SERVER["SERVER_NAME"] . substr($_SERVER["REQUEST_URI"], 0, -16); ?>" class="btn btn-primary">Go to Login</a>
    </div>
<?php } ?>