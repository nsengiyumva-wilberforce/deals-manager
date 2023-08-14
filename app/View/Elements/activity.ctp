<?php
/**
 * List all activity for deal on deal view page.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */

?>
<?php foreach ($activity as $row): ?>
    <div class="cd-timeline-block">        
        <?php
        switch ($row['Timeline']['module']) {
            case "add_Deal":
                echo '<div class="cd-timeline-img"><i class="fa fa-plus fa-2x"></i></div>';
                echo '<div class="cd-timeline-content"><b>' . h($row['Timeline']['user']) . '</b>';
                echo '<span class="pull-right"><i class="fa fa-clock-o"></i> ' . $this->Time->format($this->Common->dateTime(), h($row['Timeline']['created'])) . '</span>';
                echo '<p>' . __('<span class="label label-success">created</span> the Deal') . ' </p> </div>';
                break;
            case "add_Contact":
                echo '<div class="cd-timeline-img"><i class="fa fa-users fa-2x"></i></div>';
                echo '<div class="cd-timeline-content"><b>' . h($row['Timeline']['user']) . '</b>';
                echo '<span class="pull-right"><i class="fa fa-clock-o"></i> ' . $this->Time->format($this->Common->dateTime(), h($row['Timeline']['created'])) . '</span>';
                echo '<p>' . __('<span class="label label-success">Added</span> the contact') . ' <b>' . h($row['Timeline']['activity']) . '</b>.</p></div>';
                break;
            case "unlink_Contact":
                echo '<div class="cd-timeline-img cd-del"><i class="fa fa-users fa-2x"></i></div>';
                echo '<div class="cd-timeline-content"><b>' . h($row['Timeline']['user']) . '</b>';
                echo '<span class="pull-right"><i class="fa fa-clock-o"></i> ' . $this->Time->format($this->Common->dateTime(), h($row['Timeline']['created'])) . '</span>';
                echo '<p>' . __('<span class="label label-danger">Deleted</span> the contact') . ' <b>' . h($row['Timeline']['activity']) . '</b>.</p></div>';
                break;
            case "add_Product":
                echo '<div class="cd-timeline-img"><i class="fa fa-gift fa-2x"></i></div>';
                echo '<div class="cd-timeline-content"><b>' . h($row['Timeline']['user']) . '</b>';
                echo '<span class="pull-right"><i class="fa fa-clock-o"></i> ' . $this->Time->format($this->Common->dateTime(), h($row['Timeline']['created'])) . '</span>';
                echo '<p>' . __('<span class="label label-success">Added</span> the Product') . ' <b>' . h($row['Timeline']['activity']) . '</b></p></div>';
                break;
            case "update_Product":
                echo '<div class="cd-timeline-img cd-edit"><i class="fa fa-gift fa-2x"></i></div>';
                echo '<div class="cd-timeline-content"><b>' . h($row['Timeline']['user']) . '</b>';
                echo '<span class="pull-right"><i class="fa fa-clock-o"></i> ' . $this->Time->format($this->Common->dateTime(), h($row['Timeline']['created'])) . '</span>';
                echo '<p>' . __('<span class="label label-warning">Updated</span> the Product') . ' <b>' . h($row['Timeline']['activity']) . '</b></p></div>';
                break;
            case "unlink_Product":
                echo '<div class="cd-timeline-img cd-del"><i class="fa fa-gift fa-2x"></i></div>';
                echo '<div class="cd-timeline-content"><b>' . h($row['Timeline']['user']) . '</b>';
                echo '<span class="pull-right"><i class="fa fa-clock-o"></i> ' . $this->Time->format($this->Common->dateTime(), h($row['Timeline']['created'])) . '</span>';
                echo '<p>' . __('<span class="label label-danger">Deleted</span> the Product') . ' <b>' . h($row['Timeline']['activity']) . '</b></p> </div>';
                break;
            case "add_Source":
                echo '<div class="cd-timeline-img"><i class="fa fa-eye fa-2x"></i></div>';
                echo '<div class="cd-timeline-content"><b>' . h($row['Timeline']['user']) . '</b>';
                echo '<span class="pull-right"><i class="fa fa-clock-o"></i> ' . $this->Time->format($this->Common->dateTime(), h($row['Timeline']['created'])) . '</span>';
                echo '<p>' . __('<span class="label label-success">Added</span> the Source') . ' <b>' . h($row['Timeline']['activity']) . '</b></p> </div>';
                break;
            case "unlink_Source":
                echo '<div class="cd-timeline-img cd-del"><i class="fa fa-eye fa-2x"></i></div>';
                echo '<div class="cd-timeline-content"><b>' . h($row['Timeline']['user']) . '</b>';
                echo '<span class="pull-right"><i class="fa fa-clock-o"></i> ' . $this->Time->format($this->Common->dateTime(), h($row['Timeline']['created'])) . '</span>';
                echo '<p>' . __('<span class="label label-danger">Deleted</span> the Source') . ' <b>' . h($row['Timeline']['activity']) . '</b></p> </div>';
                break;
            case "add_File":
                echo '<div class="cd-timeline-img"><i class="fa fa-file-pdf-o fa-2x"></i></div>';
                echo '<div class="cd-timeline-content"><b>' . h($row['Timeline']['user']) . '</b>';
                echo '<span class="pull-right"><i class="fa fa-clock-o"></i> ' . $this->Time->format($this->Common->dateTime(), h($row['Timeline']['created'])) . '</span>';
                echo '<p>' . __('<span class="label label-success">Added</span> the File') . ' <b>' . h($row['Timeline']['activity']) . '</b></p> </div>';
                break;
            case "unlink_File":
                echo '<div class="cd-timeline-img cd-del"><i class="fa fa-file-pdf-o fa-2x"></i></div>';
                echo '<div class="cd-timeline-content"><b>' . h($row['Timeline']['user']) . '</b>';
                echo '<span class="pull-right"><i class="fa fa-clock-o"></i> ' . $this->Time->format($this->Common->dateTime(), h($row['Timeline']['created'])) . '</span>';
                echo '<p>' . __('<span class="label label-danger">Deleted</span> the File') . ' <b>' . h($row['Timeline']['activity']) . '</b></p> </div>';
                break;
            case "add_Discussion":
                echo '<div class="cd-timeline-img"><i class="fa fa-comments-o fa-2x"></i></div>';
                echo '<div class="cd-timeline-content"><b>' . h($row['Timeline']['user']) . '</b>';
                echo '<span class="pull-right"><i class="fa fa-clock-o"></i> ' . $this->Time->format($this->Common->dateTime(), h($row['Timeline']['created'])) . '</span>';
                echo '<p>' . __('<span class="label label-success">Added</span> the comment') . ' <b>' . h($row['Timeline']['activity']) . '</b></p> </div>';
                break;
            case "unlink_Discussion":
                echo '<div class="cd-timeline-img cd-del"><i class="fa fa-comments-o fa-2x"></i></div>';
                echo '<div class="cd-timeline-content"><b>' . h($row['Timeline']['user']) . '</b>';
                echo '<span class="pull-right"><i class="fa fa-clock-o"></i> ' . $this->Time->format($this->Common->dateTime(), h($row['Timeline']['created'])) . '</span>';
                echo '<p>' . __('<span class="label label-danger">Deleted</span> the comment') . ' <b>' . h($row['Timeline']['activity']) . '</b></p> </div>';
                break;
            case "add_Task":
                echo '<div class="cd-timeline-img"><i class="fa fa-tasks fa-2x"></i></div>';
                echo '<div class="cd-timeline-content"><b>' . h($row['Timeline']['user']) . '</b>';
                echo '<span class="pull-right"><i class="fa fa-clock-o"></i> ' . $this->Time->format($this->Common->dateTime(), h($row['Timeline']['created'])) . '</span>';
                echo '<p>' . __('<span class="label label-success">Added</span> the Task') . ' <b>' . h($row['Timeline']['activity']) . '</b></p> </div>';
                break;
            case "update_Task":
                echo '<div class="cd-timeline-img cd-edit"><i class="fa fa-tasks fa-2x"></i></div>';
                echo '<div class="cd-timeline-content"><b>' . h($row['Timeline']['user']) . '</b>';
                echo '<span class="pull-right"><i class="fa fa-clock-o"></i> ' . $this->Time->format($this->Common->dateTime(), h($row['Timeline']['created'])) . '</span>';
                echo '<p>' . __('<span class="label label-warning">Updated</span> the Task') . ' <b>' . h($row['Timeline']['activity']) . '</b></p> </div>';
                break;
            case "unlink_Task":
                echo '<div class="cd-timeline-img cd-del"><i class="fa fa-tasks fa-2x"></i></div>';
                echo '<div class="cd-timeline-content"><b>' . h($row['Timeline']['user']) . '</b>';
                echo '<span class="pull-right"><i class="fa fa-clock-o"></i> ' . $this->Time->format($this->Common->dateTime(), h($row['Timeline']['created'])) . '</span>';
                echo '<p>' . __('<span class="label label-danger">Deleted</span> the Task') . ' <b>' . h($row['Timeline']['activity']) . '</b></p> </div>';
                break;
            case "add_User":
                echo '<div class="cd-timeline-img"><i class="fa fa-user fa-2x"></i></div>';
                echo '<div class="cd-timeline-content"><b>' . h($row['Timeline']['user']) . '</b>';
                echo '<span class="pull-right"><i class="fa fa-clock-o"></i> ' . $this->Time->format($this->Common->dateTime(), h($row['Timeline']['created'])) . '</span>';
                echo '<p>' . __('<span class="label label-success">Appoint</span> the User') . ' <b>' . h($row['Timeline']['activity']) . '</b> to deal</p></div>';
                break;
            case "unlink_User":
                echo '<div class="cd-timeline-img cd-del"><i class="fa fa-user fa-2x"></i></div>';
                echo '<div class="cd-timeline-content"><b>' . h($row['Timeline']['user']) . '</b>';
                echo '<span class="pull-right"><i class="fa fa-clock-o"></i> ' . $this->Time->format($this->Common->dateTime(), h($row['Timeline']['created'])) . '</span>';
                echo '<p>' . __('<span class="label label-danger">Unappoint</span> the User') . ' <b>' . h($row['Timeline']['activity']) . '</b> from deal</p> </div>';
                break;
            case "change_Price":
                echo '<div class="cd-timeline-img"><i class="fa fa-money fa-2x"></i></div>';
                echo '<div class="cd-timeline-content"><b>' . h($row['Timeline']['user']) . '</b>';
                echo '<span class="pull-right"><i class="fa fa-clock-o"></i> ' . $this->Time->format($this->Common->dateTime(), h($row['Timeline']['created'])) . '</span>';
                echo '<p>' . __('<span class="label label-warning">Change</span> Deal Price from') . ' <b>' . h($row['Timeline']['activity']) . '</b></p></div>';
                break;
            case "rename_Deal":
                echo '<div class="cd-timeline-img"><i class="fa fa-edit fa-2x"></i></div>';
                echo '<div class="cd-timeline-content"><b>' . h($row['Timeline']['user']) . '</b>';
                echo '<span class="pull-right"><i class="fa fa-clock-o"></i> ' . $this->Time->format($this->Common->dateTime(), h($row['Timeline']['created'])) . '</span>';
                echo '<p>' . __('<span class="label label-warning">Change</span> Deal Name from') . ' <b>' . h($row['Timeline']['activity']) . '</b></p></div>';
                break;
            case "move_Pipeline":
                echo '<div class="cd-timeline-img"><i class="fa fa-filter fa-2x"></i></div>';
                echo '<div class="cd-timeline-content"><b>' . h($row['Timeline']['user']) . '</b>';
                echo '<span class="pull-right"><i class="fa fa-clock-o"></i> ' . $this->Time->format($this->Common->dateTime(), h($row['Timeline']['created'])) . '</span>';
                echo '<p>' . __('<span class="label label-warning">Change</span> Deal Pipeline from') . ' <b>' . h($row['Timeline']['activity']) . '</b></p></div>';
                break;
            case "move_Stage":
                echo '<div class="cd-timeline-img"><i class="fa fa-sitemap fa-2x"></i></div>';
                echo '<div class="cd-timeline-content"><b>' . h($row['Timeline']['user']) . '</b>';
                echo '<span class="pull-right"><i class="fa fa-clock-o"></i> ' . $this->Time->format($this->Common->dateTime(), h($row['Timeline']['created'])) . '</span>';
                echo '<p>' . __('<span class="label label-warning">Change</span> Deal Stage from') . ' <b>' . h($row['Timeline']['activity']) . '</b></p></div>';
                break;
            case "won_Deal":
                echo '<div class="cd-timeline-img"><i class="fa fa-thumbs-up fa-2x"></i></div>';
                echo '<div class="cd-timeline-content"><b>' . h($row['Timeline']['user']) . '</b>';
                echo '<span class="pull-right"><i class="fa fa-clock-o"></i> ' . $this->Time->format($this->Common->dateTime(), h($row['Timeline']['created'])) . '</span>';
                echo '<p>' . __('<span class="label label-success">Won</span> the deal') . ' <b>' . h($row['Timeline']['activity']) . '</b></p></div>';
                break;
            case "loss_Deal":
                echo '<div class="cd-timeline-img"><i class="fa fa-thumbs-down fa-2x"></i></div>';
                echo '<div class="cd-timeline-content"><b>' . h($row['Timeline']['user']) . '</b>';
                echo '<span class="pull-right"><i class="fa fa-clock-o"></i> ' . $this->Time->format($this->Common->dateTime(), h($row['Timeline']['created'])) . '</span>';
                echo '<p>' . __('<span class="label label-danger">Loss</span> the deal') . ' <b>' . h($row['Timeline']['activity']) . '</b></p></div>';
                break;
            case "make_active":
                echo '<div class="cd-timeline-img"><i class="fa fa-arrow-up fa-2x"></i></div>';
                echo '<div class="cd-timeline-content"><b>' . h($row['Timeline']['user']) . '</b>';
                echo '<span class="pull-right"><i class="fa fa-clock-o"></i> ' . $this->Time->format($this->Common->dateTime(), h($row['Timeline']['created'])) . '</span>';
                echo '<p>' . __('<span class="label label-success">Active</span> again deal') . ' <b>' . h($row['Timeline']['activity']) . '</b>.</p></div>';
                break;
            default:
                echo '';
                break;
        }

        ?>
    </div>
<?php endforeach; ?>