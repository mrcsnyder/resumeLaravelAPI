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

//currently unused home route
Route::get('/home', 'HomeController@index')->name('home');

//create project get/view route
Route::get('/create-project', 'ProjectsController@create')->name('create-project');

//store newly created project post route
Route::post('/create-project', 'ProjectsController@store')->name('create-project');

//projects index page
Route::get('/projects', 'ProjectsController@index')->name('projects');

//edit get/view route
Route::get('/edit-project/{id}', 'ProjectsController@edit')->name('edit-project');

// update project
Route::patch('/project-update/{id}', 'ProjectsController@update')->name('project-update');



// dropzone multi image/project gallery post route:
Route::post('multi-upload', 'ProjectsController@multiImageUpload')->name('multi-upload');

//update gallery image caption route:

Route::post('image-update/{id}', 'ProjectsController@updateImageCaption')->name('image-update');
