<?php

use App\Http\Controllers\Auth\Admin\AdminCreatorManage;
use App\Http\Controllers\Auth\Admin\CustomerManage;
use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\Auth\Admin\RegisterCustumer;
use App\Http\Controllers\Auth\Admin\regiterController;
use App\Http\Controllers\Creator\CreatorManage;
use App\Http\Controllers\Customer\Customer;
use App\Http\Controllers\Forum\ManageBlogController;
use App\Models\Creators;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FullCalenderController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|creator/register/verify.
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
 */
Illuminate\Support\Facades\Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('/welcome');
});

Route::get('/actived/{customer}/{token}',[regiterController::class, 'actived'])->name('actived');
//foget pass word
Route::get('/forgetPass', [LoginController::class, 'forgetPass'])->name('forgetPass');
Route::post('/postForgetPass',[LoginController::class,'postForgetPass'])->name('postForgetPass');
Route::get('/getPass/{user}/{token}',[LoginController::class,'getPass'])->name('getPass');
Route::post('/getPass/{user}/{token}',[LoginController::class,'postGetPass'])->name('postGetPass');

//Admin
Route::group(['prefix' => '/'], function () {
    Route::get('admin/login', [LoginController::class, 'index'])->name('login.bol');
    Route::post('admin/login/store', [LoginController::class, 'checkLogin'])->name('login.check');
    Route::get('admin/', function () {
        return view('/home');
    })->name('admin.home');
    Route::get('search/customer',[CustomerManage::class,'searchTable'])->name('searchTable');
    Route::get('search/project',[CustomerManage::class,'searchProject'])->name('searchProject');
    Route::post('admin/customer/register', [RegisterCustumer::class, 'createClient'])->name('admin.customer.register');
    Route::get('admin/customer', [CustomerManage::class, 'index'])->name('admin.customer');
    Route::get('admin/customer/create', [CustomerManage::class, 'addCustomerScreen'])->name('admin.customer.create');
    Route::get('admin/project/create', [CustomerManage::class, 'addProjectScreen'])->name('admin.project.create');
    Route::post('admin/project/store', [CustomerManage::class, 'addProject'])->name('admin.project.store');
    Route::get('logout', [LoginController::class, 'logout'])->name('admin.users.logout');
    Route::get('/project/{id}', [CustomerManage::class, 'showProject'])->name('admin.project');
    Route::get('/project/{id}/assign/{customerId}', [CustomerManage::class, 'assignScreen'])->name('admin.project.assign');
    Route::post('/project/{project_id}/assign/{creator_id}', [CustomerManage::class, 'assign'])->name('admin.project.assign.store');
    Route::get('/admin/creator', [AdminCreatorManage::class, 'index'])->name('admin.creator');
    Route::get('/admin/creator/projects/{id}', [AdminCreatorManage::class, 'showProject'])->name('admin.creator.project');
    Route::get('/admin/project/{id}/detail', [CustomerManage::class, 'showTotalCreator'])->name('admin.creator.project.detail');
    Route::put('admin/customer/projects/{id}',[CustomerManage::class, 'expiredProject'])->name('admin.expiredProject');

    //New route
    Route::delete('admin/customer/projects/{project_id}/{creator_id}', [CustomerManage::class, 'deleteCreator'])->name('admin.creator.deleteCreator');
});

Route::get('/getEventUser/{id}/creator/{creator_id}', [Customer::class, 'getEventCustomer'])->middleware('auth')->name('getEventCustomer');
//client
Route::group(['prefix' => '/Manager'], function () {
    Route::get('/', [Customer::class, 'ProjectManage'])->name('customer.home');
    Route::get('/project/manage/{id}', [Customer::class, 'projectShow'])->name('customer.project.detail');
    Route::match(['get', 'post'],'/project/search/{id}',[Customer::class, 'search'])->name('customer.project.search');
    
});


//creator
Route::group(['prefix' => '/creator'], function () {
    Route::get('/login', [LoginController::class, 'loginScreenCreator'])->name('creator.login');
    Route::get('/register', [LoginController::class, 'registerScreenCreator'])->name('creator.register');
    Route::post('/register/verify', [regiterController::class, 'check_register'])->name('register.creator');
    Route::post('/check/login', [LoginController::class, 'checkLoginCreator'])->name('login.creator');
    Route::get('/', [CreatorManage::class, 'index'])->name('creator.home');
    Route::post('/profile', [CreatorManage::class, 'editProfile'])->name('creator.profile');
    Route::get('/getevent/{id}/creator/{creator_id}', [CreatorManage::class, 'getEvent'])->name('getevent');
    Route::post('/calendar', [CreatorManage::class, 'store'])->name('calendar.store');
    Route::patch('/calendar/update/{id}', [CreatorManage::class, 'update'])->name('calendar.update');
    Route::delete('/calendar/delete/{id}', [CreatorManage::class, 'destroy'])->name('calendar.destroy');
    Route::post('/search/{id}', [CreatorManage::class, 'search'])->name('search');
});

//forum
Route::group(['prefix' => '/blog'], function () {
    Route::get('/index', [ManageBlogController::class, 'index'])->name('blog');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('verified');
