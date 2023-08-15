<?php
/**
 * Install aiDvantage-CRM
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
$DBconfigFile = "../app/Config/database.php";

$steps = isset($_GET['step']) ? $_GET['step'] : '';
switch ($steps) {
    default:
        include_once ('steps/step1.php');
        break;
    case "2":
        include_once ('steps/step2.php');
        break;
    case "3":
        include_once ('steps/step3.php');
        break;
    case "4":
        include_once ('steps/step4.php');
        break;
    case "5":
        include_once ('steps/step5.php');
        break;
}
?>