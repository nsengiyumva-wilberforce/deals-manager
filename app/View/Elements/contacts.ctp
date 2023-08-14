<?php
/**
 *  Contacts  List
 * 
 * @author:   AnkkSoft.com
 * Copyright: AnkkSoft 2020
 * Website:   https://www.ankksoft.com
 * CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
if (!empty($Contacts)) {
    foreach ($Contacts as $row) :

        ?>
        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="<?php echo 'row' . h($row['Contact']['id']); ?>">
            <div class="main-box clearfix profile-box-contact">
                <div class="main-box-body clearfix">
                    <a href="<?php echo $this->webroot; ?>contacts/view/<?= h($row['Contact']['id']); ?>">
                        <div class="profile-box-header contact-box-list clearfix">
                            <div class="col-sm-5">
                                <div class="text-center">
                                    <?php $cImage = ($row['Contact']['picture']) ? $row['Contact']['picture'] : 'user.png'; ?>    
                                    <?= $this->Html->image('contact/thumb/' . $cImage, array('class' => 'img-circle m-t-xs ')); ?>
                                    <div class="m-t-xs font-bold"><h5><?= h($row['Contact']['title']); ?></h5></div>
                                </div>
                            </div>
                            <div class="col-sm-7">
                                <h2><?php echo h($row['Contact']['name']); ?></h2>
                                <ul class="contact-details">                                   
                                    <li>
                                        <?php echo ($row['Contact']['email']) ? '<i class="fa fa-envelope"></i> ' . h($row['Contact']['email']) : ''; ?>
                                    </li>
                                    <li>
                                        <?php echo ($row['Contact']['phone']) ? ' <i class="fa fa-phone"></i> ' . h($row['Contact']['phone']) : ''; ?>
                                    </li>
                                    <li>
                                        <?php echo ($row['Contact']['location']) ? ' <i class="fa fa-map-marker"></i> ' . h($row['Contact']['location']) : ''; ?>
                                    </li>
                                    <li>
                                        <?php echo ($row['Contact']['address']) ? ' <i class="fa fa-home"></i> ' . h($row['Contact']['address']) : ''; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="contact-box-footer clearfix">
                            <div class="col-md-3 col-xs-3 border-right contact-social">
                                <a href="<?php echo ($row['Contact']['facebook']) ? 'http://' . h($row['Contact']['facebook']) : '#'; ?>"> <i class="fa fa-facebook-square"></i>  </a>
                            </div>
                            <div class="col-md-3 col-xs-3 border-right contact-social">
                                <a href="<?php echo ($row['Contact']['twitter']) ? 'http://' . h($row['Contact']['twitter']) : '#'; ?>">  <i class="fa fa-twitter-square"></i>  </a>
                            </div>
                            <div class="col-md-3 col-xs-3 border-right contact-social">
                                <a href="<?php echo ($row['Contact']['linkedIn']) ? 'http://' . h($row['Contact']['linkedIn']) : '#'; ?>">  <i class="fa fa-linkedin-square"></i> </a>  
                            </div>
                            <div class="col-md-3 col-xs-3 contact-social">
                                <span class="label label-primary load-m" data-target="#uM" data-toggle="modal" data-name="<?= h($row['Contact']['name']); ?>"  data-email="<?= $row['Contact']['email']; ?>"><?php __('Email'); ?></span>
                                <?php if ($this->Common->isStaffPermission('14')): ?>
                                    <a  href="#" class="contact-delete" data-toggle="modal" data-target="#delContM" onclick="fieldU('ContactId',<?php echo h($row['Contact']['id']); ?>)"><i class="fa fa-trash-o"></i></a>
                                    <?php endif; ?>
                            </div>
                        </div>   
                    </a>
                </div>
            </div>
        </div>
        <?php
    endforeach;
} else {
    echo "<span class='contact-blank'>" . __('No Contacts added') . "</span>";
}

?>