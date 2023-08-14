<?php
/**
 * Sign Up Email template
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
        <title><?php echo __('Sign Up'); ?></title>
        <?php echo $this->Html->css('email.css?' . rand); ?>
    </head>

    <body class="main-email signup-email">
        <table cellpadding="0" cellspacing="0">
            <!--CONTANT-->
            <tr>
                <td valign="top" class="content">
                    <h2 class="comp-name"><?php echo __('Welcome to'); ?> <?= h($company['SettingCompany']['name']); ?></h2>
                    <h3>
                        <?php echo __('Thanks for signing up! We are excited to have you join.'); ?>
                    </h3>
                    <br/>
                    <h5>&nbsp;</h5>
                    <h2><?php echo __('Account Details'); ?>:-</h2>
                    <p class="pass">
                        <b><?php echo __('Username'); ?>:</b> <?= $data['username']; ?>
                        <br/>
                        <b><?php echo __('Password'); ?>:</b> <?= $data['pass']; ?>
                    </p>
                    <p class="log"> <a href="<?php echo $this->Html->url('/', true); ?>"><?php echo __('Click Here To Login'); ?></a></p>
                </td>
            </tr>
            <!--/CONTANT-->
        </table>
    </body>
</html>