<?php

use Illuminate\Http\Request;


Route::group([

//  'middleware' => 'api',
// 'namespace' => 'App\Http\Controllers',
 'prefix' => 'auth'

], function ($router) {

  Route::post('login', 'API\AuthenController@login');
  Route::post('register', 'API\AuthenController@register');
  Route::post('logout', 'API\AuthenController@logout');
  Route::post('refresh', 'AuthenController@refresh');
  Route::post('me', 'AuthenController@me');
  Route::get('/me','API\AuthenController@me');
  Route::post('resetpassword' ,'API\UserController@resetpass');
  Route::post('reset-password', 'API\AuthenController@sendPasswordResetLink');

 // handle reset password form process
  Route::post('reset/password', 'API\AuthenController@callResetPassword');
  Route::post('reset-password' ,'API\UserController@resetpass');
});

//users
Route::put('profile', 'API\UserController@updateProfile');
Route::get('users','API\UserController@users');
Route::get('/userconnecté','API\UserController@userconnecté');

//files 
Route::get('/file/{id}','API\FilesController@files');
Route::post('formSubmitResume/{id}','API\FilesController@formSubmitResume');
Route::post('updateresume/{id}','API\FilesController@addfilename');
Route::apiResource('File' ,'API\FilesController');
Route::post('formSubmitdiploma/{id}','API\FilesController@formSubmitDiploma');
Route::post('updatediploma/{id}','API\FilesController@addfilenamediploma');
Route::get('/files','API\FilesController@filesapplication');

//resetpass
Route::post('resetpassword' ,'API\UserController@resetpass');

//categorie
Route::apiResource('categorie','API\CategorieController');
Route::get('/searchcategorie', 'API\CategorieController@searchc');

//companies
Route::apiResource('companie','API\CompanieController');
Route::get('/searchcompanie', 'API\CompanieController@searchc');

//locations
Route::apiResource('location','API\LocationController');
Route::get('/searchlocation', 'API\LocationController@searchc');

//jobs
Route::apiResource('/job','API\JobController');
Route::get('/searchc', 'API\JobController@searchc');
Route::get('/joblocation','API\JobController@getlocations');
Route::get('/jobcategory','API\JobController@getcategories');
Route::get('/jobcompany','API\JobController@getcompanies');
Route::get('/jobcontract','API\JobController@getcontract');
Route::get('/getlocation/{id}','API\JobController@locations');
Route::get('/getcategory/{id}','API\JobController@categories');
Route::get('/getcompany/{id}','API\JobController@companies');
Route::get('/getcontract/{id}','API\JobController@contract');
Route::get('/getjob/{id}','API\JobController@getjob');
Route::post('/status/{id}/{stat}','API\JobController@changestatus');
//categoryjob
Route::apiResource('/categoryjob','API\CategoryJobController');

//formsjob
Route::get('/formsjob/{id}','API\FormsJobController@getforms');
Route::post('/formsfield/{id}','API\FormsJobController@store');

//contract
Route::apiResource('contract','API\ContractController');
Route::get('/searchcontract', 'API\ContractController@searchc');


Route::get('/indexjob','API\HomeController@getjobs');
Route::get('/indexcategory','API\HomeController@getcategories');
Route::get('/indexcompany','API\HomeController@getcompanies');
Route::get('/indexlocation','API\HomeController@getlocations');
Route::get('/indexcontract','API\HomeController@getcontracts');
Route::get('/searchjob', 'API\HomeController@searchjob');

Route::get('/searchwithcontract/{id}','API\HomeController@getjobswithcontract');
Route::get('/searchwithlocation/{id}','API\HomeController@getjobswithlocation');
Route::get('/searchwithcategorie/{id}','API\HomeController@getjobswithcategorie');
Route::get('/getindexjob/{id}','API\HomeController@getjob');

//applications
Route::apiResource('/application','API\ApplicationController');
Route::post('/applicationform/{id}','API\ApplicationController@store');
Route::post('/extrafielsapplications/{id}','API\ApplicationController@storeextrafields');
