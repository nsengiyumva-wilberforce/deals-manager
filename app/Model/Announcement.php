<?php

/**
 * class for performing all Announcement related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Announcement extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Announcement';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'announcements';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array(
        'title' => array(
            'rule' => 'notBlank',
            'required' => true,
        ),
        'start_date' => array(
            'rule' => 'notBlank',
            'required' => true,
        ),
        'end_date' => array(
            'rule' => 'notBlank',
            'required' => true,
        )
    );

    /**
     * This function is used to get announcement by id
     *
     * @access public
     * @return array
     */
    public function getAnnouncementById($Id)
    {
        $result = $this->find('first', array('conditions' => array('Announcement.id' => $Id), 'fields' => array('Announcement.*')));
        return $result;
    }

    /**
     * This function is used to get  all announcement by user type
     *
     * @access public
     * @return array
     */
    public function getAnnouncements($type, $userId = null)
    {
        $date = date("Y-m-d");
        if ($type == 1 || $type == 2 || $type == 3):
            $permission = array(1, 3);
        else:
            $permission = array(2, 3);
        endif;

        $result = $this->find('all', array(
            'conditions' => array('Announcement.permission' => $permission, 'Announcement.start_date <=' => $date, 'Announcement.end_date >=' => $date, "NOT" => array('Announcement.read REGEXP' => "[[:<:]]" . $userId . "[[:>:]]")),
            'fields' => array('Announcement.id', 'Announcement.title')
        ));
        return $result;
    }

    /**
     * This function is used to get all announcement
     *
     * @access public
     * @return array
     */
    public function getAllAnnouncement()
    {
        $result = $this->find('all', array(
            'joins' => array(
                array('table' => 'users',
                    'alias' => 'User',
                    'type' => 'left',
                    'foreignKey' => false,
                    'conditions' => array('User.id = Announcement.user_id')
                )
            ),
            'fields' => array('Announcement.*', 'User.id', 'User.first_name', 'User.last_name', 'User.picture'),
            'order' => 'Announcement.id desc'
        ));
        return $result;
    }
}
