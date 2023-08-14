<?php
/**
 * class for performing various common functions in view.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
//load database tables
App::import("Model", "User");
App::import("Model", "Pipeline");
App::import("Model", "Milestone");
App::import("Model", "PipelinePermission");

class CommonHelper extends AppHelper
{

    /**
     *  Name of helper used in application
     *
     * @var object
     */
    var $name = 'Common';

    /**
     * This helper uses following helpers
     *
     * @var array
     */
    var $helpers = array('Html', 'Form', 'Session');

    /**
     *  This function is used to get pipeline list for admin and user
     *
     * @return array
     */
    public function getPipelineList()
    {
        $PipelineModel = new Pipeline();
        $PipelinePermissionModel = new PipelinePermission();
        if ($this->Session->read('Auth.User.user_group_id') == '1') {
            $PipelineList = $PipelineModel->find('list', array('fields' => array('Pipeline.id', 'Pipeline.name'), 'order' => array('Pipeline.id' => 'DESC')));
        } else {
            $userId = $this->Session->read('Auth.User.id');
            $outPipelines = $PipelinePermissionModel->find('list', array('conditions' => array('PipelinePermission.user_id = "' . $userId . '"'), 'fields' => array('PipelinePermission.pipeline_id')));
            $PipelineList = $PipelineModel->find('list', array(
                'conditions' => array("NOT" => array("Pipeline.id" => $outPipelines)),
                'fields' => array('Pipeline.id', 'Pipeline.name'),
                'order' => array('Pipeline.id' => 'DESC'),
            ));
        }
        return $PipelineList;
    }

    /**
     *  This function is used to get user list
     *
     * @return array
     */
    public function getUserList()
    {
        $UserModel = new User();
        $userGId = $this->Session->read('Auth.User.user_group_id');
        if ($userGId == 1) {
            $UserList = $UserModel->find('list', array('fields' => array('User.id', 'User.name'), 'order' => array('User.first_name' => 'ASC')));
        } else {
            $groupId = $this->Session->read('Auth.User.group_id');
            $UserList = $UserModel->find('list', array('conditions' => array('User.group_id = "' . $groupId . '"'), 'fields' => array('User.id', 'User.name'), 'order' => array('User.first_name' => 'ASC')));
        }
        return $UserList;
    }

    /**
     *  This function is used Check user type is admin
     *
     * @return boolan
     */
    public function isAdmin()
    {
        if ($this->Session->read('Auth.User.user_group_id') == '1') {
            return true;
        }
    }

    /**
     *  This function is used Check user type is group manager
     *
     * @return boolan
     */
    public function isManager()
    {
        if ($this->Session->read('Auth.User.user_group_id') == '2') {
            return true;
        }
    }

    /**
     *  This function is used Check user type is staff
     *
     * @return boolan
     */
    public function isAdminManager()
    {
        if ($this->Session->read('Auth.User.user_group_id') == '1' || $this->Session->read('Auth.User.user_group_id') == '2') {
            return true;
        }
    }

    /**
     *  This function is used Check user type is staff
     *
     * @return boolan
     */
    public function isStaff()
    {
        if ($this->Session->read('Auth.User.user_group_id') == '2' || $this->Session->read('Auth.User.user_group_id') == '3') {
            return true;
        }
    }

    /**
     *  This function is used Check user type is staff or Admin
     *
     * @return boolan
     */
    public function isAdminStaff()
    {
        if ($this->Session->read('Auth.User.user_group_id') == '1' || $this->Session->read('Auth.User.user_group_id') == '2' || $this->Session->read('Auth.User.user_group_id') == '3') {
            return true;
        }
    }

    /**
     *  This function is used Check Admin Permissions
     *
     * @return boolan
     */
    public function isAdminPermission($id = null)
    {
        $user = $this->Session->read('Auth.User.permission');
        if (empty($user) && $this->Session->read('Auth.User.user_group_id') == '1') {
            return true;
        } else {
            $permissions = explode(',', $this->Session->read('Auth.User.permission'));
            if (in_array($id, $permissions) && $this->Session->read('Auth.User.user_group_id') == '1') {
                return true;
            }
        }
    }

    /**
     *  This function is used Check staff permissions
     *
     * @return boolan
     */
    public function isStaffPermission($id = null)
    {
        if ($this->Session->read('Auth.User.user_group_id') == '1') {
            return true;
        } else {
            $user = $this->Session->read('Auth.User.permission');
            if (empty($user)) {
                $permissions = array(11, 21, 31, 41, 51);
            } else {
                $permissions = explode(',', $this->Session->read('Auth.User.permission'));
            }
            if (in_array($id, $permissions)) {
                return true;
            }
        }
    }

    /**
     *  This function is used show ticket status by ticket id 
     *
     * @return text
     */
    public function ticket_status($id)
    {
        if ($id == '1') {
            echo '<span class="label label-success">' . __('Open') . '</span>';
        } elseif ($id == '2') {
            echo '<span class="label label-primary">' . __('In Progress') . '</span>';
        } elseif ($id == '3') {
            echo '<span class="label label-danger">' . __('On Hold') . '</span>';
        } elseif ($id == '4') {
            echo '<span class="label label-warning">' . __('Reopened') . '</span>';
        } elseif ($id == '5') {
            echo '<span class="label label-default">' . __('Closed') . '</span>';
        } else {
            echo '<span class="label label-blue">' . __('New') . '</span>';
        }
    }

    /**
     * This function is used show color list for add new label
     *
     * @return array
     */
    public function getColors()
    {
        $result = array('000' => __('Black'), '0000ff' => __('Blue'), '008000' => __('Green'), '808080' => __('Gray'), 'FF0000' => __('Red'), 'FFFF00' => __('Yellow'), 'FFC0CB' => __('Pink'), 'FFA500' => __('Orange'), 'FFD700' => __('Gold'));
        return $result;
    }

    /**
     *  This function is used show task priority by task id
     *
     * @return text
     */
    public function priority($id)
    {
        if ($id == '1') {
            echo '<span class="label label-success">' . __('Low Priority') . '</span>';
        } elseif ($id == '2') {
            echo '<span class="label label-warning">' . __('Medium Priority') . '</span>';
        } elseif ($id == '3') {
            echo '<span class="label label-danger">' . __('High Priority') . '</span>';
        } else {
            
        }
    }

    /**
     *  This function is used show task priority by task id
     *
     * @return text
     */
    public function priorityClass($id)
    {
        if ($id == '1') {
            echo 'task-low';
        } elseif ($id == '2') {
            echo 'task-medium';
        } elseif ($id == '3') {
            echo 'task-high';
        } else {
            echo '';
        }
    }

    /**
     *  This function is used show task motive by task id
     *
     * @return text
     */
    public function motives($id)
    {
        if ($id == '1') {
            echo '<i class="fa fa-envelope fa-lg"></i>';
        } elseif ($id == '2') {
            echo '<i class="fa fa-briefcase fa-lg"></i>';
        } elseif ($id == '3') {
            echo '<i class="fa fa-phone fa-lg"></i>';
        } elseif ($id == '4') {
            echo '<i class="fa fa-child fa-lg"></i>';
        } elseif ($id == '5') {
            echo '<i class="fa fa-tasks fa-lg"></i>';
        } elseif ($id == '6') {
            echo '<i class="fa fa-quote-left fa-lg"></i>';
        } elseif ($id == '7') {
            echo '<i class="fa fa-file-archive-o fa-lg"></i>';
        } else {
            echo '<i class="fa fa-question-circle fa-lg"></i>';
        }
    }

    /**
     *  This function is used show motives list
     *
     * @return array
     */
    public function motivesList()
    {
        return $motives = array('1' => __('Email'), '2' => __('Appointment'), '3' => __('Call'), '4' => __('Consultancy'), '5' => __('Task'), '6' => __('Quote'), '7' => __('Invoice'), '8' => __('Other'));
    }

    /**
     *  This function is used show deal status by deal id 
     *
     * @return text
     */
    public function status($id)
    {
        if ($id == '0') {
            echo '<span class="label label-success">' . __('Active') . '</span>';
        } elseif ($id == '1') {
            echo '<span class="label label-warning">' . __('Won') . '</span>';
        } elseif ($id == '2') {
            echo '<span class="label label-danger">' . __('Loss') . '</span>';
        } else {
            
        }
    }

    /**
     *  This function is used show time zone list in setting page
     *
     * @return array
     */
    public function generate_timezone_list()
    {
        static $regions = array(
            DateTimeZone::AFRICA,
            DateTimeZone::AMERICA,
            DateTimeZone::ANTARCTICA,
            DateTimeZone::ASIA,
            DateTimeZone::ATLANTIC,
            DateTimeZone::AUSTRALIA,
            DateTimeZone::EUROPE,
            DateTimeZone::INDIAN,
            DateTimeZone::PACIFIC,
        );

        $timezones = array();
        foreach ($regions as $region) {
            $timezones = array_merge($timezones, DateTimeZone::listIdentifiers($region));
        }

        $timezone_offsets = array();
        foreach ($timezones as $timezone) {
            $tz = new DateTimeZone($timezone);
            $timezone_offsets[$timezone] = $tz->getOffset(new DateTime);
        }

        // sort timezone by offset
        asort($timezone_offsets);

        $timezone_list = array();
        foreach ($timezone_offsets as $timezone => $offset) {
            $offset_prefix = $offset < 0 ? '-' : '+';
            $offset_formatted = gmdate('H:i', abs($offset));

            $pretty_offset = "UTC${offset_prefix}${offset_formatted}";

            $timezone_list[$timezone] = "(${pretty_offset}) $timezone";
        }

        return $timezone_list;
    }

    /**
     *  This function is used show logo for company from setting
     *
     * @return text
     */
    public function logo($title = null, $image = null, $titleText = null)
    {
        if (!empty($title)) {
            if ($title == '2') {
                echo $this->Html->image($image);
            } else {
                echo $titleText;
            }
        } else {
            $title = $this->Session->read('Auth.User.title');
            if ($title == '2') {
                $image = $this->Session->read('Auth.User.title_logo');
                echo $this->Html->image($image);
            } else {
                echo $this->Session->read('Auth.User.title_text');
            }
        }
    }

    /**
     *  This function is used show activity type list for activity page
     *
     * @return array
     */
    public function activity()
    {
        return $activity = array('add_Deal' => __('Deal Created'), 'move_Deal' => __('Deal Stage Changed'), 'change_Price' => __('Deal Price Changed'), 'move_Pipeline' => __('Deal Pipeline Changed'), 'won_Deal' => __('Deal Won'), 'loss_Deal' => __('Deal Lost'), 'unlink_Deal' => __('Deal Deleted'), 'add_User' => __('Appoint User'), 'unlink_User' => __('Unappoint User'), 'make_active' => __('Deal Reactive'), 'add_Task' => __('Task Created'), 'update_Task' => __('Task Updated'), 'unlink_Task' => __('Task Deleted'), 'add_File' => __('File Added'), 'unlink_File' => __('File Removed'), 'add_Discussion' => __('Comment Added'), 'unlink_Discussion' => __('Comment Deleted'), 'add_Contact' => __('Contact Added'), 'unlink_Contact' => __('Contact Removed'), 'add_Product' => __('Product Added'), 'update_Product' => __('Product Updated'), 'unlink_Product' => __('Product Removed'), 'add_Source' => __('Source Added'), 'unlink_Source' => __('Source Removed'));
    }

    /**
     *  This function is used show activity icon for activity type on view deal page
     *
     * @return text
     */
    public function timeline_list($module, $activity)
    {
        switch ($module) {
            case "add_File":
                echo '<p>' . __('<label class="label label-success">Added</label> the File') . ' <b>' . $activity . '</b></p>';
                echo '<span><i class="fa fa-file-pdf-o"></i></span>';
                break;
            case "unlink_File":
                echo '<p>' . __('<label class="label label-danger">Deleted</label> the file') . ' <b>' . $activity . '</b></p>';
                echo '<span class="badge badge-danger"><i class="fa fa-file-pdf-o"></i></span>';
                break;
            case "add_Contact":
                echo '<p>' . __('<label class="label label-success">Added</label> the contact') . ' <b>' . $activity . '</b>.</p>';
                echo '<span><i class="fa fa-users"></i></span>';
                break;
            case "unlink_Contact":
                echo '<p>' . __('<label class="label label-danger">Deleted</label> the contact') . ' <b>' . $activity . '</b>.</p>';
                echo '<span class="badge badge-danger"><i class="fa fa-users"></i></span>';
                break;
            case "add_Product":
                echo '<p>' . __('<label class="label label-success">Added</label> the product') . ' <b>' . $activity . '</b></p>';
                echo '<span><i class="fa fa-gift"></i></span>';
                break;
            case "update_Product":
                echo '<p>' . __('<label class="label label-warning">Updated</label> the product') . ' <b>' . $activity . '</b></p>';
                echo '<span class="badge badge-primary"><i class="fa fa-gift"></i></span>';
                break;
            case "unlink_Product":
                echo '<p>' . __('<label class="label label-danger">Deleted</label> the product') . ' <b>' . $activity . '</b></p>';
                echo '<span class="badge badge-danger"><i class="fa fa-gift"></i></span>';
                break;
            case "add_Source":
                echo '<p>' . __('<label class="label label-success">Added</label> the source') . ' <b>' . $activity . '</b></p>';
                echo '<span><i class="fa fa-eye"></i></span>';
                break;
            case "unlink_Source":
                echo '<p>' . __('<label class="label label-danger">Deleted</label> the source') . ' <b>' . $activity . '</b></p>';
                echo '<span class="badge badge-danger"><i class="fa fa-eye"></i></span>';
                break;
            case "add_Deal":
                echo '<p>' . __('<label class="label label-success">created</label> the deal') . ' </p>';
                echo '<span><i class="fa fa-plus"></i></span>';
                break;
            case "unlink_Deal":
                echo '<span class="badge badge-danger"><i class="fa fa-fw">&#xf00d;</i></span>';
                break;
            case "add_Discussion":
                echo '<p>' . __('<label class="label label-success">Added</label> the comment') . ' <b>' . $activity . '</b></p>';
                echo '<span><i class="fa fa-comments-o"></i></span>';
                break;
            case "unlink_Discussion":
                echo '<p>' . __('<label class="label label-danger">Deleted</label> the comment') . ' <b>' . $activity . '</b></p>';

                echo '<span class="badge badge-danger"><i class="fa fa-comments-o"></i></span>';
                break;
            case "add_Task":
                echo '<p>' . __('<label class="label label-success">Added</label> the task') . ' <b>' . $activity . '</b></p>';
                echo '<span><i class="fa fa-tasks"></i></span>';
                break;
            case "update_Task":
                echo '<p>' . __('<label class="label label-warning">Updated</label> the task') . ' <b>' . $activity . '</b></p>';
                echo '<span class="badge badge-primary"><i class="fa fa-tasks"></i></span>';
                break;
            case "unlink_Task":
                echo '<p>' . __('<label class="label label-danger">Deleted</label> the task') . ' <b>' . $activity . '</b></p>';
                echo '<span class="badge badge-danger"><i class="fa fa-tasks"></i></span>';
                break;
            case "add_User":
                echo '<p>' . __('<label class="label label-success">Appoint</label> the user') . ' <b>' . $activity . '</b> to deal</p>';
                echo '<span><i class="fa fa-user"></i></span>';
                break;
            case "unlink_User":
                echo '<p>' . __('<label class="label label-danger">Unappoint</label> the user') . ' <b>' . $activity . '</b> from deal</p>';
                echo '<span class="badge badge-danger"><i class="fa fa-user"></i></span>';
                break;
            case "change_Price":
                echo '<p>' . __('<label class="label label-warning">Change</label> deal price from') . ' <b>' . $activity . '</b></p>';
                echo '<span><i class="fa fa-money"></i></span>';
                break;
            case "rename_Deal":
                echo '<p>' . __('<label class="label label-warning">Change</label> deal name from') . ' <b>' . $activity . '</b></p>';
                echo '<span><i class="fa fa-plus"></i></span>';
                break;
            case "move_Pipeline":
                echo '<p>' . __('<label class="label label-warning">Change</label> deal pipeline from') . ' <b>' . $activity . '</b></p>';
                echo '<span><i class="fa fa-filter"></i></span>';
                break;
            case "move_Stage":
                echo '<p>' . __('<label class="label label-warning">Change</label> deal stage from') . ' <b>' . $activity . '</b></p>';
                echo '<span><i class="fa fa-sitemap"></i></span>';
                break;
            case "won_Deal":
                echo '<p>' . __('<label class="label label-success">Won</label> the deal') . ' <b>' . $activity . '</b></p>';
                echo '<span><i class="fa fa-thumbs-up"></i></span>';
                break;
            case "loss_Deal":
                echo '<p>' . __('<label class="label label-danger">Loss</label> the deal') . ' <b>' . $activity . '</b></p>';
                echo '<span><i class="fa fa-thumbs-down"></i></span>';
                break;
            case "make_active":
                echo '<p>' . __('<label class="label label-success">Active</label> again deal') . ' <b>' . $activity . '</b>.</p>';
                echo '<span><i class="fa fa-arrow-up"></i></span>';
                break;
        }
    }

    /**
     *  This function is used show date and time for application from setting page 
     *
     * @return text
     */
    public function dateTime()
    {
        if ($this->Session->read('Auth.User.date_format')) {
            return $this->Session->read('Auth.User.date_format') . ' ' . $this->Session->read('Auth.User.time_format');
        } else {
            return 'Y-m-d H:i A';
        }
    }

    /**
     *  This function is used show date for application from setting page 
     *
     * @return text
     */
    public function dateShow()
    {
        if ($this->Session->read('Auth.User.date_format')) {
            return $this->Session->read('Auth.User.date_format');
        } else {
            return 'Y-m-d';
        }
    }

    /**
     *  This function is used show date for application from setting page 
     *
     * @return text
     */
    public function timeShow()
    {
        if ($this->Session->read('Auth.User.time_format')) {
            return $this->Session->read('Auth.User.time_format');
        } else {
            return 'H:i A';
        }
    }

    /**
     *  This function is used show user permissions on users role page
     *
     * @return text
     */
    public function permissions($module)
    {
        switch ($module) {
            case "1":
                echo '<label class="label label-default">' . __('Pipelines') . '</label>';
                break;
            case "2":
                echo '<label class="label label-default">' . __('Stages') . '</label>';
                break;
            case "3":
                echo '<label class="label label-default">' . __('All Task') . '</label>';
                break;
            case "4":
                echo '<label class="label label-default">' . __('Users') . '</label>';
                break;
            case "5":
                echo '<label class="label label-default">' . __('Reports') . '</label>';
                break;
            case "6":
                echo '<label class="label label-default">' . __('Activity') . '</label>';
                break;
            case "7":
                echo '<label class="label label-default">' . __('Settings') . '</label>';
                break;
            case "8":
                echo '<label class="label label-default">' . __('Labels') . '</label>';
                break;
            case "11":
                echo '<label class="label label-default">' . __('View Contacts') . '</label>';
                break;
            case "12":
                echo '<label class="label label-default">' . __('Add Contacts') . '</label>';
                break;
            case "13":
                echo '<label class="label label-default">' . __('Edit Contacts') . '</label>';
                break;
            case "14":
                echo '<label class="label label-default">' . __('Delete Contacts') . '</label>';
                break;
            case "21":
                echo '<label class="label label-default">' . __('View Clients') . '</label>';
                break;
            case "22":
                echo '<label class="label label-default">' . __('Add Clients') . '</label>';
                break;
            case "23":
                echo '<label class="label label-default">' . __('Edit Clients') . '</label>';
                break;
            case "24":
                echo '<label class="label label-default">' . __('Delete Clients') . '</label>';
                break;
            case "31":
                echo '<label class="label label-default">' . __('View Products') . '</label>';
                break;
            case "32":
                echo '<label class="label label-default">' . __('Add Products') . '</label>';
                break;
            case "33":
                echo '<label class="label label-default">' . __('Edit Products') . '</label>';
                break;
            case "34":
                echo '<label class="label label-default">' . __('Delete Products') . '</label>';
                break;
            case "41":
                echo '<label class="label label-default">' . __('View Sources') . '</label>';
                break;
            case "42":
                echo '<label class="label label-default">' . __('Add Sources') . '</label>';
                break;
            case "43":
                echo '<label class="label label-default">' . __('Edit Sources') . '</label>';
                break;
            case "44":
                echo '<label class="label label-default">' . __('Delete Sources') . '</label>';
                break;
            case "51":
                echo '<label class="label label-default">' . __('View Invoices') . '</label>';
                break;
            case "52":
                echo '<label class="label label-default">' . __('Add Invoices') . '</label>';
                break;
            case "53":
                echo '<label class="label label-default">' . __('Edit Invoices') . '</label>';
                break;
            case "54":
                echo '<label class="label label-default">' . __('Delete Invoices') . '</label>';
                break;
        }
    }

    /**
     *  This function is used show user permissions on users role page
     *
     * @return text
     */
    public function user_type($typeId)
    {
        switch ($typeId) {
            case "1":
                echo 'Admin';
                break;
            case "2":
                echo 'Manager';
                break;
            case "3":
                echo 'Staff';
                break;
            case "4":
                echo 'Client';
                break;
        }
    }

    /**
     *  This function is used show invoice status by invoice id 
     *
     * @return text
     */
    public function invoice_status($id)
    {
        if ($id == 0) {
            echo '<span class="label label-success">' . __('Open') . '</span>';
        } elseif ($id == 1) {
            echo '<span class="label label-warning">' . __('Not Paid') . '</span>';
        } elseif ($id == 2) {
            echo '<span class="label label-danger">' . __('Partialy Paid') . '</span>';
        } elseif ($id == 3) {
            echo '<span class="label label-primary">' . __('Paid') . '</span>';
        } elseif ($id == 4) {
            echo '<span class="label label-warning">' . __('Cancelled') . '</span>';
        } else {
            echo '<span class="label label-blue">' . __('') . '</span>';
        }
    }
}
