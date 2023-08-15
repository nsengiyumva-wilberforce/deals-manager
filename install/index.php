<?php
/**
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
header('Content-type: text/html; charset=ISO-8859-1');
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Installation">
        <meta name="author" content="Ankksoft">
        <title>aiDvantage-CRM</title>
        <!-- Favicon -->
        <link type="image/x-icon" href="favicon.gif" rel="shortcut icon"/>
        <!-- Theme style --> 
        <link href="../app/webroot/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/wizard.css" rel="stylesheet">
        <link href="../app/webroot/css/style.css" rel="stylesheet">
        <!-- Theme Jquery --> 
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,300,600,700' rel='stylesheet' type='text/css'>
        <script src="../app/webroot/js/jquery.min.js"></script>
        <script src="../app/webroot/js/jquery.validate.min.js"></script>
    </head>
    <body class="install">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-lg-8 col-lg-offset-2">
                    <!-- Header Section --> 
                    <header id="login-header">
                        <div id="login-logo">
                            Install aiDvantage-CRM
                        </div>
                    </header>
                    <!-- End Header Section --> 
                    <!-- Main Content--> 
                    <div class="main-box-body clearfix">                     
                        <?php require("install.php"); ?>                  
                    </div> 
                    <!--End Main Content--> 
                </div>
            </div>
        </div>     
    </body>
</html>