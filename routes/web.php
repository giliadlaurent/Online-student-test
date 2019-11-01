<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
 */

Auth::routes();
Route::get('new', function () {
	return view('groups.new');
});

Route::get('instructions', function () {
	return view('instruct');
});

route::get('result', function () {
	$x = \App\Testdetail::paginate(1);
	return view('resut', ['x' => $x]);
});
route::get('post', 'postcontroller@index');
Route::get('/', 'PageController@login');

Route::get('/register', 'PageController@error404');

/*Route::get('/403', 'PageController@error403');
Route::get('/404', 'PageController@error404');
Route::get('/503', 'PageController@error503');*/

Route::get('/home', 'HomeController@index');
Route::get('/stats', 'TestDetails@results');
Route::get('/settings', 'HomeController@settings');
Route::patch('/settings/update/email', 'HomeController@updateEmail');
Route::patch('/settings/update/password', 'HomeController@updatePassword');

/*----------  Routes for test taking  ----------*/

Route::group(['prefix' => 'test'], function () {

	Route::get('/question', 'TestController@showQuestion');
	Route::post('/question', 'TestController@answerQuestion');
	Route::get('/answer', 'TestController@showAnswer');
	Route::get('/{test}', 'TestController@startTest');
	Route::get('/{test}/retry', 'TestController@testRetry');
	Route::get('/{test}/end', 'TestController@testEnd');

});

/*---------- Routes for the moderator section ----------*/

Route::group(['prefix' => 'mod', 'middleware' => 'is.mod'], function () {

	Route::get('/', 'ModeratorController@index');
	Route::get('/tests', 'ModeratorController@showGroups');
	Route::get('/tests/all', 'ModeratorController@showAllTests');
	Route::get('/tests/group/{group}', 'ModeratorController@showGroupTests');
	Route::get('/tests/new', 'AdministrativeTestController@newTest');
	Route::post('/tests/new', 'AdministrativeTestController@addTest');
	Route::get('/tests/{test}', 'AdministrativeTestController@showTest');
	Route::get('/tests/{test}/edit', 'AdministrativeTestController@editTest');
	Route::patch('/tests/{test}/edit', 'AdministrativeTestController@updateTest');
	Route::delete('/tests/{test}/delete', 'AdministrativeTestController@deleteTest');
	Route::get('/tests/{test}/question', 'AdministrativeTestController@newQuestion');
	Route::post('/tests/{test}/question', 'AdministrativeTestController@addQuestion');
	Route::get('/questions/{question}/edit', 'AdministrativeTestController@editQuestion');
	Route::patch('/questions/{question}', 'AdministrativeTestController@updateQuestion');
	Route::get('/questions/{question}/delete', 'AdministrativeTestController@deleteQuestion');

	Route::get('/users', 'ModeratorController@showUsers');
	Route::get('/users/new', 'AdministrativeUserController@newUser');
	Route::post('/users/new', 'AdministrativeUserController@addUser');
	Route::get('/users/{user}', 'AdministrativeUserController@showUser');
	Route::get('/users/{user}/edit', 'AdministrativeUserController@editUser');
	Route::post('/users/{user}/edit', 'AdministrativeUserController@updateUser');
	Route::get('/users/{user}/reset-password', 'AdministrativeUserController@resetUserPassword');
	Route::get('/users/{user}/delete', 'AdministrativeUserController@deleteUser');

	Route::get('/groups/{group}', 'GroupController@showGroup');
	Route::get('/groups/{group}/edit', 'GroupController@editGroup');
	Route::patch('/groups/{group}/edit', 'GroupController@updateGroup');
});

/*----------  Routes for the administrator section  ----------*/

Route::group(['prefix' => 'admin', 'middleware' => 'is.admin'], function () {

	Route::get('/', 'AdminController@index');

	Route::get('/tests', 'AdminController@showGroups');
	Route::get('/tests/all', 'AdminController@showAllTests');
	Route::get('/tests/group/{group}', 'AdminController@showGroupTests');
	Route::get('/tests/new', 'AdministrativeTestController@newTest');
	Route::post('/tests/new', 'AdministrativeTestController@addTest');
	Route::get('/tests/{test}', 'AdministrativeTestController@showTest');
	Route::get('/tests/{test}/edit', 'AdministrativeTestController@editTest');
	Route::patch('/tests/{test}/edit', 'AdministrativeTestController@updateTest');
	Route::delete('/tests/{test}/delete', 'AdministrativeTestController@deleteTest');
	Route::get('/tests/{test}/question', 'AdministrativeTestController@newQuestion');
	Route::post('/tests/{test}/question', 'AdministrativeTestController@addQuestion');
	Route::get('/questions/{question}/edit', 'AdministrativeTestController@editQuestion');
	Route::patch('/questions/{question}', 'AdministrativeTestController@updateQuestion');
	Route::get('/questions/{question}/delete', 'AdministrativeTestController@deleteQuestion');

	Route::get('/users', 'AdminController@showGroups');
	Route::get('/users/all', 'AdminController@showAllUsers');
	Route::get('/users/group/{group}', 'AdminController@showGroupUsers');
	Route::get('/users/new', 'AdministrativeUserController@newUser');
	Route::post('/users/new', 'AdministrativeUserController@addUser');
	Route::get('/users/{user}', 'AdministrativeUserController@showUser');
	Route::get('/users/{user}/edit', 'AdministrativeUserController@editUser');
	Route::post('/users/{user}/edit', 'AdministrativeUserController@updateUser');
	Route::get('/users/{user}/reset-password', 'AdministrativeUserController@resetUserPassword');
	Route::get('/users/{user}/delete', 'AdministrativeUserController@deleteUser');

	Route::get('/groups', 'GroupController@showGroups');
	Route::get('/groups/{group}', 'GroupController@showGroup');

	Route::get('/groups/new', 'GroupController@newGroup');
	Route::post('/groups/new', 'GroupController@newGroup');

	Route::get('/groups/{group}/edit', 'GroupController@editGroup');
	Route::patch('/groups/{group}/edit', 'GroupController@updateGroup');
	Route::get('/groups/{group}/delete', 'GroupController@DeleteGroup');
	Route::get('/groups/{group}/delete', 'GroupController@Delete');

});

// \Event::listen('Illuminate\Database\Events\QueryExecuted', function ($query) {
//     echo "<pre>";
//     var_dump($query->sql);
//     var_dump($query->time);
//     echo "</pre>";
// });
