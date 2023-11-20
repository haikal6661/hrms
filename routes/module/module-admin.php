<?php

use App\Http\Controllers\AdminDAO;
use App\Models\Announcement;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin', 'middleware' => 'auth'], function(){

    Route::group(['middleware' => ['role:Admin|HOD']], function () {

        //all announcement route for admin
        Route::get('/announcement-list', function (Request $request){

            $announcementList = Announcement::paginate(10);

            return view('admin.announcement-list', [
                'announcementList' => $announcementList,
            ]);
        })->name('.announcement-list');

        Route::get('/announcement-create', function (Request $request){

            $user = Auth::user();
            return view('.admin.announcement-create', [
                'user' => $user,
            ]);
        })->name('.announcement-create');

        Route::post('/announcement-submit', function (Request $request){

            $AdminDAO = new AdminDAO();
            return $AdminDAO->storeAnnouncement($request);
        })->name('.announcement-submit');

        Route::post('/ckeditor-upload', function (Request $request){

            $AdminDAO = new AdminDAO();
            return $AdminDAO->ckeditorUpload($request);
        })->name('.ckeditor-upload');

        Route::get('/announcement-edit', function (Request $request){

            $announcementId = $request->id;
            $user = Auth::user();
            $announcement = Announcement::find($announcementId);

            return view('.admin.announcement-edit', [
                'user' => $user,
                'announcement' => $announcement,
            ]);
        })->name('.announcement-edit');

        Route::post('/announcement-update', function (Request $request){

            $AdminDAO = new AdminDAO();
            return $AdminDAO->updateAnnouncement($request);

        })->name('.announcement-update');

        Route::get('/announcement-details', function (Request $request){
            
            $announcement = Announcement::find($request->id);
            
            return response()->json([$announcement]);
        })->name('.announcement-details');

    });

});


?>