<?php
/**
 * View for Announcement details page
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div class="row">
    <div class="col-lg-10 col-lg-offset-1">
        <div class="main-box no-header clearfix">	
            <div class="main-box-body clearfix">
                <div class="row">                         
                    <div class="col-sm-12 page-title text-center">
                        <h1><?= h($announcement['Announcement']['title']); ?></h1>                           
                    </div>
                    <div><?= h($announcement['Announcement']['description']); ?></div>                    
                </div>                   
            </div>
        </div>					
    </div>
</div>