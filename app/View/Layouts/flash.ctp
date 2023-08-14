<?php
/**
 * Flash default layout.
 *  
 * @author:   AnkkSoft.com
 * Copyright: AnkkSoft 2020
 * Website:   https://www.ankksoft.com
 * CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<!DOCTYPE html>
<html>
    <head>
        <?php echo $this->Html->charset(); ?>
        <title><?php echo h($pageTitle); ?></title>
    </head>
    <body>
        <p>
            <?php echo $this->Html->link($message, $url); ?>
        </p>
    </body>
</html>
