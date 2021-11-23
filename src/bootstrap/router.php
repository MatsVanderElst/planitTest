<?php
// set routes
$routes = array(
  'home' => array(
    'controller' => 'Pages',
    'action' => 'index'
  ),
  'register' => array(
    'controller' => 'Pages',
    'action' => 'register'
  ),
  'login' => array(
    'controller' => 'Pages',
    'action' => 'login'
  ),
  'credit' => array(
    'controller' => 'Pages',
    'action' => 'credit'
  ),
  'store' => array(
    'controller' => 'pages',
    'action' => 'store'
  ),

);

if (empty($_GET['page'])) {
  $_GET['page'] = 'register';
}
if (empty($routes[$_GET['page']])) {
  header('Location: index.php');
  exit();
}

$route = $routes[$_GET['page']];
