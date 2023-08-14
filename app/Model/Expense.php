<?php

/**
 * class for performing all expense related data abstraction
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class Expense extends AppModel
{

    /**
     * Modal name used in application
     *
     * @var object
     */
    public $name = 'Expense';

    /**
     * Table name in database
     *
     * @var object
     */
    var $useTable = 'expenses';

    /**
     * model validation array
     *
     * @var array
     */
    var $validate = array();

    /**
     * This function is used to get expense by category id
     *
     * @access public
     * @return array
     */
    public function getExpenseById($id)
    {
        $results = $this->find('first', array('conditions' => array('Expense.id' => $id), 'fields' => array('Expense.*')));
        return $results;
    }

    /**
     * This function is used to get expense by category id
     *
     * @access public
     * @return array
     */
    public function getExpense($catId)
    {
        $results = $this->find('first', array('conditions' => array('Expense.category_id' => $catId), 'fields' => array('Expense.*')));
        return $results;
    }

    /**
     * This function is used to get all expenses
     *
     * @access public
     * @return array
     */
    public function getExpenseAll($userGId, $groupId, $userIds)
    {
        $conditions = array();
        if ($userGId == 2) {
            $conditions['OR'] = array(
                'Deal.group_id' => $groupId,
                'Expense.user_id' => $userIds,
            );
        } elseif ($userGId == 3) {
            $conditions['Expense.user_id'] = $userIds;
        }
        $result = $this->find('all', array(
            'joins' => array(
                array(
                    'alias' => 'ExpenseCategory',
                    'table' => 'expenses_category',
                    'type' => 'Left',
                    'conditions' => 'ExpenseCategory.id = Expense.category_id'
                ),
                array(
                    'alias' => 'Deal',
                    'table' => 'deal',
                    'type' => 'Left',
                    'conditions' => 'Deal.id = Expense.deal_id'
                ),
                array(
                    'alias' => 'User',
                    'table' => 'users',
                    'type' => 'Left',
                    'conditions' => 'User.id = Expense.user_id'
                )
            ),
            'conditions' => $conditions,
            'order' => 'Expense.id desc',
            'fields' => array('Expense.*', 'ExpenseCategory.name', 'Deal.id', 'Deal.name', 'User.first_name', 'User.last_name')
        ));
        return $result;
    }

    /**
     * This function is used to get expense by category id
     *
     * @access public
     * @return array
     */
    public function getExp($catId)
    {
        $results = $this->find('first', array('conditions' => array('Expenses.category_id' => $catId), 'fields' => array('Expenses.*')));
        return $results;
    }
}
