<?php 

$routes->resource('new_admin');
$routes->resource('new_admin/create',"New_Admin::create");
$routes->resource('new_admin/borrowedBooks',"New_Admin::borrowedBooks");

$routes->resource('new_admin/availableBooks',"New_Admin::availableBooks");
$routes->resource('new_admin/show/{:num}',"New_Admin::availableBooks/$1");
$routes->resource('new_admin/update/{:num}',"New_Admin::update/$1");
$routes->resource('new_admin/delete/{:num}',"New_Admin::delete/$1");
$route->resource('newuser');