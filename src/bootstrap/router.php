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
  'menu' => array(
    'controller' => 'pages',
    'action' => 'menu'
  ),
  'list' => array(
    'controller' => 'pages',
    'action' => 'list'
  ),
  'cart' => array(
    'controller' => 'pages',
    'action' => 'cart'
  ),
  'fridge' => array(
    'controller' => 'pages',
    'action' => 'fridge'
  ),
  'settings' => array(
    'controller' => 'pages',
    'action' => 'settings'
  ),
  'productDetail' => array(
    'controller' => 'pages',
    'action' => 'productDetail'
  ),
  'editDate' => array(
    'controller' => 'pages',
    'action' => 'editDate'
  )

);

if (empty($_GET['page'])) {
  $_GET['page'] = 'register';
}
if (empty($routes[$_GET['page']])) {
  header('Location: index.php');
  exit();
}

$route = $routes[$_GET['page']];
