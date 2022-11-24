<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminsController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DepartmentsController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\Incomecontroller;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect' ]
    ], function(){
    Route::get('admin/home',[AdminController::class,'index'])->name('adminhome');
    Route::GET('admin-login',[LoginController::class,'showLoginForm'])->name('admin.login');
    Route::post('login-admin',[LoginController::class,'loginAdmin'])->name('login.admin');
    Route::get('logout',[LoginController::class,'logout'])->name('admin.logout');

Route::group(['prefix' => 'admin', 'middleware' => ['auth:admin']], function () {

    Route::resource('countries', CountryController::class);
    Route::get('countries_status',[CountryController::class,'countriesStatus'])->name('countries.status');

    //roles
    Route::resource('roles', RoleController::class);

    //admins
    Route::resource('admins', AdminsController::class);

    //users
    Route::resource('users', UsersController::class);
    Route::get('users_status', [UsersController::class, 'usersStatus'])->name('users.status');

    //faqs
    Route::resource('faqs', FaqController::class);
    Route::get('faqs_status',[FaqController::class,'faqsStatus'])->name('faqs.status');

    //incomes
    Route::resource('incomes', Incomecontroller::class);

   //admin complaint replies
   Route::post('/admin/complaints/reply',[Incomecontroller::class,'complaintReplyAdmin'])->name('admin.complaint.reply');

    //departments
    Route::resource('departments', DepartmentsController::class);
    Route::get('departments_status',[DepartmentsController::class,'departmentsStatus'])->name('departments.status');

    //settings
    Route::resource('settings', SettingController::class)->except(['create', 'store','destroy']);

    });
});
?>