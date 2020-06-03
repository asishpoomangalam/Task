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

//********************************GET********************************
//LoginController
Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm')->name('admin_login');
Route::get('/login/customer', 'Auth\LoginController@showCustomerLoginForm')->name('customer_login');
Route::get('/login/marketing', 'Auth\LoginController@showMarketingLoginForm')->name('marketing_login');
Route::get('/login/support', 'Auth\LoginController@showSupportLoginForm')->name('support_login');
 
//RegisterController
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm')->name('admin_register');
Route::get('/register/customer', 'Auth\RegisterController@showCustomerRegisterForm')->name('customer_register');
Route::get('/register/marketing', 'Auth\RegisterController@showMarketingRegisterForm')->name('marketing_register');
Route::get('/register/support', 'Auth\RegisterController@showSupportRegisterForm')->name('support_register');
 
//CustomerController
Route::get('/customer', 'CustomerController@customerDashboard')->name('customer_dashboard');

//MarketingController
Route::get('/marketing', 'MarketingController@marketingDashboard')->name('marketing_dashboard');

//SupportController
Route::get('/support', 'SupportController@supportDashboard')->name('support_dashboard');
 
//AdminController
Route::get('/admin', 'AdminController@adminDashboard')->name('admin_dashboard');

Route::get('/products', 'ProductController@index')->name('productlists');

Route::get('/addproducts', 'ProductController@create')->name('addproducts');

Route::get('/editproduct/{id}', 'ProductController@edit')->name('editproduct');

Route::get('/deleteproduct/{id}', 'ProductController@destroy')->name('deleteproduct');

 
//HomeController
Route::get('/home', 'HomeController@index')->name('home');
 
//********************************POST********************************
//LoginController
Route::post('/login/admin', 'Auth\LoginController@adminLogin')->name('admin_login');
Route::post('/login/customer', 'Auth\LoginController@customerLogin')->name('customer_login');
Route::post('/login/marketing', 'Auth\LoginController@marketingLogin')->name('marketing_login');
Route::post('/login/support', 'Auth\LoginController@supportLogin')->name('support_login');
 
//RegisterController
Route::post('/register/admin', 'Auth\RegisterController@createAdmin')->name('admin_register');
Route::post('/register/customer', 'Auth\RegisterController@createCustomer')->name('customer_register');
Route::post('/register/marketing', 'Auth\RegisterController@createMarketing')->name('marketing_register');
Route::post('/register/support', 'Auth\RegisterController@createSupport')->name('support_register');

Route::post('/insertproduct', 'ProductController@store')->name('insertproduct');
Route::post('/updateproduct/{id}', 'ProductController@update')->name('updateproduct');


//For Frontend

Route::redirect('/login', '/login/customer');
	
Route::get('/product', 'frontend\ProductsController@index')->name('product');

Route::middleware(['auth:customer'])->group(function () {

Route::patch('update-cart', 'frontend\ProductsController@update')->middleware('auth.customer');
 
Route::delete('remove-from-cart', 'frontend\ProductsController@remove')->middleware('auth.customer');
 
Route::get('cart', 'frontend\ProductsController@cart');
 
Route::get('add-to-cart/{id}', 'frontend\ProductsController@addToCart')->middleware('auth.customer');

Route::post('/requesthandler', 'frontend\ProductsController@requestHandler')->middleware('auth.customer');

Route::post('/responsehandler', 'frontend\ProductsController@responseHandler')->middleware('auth.customer');

});