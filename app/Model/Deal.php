<?php
/**
 * class for performing all deal related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
App::uses('CakeSession', 'Model/Datasource');

class Deal extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Deal';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'deal';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array();

    /**
     * This function is used to get deal by deal id
     *
     * @access public
     * @return array
     */
    public function getDealById($dealId)
    {
        $result = $this->find('first', array('conditions' => array('Deal.id' => $dealId)));
        return $result;
    }

    /**
     * This function is used to get deals by stage id and other filter
     *
     * @access public
     * @return array
     */
    public function getDealsByStage($stageId, $labelId, $userId, $userGId, $page = null)
    {
        $conditions = array();
        $options = array();
        $conditions['Deal.stage_id'] = $stageId;
        $conditions['Deal.status'] = '0';
        if (!empty($page)) {
            $page = 10 * $page;
        } else {
            $page = 0;
        }
        if ($userGId == 2) {
            $conditions['Deal.group_id'] = CakeSession::read("Auth.User.group_id");
        }
        if (!empty($labelId)) {
            $conditions['LabelDeal.label_id'] = $labelId;
            $options[] = array(
                'table' => 'label_deals',
                'alias' => 'LabelDeal',
                'type' => 'inner',
                'conditions' => array(
                    'LabelDeal.deal_id = Deal.id'
                )
            );
        }
        if (!empty($userId)) {
            $conditions['UserDeal.user_id'] = $userId;
            $options[] = array(
                'table' => 'user_deals',
                'alias' => 'UserDeal',
                'type' => 'INNER',
                'conditions' => array(
                    'UserDeal.deal_id = Deal.id'
                )
            );
        }

        $result = $this->find('all', array(
            'joins' => $options,
            'conditions' => $conditions,
            'fields' => array('Deal.*'),
            'limit' => 10,
            'offset' => $page,
            'order' => 'Deal.name ASC',
        ));
        return $result;
    }

    /**
     * This function is used to get report data with pipeline id and other parameters
     *
     * @access public
     * @return array
     */
    public function Report($pipelineId, $stageId, $fromDate, $toDate, $status, $userId = null, $productId = null, $sourceId = null, $price = null)
    {
        $conditions = array();

        $conditions['Deal.pipeline_id'] = $pipelineId;
        $conditions['Deal.stage_id'] = $stageId;
        if (is_numeric($status)) {
            $conditions['Deal.status'] = $status;
        }
        $conditions['and'] = array(array('Deal.created <=' => $toDate, 'Deal.created >=' => $fromDate));
        $options = array();
        if (!empty($productId)) {
            $options[] = array(
                'table' => 'product_deals',
                'alias' => 'ProductDeal',
                'type' => 'LEFT',
                'conditions' => array(
                    'ProductDeal.deal_id = Deal.id'
                )
            );
            $conditions['ProductDeal.product_id'] = $productId;
        }
        if (!empty($sourceId)) {
            $options[] = array(
                'table' => 'source_deals',
                'alias' => 'SourceDeal',
                'type' => 'LEFT',
                'conditions' => array(
                    'SourceDeal.deal_id = Deal.id'
                )
            );
            $conditions['SourceDeal.source_id'] = $sourceId;
        }
        if (!empty($userId)) {
            $conditions['UserDeal.user_id'] = $userId;
            $options[] = array(
                'table' => 'user_deals',
                'alias' => 'UserDeal',
                'type' => 'INNER',
                'foreignKey' => false,
                'conditions' => array(
                    'UserDeal.deal_id = Deal.id'
                )
            );
        }
        if (!empty($price)) {
            $result = $this->find('first', array(
                'joins' => $options,
                'conditions' => $conditions,
                'fields' => array('SUM(Deal.price) as sum'),
            ));
        } else {
            $result = $this->find('count', array(
                'joins' => $options,
                'conditions' => $conditions,
            ));
        }
        return $result;
    }

    /**
     * This function is used to get deals to export by user id,pipeline id and date
     *
     * @access public
     * @return array
     */
    public function getExport($userId, $pipelinId, $fDate, $tDate, $status)
    {
        $conditions = array();
        if (!empty($userId)) {
            $conditions['UserDeal.user_id'] = $userId;
        }
        if (!empty($status)) {
            $conditions['Deal.status'] = $status;
        }

        $conditions['and'] = array(array('Deal.created <= ' => $tDate, 'Deal.created >= ' => $fDate));
        $conditions['Deal.pipeline_id'] = $pipelinId;
        $result = $this->find('all', array(
            'joins' => array(
                array(
                    'table' => 'stages',
                    'alias' => 'Stage',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array(
                        'Stage.id = Deal.stage_id'
                    )
                ),
                array(
                    'table' => 'pipeline',
                    'alias' => 'Pipeline',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array(
                        'Pipeline.id = Deal.pipeline_id'
                    )
                ),
                array(
                    'table' => 'user_deals',
                    'alias' => 'UserDeal',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array(
                        'UserDeal.deal_id = Deal.id'
                    )
                )
            ),
            'fields' => array('Deal.id', 'Deal.name', 'Deal.price', 'Deal.created', 'Deal.modified', 'Stage.name', 'Pipeline.name'),
            'conditions' => $conditions
        ));
        return $result;
    }

    /**
     * This function is used to get deals by user id
     *
     * @access public
     * @return array
     */
    public function getDealsByUser($userId)
    {
        $conditions = array();
        $options = array();
        if (!empty($userId)) {
            $conditions['UserDeal.user_id'] = $userId;
            $options = array(
                array(
                    'table' => 'user_deals',
                    'alias' => 'UserDeal',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array(
                        'UserDeal.deal_id = Deal.id'
                    )
                )
            );
        }
        $conditions['Deal.status'] = '0';
        $result = $this->find('list', array(
            'joins' => $options,
            'conditions' => $conditions,
            'fields' => array('Deal.id', 'Deal.name'),
            'order' => 'Deal.name ASC',
        ));
        return $result;
    }

    /**
     * This function is used to get deals by user
     *
     * @access public
     * @return array
     */
    public function getDealsListByUser($userId)
    {
        $conditions = array();
        $options = array();
        if (!empty($userId)) {
            $conditions['UserDeal.user_id'] = $userId;
            $options = array(
                array(
                    'table' => 'user_deals',
                    'alias' => 'UserDeal',
                    'type' => 'INNER',
                    'foreignKey' => false,
                    'conditions' => array(
                        'UserDeal.deal_id = Deal.id'
                    )
                )
            );
        }
        $conditions['Deal.status'] = '0';
        $result = $this->find('all', array(
            'joins' => $options,
            'conditions' => $conditions,
            'fields' => array('Deal.id', 'Deal.name'),
            'order' => 'Deal.name ASC',
        ));
        return $result;
    }

    /**
     * This function is used to get list of all deals by group or not
     *
     * @access public
     * @return array
     */
    public function getAllDeals($groupId = null)
    {
        $conditions = array();
        $options = array();
        if (!empty($groupId)) {
            $conditions['Deal.group_id'] = $groupId;
        }
        $result = $this->find('list', array(
            'joins' => $options,
            'conditions' => $conditions,
            'fields' => array('Deal.id', 'Deal.name'),
            'order' => 'Deal.name ASC',
        ));
        return $result;
    }

    /**
     * This function is used to get list of all deals by group or not
     *
     * @access public
     * @return array
     */
    public function getAllActiveDeals($groupId = null)
    {
        $conditions = array();
        if (!empty($groupId)) {
            $conditions['Deal.group_id'] = $groupId;
        }
        $conditions['Deal.status'] = 0;
        $result = $this->find('list', array(
            'conditions' => $conditions,
            'fields' => array('Deal.id', 'Deal.name'),
            'order' => 'Deal.name ASC',
        ));
        return $result;
    }

    /**
     * Used to get deals in contact by contact id
     *
     * @access public
     * @return array
     */
    public function getDealsByContact($contactId, $userId, $userGId, $groupId)
    {
        $conditions = array();
        $conditions['ContactDeal.contact_id'] = $contactId;

        if (!empty($userGId) && $userGId == 2) {
            $conditions['Deal.group_id'] = $groupId;
        } elseif (!empty($userId)) {
            $conditions['UserDeal.user_id'] = $userId;
        }

        $options = array(
            array(
                'table' => 'contact_deals',
                'alias' => 'ContactDeal',
                'type' => 'INNER',
                'foreignKey' => false,
                'conditions' => array(
                    'ContactDeal.deal_id = Deal.id'
                )
            ),
            array(
                'table' => 'stages',
                'alias' => 'Stage',
                'type' => 'LEFT',
                'foreignKey' => false,
                'conditions' => array(
                    'Stage.id = Deal.stage_id'
                )
            ),
            array(
                'table' => 'pipeline',
                'alias' => 'Pipeline',
                'type' => 'LEFT',
                'foreignKey' => false,
                'conditions' => array(
                    'Pipeline.id = Deal.pipeline_id'
                )
            ),
            array(
                'table' => 'user_deals',
                'alias' => 'UserDeal',
                'type' => 'INNER',
                'foreignKey' => false,
                'conditions' => array(
                    'UserDeal.deal_id = Deal.id'
                )
            )
        );
        $result = $this->find('all', array(
            'joins' => $options,
            'conditions' => $conditions,
            'fields' => array('Distinct(Deal.id)', 'Deal.name', 'Deal.status', 'Pipeline.name', 'Stage.name'),
            'order' => 'Deal.name ASC',
        ));
        return $result;
    }

    /**
     * This function is used to get deals in source by source id and user id
     *
     * @access public
     * @return array
     */
    public function getDealsBySource($sourceId, $userId, $userGId, $groupId)
    {
        $conditions = array();
        $options = array();
        $conditions['SourceDeal.source_id'] = $sourceId;
        if (!empty($userGId) && $userGId == 2) {
            $conditions['Deal.group_id'] = $groupId;
        } elseif (!empty($userId)) {
            $conditions['UserDeal.user_id'] = $userId;
            $options[] = array(
                'table' => 'user_deals',
                'alias' => 'UserDeal',
                'type' => 'INNER',
                'foreignKey' => false,
                'conditions' => array(
                    'UserDeal.deal_id = Deal.id'
                )
            );
        }

        $options[] = array(
            'table' => 'source_deals',
            'alias' => 'SourceDeal',
            'type' => 'INNER',
            'foreignKey' => false,
            'conditions' => array(
                'SourceDeal.deal_id = Deal.id'
            )
        );
        $options[] = array(
            'table' => 'stages',
            'alias' => 'Stage',
            'type' => 'LEFT',
            'foreignKey' => false,
            'conditions' => array(
                'Stage.id = Deal.stage_id'
            )
        );
        $options[] = array(
            'table' => 'pipeline',
            'alias' => 'Pipeline',
            'type' => 'LEFT',
            'foreignKey' => false,
            'conditions' => array(
                'Pipeline.id = Deal.pipeline_id'
            )
        );
        $result = $this->find('all', array(
            'joins' => $options,
            'conditions' => $conditions,
            'fields' => array('Distinct(Deal.id)', 'Deal.name', 'Deal.status', 'Pipeline.name', 'Stage.name'),
            'order' => 'Deal.name ASC',
        ));
        return $result;
    }

    /**
     * This function is used to get deals in product by product id
     *
     * @access public
     * @return array
     */
    public function getDealsByProduct($productId, $userId, $userGId, $groupId)
    {
        $conditions = array();
        $conditions['ProductDeal.product_id'] = $productId;
        if (!empty($userGId) && $userGId == 2) {
            $conditions['Deal.group_id'] = $groupId;
        } elseif (!empty($userId)) {
            $conditions['UserDeal.user_id'] = $userId;
        }
        $options = array(
            array(
                'table' => 'product_deals',
                'alias' => 'ProductDeal',
                'type' => 'INNER',
                'foreignKey' => false,
                'conditions' => array(
                    'ProductDeal.deal_id = Deal.id'
                )
            ),
            array(
                'table' => 'stages',
                'alias' => 'Stage',
                'type' => 'LEFT',
                'foreignKey' => false,
                'conditions' => array(
                    'Stage.id = Deal.stage_id'
                )
            ),
            array(
                'table' => 'pipeline',
                'alias' => 'Pipeline',
                'type' => 'LEFT',
                'foreignKey' => false,
                'conditions' => array(
                    'Pipeline.id = Deal.pipeline_id'
                )
            ),
            array(
                'table' => 'user_deals',
                'alias' => 'UserDeal',
                'type' => 'INNER',
                'foreignKey' => false,
                'conditions' => array(
                    'UserDeal.deal_id = Deal.id'
                )
            )
        );
        $result = $this->find('all', array(
            'joins' => $options,
            'conditions' => $conditions,
            'fields' => array('Distinct(Deal.id)', 'Deal.name', 'Deal.status', 'Pipeline.name', 'Stage.name'),
            'order' => 'Deal.name ASC',
        ));
        return $result;
    }

    /**
     * This function is used to get first deal for pipeline
     *
     * @access public
     * @return array
     */
    public function getPipelineDeal($pipelineId)
    {
        $result = $this->find('first', array('conditions' => array('Deal.pipeline_id' => $pipelineId, 'Deal.status' => '0'), 'fields' => array('Deal.id')));
        return $result;
    }

    /**
     * This function is used to get first deal for stage
     *
     * @access public
     * @return array
     */
    public function getStageDeal($stageId)
    {
        $result = $this->find('first', array('conditions' => array('Deal.stage_id' => $stageId, 'Deal.status' => '0'), 'fields' => array('Deal.id')));
        return $result;
    }

    /**
     * This function is used to find deals for search box by deal name and user id
     *
     * @access public
     * @return array
     */
    public function getFind($name, $userId)
    {
        $conditions = array();
        $options = array();
        $conditions['Deal.name LIKE'] = '%' . $name . '%';
        if (!empty($userId)) {
            $conditions['UserDeal.user_id'] = $userId;
            $options[] = array(
                'table' => 'user_deals',
                'alias' => 'UserDeal',
                'type' => 'INNER',
                'conditions' => array(
                    'UserDeal.deal_id = Deal.id'
                )
            );
        }

        $result = $this->find('all', array(
            'joins' => $options,
            'conditions' => $conditions,
            'fields' => array('Deal.id', 'Deal.name'),
            'order' => 'Deal.name ASC',
        ));
        return $result;
    }

    /**
     * This function is used to get deal price by deal id
     *
     * @access public
     * @return array
     */
    public function getDealPrice($dealId)
    {
        $result = $this->find('first', array('conditions' => array('Deal.id' => $dealId), 'fields' => array('Deal.price'),));
        return $result;
    }

    /**
     * This function is used to get deal pipeline by deal id
     *
     * @access public
     * @return array
     */
    public function getDealPipeline($dealId)
    {
        $result = $this->find('first', array('conditions' => array('Deal.id' => $dealId), 'fields' => array('Deal.pipeline_id'),));
        return $result;
    }

    /**
     * This function is used to get  all deals id
     *
     * @access public
     * @return array
     */
    public function getAllDealsID()
    {
        $result = $this->find('all', array(
            'fields' => array('Deal.id')
        ));
        return $result;
    }

    /**
     * This function is used to get deals in company by company id
     *
     * @access public
     * @return array
     */
    public function getDealsByCompany($companyId)
    {
        $conditions = array();
        $conditions['Deal.company_id'] = $companyId;
        $options = array(
            array(
                'table' => 'stages',
                'alias' => 'Stage',
                'type' => 'LEFT',
                'foreignKey' => false,
                'conditions' => array(
                    'Stage.id = Deal.stage_id'
                )
            ),
            array(
                'table' => 'pipeline',
                'alias' => 'Pipeline',
                'type' => 'LEFT',
                'foreignKey' => false,
                'conditions' => array(
                    'Pipeline.id = Deal.pipeline_id'
                )
            )
        );
        $result = $this->find('all', array(
            'joins' => $options,
            'conditions' => $conditions,
            'fields' => array('Distinct(Deal.id)', 'Deal.name', 'Deal.status', 'Pipeline.name', 'Stage.name'),
            'order' => 'Deal.name ASC',
        ));
        return $result;
    }

    /**
     * This function is used to get deal by deal id
     *
     * @access public
     * @return array
     */
    public function getDealForView($dealId)
    {
        $options = array(
            array(
                'table' => 'stages',
                'alias' => 'Stage',
                'type' => 'LEFT',
                'foreignKey' => false,
                'conditions' => array(
                    'Stage.id = Deal.stage_id'
                )
            ),
            array(
                'table' => 'pipeline',
                'alias' => 'Pipeline',
                'type' => 'LEFT',
                'foreignKey' => false,
                'conditions' => array(
                    'Pipeline.id = Deal.pipeline_id'
                )
            ),
            array(
                'table' => 'user_groups',
                'alias' => 'UserGroup',
                'type' => 'LEFT',
                'foreignKey' => false,
                'conditions' => array(
                    'UserGroup.id = Deal.group_id'
                )
            )
        );
        $result = $this->find('first', array(
            'joins' => $options,
            'conditions' => array('Deal.id' => $dealId),
            'fields' => array('Deal.*', 'Pipeline.name', 'Stage.name', 'UserGroup.name'),
        ));
        return $result;
    }

    /**
     * This function is used to get deal by group id & deal id
     *
     * @access public
     * @return array
     */
    public function getDealByGroup($groupId, $dealId)
    {
        $result = $this->find('first', array('conditions' => array('Deal.id' => $dealId, 'Deal.group_id' => $groupId)));
        return $result;
    }

    /**
     * This function is used to get deal by group id & deal id
     *
     * @access public
     * @return array
     */
    public function checkDealByCompany($companyId, $dealId)
    {
        $result = $this->find('first', array('conditions' => array('Deal.id' => $dealId, 'Deal.company_id' => $companyId)));
        return $result;
    }
}
