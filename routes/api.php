<?php


use Illuminate\Http\Request;

use App\Personal;

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


//endpoint route, passing user's id
Route::get('personal-with-all/{id}', 'PersonalController@getPersonal');

