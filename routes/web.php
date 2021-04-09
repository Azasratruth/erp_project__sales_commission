<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/check', 'Controller@index');


Route::middleware(['role:sales_person'])->group(function () {
    // Route::get('/ambassador_home', 'Brand_Ambassador_Controller@index');
});

Route::middleware(['role:sales_manager'])->group(function () {
    Route::get('/add_sale', 'Sale_Controller@index');
    Route::post('/add_sale', 'Sale_Controller@store');
});


Route::middleware(['role:payables_manager'])->group(function () {
    // Route::get('/ambassador_home', 'Brand_Ambassador_Controller@index');
});


Route::middleware(['role:manager'])->group(function () {
    Route::get('/sales_commission', 'Commission_Controller@index');
    Route::post('/sales_commission', 'Commission_Controller@store');
    Route::get('/sales_commission/{id}', 'Commission_Controller@destroy');
    Route::get('/sales_commission_approve/{id}', 'Commission_Controller@approve');
});


Route::middleware(['role:ceo'])->group(function () {
    Route::get('/employee_sales_plan', 'Employee_Sales_Plan_Controller@index');
    Route::get('/employee_sales_plan/{id}/{approve}', 'Employee_Sales_Plan_Controller@store');
});

Route::middleware(['role:admin'])->group(function () {
    
    // Assign Roles
    Route::get('/assign_roles', 'Admin_Controller@assign_roles_index');
    // Route::get('/assign_roles/{user_id}/', 'Admin_Controller@assign_roles_redirect');
    Route::get('/assign_roles/{user_id}/{role?}', 'Admin_Controller@assign_roles_store');

    // Add Products
    Route::get('/add_product', 'Product_Controller@index');
    Route::post('/add_product', 'Product_Controller@store');
});