<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');
$routes->group('admin',function($routes){
 $routes->get('dashboard','Admin::index', ['filter'=>'auth']);
$routes->get('add_book','Admin::addBook',['filter'=>'auth']);
$routes->post('saveBook','Admin::saveBook' ,['filter'=>'auth']);
$routes->get('edit/{:num}','Admin::edit/$1', ['filter'=>'auth']);
$routes->put('saveEdit/{:num}',"Admin::saveEdit/$1",['filter'=>'auth']);
$routes->delete('delete/{:num}',"Admin::delete/$1",['filter'=>'auth']);

});
$routes->post('Login/login','Login::login');
$routes->get('User/userdashboard','User::index',['filters'=>'auth']);
$routes->get('User/borrow/{:num}','User::borrow/$1', ['filters'=>'auth']);
$routes->add('Login/register',"Login::register",['filters'=>'auth']);
$routes->add('User/logout','User::logout');
$routes->get('User/sentback/{:num}','User::sentback/$1',['filters'=>'auth']);

$routes->resource('task');





/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
