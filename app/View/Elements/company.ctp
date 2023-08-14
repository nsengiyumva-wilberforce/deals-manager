<?php
/**
 * List companies.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<?php foreach ($companies as $row) : ?>
    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12" id="<?php echo 'row' . h($row['Company']['id']); ?>">
        <div class="company">
            <div class="company-title">
                <?php if ($this->Common->isStaffPermission('24')): ?>
                    <a  data-target="#delM" data-toggle="modal" href="#" class="table-link danger pull-right" onclick="fieldU('CompanyId',<?php echo h($row['Company']['id']); ?>)" ref='popover' data-content="<?php echo __('Delete'); ?>">
                        <i class="fa fa-trash-o"></i>
                    </a>
                <?php endif; ?>
                <a  href="<?php echo $this->Html->url(array("controller" => "companies", "action" => "view", h($row['Company']['id']))); ?>" class="view-comp pull-right" ref='popover' data-content="<?php echo __('View'); ?>">
                    <i class="fa fa-eye"></i> 
                </a>
                <h5><?= h($row['Company']['name']); ?></h5>
            </div>
            <div class="company-content">
                <div class="col-sm-6 company-details">
                    <div class="col-sm-12">
                        <ul>                                   
                            <li><i class="fa fa-envelope"></i> <?= h($row['Company']['email']); ?> </li>                       
                        </ul>
                    </div>
                    <div class="col-sm-12">
                        <ul> 
                            <li><i class="fa fa-phone"></i> <?= h($row['Company']['phone']); ?></li>
                        </ul>
                    </div>
                    <div class="col-sm-12" >
                        <ul>                                   
                            <li><i class="fa fa-home"></i> <?= h($row['Company']['address']); ?><br>
                                <?= h($row['Company']['city']) . ' ' . h($row['Company']['state']) . ' ' . h($row['Company']['country']); ?>
                            </li>                           
                        </ul>
                    </div>
                    <div class="col-sm-12" >
                        <?php
                        if ($this->Common->isAdmin()):
                            $gps = explode(',', $row['Company']['groups']);
                            foreach ($groups as $key => $value):
                                if (in_array($key, $gps)) :
                                    echo '<span class="label label-sm label-warning">' . h($value) . '</span>&nbsp;';
                                endif;
                            endforeach;
                        endif;

                        ?>
                    </div>
                </div>
                <div class="team-members col-sm-6">
                    <div class="col-sm-12"><h1><?php __('Clients'); ?></h1></div>
                    <div class="col-sm-12 team-img">
                        <?php
                        foreach ($row['Users'] as $user):
                            echo $this->Html->image('avatar/thumb/' . $user['User']['picture'], array('class' => 'img-circle', 'ref' => 'popover', 'data-content' => h($user['User']['name'])));
                        endforeach;

                        ?>
                    </div>
                </div>

            </div>
            <!-- Social Icons -->
            <div class="col-sm-12 social-div">
                <ul class="company-social">                                   
                    <li><a href="<?php echo ($row['Company']['facebook']) ? h($row['Company']['facebook']) : '#'; ?>"><i class="fa fa-facebook-square"></i></a></li>
                    <li><a href="<?php echo ($row['Company']['twitter']) ? h($row['Company']['twitter']) : '#'; ?>"><i class="fa fa-twitter-square"></i></a>  </li>
                    <li><a href="<?php echo ($row['Company']['linkedIn']) ? h($row['Company']['linkedIn']) : '#'; ?>"><i class="fa fa-linkedin-square"></i> </a> </li>
                    <li><a href="<?php echo ($row['Company']['skype']) ? h($row['Company']['skype']) : '#'; ?>"><i class="fa fa-skype"></i></a>  </li>
                    <li><a href="<?php echo ($row['Company']['youtube']) ? h($row['Company']['youtube']) : '#'; ?>"><i class="fa fa-youtube-square"></i></a> </li>
                    <li><a href="<?php echo ($row['Company']['google_plus']) ? h($row['Company']['google_plus']) : '#'; ?>"><i class="fa fa-google-plus-square"></i></a> </li>
                    <li><a href="<?php echo ($row['Company']['pinterest']) ? h($row['Company']['pinterest']) : '#'; ?>"><i class="fa fa-pinterest-square"></i></a> </li>
                    <li><a href="<?php echo ($row['Company']['tumblr']) ? h($row['Company']['tumblr']) : '#'; ?>"><i class="fa fa-tumblr-square"></i></a> </li>
                    <li><a href="<?php echo ($row['Company']['instagram']) ? h($row['Company']['instagram']) : '#'; ?>"><i class="fa fa-instagram"></i></a> </li>
                    <li><a href="<?php echo ($row['Company']['github']) ? h($row['Company']['github']) : '#'; ?>"><i class="fa fa-github-square"></i></a> </li>
                    <li><a href="<?php echo ($row['Company']['digg']) ? h($row['Company']['digg']) : '#'; ?>"><i class="fa fa-digg"></i></a> </li>
                </ul>
            </div>
            <!-- End Social Icons -->
            <div class="company-footer">

                <div class="row">
                    <div class="col-md-4 col-xs-4 text-center border-right">
                        <div class="font-bold"><?php echo __('DEALS'); ?> </div>
                        <?php echo h($row['deals']); ?>
                    </div>
                    <div class="col-md-4 col-xs-4 text-center border-right">
                        <div class="font-bold"><?php echo __('CONTACTS'); ?></div>
                        <?php echo h($row['contacts']); ?>
                    </div>
                    <div class="col-md-4 col-xs-4 text-center">
                        <div class="font-bold"><?php echo __('INVOICES'); ?></div>
                        <?php echo h($row['invoices']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>  
<?php endforeach; ?>