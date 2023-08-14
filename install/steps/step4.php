<?php
/**
 * Step 4 is  database creation for install deals manager .
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
        <li class="active">             
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
    $success = FALSE;

    if ($_POST) {
        $host = $_POST["host"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $dbname = $_POST["dbname"];
       // $code = $_POST["code"];
        $link = mysqli_connect($host, $username, $password);
        if (!$link) {
            echo '<br><div class="alert alert-danger fade in">Could not connect to MYSQL</div>';
        } else {
            echo '<br><div class="alert alert-success fade in">Connection to MYSQL successful.</div>';
            
            if (!mysqli_query($link,"CREATE DATABASE IF NOT EXISTS `$dbname` /*!40100 CHARACTER SET utf8 COLLATE 'utf8_general_ci' */")) {
                echo "<br><div class='alert alert-danger fade in'>Database " . $dbname . " does not exist and could not be created. Please create the Database manually and retry this step.</div>";
                return FALSE;
            } else {
                echo "<div class='alert alert-success fade in'>Database " . $dbname . " created</div>";
            }

            $link_database = mysqli_connect($host, $username, $password, $dbname);

            function write_dbconfig($host, $username, $password, $dbname, $DBconfigFile)
            {

                $newcontent = '<?php  
        /*
        | -------------------------------------------------------------------
        | DATABASE CONNECTIVITY SETTINGS
        | -------------------------------------------------------------------
        | This file will contain the settings needed to access your database.
        |
        | For complete instructions please consult the \'Database Connection\'
        | page of the User Guide.
        |
        */
                                                     
    class DATABASE_CONFIG {

	public $default = array(
		\'datasource\' => \'Database/Mysql\',
		\'persistent\' => false,
		\'host\' => \'' . $host . '\',
		\'login\' => \'' . $username . '\',
		\'password\' => \'' . $password . '\',
		\'database\' => \'' . $dbname . '\',
		\'encoding\' => \'utf8\',
	);

	
}
						

	/* End of file database.php */
	/* Location: ./app/Config/database.php */
							';


                $file_contents = file_get_contents($DBconfigFile);
                $fh = fopen($DBconfigFile, "w");
                $file_contents = $newcontent;
                if (fwrite($fh, $file_contents)) {

                    return true;
                }
                fclose($fh);
            }
            if (!write_dbconfig($host, $username, $password, $dbname, $DBconfigFile)) {
                echo "<div class='alert alert-danger fade in'>Failed to write config to " . $DBconfigFile . "</div>";
            } else {
                $mysql_file = 'steps/dm.sql';
                $file_content = file($mysql_file);
                $query = "";
                $error_count = 0;
                foreach ($file_content as $sql_line) {
                    if (trim($sql_line) != "" && strpos($sql_line, "--") === false) {
                        $query .= $sql_line;
                        if (preg_match("/;\s*$/", $sql_line)) { 
                            @mysqli_query($link_database, $query);
                            if (@mysqli_error($link_database)) {
                                $error_count++;
                                $mysql_error .= @mysqli_error() . '<br />';
                            }
                            $query = "";
                        }
                    }
                }
                $success = TRUE;
                echo "<div class='alert alert-success fade in'>Database config written to the database file.</div>";
                echo "<div class='alert alert-success fade in'>Database Created Successfully.</div>";
            }
        }
    }

    ?>
    <?php if ($success) { ?>
        <div class="bottom">
            <form action="?step=5" method="POST">
                <input type="submit" class="btn btn-primary pull-right" value="Next Step"/>
            </form>
        </div>
    <?php } else { ?> 
        <br><h1>Database Config</h1>
        <form action="" method="POST" class="vForm">
            <p>
                <label for="host">Host *</label>
                <input id="host" type="text" name="host" class="required form-control" value="localhost" />
            </p>
            <p>
                <label for="username">Username *</label>
                <input id="username" type="text" name="username" class="form-control required" />
            </p>
            <p>
                <label for="password">Password *</label>
                <input id="password" type="password" class="form-control" name="password" />
            </p>
            <p>
                <label for="dbname">Database Name *</label>
                <input id="dbname" type="text" class="form-control" name="dbname" value="dm" />
                <span class="help-block alert alert-warning">If the database does not exist the system will try to create it</span>
            </p>
            <div class="bottom">
                <input type="submit" class="btn btn-primary pull-right" value="Next Steps"/>
            </div>
        </form>
    <?php } ?>
<?php } ?>
<script>
    $(document).ready(function () {
        $('.vForm').validate({
            errorClass: 'form-error',
            rules: {
                "host": "required",
                "username": "required",
                "dbname": "required",
            },
            messages: {},
            submitHandler: function (form) {
                form.submit();
            }
        });
    });
</script>