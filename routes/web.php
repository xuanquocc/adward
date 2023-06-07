<?php

use App\Http\Controllers\Auth\Admin\CustomerManage;
use App\Http\Controllers\Auth\Admin\LoginController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\Admin\RegisterCustumer;
use App\Http\Controllers\Creator\CreatorManage;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */
Auth::routes(['verify' => true]); 

Route::get('/', function () {
    return view('/welcome');
});
//Admin
Route::group(['prefix' => '/'], function () {
    Route::get('admin/login', [LoginController::class, 'index'])->name('login.bol');
    Route::post('admin/login/store', [LoginController::class, 'checkLogin'])->name('login.check');
    Route::get('admin/', function () {
        return view('/home');
    })->middleware('verified')->name('admin.home');
    Route::post('admin/customer/register', [RegisterCustumer::class, 'createClient'])->name('admin.customer.register');
    Route::get('admin/custumer', [CustomerManage::class, 'index'])->name('admin.customer');
    Route::get('admin/custumer/create', [CustomerManage::class, 'addCustomerScreen'])->name('admin.customer.create');
    Route::get('admin/project/create', [CustomerManage::class, 'addProjectScreen'])->name('admin.project.create');
    Route::post('admin/project/store', [CustomerManage::class, 'addProject'])->name('admin.project.store');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.users.logout');
    Route::get('/project/{id}', [CustomerManage::class, 'showProject'])->name('admin.project');
    Route::get('/project/{id}/assign', [CustomerManage::class, 'assignScreen'])->name('admin.project.assign');
});

//client
Route::group(['prefix' => '/'], function () {
    Route::get('customer/', function () {
        return view('customer.index');
    })->middleware('verified')->name('customer.home');
});

//creator
Route::group(['prefix' => '/creator'], function () {
    Route::get('/', [CreatorManage::class, 'index'])->middleware('verified')->name('creator.home');
    Route::post('/profile', [CreatorManage::class, 'editProfile'])->middleware('verified')->name('creator.profile');

});

// Route::get('/email/verify', function () {
//     return view('auth.verify-email');
// })->middleware('auth')->name('verification.notice');
 
// Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//     $request->fulfill();
 
//     return redirect('/home');
// })->middleware(['auth', 'signed'])->name('verification.verify');

// Route::post('/email/verification-notification', function (Request $request)  {
//     $request->user()->sendEmailVerificationNotification();
 
//     return back()->with('message', 'Verification link sent!');
// })->middleware(['auth', 'throttle:6,1'])->name('verification.send');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');        
