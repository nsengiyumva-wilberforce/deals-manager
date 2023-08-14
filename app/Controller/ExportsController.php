<?php

/**
 * Class for performing all export related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
class ExportsController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('Contact', 'Company', 'Task', 'Deal', 'ProductDeal', 'SourceDeal', 'ContactDeal');

    /**
     * This controller uses following helpers
     *
     * @var array
     */
    var $helpers = array('Html', 'Form', 'Js', 'Paginator', 'Time');

    /**
     * This controller uses following components
     *
     * @var array
     */
    var $components = array('Auth', 'Cookie', 'Session', 'Paginator', 'RequestHandler');

    /**
     * Called before the controller action.  You can use this method to configure and customize components
     * or perform logic that needs to happen before each controller action.
     *
     * @return void
     */
    public function beforeFilter()
    {
        parent::beforeFilter();
        //check if login
        $this->checkLogin();
        //check if admin
        $this->isAdmin();
        //set layout
        $this->layout = 'admin';
    }

    /**
     * This function is used to display export page
     *
     * @return void
     */
    public function index()
    {
        
    }

    /**
     * This function is used to export contacts in csv file 
     *
     * @return void
     */
    public function contacts()
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Post request  -----------
        if ($this->request->is('post')) {
            //file name
            $filename = 'contacts' . "_" . date("Y-m-d_H-i", time()) . ".csv";
            //force csv download
            header('Content-type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');

            //get all contacts
            $contacts = $this->Contact->find('all', array('order' => array('name' => 'ASC')));

            //Create file and add contacts in csv file for download
            $file = fopen('php://output', 'w');
            $data = array('Name', 'Title', 'Email', 'Phone', 'Address', 'Location', 'Company', 'Facebook', 'Twitter', 'LinkedIn', 'Skype');
            fputcsv($file, $data, ',', '"');
            foreach ($contacts as $row) {
                if ($row['Contact']['company_id']) {
                    $comapny = $this->Company->find('first', array('conditions' => array('Company.id' => $row['Contact']['company_id']), 'fields' => array('Company.name')));
                }
                $data = array();
                $data[] = $row['Contact']['name'];
                $data[] = $row['Contact']['title'];
                $data[] = $row['Contact']['email'];
                $data[] = $row['Contact']['phone'];
                $data[] = $row['Contact']['address'];
                $data[] = $row['Contact']['location'];
                $data[] = (isset($comapny['Company']['name'])) ? $comapny['Company']['name'] : '';
                $data[] = $row['Contact']['facebook'];
                $data[] = $row['Contact']['twitter'];
                $data[] = $row['Contact']['linkedIn'];
                $data[] = $row['Contact']['skype'];
                fputcsv($file, $data, ',', '"');
            }
            fclose($file);
        }
    }

    /**
     * This function is used to export Companies in csv file
     *
     * @return void
     */
    public function company()
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Post request  -----------
        if ($this->request->is('post')) {

            //get all companies
            $companies = $this->Company->find('all', array('order' => array('name' => 'ASC')));

            //Create file and add companies in csv file for download
            $filename = 'companies' . "_" . date("Y-m-d_H-i", time()) . ".csv";
            //force csv download
            header('Content-type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');
            $file = fopen('php://output', 'w');
            $data = array('Name', 'Email', 'Phone', 'Address', 'Website');
            fputcsv($file, $data, ',', '"');
            foreach ($companies as $row) {
                $data = array();
                $data[] = $row['Company']['name'];
                $data[] = $row['Company']['email'];
                $data[] = $row['Company']['phone'];
                $data[] = $row['Company']['address'];
                $data[] = $row['Company']['website'];
                fputcsv($file, $data, ',', '"');
            }
            fclose($file);
        }
    }

    /**
     * This function is used to export tasks in csv file
     *
     * @return void
     */
    public function tasks()
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $userId = $this->Auth->user('id');
            //check export task type
            $Tasktype = ($this->checkAdmin()) ? $this->request->data['Export']['type'] : '1';
            $fDate = date("Y-m-d", strtotime($this->request->data['Export']['from_date']));
            $tDate = date('Y-m-d 24:00:00', strtotime($this->request->data['Export']['to_date']));
            //get all tasks by parametes
            $tasks = $this->Task->getExport($userId, $Tasktype, $fDate, $tDate);

            //Create file and add task in csv file for download
            $file_name = 'Task';
            $filename = $file_name . "_" . date("Y-m-d_H-i", time()) . ".csv";

            //force csv download
            header('Content-type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');
            $file = fopen('php://output', 'w');
            $data = array('Task', 'Date', 'Time', 'Priority', 'Deal', 'Pipeline', 'By', 'Status');
            fputcsv($file, $data, ',', '"');

            //add task data to csv file in loop for tasks
            foreach ($tasks as $row) {
                $data = array();
                $data[] = $row['Task']['task'];
                $data[] = $row['Task']['date'];
                $data[] = date('H:i a', strtotime($row['Task']['time']));
                if ($row['Task']['priority'] == '1') {
                    $priority = 'High Priorty';
                } elseif ($row['Task']['priority'] == '2') {
                    $priority = 'Medium Priorty';
                } else {
                    $priority = 'Low Priorty';
                }
                $data[] = $priority;
                $data[] = $row['Deal']['name'];
                $data[] = $row['Pipeline']['name'];
                $data[] = $row['User']['first_name'] . ' ' . $row['User']['last_name'];
                $data[] = ($row['Task']['status'] == 1) ? 'Done' : '';
                fputcsv($file, $data, ',', '"');
            }
            fclose($file);
        }
    }

    /**
     * This function is used to export deals in csv file
     *
     * @return void
     */
    public function deals()
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Post request  -----------
        if ($this->request->is('post')) {

            //check user type admin/user,if user get user id
            $userId = ($this->checkAdmin()) ? '' : $this->Auth->user('id');

            //Common variables
            $pipelinId = $this->request->data['Export']['pipeline_id'];
            $fDate = date("Y-m-d", strtotime($this->request->data['Export']['from_date']));
            $tDate = date('Y-m-d 24:00:00', strtotime($this->request->data['Export']['to_date']));
            $status = $this->request->data['Export']['status'];

            //get deals by parameters
            $deals = $this->Deal->getExport($userId, $pipelinId, $fDate, $tDate, $status);

            //Create file and add deals in csv file for download
            $filename = 'deals' . "_" . date("Y-m-d_H-i", time()) . ".csv";
            //force csv download
            header('Content-type: text/csv');
            header('Content-Disposition: attachment; filename="' . $filename . '";');
            $file = fopen('php://output', 'w');
            $data = array();
            $data = array('Name', 'Price', 'Pipeline', 'Stage', 'Created', 'Updated');
            $maxProductID = 0;
            $maxSourceID = 0;
            $maxContactID = 0;
            $rowt = 1;
            foreach ($deals as $row) {

                //get assing products to deal
                $products = $this->ProductDeal->find('all', array('conditions' => array('ProductDeal.deal_id' => $row['Deal']['id']),
                    'joins' => array(
                        array(
                            'table' => 'products',
                            'alias' => 'Product',
                            'type' => 'INNER',
                            'foreignKey' => false,
                            'conditions' => array(
                                'Product.id = ProductDeal.product_id'
                            ))
                    ),
                    'fields' => array('Product.name'),
                ));
                $allProduct[] = $products;
                $pCount = count($products);
                $maxProductID = max($pCount, $maxProductID);

                //get assing sources to deal
                $sources = $this->SourceDeal->find('all', array('conditions' => array('SourceDeal.deal_id' => $row['Deal']['id']),
                    'joins' => array(
                        array(
                            'table' => 'source',
                            'alias' => 'Source',
                            'type' => 'INNER',
                            'foreignKey' => false,
                            'conditions' => array(
                                'Source.id = SourceDeal.source_id'
                            ))
                    ),
                    'fields' => array('Source.name'),
                ));
                $allSource[] = $sources;
                $sCount = count($sources);
                $maxSourceID = max($sCount, $maxSourceID);

                //get assign contacts to deal
                $contacts = $this->ContactDeal->find('all', array('conditions' => array('ContactDeal.deal_id' => $row['Deal']['id']),
                    'joins' => array(
                        array(
                            'table' => 'contact',
                            'alias' => 'Contact',
                            'type' => 'INNER',
                            'foreignKey' => false,
                            'conditions' => array(
                                'Contact.id = ContactDeal.contact_id'
                            ))
                    ),
                    'fields' => array('Contact.name', 'Contact.email', 'Contact.phone'),
                ));
                $allContact[] = $contacts;
                $cCount = count($contacts);
                $maxContactID = max($cCount, $maxContactID);
            }
            for ($i = 1; $i <= $maxProductID; $i++) {
                $data[] = 'Product Name-' . $i;
            }
            for ($i = 1; $i <= $maxSourceID; $i++) {
                $data[] = 'Source Name-' . $i;
            }
            for ($i = 1; $i <= $maxContactID; $i++) {
                $data[] = 'Contact Name-' . $i;
                $data[] = 'Contact Email-' . $i;
                $data[] = 'Contact Phone-' . $i;
            }

            fputcsv($file, $data, ',', '"');
            $j = 0;

            //create cloum for deal and add contacts,source,products to csv file
            foreach ($deals as $row) {
                $data = array();
                $data[] = $row['Deal']['name'];
                $data[] = ($row['Deal']['price']) ? $this->Auth->user('currency_symbol') . '' . $row['Deal']['price'] : $this->Auth->user('currency_symbol') . '0';
                $data[] = $row['Pipeline']['name'];
                $data[] = $row['Stage']['name'];
                $data[] = date('Y-m-d H:i a', strtotime($row['Deal']['created']));
                $data[] = date('Y-m-d H:i a', strtotime($row['Deal']['modified']));
                for ($i = 0; $i < $maxProductID; $i++) {
                    $data[] = (isset($allProduct[$j][$i]['Product']['name'])) ? $allProduct[$j][$i]['Product']['name'] : '';
                }
                for ($i = 0; $i < $maxSourceID; $i++) {
                    $data[] = (isset($allSource[$j][$i]['Source']['name'])) ? $allSource[$j][$i]['Source']['name'] : '';
                }
                for ($i = 0; $i < $maxContactID; $i++) {
                    $data[] = (isset($allContact[$j][$i]['Contact']['name'])) ? $allContact[$j][$i]['Contact']['name'] : '';
                    $data[] = (isset($allContact[$j][$i]['Contact']['email'])) ? $allContact[$j][$i]['Contact']['email'] : '';
                    $data[] = (isset($allContact[$j][$i]['Contact']['phone'])) ? $allContact[$j][$i]['Contact']['phone'] : '';
                }
                fputcsv($file, $data, ',', '"');
                $j++;
            }
            fclose($file);
        }
    }
}

/* End of file ExportsController.php */
/* Location: ./app/Controller/ExportsController.php */