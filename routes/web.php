<?php


Route::get('/', 'MainController@index');

Route::group(['namespace'=>'Gallery', 'middleware'=>'auth'], function () {

    Route::get('/create', 'FlowersController@flowers');

    Route::post('/storeFlowers', 'FlowersController@add');

    Route::get('/flowers', 'FlowersController@index');

    Route::get('/showFlowers/{id}', 'FlowersController@show');

    Route::get('/cars', 'CarsController@index');

    Route::get('/createCars', 'CarsController@create');

    Route::get('/showCars/{id}', 'CarsController@show');

    Route::post('/storeCars', 'CarsController@add');

    Route::get('/sport', 'SportController@index');

    Route::get('/showSport/{id}', 'SportController@show');

    Route::get('/createSport', 'SportController@create');

    Route::post('/storeSport', 'SportController@add');

    Route::get('/animals', 'AnimalsController@animals');

    Route::post('/storeAnimals', 'AnimalsController@add');

    Route::get('/showAnimals/{id}', 'AnimalsController@show');

    Route::get('/createAnimals', 'AnimalsController@create');

    Route::get('/space', 'SpaceController@space');

    Route::post('/storeSpace', 'SpaceController@add');

    Route::get('/showSpace/{id}', 'SpaceController@show');

    Route::get('/createSpace', 'SpaceController@create');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
