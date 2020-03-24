<?php

use Illuminate\Http\Request;

use App\Project;

use App\Education;

use App\Award;

use App\Work;

use App\Skill;

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
});

Route::get('education', function() {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure. This will be cleaned up later.
    return Education::with('education_degrees', 'education_certificates')->get();
});

Route::get('education-awards', function() {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure. This will be cleaned up later.

    $awards = Award::all();
    $scholarships = $awards->where('award_type','=','scholarship');
    $honors = $awards->where('award_type','=','honor_roll');

    return compact('scholarships', 'honors');

});

Route::get('work', function() {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure. This will be cleaned up later.
    return Work::orderBy('created_at', 'DESC')->get();

});


Route::get('skills', function() {
    // If the Content-Type and Accept headers are set to 'application/json',
    // this will return a JSON structure. This will be cleaned up later.

    $skills = Skill::all();

    //collect each category for skills, adding ->values ensures that all of these are actually arrays at api endpoint
    $coding = $skills->where('category','=','coding')->values();
    $methods_devops = $skills->where('category','=','methods_devops')->values();
    $software = $skills->where('category','=','software')->values();
    $operating_systems = $skills->where('category','=','operating_systems')->values();
    $business = $skills->where('category','=','business')->values();

    return array('coding' => $coding, 'methods_devops' => $methods_devops ,'software' => $software, 'operating_systems' => $operating_systems, 'business' => $business);
});
