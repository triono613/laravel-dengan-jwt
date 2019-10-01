<?php

Route::group(['middleware' => ['api']], function(){

    Route::post('auth/signup','AuthController@signup' );
    Route::post('auth/signin','AuthController@signin' );

    Route::get('/tutorial','TutorialController@index');
    Route::get('/tutorial/{id}','TutorialController@show');


    Route::group(['middleware' => ['jwt.auth']], function () {

        Route::get('/profile', 'UserController@show') ;
        Route::post('/tutorial', 'TutorialController@store') ;

        Route::post('/tutorial_new', 'TutorialController@store') ;

        Route::post('/tutorial_new_again', 'TutorialController@store') ;

    });




});
