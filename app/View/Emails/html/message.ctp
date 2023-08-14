<?php
/**
 * Message Email template
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title><?php echo __('Message'); ?></title>
        <?php echo $this->Html->css('email.css?' . rand); ?>
    </head>

    <body class="main-email msg-email">
        <table cellpadding="0" cellspacing="0">   
            <!--CONTANT-->
            <tr>
                <td valign="top" class="content">         
                    <p><?= $data; ?></p>          
                    <br/>
                </td>
            </tr>
            <!--/CONTANT-->
        </table>
    </body>
</html>