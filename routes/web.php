<?php

use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\Leave\LeaveDAO;
use App\Http\Controllers\Staff\StaffDAO;
use Illuminate\Support\Facades\Auth;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//----------Module Staff routes start----------
require __DIR__.'/module/module-staff.php';
//----------Module Staff routes end----------

//----------Module Leave routes start----------
require __DIR__.'/module/module-leave.php';
//----------Module Leave routes end-----------

//----------Module Leave routes start----------
require __DIR__.'/module/module-uac.php';
//----------Module Leave routes end-----------

//----------Module Notification routes start----------
require __DIR__.'/module/module-notification.php';
//----------Module Notification routes end-----------

//----------Module Admin routes start----------
require __DIR__.'/module/module-admin.php';
//----------Module Admin routes end-----------

Route::get('send', [LeaveDAO::class,"sendEmail"]);
Route::get('calendar-event', [FullCalendarController::class, 'index']);
