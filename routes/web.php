<?php

use App\Http\Controllers\Auth\Admin\AdminCreatorManage;
use App\Http\Controllers\Auth\Admin\CustomerManage;
use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\Auth\Admin\RegisterCustumer;
use App\Http\Controllers\Creator\CreatorManage;
use App\Http\Controllers\Customer\Customer;
use App\Models\Creators;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FullCalenderController;
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
Illuminate\Support\Facades\Auth::routes(['verify' => true]);

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
    Route::get('/project/{id}/assign/{customerId}', [CustomerManage::class, 'assignScreen'])->name('admin.project.assign');
    Route::post('/project/{project_id}/assign/{creator_id}', [CustomerManage::class, 'assign'])->name('admin.project.assign.store');
    Route::get('/admin/creator', [AdminCreatorManage::class, 'index'])->name('admin.creator');
    Route::get('/admin/creator/projects/{id}', [AdminCreatorManage::class, 'showProject'])->name('admin.creator.project');
    Route::get('/admin/project/{id}/detail', [CustomerManage::class, 'showTotalCreator'])->name('admin.creator.project.detail');
});

//client
Route::group(['prefix' => '/Manager'], function () {
    Route::get('/', [Customer::class, 'ProjectManage'])->middleware('verified')->name('customer.home');
    Route::get('/project/manage/{id}', [Customer::class, 'projectShow'])->middleware('verified')->name('customer.project.detail');
    Route::match(['get', 'post'],'/project/search/{id}',[Customer::class, 'search'])->middleware('verified')->name('customer.project.search');
});


//creator
Route::group(['prefix' => '/creator'], function () {
    Route::get('/', [CreatorManage::class, 'index'])->middleware('verified')->name('creator.home');
    Route::post('/profile', [CreatorManage::class, 'editProfile'])->middleware('verified')->name('creator.profile');
    Route::get('/getevent/{id}/creator/{creator_id}', [CreatorManage::class, 'getEvent'])->name('getevent');
    Route::post('/calendar', [CreatorManage::class, 'store'])->name('calendar.store');
    Route::patch('/calendar/update/{id}', [CreatorManage::class, 'update'])->name('calendar.update');
    Route::delete('/calendar/delete/{id}', [CreatorManage::class, 'destroy'])->name('calendar.destroy');
    Route::post('/search/{id}', [CreatorManage::class, 'search'])->name('search');
    Route::get('/events/{creatorId}', [CreatorManage::class, 'getEvents'])->name('getEvents');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
