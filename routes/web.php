<?php

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

//projects index page and root/home route
Route::get('/', 'ProjectsController@index')->name('/');

//create project get/view route
Route::get('/create-project', 'ProjectsController@create')->name('create-project')->middleware('power');

//store newly created project post route
Route::post('/create-project', 'ProjectsController@store')->name('create-project')->middleware('power');


//edit get/view route
Route::get('/edit-project/{id}', 'ProjectsController@edit')->name('edit-project')->middleware('power');

// update project
Route::patch('/project-update/{id}', 'ProjectsController@update')->name('project-update')->middleware('power');


// dropzone multi image/project gallery post route:
Route::post('multi-upload', 'ProjectsController@multiImageUpload')->name('multi-upload')->middleware('power');

//update gallery image caption route:

Route::post('image-update/{id}', 'ProjectsController@updateImageCaption')->name('image-update')->middleware('power');
