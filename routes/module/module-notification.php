<?php

use App\Http\Controllers\NotificationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'notification', 'as' => 'notification', 'middleware' => 'auth'], function(){

    Route::post('/notification-read', function(Request $request){

    //     $selectedIds = $request->input('selectedIds');
    // dd($selectedIds);
    $Notification = new NotificationController();
        return $Notification->markSelectedAsRead($request);
    })->name('.notification-read');

    Route::get('/mark-as-read/{notification}', [NotificationController::class,"markAsRead"])->name('.mark-as-read');

});

?>