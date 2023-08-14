<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * @author:  Impactive Digital
 * @Copyright: Impactive digital 2023
 * @Website:   https://www.impactoutsourcing.com
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Admins',
 * to use (in this case, /app/View/Admins/index.ctp)...
 */
Router::connect('/', array('controller' => 'admins', 'action' => 'index'));
Router::connect('/login', array('controller' => 'users', 'action' => 'login'));
Router::connect('/forgot_password', array('controller' => 'users', 'action' => 'forgotPassword'));
Router::connect('/profile', array('controller' => 'users', 'action' => 'profile'));
Router::connect('/activity', array('controller' => 'timelines', 'action' => 'index'));
Router::connect('/roles', array('controller' => 'users', 'action' => 'role'));
Router::connect('/staff', array('controller' => 'users', 'action' => 'staff'));
Router::connect('/clients', array('controller' => 'users', 'action' => 'client'));

/**
 * Load all plugin routes.
 * how to customize the loading of plugin routes.
 */
CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
require CAKE . 'Config' . DS . 'routes.php';
