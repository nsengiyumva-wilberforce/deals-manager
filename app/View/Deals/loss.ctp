<?php
/**
 * View for lost deals.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div class="row">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-12">
                <div class="clearfix">
                    <h1 class="pull-left"><?php echo __('Lost Deals'); ?></h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="main-box no-header clearfix">					  
                    <div class="main-box-body clearfix">
                        <!--Lost deal list -->
                        <div class="table-responsive">
                            <?php echo $this->element('history'); ?>		
                        </div>
                        <!--End Lost deal list -->
                    </div>
                </div>
            </div>
        </div>						
    </div>
</div>