<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/
$router->group(['prefix' => 'api'], function () use ($router) {

		$router->post("student", "Student\StudentController@list");

		$router->post("student/list", "Student\StudentController@list");

		$router->post("student/save", "Student\StudentController@save");

		$router->post("student/detail", "Student\StudentController@detail");

		$router->post("student/update", "Student\StudentController@update");

		$router->post("student/delete", "Student\StudentController@delete");

});