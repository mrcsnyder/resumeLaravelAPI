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


Auth::routes();


Route::get('/', 'HomeController@index')->name('/');

//education index page and root/home route
Route::get('/education', 'EducationController@index')->name('/education')->middleware('power');

//create education get/view route
Route::get('/education/create-education', 'EducationController@create')->name('/education/create-education')->middleware('power');

//store newly created education post route
Route::post('/education/create-education', 'EducationController@store')->name('/education/create-education')->middleware('power');


//edit education get/view route
Route::get('/education/edit-education/{id}', 'EducationController@edit')->name('/education/edit-education')->middleware('power');

// update education
Route::patch('/education/edit-education/{id}', 'EducationController@update')->name('/education/education-update')->middleware('power');


/// create certficate-diploma
///  /education/create-certificate-diploma
Route::post('/education/create-certificate-diploma', 'EducationController@storeCertificateDiploma')->name('/education/create-certificate-diploma')->middleware('power');


// edit certificate/diploma view
Route::get('/education/degree/edit-degree-certificate/{id}', 'EducationController@editDegreeCertificate')->name('/education/degree/edit-degree-certificate/{id}')->middleware('power');


// update certificate/diploma view
Route::patch('/education/degree/edit-degree-certificate/{id}', 'EducationController@updateDegreeCertificate')->name('/education/degree/degree-certificate-update')->middleware('power');


//projects index page and root/home route
Route::get('/projects', 'ProjectsController@index')->name('/projects')->middleware('power');

//create project get/view route
Route::get('/projects/create-project', 'ProjectsController@create')->name('/projects/create-project')->middleware('power');

//store newly created project post route
Route::post('/projects/create-project', 'ProjectsController@store')->name('/projects/create-project')->middleware('power');


//edit get/view route
Route::get('/projects/edit-project/{id}', 'ProjectsController@edit')->name('/projects/edit-project')->middleware('power');

// update project
Route::patch('/projects/project-update/{id}', 'ProjectsController@update')->name('/projects/project-update')->middleware('power');


// dropzone multi image/project gallery post route:
Route::post('/projects/multi-upload', 'ProjectsController@multiImageUpload')->name('/projects/multi-upload')->middleware('power');

//update gallery image caption route:
Route::post('/projects/image-update/{id}', 'ProjectsController@updateImageCaption')->name('/projects/image-update')->middleware('power');
