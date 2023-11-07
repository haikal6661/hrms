<?php

use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'notification', 'as' => 'notification', 'middleware' => 'auth'], function(){

    // dd('sini');
    Route::get('/notifications', function () {

    $notificationList = Auth::user()->notifications()->paginate(5);

    return view('backend.layouts.notifications', [
        'notificationList' => $notificationList,
        ]);
    })->name('.notifications');


    Route::post('/notification-read', function(Request $request){

    //     $selectedIds = $request->input('selectedIds');
    // dd($selectedIds);
    $Notification = new NotificationController();
        return $Notification->markSelectedAsRead($request);
    })->name('.notification-read');

    Route::get('/mark-as-read/{notification}', [NotificationController::class,"markAsRead"])->name('.mark-as-read');

});

?>