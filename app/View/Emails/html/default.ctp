<?php
/**
 * Default Email template
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
$content = explode("\n", $content);

foreach ($content as $line):
    echo '<p> ' . $line . "</p>\n";
endforeach;

?>
