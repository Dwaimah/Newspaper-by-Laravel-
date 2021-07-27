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
//front
Route::get('/', 'App\Http\Controllers\frontController@index')->name('frontend.index');
Route::get('article/{slug}', 'App\Http\Controllers\frontController@article')->name('frontend.post');
Route::get('category/{cid}', 'App\Http\Controllers\frontController@category')->name('frontend.category');
Route::get('search-content', 'App\Http\Controllers\frontController@searchContent')->name('frontend.searchContent');
Route::get('page/{id}', 'App\Http\Controllers\frontController@page')->name('frontend.page');
Route::get('contact', 'App\Http\Controllers\frontController@contact')->name('frontend.contact');



//category
Route::get('laranews-admin','App\Http\Controllers\adminController@index')->name('admin.index');


Route::get('viewcategory', 'App\Http\Controllers\adminController@viewcategory')->name('admin.viewcategory')->middleware('role:Superadmin');


Route::post('addcategory','App\Http\Controllers\crudController@insertData')->name('admin.addcategory')->middleware('role:Superadmin|Admin');
Route::post('updatecategory','App\Http\Controllers\crudController@updateData')->name('admin.updatecategory')->middleware('role:Superadmin|Admin');
Route::get('editcategory/{id}', 'App\Http\Controllers\adminController@editcategory')->name('admin.editcategory')->middleware('role:Superadmin|Admin');
Route::post('multipledelete', 'App\Http\Controllers\adminController@deletedata')->name('admin.deletecategory')->middleware('role:Superadmin|Admin');

//settings
Route::get('settings', 'App\Http\Controllers\adminController@settings')->name('admin.settings')->middleware('role:Superadmin|Admin');
Route::post('addsetting','App\Http\Controllers\crudController@insertData')->name('admin.addsetting')->middleware('role:Superadmin|Admin');
Route::post('updatesetting','App\Http\Controllers\crudController@updateData')->name('admin.updatesetting')->middleware('role:Superadmin|Admin');

//posts
Route::get('add-post', 'App\Http\Controllers\adminController@addPost')->name('admin.add-post')->middleware('role:Superadmin|Admin|Writer|Validator');
Route::post('addpost', 'App\Http\Controllers\crudController@insertData')->name('admin.addpost');
Route::get('all-posts', 'App\Http\Controllers\adminController@allposts')->name('admin.all-posts');
Route::get('editpost/{id}', 'App\Http\Controllers\adminController@editpost')->name('admin.editpost')->middleware('role:Superadmin|Admin|Writer|Validator|Publisher');
Route::post('updatepost', 'App\Http\Controllers\crudController@updateData')->name('admin.updatepost');
Route::post('multipledeleteposts', 'App\Http\Controllers\adminController@deletedata')->name('admin.deleteposts')->middleware('role:Superadmin|Admin');


//pages
Route::get('add-page', 'App\Http\Controllers\adminController@addPage')->name('admin.add-page')->middleware('role:Superadmin');
Route::post('addpage', 'App\Http\Controllers\crudController@insertData')->name('admin.addpage')->middleware('role:Superadmin');
Route::get('all-pages', 'App\Http\Controllers\adminController@allpages')->name('admin.all-pages')->middleware('role:Superadmin');
Route::get('editpage/{id}', 'App\Http\Controllers\adminController@editpage')->name('admin.editpage')->middleware('role:Superadmin');
Route::post('updatepage', 'App\Http\Controllers\crudController@updateData')->name('admin.updatepage')->middleware('role:Superadmin');
Route::post('multipledeletepages', 'App\Http\Controllers\adminController@deletedata')->name('admin.deletepages')->middleware('role:Superadmin');


//Message

Route::post('sendmessage', 'App\Http\Controllers\crudController@insertData')->name('admin.sendmessage');
Route::get('messages', 'App\Http\Controllers\adminController@messages')->name('admin.messages')->middleware('role:Superadmin|Admin');
Route::post('multipledeletepages', 'App\Http\Controllers\adminController@deletedata')->name('admin.deletemessages')->middleware('role:Superadmin|Admin');

//Advertisements

Route::get('add-adv', 'App\Http\Controllers\adminController@addAdv')->name('admin.add-adv')->middleware('role:Superadmin|Admin');
Route::post('addadv', 'App\Http\Controllers\crudController@insertData')->name('admin.addadv')->middleware('role:Superadmin|Admin');
Route::get('all-adv', 'App\Http\Controllers\adminController@alladvs')->name('admin.all-advs')->middleware('role:Superadmin|Admin');
Route::get('editadv/{id}', 'App\Http\Controllers\adminController@editadv')->name('admin.editadv')->middleware('role:Superadmin|Admin');
Route::post('updateadv', 'App\Http\Controllers\crudController@updateData')->name('admin.updateadv')->middleware('role:Superadmin|Admin');
Route::post('multipledeleteadvs', 'App\Http\Controllers\adminController@deletedata')->name('admin.deleteadvs')->middleware('role:Superadmin|Admin');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'home'])->name('home');
Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/logout', [App\Http\Controllers\HomeController::class, 'logout'])->name('logout');


//Users
Route::get('users','App\Http\Controllers\adminController@users')->name('admin.users')->middleware('role:Superadmin|Admin');
Route::get('edituser/{id}', 'App\Http\Controllers\adminController@edituser')->name('admin.edituser')->middleware('role:Superadmin|Admin');
Route::post('updateuser', 'App\Http\Controllers\crudController@updateData')->name('admin.updateuser')->middleware('role:Superadmin|Admin');
Route::post('multipledeleteusers', 'App\Http\Controllers\adminController@deletedata')->name('admin.deleteusers')->middleware('role:Superadmin|Admin');

//Roles
Route::get('all-roles','App\Http\Controllers\adminController@allroles')->name('admin.roles')->middleware('role:Superadmin|Admin');
Route::get('add-role','App\Http\Controllers\adminController@addrole')->name('add-role')->middleware('role:Superadmin|Admin');
Route::post('addrole', 'App\Http\Controllers\crudController@insertData')->name('addrole')->middleware('role:Superadmin|Admin');


Route::get('editrole/{id}', 'App\Http\Controllers\adminController@editrole')->name('admin.editrole')->middleware('role:Superadmin|Admin');
Route::post('updaterole', 'App\Http\Controllers\crudController@updateData')->name('updaterole')->middleware('role:Superadmin|Admin');
Route::post('multipledeleteroles', 'App\Http\Controllers\adminController@deletedata')->name('deleteroles')->middleware('role:Superadmin|Admin');



