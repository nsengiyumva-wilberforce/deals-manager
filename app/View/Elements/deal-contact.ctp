<?php
/**
 *  List contacts in deal details page.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<div class="row">
    <div class="input-group col-md-12">
        <?php echo $this->Form->input('Contact.name', array('type' => 'text', 'class' => 'form-control input-lg typeahead', 'data-provide' => 'typeahead', 'label' => false, 'div' => false, 'Placeholder' => __('Search Contact'), 'id' => 'contacts', 'label' => '', 'autocomplete' => 'off')); ?>
    </div>
</div>
<div class="row top-margin contact-list">
    <?php
    if (!empty($contacts)) :
        foreach ($contacts as $row) :

            ?>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12" id="<?php echo 'row' . h($row['Contact']['id']); ?>">
                <div class="main-box clearfix profile-box-contact">
                    <div class="main-box-body clearfix">
                        <a href="<?php echo $this->webroot; ?>contacts/view/<?= h($row['Contact']['id']); ?>">
                            <div class="profile-box-header contact-box-list clearfix">
                                <div class="col-sm-6">
                                    <div class="text-center">
                                        <?php $cImage = ($row['Contact']['picture']) ? $row['Contact']['picture'] : 'user.png'; ?>    
                                        <?= $this->Html->image('contact/thumb/' . $cImage, array('class' => 'img-circle m-t-xs ')); ?>
                                        <div class="m-t-xs font-bold"><h5><?= h($row['Contact']['title']); ?></h5></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <h2><?php echo $row['Contact']['name']; ?></h2>
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
                                    <a href="<?php echo ($row['Contact']['skype']) ? 'http://' . h($row['Contact']['skype']) : '#'; ?>">  <i class="fa fa-skype"></i>  </a>
                                    <?php if ($this->Common->isAdmin()): ?>
                                        <a  href="#" class="contact-delete" data-toggle="modal" data-target="#delM" data-title="<?php echo __('Delete Contact'); ?>" data-action="contacts" data-id="<?= h($row['Contact']['id']); ?>"><i class="fa fa-trash-o"></i></a>
                                        <?php endif; ?>
                                </div>
                            </div>   
                        </a>
                    </div>
                </div>
            </div>
            <?php
        endforeach;
    endif;

    ?>
</div>