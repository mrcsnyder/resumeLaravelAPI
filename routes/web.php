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


// update certificate/diploma route
Route::patch('/education/degree/edit-degree-certificate/{id}', 'EducationController@updateDegreeCertificate')->name('/education/degree/degree-certificate-update')->middleware('power');


// create award view
Route::get('/education/award/create-award','EducationController@createAward')->name('/education/award/create-award')->middleware('power');

// store created award post route
Route::post('/education/create-award', 'EducationController@storeAward')->name('/education/create-award')->middleware('power');


// edit certificate/diploma view
Route::get('/education/award/edit-award/{id}', 'EducationController@editAward')->name('/education/award/edit-award/{id}')->middleware('power');

//update/patch award route
///education/award/award-update
Route::patch('/education/award/edit-award/{id}', 'EducationController@updateAward')->name('/education/award/award-update')->middleware('power');

//work index page and root/home route
Route::get('/work', 'WorkController@index')->name('/work')->middleware('power');

//work create page
Route::get('/work/create-work', 'WorkController@create')->name('/work/create-work')->middleware('power');


//store newly created work post route
Route::post('/work/create-work', 'WorkController@store')->name('/work/create-work')->middleware('power');


//edit work get/view route
Route::get('/work/edit-work/{id}', 'WorkController@edit')->name('/work/edit-work')->middleware('power');

// update work
Route::patch('/work/edit-work/{id}', 'WorkController@update')->name('/work/work-update')->middleware('power');


//skill create page route
Route::get('/skills', 'SkillsController@index')->name('/skills')->middleware('power');
//createSkill
Route::get('/work/skill/create-skill', 'SkillsController@createSkill')->name('/work/skill/create-skill')->middleware('power');

//store newly created work post route
Route::post('/work/skill/create-skill', 'SkillsController@storeSkill')->name('/work/skill/create-skill')->middleware('power');

//edit skill get/view route
Route::get('/work/skill/edit-skill/{id}', 'SkillsController@editSkill')->name('/work/skill/edit-skill')->middleware('power');

// update skill
Route::patch('/work/skill/edit-skill/{id}', 'SkillsController@updateSkill')->name('/work/skill/skill-update')->middleware('power');




//personal index page and root/home route
Route::get('/personal', 'PersonalController@index')->name('/personal')->middleware('power');

Route::get('/personal/create-personal', 'PersonalController@create')->name('/personal/create-personal')->middleware('power');

//store newly created personal details post route
Route::post('/personal/create-personal', 'PersonalController@store')->name('/personal/create-personal')->middleware('power');

//edit personal get/view route
Route::get('/personal/edit-personal', 'PersonalController@edit')->name('/personal/edit-personal')->middleware('power');

// update personal
Route::patch('/personal/edit-personal/{id}', 'PersonalController@update')->name('/personal/personal-update')->middleware('power');


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


//delete gallery image and its caption

//delete entire project and related images route
Route::delete('/projects/project-image-delete/{id}', 'ProjectsController@destroyImage')->name('/projects/project-image-delete')->middleware('power');

//delete individual project image route
Route::delete('/projects/project-delete/{id}', 'ProjectsController@destroyProject')->name('/projects/project-delete')->middleware('power');



////email contact resume route
Route::post('/resume/send-contact', 'HomeController@sendFromContact')->name('/resume/send-contact');

