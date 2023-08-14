<?php
/**
 * Step 2 check server requirement for install deals manager.
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
        <li class="active">              
            Server Requirements                 
        </li> 
        <li class="disabled">             
            Directory Permissions                   
        </li>
        <li class="disabled">             
            Database                   
        </li>     
        <li class="disabled">                 
            Finish
        </li>
    </ul>
</div>
<!--End Install Steps --> 
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = FALSE;
    if (phpversion() < "5.3") {
        $error = TRUE;
        $var1 = "<span class='label label-danger'>Your PHP version is " . phpversion() . "</span>";
    } else {
        $var1 = "<span class='label label-success'>v." . phpversion() . "</span>";
    }

    if (!extension_loaded('mysql')) {
        $var2 = "<span class='label label-danger'>Not enabled</span>";
    } else {
        $var2 = "<span class='label label-success'>OK</span>";
    }
    if (!extension_loaded('mbstring')) {
        $var3 = "<span class='label label-danger'>Not enabled</span>";
    } else {
        $var3 = "<span class='label label-success'>OK</span>";
    }
    if (!extension_loaded('gd')) {
        $var4 = "<span class='label label-danger'>Not enabled</span>";
    } else {
        $var4 = "<span class='label label-success'>OK</span>";
    }
    if (!extension_loaded('dom')) {
        $var5 = "<span class='label label-danger'>Not enabled</span>";
    } else {
        $var5 = "<span class='label label-success'>OK</span>";
    }
    if (!extension_loaded('curl')) {
        $var6 = "<span class='label label-danger'>Not enabled</span>";
    } else {
        $var6 = "<span class='label label-success'>OK</span>";
    }

    if (ini_get('allow_url_fopen') != "1") {
        $var7 = "<span class='label label-warning'>Allow_url_fopen is not enabled!</span>";
    } else {
        $var7 = "<span class='label label-success'>OK</span>";
    }
    if (!extension_loaded('zip')) {
        $var8 = "<span class='label label-warning'>Not enabled</span>";
    } else {
        $var8 = "<span class='label label-success'>OK</span>";
    }

    ?> 
    <h3>Server Requirements</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Required</th>
                <th>Result</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>PHP 5.3+ </td>
                <td><?php echo $var1; ?></td>
            </tr>
            <tr>
                <td>Mysql PHP extension (Optional)</td>
                <td><?php echo $var2; ?></td>
            </tr>     
            <tr>
                <td>MBString PHP extension</td>
                <td><?php echo $var3; ?></td>
            </tr>
            <tr>
                <td>GD PHP extension</td>
                <td><?php echo $var4; ?></td>
            </tr>      
            <tr>
                <td>DOM PHP extension</td>
                <td><?php echo $var5; ?></td>
            </tr>
            <tr>
                <td>CURL PHP extension</td>
                <td><?php echo $var6; ?></td>
            </tr>
            <tr>
                <td>Allow_url_fopen is enabled!</td>
                <td><?php echo $var7; ?></td>
            </tr>
            <tr>
                <td>ZIP PHP extension</td>
                <td><?php echo $var8; ?></td>
            </tr>           
        </tbody>
    </table>
    <!-- Next Step --> 
    <div class="bottom">
        <?php if ($error) { ?>
            <a href="#" class="btn btn-primary disabled pull-right">Next Step</a>
        <?php } else { ?>
            <form action="?step=3" method="POST">
                <input type="submit" class="btn btn-primary pull-right" value="Next Step"/>
            </form>
        <?php } ?>
    </div>
    <!-- End Next Step --> 
<?php } ?>