<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'leave', 'as' => 'leave', 'middleware' => 'auth'], function(){

    Route::get('/leave-balance', function(Request $request){
        
        return view('leave.leave-balance');

    })->name('.leave-balance');

});

?>