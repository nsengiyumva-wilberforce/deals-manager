<?php
/**
 * Step 3 check Directory Permissions for install deals manager.
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
        <li class="active">             
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

    if (!is_writeable($DBconfigFile)) {
        $error = TRUE;
        $var1 = "<span class='label label-danger'>Database File (app/Config/database.php) is not writeable!</span>";
    } else {
        $var1 = "<span class='label label-success'>OK</span>";
    }

    if (!is_writeable("../app/tmp")) {
        $error = TRUE;
        $var2 = "<span class='label label-warning'>/app/tmp folder is not writeable!</span>";
    } else {
        $var2 = "<span class='label label-success'>OK</span>";
    }
    if (!is_writeable("../app/webroot/files")) {
        $error = TRUE;
        $var3 = "<span class='label label-danger'>../app/webroot/files folder is not writeable!</span>";
    } else {
        $var3 = "<span class='label label-success'>OK</span>";
    }

    if (!is_writeable("../app/webroot/files/deal")) {
        $error = TRUE;
        $var4 = "<span class='label label-danger'>../app/webroot/files/deal folder is not writeable!</span>";
    } else {
        $var4 = "<span class='label label-success'>OK</span>";
    }
    if (!is_writeable("../app/webroot/files/backup")) {
        $error = TRUE;
        $var5 = "<span class='label label-danger'>../app/webroot/files/backup folder is not writeable!</span>";
    } else {
        $var5 = "<span class='label label-success'>OK</span>";
    }
    if (!is_writeable("../app/webroot/files/export")) {
        $error = TRUE;
        $var6 = "<span class='label label-danger'>../app/webroot/files/export folder is not writeable!</span>";
    } else {
        $var6 = "<span class='label label-success'>OK</span>";
    }
    if (!is_writeable("../app/webroot/files/ticket")) {
        $error = TRUE;
        $var7 = "<span class='label label-danger'>../app/webroot/files/ticket folder is not writeable!</span>";
    } else {
        $var7 = "<span class='label label-success'>OK</span>";
    }
    if (!is_writeable("../app/webroot/img/avatar")) {
        $error = TRUE;
        $var8 = "<span class='label label-danger'>../app/webroot/img/avatar folder is not writeable!</span>";
    } else {
        $var8 = "<span class='label label-success'>OK</span>";
    }
    if (!is_writeable("../app/webroot/img/contact")) {
        $error = TRUE;
        $var9 = "<span class='label label-danger'>../app/webroot/img/contact folder is not writeable!</span>";
    } else {
        $var9 = "<span class='label label-success'>OK</span>";
    }
    if (!is_writeable("../app/webroot/files/expenses")) {
        $error = TRUE;
        $var10 = "<span class='label label-danger'>../app/webroot/files/expenses folder is not writeable!</span>";
    } else {
        $var10 = "<span class='label label-success'>OK</span>";
    }
    if (!is_writeable("../app/Config/email.php")) {
        $error = TRUE;
        $var11 = "<span class='label label-warning'>/app/Config/email.php file is not writeable!</span>";
    } else {
        $var11 = "<span class='label label-success'>OK</span>";
    }
    if (!is_writeable("../app/tmp/logs/error.log")) {
        $error = TRUE;
        $var12 = "<span class='label label-warning'>/app/tmp/logs/error.log file is not writeable!</span>";
    } else {
        $var12 = "<span class='label label-success'>OK</span>";
    }

    ?> 
    <h3>Directory Permissions</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Required</th>
                <th>Result</th>
            </tr>
        </thead>
        <tbody>       
            <tr>
                <td>Database file (/app/Config/database.php) writeable</td>
                <td><?php echo $var1; ?></td>
            </tr>
            <tr>
                <td>Email file (/app/Config/email.php) writeable</td>
                <td><?php echo $var11; ?></td>
            </tr>
            <tr>
                <td>Cache Directory(/app/tmp/logs/error.log) file is writeable</td>
                <td><?php echo $var12; ?></td>
            </tr>
            <tr>
                <td>Error Log (/app/tmp) folder & Sub Folders is writeable</td>
                <td><?php echo $var2; ?></td>
            </tr>
            <tr>
                <td>Files (/app/webroot/files) folder is writeable</td>
                <td><?php echo $var3; ?></td>
            </tr>
            <tr>
                <td>Deal (/app/webroot/files/deal) folder is writeable</td>
                <td><?php echo $var4; ?></td>
            </tr>
            <tr>
                <td>Backup (/app/webroot/files/backup) folder is writeable</td>
                <td><?php echo $var5; ?></td>
            </tr>
            <tr>
                <td>Export (/app/webroot/files/export) folder is writeable</td>
                <td><?php echo $var6; ?></td>
            </tr>
            <tr>
                <td>Ticket (/app/webroot/files/ticket) folder is writeable</td>
                <td><?php echo $var7; ?></td>
            </tr>
            <tr>
                <td>Ticket (/app/webroot/files/expenses) folder is writeable</td>
                <td><?php echo $var10; ?></td>
            </tr>
            <tr>
                <td>Avatar (/app/webroot/img/avatar) folder is writeable</td>
                <td><?php echo $var8; ?></td>
            </tr>
            <tr>
                <td>Contact (/app/webroot/files/contact) folder is writeable</td>
                <td><?php echo $var9; ?></td>
            </tr>
        </tbody>
    </table>
    <!-- Next Step --> 
    <div class="bottom">
        <?php if ($error) { ?>
            <a href="#" class="btn btn-primary disabled pull-right">Next Step</a>
        <?php } else { ?>
            <form action="?step=4" method="POST">
                <input type="submit" class="btn btn-primary pull-right" value="Next Step"/>
            </form>
        <?php } ?>
    </div>
    <!--End Next Step --> 
<?php } ?>