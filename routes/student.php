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

		$router->get("student/list/{page}/{limit}", "Student\StudentController@list");
		/* return : 
		{
		    "status": 200,
		    "msg": "success",
		    "data": {
		        "page_current": 1,
		        "page_limit": "2",
		        "total": 3,
		        "content": [
		            {
		                "student_id": 1,
		                "student_uuid": "8d18ad34-c3df-4dfb-a7cb-4fa014c2c247",
		                "student_name": "Budi Suherman",
		                "student_class": "XI",
		                "student_address": "Jl. Bambu 1 no 105 Kebon Jeruk JakBar",
		                "student_gender": "M"
		            },
		            {
		                "student_id": 2,
		                "student_uuid": "1b9b3dcf-a51c-4b48-a915-c0a21df5bbc2",
		                "student_name": "Asep Hambali",
		                "student_class": "XI",
		                "student_address": "Jl. Kebon Sirih Jakarta Timur",
		                "student_gender": "M"
		            }
		        ]
		    }
		}
		*/

		$router->post("student/save", "Student\StudentController@save");
		/* return :
		{
		    "status": 200,
		    "msg": "success",
		    "data": {
		        "last_id": 1
		    }
		}
		*/

		$router->get("student/detail/{student_uuid}", "Student\StudentController@detail");
		/* return : 
		{
		    "status": 200,
		    "msg": "success",
		    "data": [
		        {
		            "student_id": 3,
		            "student_uuid": "effef172-60c5-48a4-b804-37d48aa3f1a9",
		            "student_name": "Nina Karlina",
		            "student_class": "XI",
		            "student_gender": "F",
		            "student_address": "Jl. Danmogot no 115 JakBar",
		            "created_date": null,
		            "created_by": null,
		            "modified_date": null,
		            "modified_by": null,
		            "deleted": "0"
		        }
		    ]
		}
		*/

		$router->put("student/update/{student_uuid}", "Student\StudentController@update");
		/*
		return : 
		{
		    "status": 200,
		    "msg": "success",
		    "data": true
		}
		*/


		$router->delete("student/delete/{student_uuid}", "Student\StudentController@delete");
		/*
		return : 
		{
		    "status": 200,
		    "msg": "deleted",
		    "data": true
		}
		*/

});