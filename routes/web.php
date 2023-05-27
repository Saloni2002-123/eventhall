<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventHallController;
use App\Http\Controllers\HallController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Hash;

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
    return view('home');
});
//homepage
Route::get('/home', [EventHallController::class, 'index'])->name('home');
Route::get('/aboutus', [EventHallController::class, 'aboutus'])->name('aboutus');

Route::get('/eventhall', [HallController::class, 'viewHalls'])->name('eventhall');
Route::get('/services', [ServiceController::class, 'viewServices'])->name('service');

//admin signup
Route::get('/admreg',[AdminController::class,'register']);
Route::post('/admreg',[AdminController::class,'registered'])->name('admin.reg');

Route::namespace('Auth')->group(function(){
    //admin-login
Route::get('/admlog',[AdminController::class,'login'])->name('adm.log');
Route::post('/admlogCheck',[AdminController::class,"loginAdmin"])->name('admlog.check');
//admin-dash
Route::get('/dashboard', [AdminController::class,"dashboard"]);
//admin-logout
Route::get('/logout', [AdminController::class,"logout"])->name('logout-admin');

});
// //admin login
// Route::get('/admlog',[AdminController::class,'login'])->name('adm.log');
// Route::post('/admlogcheck',[AdminController::class,'loginAdmin'])->name('admlog.check');
// Route::get('/dashboard',[AdminController::class,'dashboard']);

//user
//user register
Route::get('/userreg',[UserController::class,'register']);
Route::post('/userreg',[UserController::class,'registered'])->name('user.reg');
//user login
Route::get('/customer/login',[UserController::class,'login'])->name('user.log');
Route::post('/customer/home',[UserController::class,'loginUser'])->name('userlog.check');
Route::get('/userdashboard',[UserController::class,'dashboardUser']);
//user profile
Route::get('/profile', [UserController::class,'myprofile'])->name('profile');
Route::get('/edituser/{id}',[UserController::class,'edit'])->name('edituser');
Route::post('/edituser',[UserController::class,'update'])->name('updateuser');
//user-logout
Route::get('/logout-customer', [UserController::class,"logoutUser"])->name('logout-user');
//user-view
Route::get('/useraboutus', [UserController::class, 'useraboutus'])->name('useraboutus');
Route::get('/usereventhall', [UserController::class, 'viewHalls'])->name('usereventhall');
Route::get('/userservice', [UserController::class, 'viewServices'])->name('userservice');
//customer
Route::get('/customer',[CustomerController::class,'customer'])->name('customer');
//Route::get('/memberstatus',[UserController::class,'status'])->name('changeStatus');
Route::get('deletemember/{id}',[CustomerController::class,'destroy'])->name('user.delete');
Route::get('editmember/{id}',[CustomerController::class,'edit'])->name('user.edit');
Route::post('editmember',[CustomerController::class,'update'])->name('user.update');

//hall
Route::get('/hall',[HallController::class,'hall'])->name('hall');

//Route::get('/memberstatus',[UserController::class,'status'])->name('changeStatus');
Route::match(['get', 'post'], '/edithall/{id}', [HallController::class, 'edit'])->name('hall.edit');
Route::post('/edithall',[HallController::class,'update'])->name('hall.update');
//service
Route::get('/serve',[ServiceController::class,'service'])->name('serve');
Route::get( '/editservice/{id}', [ServiceController::class, 'edit'])->name('service.edit');
Route::post('/editservice',[ServiceController::class,'update'])->name('service.update');
 //booking
 Route::get('/booking', [BookingController::class, 'showBookingForm'])->name('booking.form');
 Route::post('/bookingstore',[BookingController::class,'store'])->name('booking.store');
 Route::get('/booking/history', [BookingController::class,'booking'])->name('booking.history');