<?php

use Illuminate\Http\Request;

use App\Project;

use App\Education;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


//API endpoint for portfolio projects and main image
Route::get('portfolio-projects', function() {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure. This will be cleaned up later.
    return Project::with('main_image')->get();
});

Route::get('portfolio-project/{id}', function($id) {
    return Project::find($id)->images;
   // return Project::find($id)->all_other_images;
});


Route::get('education', function() {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure. This will be cleaned up later.
    return Education::with('degrees')->get();
});
