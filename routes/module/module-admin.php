<?php

use App\Http\Controllers\AdminDAO;
use App\Models\Announcement;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'as' => 'admin', 'middleware' => 'auth'], function(){

    Route::group(['middleware' => ['permission:create announcement']], function () {

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

        Route::delete('/announcement-delete', function (Request $request){
            $AdminDAO = new AdminDAO();
            return $AdminDAO->deleteAnnouncement($request);
        })->name('.announcement-delete');

    });

    Route::get('/announcement-display', function () {
        $announcement = Announcement::where('status_id', 2)->first();
        Log::info($announcement);
        return response()->json(['announcement' => $announcement]);
    })->name('.announcement-display');

});


?>