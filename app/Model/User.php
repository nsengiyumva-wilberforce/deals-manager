<?php
/**
 * class for performing all user related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
App::uses('SimplePasswordHasher', 'Controller/Component/Auth');

class User extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'User';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'users';

    /**
     *  Virtual field for user name
     *
     * @var array
     */
    public $virtualFields = array(
        'name' => 'CONCAT(User.first_name, " ", User.last_name)'
    );

    /**
     * This function is called before save password
     *
     * @var bool
     */
    public function beforeSave($options = array())
    {
        if (!empty($this->data[$this->alias]['password'])) {
            $passwordHasher = new SimplePasswordHasher(array('hashType' => 'sha1'));
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }

    /**
     * Bind user detail table
     *
     */
    var $hasOne = array('UserDetail');

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array('first_name' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'First name must be required'
            ),
        ),
        'last_name' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Last name must be required'
            )
        ),
        'email' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Email must be required'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Sorry, this Email has been already taken'
            )
        ),
        'user_group_id' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Role must be required'
            )
        ),
        'job_title' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Role must be required'
            )
        ),
        'password' => array(
            'mustNotEmpty' => array(
                'rule' => 'notBlank',
                'message' => 'Please enter password',
                'on' => 'create',
                'last' => true),
            'mustBeLonger' => array(
                'rule' => array('minLength', 6),
                'message' => 'Password must be greater than 5 characters',
                'on' => 'create',
                'last' => true),
        ),
        'cPassword' => array(
            'notBlank' => array(
                'rule' => 'notBlank',
                'message' => 'Confirm password must be required'
            ),
            'size' => array(
                'rule' => array('between', 6, 25),
                'message' => 'Confirm Password should be at least 6 chars long'
            )
        )
    );

    /**
     * This function is used for add new user/admin validation array
     *
     * @var array
     */
    function UserValidate()
    {
        $vald = array(
            'first_name' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'First name must be required'
                ),
            ),
            'last_name' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Last name must be required'
                )
            ),
            'email' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Email must be required'
                ),
                'unique' => array(
                    'rule' => 'isUnique',
                    'message' => 'Sorry, this Email has been already taken'
                )
            ),
            'user_group_id' => array(
                'notBlank' => array(
                    'rule' => 'notBlank',
                    'message' => 'Role must be required'
                ))
        );
        $this->validate = $vald;
        return $this->validates();
    }

    /**
     * This function is used to get user and user details by user id 
     *
     * @access public
     * @return array
     */
    public function getUserById($userId)
    {
        $result = $this->find('first', array('conditions' => array('User.id' => $userId), 'contain' => array('UserDetail')));
        return $result;
    }

    /**
     * This function is used to get user email by user id 
     *
     * @access public
     * @return array
     */
    public function getUserEmail($userId)
    {
        $result = $this->find('first', array('conditions' => array('User.id' => $userId), 'fields' => array('User.email')));
        return $result;
    }

    /**
     * This function is used to get all users
     *
     * @access public
     * @return array
     */
    public function getAllUserByType()
    {
        $result = $this->find('all', array('conditions' => array('User.user_group_id' => '2'), 'contain' => array('UserDetail')));
        return $result;
    }

    /**
     * This function is used to get user by email
     *
     * @access public
     * @return array
     */
    public function findByEmail($email)
    {
        $res = $this->find('first', array('conditions' => array('User.email' => $email), 'contain' => array('UserDetail')));
        return $res;
    }

    /**
     * This function is used to get all users
     *
     * @access public
     * @return array
     */
    public function getUsers()
    {
        $result = $this->find('all', array('conditions' => array('User.user_group_id' => '2'), 'contain' => array('UserDetail')));
        return $result;
    }

    /**
     * This function is used to get users of deal
     *
     * @access public
     * @return array
     */
    public function getUsersByDeal($dealId)
    {
        $results = $this->find('all', array('joins' => array(
                array('table' => 'user_deals',
                    'alias' => 'UserDeal',
                    'type' => 'left',
                    'foreignKey' => false,
                    'conditions' => array('User.id = UserDeal.user_id')
                )
            ),
            'conditions' => array('UserDeal.deal_id' => $dealId),
            'order' => array('User.name ASC'),
            'fields' => array('User.id', 'User.name', 'User.email', 'User.picture', 'User.user_group_id', 'User.job_title'),
        ));
        return $results;
    }

    /**
     * This function is used to get user name by user id
     *
     * @access public
     * @return array
     */
    public function getUserName($id)
    {
        $result = $this->find('first', array('conditions' => array('User.id' => $id), 'fields' => array('User.name')));
        return $result;
    }

    /**
     * This function is used to check role have users
     *
     * @access public
     * @return array
     */
    public function checkRole($roleId)
    {
        $result = $this->find('first', array('conditions' => array('User.role' => $roleId), 'fields' => array('User.id')));
        return $result;
    }

    /**
     * This function is used to get all users count
     *
     * @access public
     * @return array
     */
    public function getUsersCount($userType)
    {
        $result = $this->find('count', array('conditions' => array('User.user_group_id' => $userType)));
        return $result;
    }

    /**
     * This function is used to get all users
     *
     * @access public
     * @return array
     */
    public function getUserByType($type)
    {
        $result = $this->find('list', array('conditions' => array('User.user_group_id' => $type), 'fields' => array('User.id', 'User.name')));
        return $result;
    }

    /**
     * This function is used to get user by company id 
     *
     * @access public
     * @return array
     */
    public function getUserByCompany($companyId)
    {
        $result = $this->find('all', array('conditions' => array('User.company_id' => $companyId), 'contain' => array('UserDetail')));
        return $result;
    }

    /**
     * This function is used to get user by email
     *
     * @access public
     * @return array
     */
    public function getUserByGroup($group)
    {
        $res = $this->find('list', array('conditions' => array('User.group_id' => $group), 'fields' => array('User.id', 'User.name')));
        return $res;
    }

    /**
     * This function is used to get user by company id 
     *
     * @access public
     * @return array
     */
    public function getClients($companyId = null)
    {
        $conditions = array();
        if (!empty($companyId)) {
            $conditions['User.company_id'] = $companyId;
        }
        $conditions['User.user_group_id'] = 4;
        $result = $this->find('all', array('conditions' => $conditions,
            'joins' => array(
                array('table' => 'company',
                    'alias' => 'Company',
                    'type' => 'left',
                    'conditions' => array('Company.id = User.company_id')
                )
            ),
            'fields' => array('User.id', 'User.name', 'Company.name')));
        return $result;
    }

    /**
     * This function is used to get user by id
     *
     * @access public
     * @return array
     */
    public function getClientCompany($userId)
    {
        $result = $this->find('first', array('conditions' => array('User.id' => $userId), 'fields' => array('User.company_id')));
        return $result;
    }

    /**
     * This function is used to get user by pipeline
     *
     * @access public
     * @return array
     */
    public function getPipelineUsers($id)
    {
        $result = $this->find('all', array('conditions' => array('User.user_group_id <>' => '1'),
            'joins' => array(
                array(
                    'table' => 'pipeline_permission',
                    'alias' => 'PipelinePermission',
                    'type' => 'LEFT',
                    'foreignKey' => false,
                    'conditions' => array(
                        'PipelinePermission.user_id = User.id',
                        'PipelinePermission.pipeline_id = "' . $id . '"'
                    )
                )),
            'fields' => array('User.id', 'User.name', 'User.job_title', 'PipelinePermission.*')));
        return $result;
    }

    /**
     * This function is used to get user list by group id
     *
     * @access public
     * @return array
     */
    public function getUserIdByGroup($group)
    {
        $res = $this->find('list', array('conditions' => array('User.group_id' => $group), 'fields' => array('User.id')));
        return $res;
    }
}
