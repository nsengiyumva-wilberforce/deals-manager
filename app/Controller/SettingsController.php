<?php
/**
 * Class for performing all setting related functions
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 */
App::uses('Folder', 'Utility');
App::uses('File', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class SettingsController extends AppController
{

    /**
     * This controller uses following models
     *
     * @var array
     */
    public $uses = array('Setting', 'SettingCompany', 'TicketType', 'IssuanceCategory', 'Backup', 'PipelinePermission', 'Backup', 'SettingEmail', 'PaymentMethod', 'ExpenseCategory', 'ProductCategory', 'UnitCategory', 'BrandCategory');

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
    var $components = array('Auth', 'Cookie', 'Session', 'Paginator', 'RequestHandler', 'Flash');

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
        //set layout
        $this->layout = 'admin';
        //check if admin
        $this->isAdmin();
        //check permissions
        $this->checkPermission('7');
    }

    /**
     * This function is used to display setting page
     *
     * @return array
     */
    public function index()
    {
        //get settings
        $this->request->data = $this->Setting->findById('1');
    }

    /**
     * This function is used to update general settings
     *
     * @return void
     */
    public function general()
    {
        // autorender off for view
        $this->autoRender = false;

        //--------- Post request  -----------
        if ($this->request->is(array('post', 'put'))) {
            $this->Setting->id = 1;
            //check if logo file exist
            if (!empty($this->request->data['Setting']['title_logo']['tmp_name']) && is_uploaded_file($this->request->data['Setting']['title_logo']['tmp_name'])) {
                $logo = $this->request->data['Setting']['title_logo']['name'];
                $fullpath = WWW_ROOT . "img";
                //save logo to server
                move_uploaded_file($this->request->data['Setting']['title_logo']['tmp_name'], $fullpath . DS . $logo);
                $this->request->data['Setting']['title_logo'] = $logo;
            } else {
                unset($this->request->data['Setting']['title_logo']);
            }
            //save settings
            if ($this->Setting->save($this->request->data)) {
                //set session values
                $this->Session->write('Auth.User.timezone', $this->request->data['Setting']['time_zone']);
                $this->Session->write('Auth.User.title', $this->request->data['Setting']['title']);
                $this->Session->write('Auth.User.title_text', $this->request->data['Setting']['title_text']);
                //update logo if changed
                if (isset($this->request->data['Setting']['title_logo'])) {
                    $this->Session->write('Auth.User.title_logo', $this->request->data['Setting']['title_logo']);
                }
                $this->Session->write('Auth.User.currency_symbol', $this->request->data['Setting']['currency_symbol']);
                $this->Session->write('Auth.User.date_format', $this->request->data['Setting']['date_format']);
                $this->Session->write('Auth.User.time_format', $this->request->data['Setting']['time_format']);
                //success message
                $this->Flash->success(__('Request has been completed.'), array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
                //redirect to setting page
                return $this->redirect(array('controller' => 'settings', 'action' => 'index'));
            }
        }
    }

    /**
     * This function is used to update company settings
     *
     * @return void
     */
    public function company()
    {

        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->SettingCompany->id = 1;
            //save company settings
            if ($this->SettingCompany->save($this->request->data)) {
                //set session values
                $this->Session->write('Company.name', $this->request->data['SettingCompany']['name']);
                $this->Flash->success(__('Request has been completed.'), array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
                //redirect to setting page
                return $this->redirect(array('controller' => 'settings', 'action' => 'company'));
            }
        }
        //get company settings
        $settingCompany = $this->SettingCompany->findById('1');

        //set variables to view
        $this->set(compact('settingCompany'));
    }

    /**
     * This function is used to display setting ticket page
     *
     * @return array
     */
    public function ticket()
    {

        //get all ticket types
        $ticketTypes = $this->TicketType->find('all');

        //set variables to view
        $this->set(compact('ticketTypes'));
    }

    /**
     *  This function is used to create backup of database.
     *
     * @return void
     */
    function backup($id = null, $tables = '*')
    {

        //--------- Post request  -----------
        if ($id == '1') {
            //create backup file 
            $return = '';
            $modelName = $this->modelClass;
            $dataSource = $this->TicketType->getDataSource();
            $databaseName = $dataSource->getSchemaName();
            // Do a short header
            $return .= '-- Database: `' . $databaseName . '`' . "\n";
            $return .= '-- Generation time: ' . date('D jS M Y H:i:s') . "\n\n\n";
            if ($tables == '*') {
                $tables = array();
                $result = $this->{$modelName}->query('SHOW TABLES');
                foreach ($result as $resultKey => $resultValue) {
                    $tables[] = current($resultValue['TABLE_NAMES']);
                }
            } else {
                $tables = is_array($tables) ? $tables : explode(',', $tables);
            }

            // Run through all the tables
            foreach ($tables as $table) {
                $tableData = $this->{$modelName}->query('SELECT * FROM ' . $table);

                $return .= 'DROP TABLE IF EXISTS ' . $table . ';';
                $createTableResult = $this->{$modelName}->query('SHOW CREATE TABLE ' . $table);
                $createTableEntry = current(current($createTableResult));
                $return .= "\n\n" . $createTableEntry['Create Table'] . ";\n\n";

                // Output the table data
                foreach ($tableData as $tableDataIndex => $tableDataDetails) {

                    $return .= 'INSERT INTO ' . $table . ' VALUES(';

                    foreach ($tableDataDetails[$table] as $dataKey => $dataValue) {

                        if (is_null($dataValue)) {
                            $escapedDataValue = 'NULL';
                        } else {
                            // Convert the encoding
                            $escapedDataValue = mb_convert_encoding($dataValue, "UTF-8", "ISO-8859-1");

                            // Escape any apostrophes using the datasource of the model.
                            $escapedDataValue = $this->{$modelName}->getDataSource()->value($escapedDataValue);
                        }

                        $tableDataDetails[$table][$dataKey] = $escapedDataValue;
                    }
                    $return .= implode(',', $tableDataDetails[$table]);

                    $return .= ");\n";
                }

                $return .= "\n\n\n";
            }

            // Set the default file name
            $fileName = 'Database-backup-' . date('Y-m-d_H-i-s') . '.sql';
            //path for backup file save
            $path = WWW_ROOT . 'files/backup';
            $file = fopen($path . '/' . $fileName, "w");
            fwrite($file, $return);
            fclose($file);
            $this->request->data['Backup']['file_name'] = $fileName;
            //save file to database
            if ($this->Backup->save($this->request->data)) {
                //success message
                $this->Flash->success(__('Request has been completed.'), array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
                //redirect to setting page
                return $this->redirect(array('controller' => 'settings', 'action' => 'backup'));
            }
        }
        //get all backup files
        $backups = $this->Backup->find('all', array('order' => array('id DESC')));
        //set variables to view
        $this->set(compact('backups'));
    }

    /**
     * This Function used to download backup file
     *
     * @return file
     */
    public function download($fileName = null)
    {
        // autorender off for view
        $this->autoRender = false;
        //path to file
        $path = WWW_ROOT . 'files/backup';
        $filepath = $path . '/' . $fileName;
        if (file_exists($filepath)):
            //return download file
            $this->response->file($filepath, array('download' => true));
        else:
            $this->Flash->success('File not exixts.', array('key' => 'fail', 'params' => array('class' => 'alert alert-danger')));
            //redirect to setting page
            return $this->redirect(array('controller' => 'settings', 'action' => 'backup'));
        endif;
    }

    /**
     * This Function used to delete backup file .
     *
     * @return json
     */
    public function delete()
    {
        // autorender off for view
        $this->autoRender = false;
        $fileId = $this->request->data['Backup']['id'];
        //if file id exist
        if (!empty($fileId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //get backup file
                $file = $this->Backup->getFile($fileId);
                //delete file from database
                $success = $this->Backup->delete(array('id' => $fileId), true);
                if ($success) {
                    //remove file from server
                    $fullpath = WWW_ROOT . "files/backup/" . $file['Backup']['file_name'];
                    if (file_exists($fullpath)):
                        unlink($fullpath);
                    endif;
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $fileId);
                    return json_encode($response);
                } else {
                    //return json failure message
                    $response = array('bug' => 1, 'msg' => 'failure');
                    return json_encode($response);
                }
            }
        }
    }

    /**
     * This Function used to change language of application .
     *
     * @return json
     */
    public function language($lng = null)
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->Setting->id = 1;
            $this->request->data['Setting']['language'] = $lng;
            //save settings
            if ($this->Setting->save($this->request->data)) {
                $this->Session->write('Auth.User.language', $this->request->data['Setting']['language']);
            }
        }
    }

    /**
     * This function is used to display email's setting page
     *
     * @return array
     */
    public function emails()
    {

        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->SettingEmail->id = 1;
            if (empty($this->request->data['SettingEmail']['protocol'])) {
                $this->request->data['SettingEmail']['protocol'] = 0;
            } else {
                // Write email file  
                $this->write_email($this->request->data['SettingEmail']['host'], $this->request->data['SettingEmail']['user'], $this->request->data['SettingEmail']['password'], $this->request->data['SettingEmail']['port']);
            }
            //save settings
            if ($this->SettingEmail->save($this->request->data)) {
                $this->Flash->success(__('Request has been completed.'), array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            }
        }
        //get email settings
        $this->request->data = $this->SettingEmail->findById('1');
        //set variables to view
        $this->set(compact('settingCompany'));
    }

    /**
     * This function is used to set email's notification on setting page
     *
     * @return array
     */
    public function noticeemail()
    {
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            $this->SettingEmail->id = 1;
            if (empty($this->request->data['SettingEmail']['add_user'])) {
                $this->request->data['SettingEmail']['add_user'] = 0;
            }
            if (empty($this->request->data['SettingEmail']['ticket'])) {
                $this->request->data['SettingEmail']['ticket'] = 0;
            }
            if (empty($this->request->data['SettingEmail']['message'])) {
                $this->request->data['SettingEmail']['message'] = 0;
            }
            //save settings
            if ($this->SettingEmail->save($this->request->data)) {
                $this->Flash->success(__('Request has been completed.'), array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            }
        }

        //redirect to setting email page
        return $this->redirect(array('controller' => 'settings', 'action' => 'emails'));
    }

    function write_email($host, $username, $password, $port)
    {

        $newcontent = '<?php  
 /**
 *  Deals manager email config.
 * 
 * @author:   AnkkSoft.com
 * @Copyright: AnkkSoft 2020
 * @Website:   https://www.ankksoft.com
 * @CodeCanyon User:  https://codecanyon.net/user/codeloop 
 *
 * This is email configuration file.
 *
 * Use it to configure email transports of Deals Manager.
 *
 * transport => The name of a supported transport; valid options are as follows:
 *  Mail - Send using PHP mail function
 *  Smtp - Send using SMTP
 *  Debug - Do not send the email, just return the result
 */
                                                     
						
class EmailConfig
{

    public $default = array(
        \'transport\' => \'Mail\',
        \'from\' => \'you@localhost\',
    );
    public $smtp = array(
        \'transport\' => \'Smtp\',
        \'from\' => array(\'site@localhost\' => \'My Site\'),
        \'host\' => \'' . $host . '\',
        \'port\' => \'' . $port . '\',
        \'timeout\' => 30,
        \'username\' => \'' . $username . '\',
        \'password\' => \'' . $password . '\',
        \'client\' => null,
        \'log\' => false,
    );
    

}

/* End of file email.php */
/* Location: ./app/Config/email.php */
							';

        $emailFile = "../Config/email.php";
        $file_contents = file_get_contents($emailFile);
        $fh = fopen($emailFile, "w");
        $file_contents = $newcontent;
        if (fwrite($fh, $file_contents)) {
            return true;
        }
        fclose($fh);
    }

    /**
     * This function is used to update pipeline settings
     *
     * @return void
     */
    public function pipeline()
    {

        //--------- Post request  -----------
        if ($this->request->is(array('post', 'put'))) {
            $this->Setting->id = 1;
            //save settings
            if ($this->Setting->save($this->request->data)) {
                //remove default pipeline permission to users
                $this->PipelinePermission->deleteAll(array('PipelinePermission.pipeline_id' => $this->request->data['Setting']['pipeline']));
                //set session values
                $this->Session->write('Pipeline.id', $this->request->data['Setting']['pipeline']);
                //success message
                $this->Flash->success(__('Request has been completed.'), array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
                //redirect to setting page
                return $this->redirect(array('controller' => 'settings', 'action' => 'pipeline'));
            }
        }
        //get settings
        $this->request->data = $this->Setting->findById('1');
    }

    /**
     * This function is used to display setting payment method page
     *
     * @return array
     */
    public function payment()
    {
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            //save settings
            if ($this->PaymentMethod->save($this->request->data)) {
                //success message
                $this->Flash->success(__('Request has been completed.'), array('key' => 'success', 'params' => array('class' => 'alert alert-info')));
            }
        }
        //get all payment methods
        $methods = $this->PaymentMethod->find('all');

        //set variables to view
        $this->set(compact('methods'));
    }

    /**
     * This function is used to edit payment method
     *
     * @return json
     */
    public function edit_method()
    {
        // autorender off for view
        $this->autoRender = false;
        //--------- Post request  -----------
        if ($this->request->is('post')) {
            //--------- Ajax request  -----------
            if ($this->RequestHandler->isAjax()) {
                $this->layout = 'ajax';
                //common variables
                $this->request->data['PaymentMethod']['id'] = $this->request->data['pk'];
                $this->request->data['PaymentMethod']['name'] = $this->request->data['value'];
                //update source
                $success = $this->PaymentMethod->save($this->request->data);
                if ($success) {
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success');
                    return json_encode($response);
                } else {
                    //return json failure message
                    $response = array('bug' => 1, 'msg' => 'failure');
                    return json_encode($response);
                }
            }
        }
    }

    /**
     * This function is used to delete payment method
     *
     * @return json
     */
    public function delete_method()
    {
        // autorender off for view
        $this->autoRender = false;
        //check permissions
        $methodId = $this->request->data['PaymentMethod']['id'];
        if (!empty($methodId)) {
            //--------- Post/Ajax request  -----------
            if ($this->request->isPost() || $this->RequestHandler->isAjax()) {
                //delete source
                $success = $this->PaymentMethod->delete($methodId, false);
                if ($success) {
                    //return json success message
                    $response = array('bug' => 0, 'msg' => 'success', 'vId' => $methodId);
                    return json_encode($response);
                } else {
                    //return json failure message
                    $response = array('bug' => 1, 'msg' => 'failure');
                    return json_encode($response);
                }
            }
        }
    }

    /**
     * This function is used to display setting expenses category
     *
     * @return array
     */
    public function expenses()
    {

        //get all expenses category
        $expensesC = $this->ExpenseCategory->find('all');

        //set variables to view
        $this->set(compact('expensesC'));
    }

    /**
     * This function is used to add products category
     *
     * @return array
     */

    public function product_categories()
    {
        //get all products category
        $productsC = $this->ProductCategory->find('all');

        //set variables to view
        $this->set(compact('productsC'));
    }

    /**
     * This function is used to add brands category
     *
     * @return array
     */
    public function brand_categories()
    {
        //get all brands category
        $brandsC = $this->BrandCategory->find('all');

        //set variables to view
        $this->set(compact('brandsC'));
    }

    /**
     * This function is used to add units category
     *
     * @return array
     */

    public function unit_categories()
    {
        //get all units category
        $unitsC = $this->UnitCategory->find('all');

        //set variables to view
        $this->set(compact('unitsC'));
    }

        /**
     * This function is used to add units category
     *
     * @return array
     */

     public function issuance_categories()
     {
         //get all issuances category
         $issuancesC = $this->IssuanceCategory->find('all');
 
         //set variables to view
         $this->set(compact('issuancesC'));
     }

}

/* End of file SettingsController.php */
/* Location: ./app/Controller/SettingsController.php */