<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'staff', 'as' => 'staff', 'middleware' => 'auth'], function(){

    //show staff page

    Route::get('/staff-list', function(Request $request){
        return view('staff.staff-list');
    })->name('.staff-list');
});



?>