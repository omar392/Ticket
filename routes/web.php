<?php

use App\Http\Controllers\User\ComplaintController;
use App\Http\Controllers\User\FaqsController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::get('/', function () {
    return redirect(route('login'));
});

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect' ]
    ], function(){

Auth::routes(['register'=>false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'auth'], function () {

    //profile User Profile
    Route::resource('profile',ProfileController::class);

    //faqs => Frquently Asked Questions
    Route::resource('frequently-asked-questions',FaqsController::class);

    //complaints => make complaint
    Route::get('/complaints',[ComplaintController::class,'index'])->name('complaint.index');
    Route::post('/complaints/store',[ComplaintController::class,'store'])->name('complaint.store');
    Route::get('/complaints/show/{id}',[ComplaintController::class,'show'])->name('complaint.show');

    //complaint replies
    Route::post('/complaints/reply',[ComplaintController::class,'complaintReply'])->name('complaint.reply');

});


});
