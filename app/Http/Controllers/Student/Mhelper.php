<?php
namespace App\Http\Controllers\Student;

use DateTime;
// use App\Http\Controllers\Sys\helper as sys;



class Mhelper 
{
	# main package
	var $uuid 											= 'Ramsey\Uuid\Uuid';
	var $uuid_parent 								= 'Ramsey\Uuid\Exception\UnsatisfiedDependencyException';
	var $db 												= 'Illuminate\Support\Facades\DB';
	var $input 											= 'Illuminate\Support\Facades\Input';
	var $paginate_manually 					= 'Illuminate\Pagination\LengthAwarePaginator';

	# models
	var $model_student 							= 'App\Http\Models\Student';


	# defined var
	var $module 			= "Student";
	var $table_module = "student";

	public function __construct() 
	{
	}

	/* ============================== CRUD ============================== */
	function listData($page=1, $limit=10, $keyword="")
	{
		// defined var
		$result 		= array();
		$selected		= $this->_selected();
		$skip_data 	= ($page < 1) ? 0 : ($page - 1) * $limit;

		// main process
		$query 	= $this->model_student::select($selected)
															->skip($skip_data)
															->take($limit)
															->get();

		// result 
		if (count($query) > 0) 
		{
			$result 	= json_decode(json_encode($query), TRUE);
		}

		return $result;
	}


	function _selected()
	{
		$result 	= array(
							"student_id", 
							"student_uuid", 
							"student_name", 
							"student_class", 
							"student_address", 
							"student_gender"
		);

		return $result;
	}

	function saveData($request=array())
	{
		$result 	= FALSE;
		if (count($request) > 0) 
		{
			$content['student_uuid']			= $this->uuid::uuid4()->toString();
			$content['student_name']			= isset($request['student_name']) ? $request['student_name'] : "";
			$content['student_class']			= isset($request['student_class']) ? $request['student_class'] : "";
			$content['student_address']		= isset($request['student_address']) ? $request['student_address'] : "";
			$content['student_gender']		= isset($request['student_gender']) ? $request['student_gender'] : "";

			$query 	= $this->model_student::insert($content);
			
			if ($query == 1) 
			{
				$result 	= TRUE;
			}
		}

		return $result;
	}

	function detailData($student_uuid="")
	{
		$result 	= array();
		if ($student_uuid !== "")
		{
			$query 	= $this->model_student::where("student_uuid", $student_uuid)->get();
			
			if (count($query) > 0) 
			{
				$result 	= json_decode(json_encode($query), TRUE);
			}
		}

		return $result;
	}

	function updateData($request=array())
	{
		$result 	= FALSE;
		if (count($request) > 0 && isset($request['student_uuid']))
		{
			$student_uuid 	= $request['student_uuid'];
			$content['student_name']			= isset($request['student_name']) ? $request['student_name'] : "";
			$content['student_class']			= isset($request['student_class']) ? $request['student_class'] : "";
			$content['student_address']		= isset($request['student_address']) ? $request['student_address'] : "";
			$content['student_gender']		= isset($request['student_gender']) ? $request['student_gender'] : "";

			$query 	= $this->model_student::where("student_uuid", $student_uuid)->update($content);
			
			if ($query == 1) 
			{
				$result 	= TRUE;
			}
		}

		return $result;
	}

	function deleteData($student_uuid="")
	{
		$result 	= FALSE;
		if ($student_uuid !== "")
		{
			$query 	= $this->model_student::where("student_uuid", $student_uuid)->delete();

			if ($query == 1) 
			{
				$result 	= TRUE;
			}
		}

		return $result;
	}

	/* ============================== END CRUD ============================== */



}