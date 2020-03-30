<?php

namespace App\Http\Controllers\Student;

use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Student\Mhelper as student_model;




class StudentController extends Controller
{

  public function __construct()
  {

  }


  /* ============================== CRUD ============================== */
  public function list(Request $request)
  {
    // defined var
    $request      = $request->all();
    $mStudent     = new student_model();
    
    // initialization
    $status     = 500;
    $msg        = "error";
    $data       = Array();
    $page       = isset($request['page']) ? $request['page'] : 1;
    $limit      = isset($request['limit']) ? $request['limit'] : 10;

    // main process
    $process    = $mStudent->listData($page, $limit);
    if (count($process) > 0) 
    {
      $status     = 200;
      $msg        = "success";
      $data       = array(
                  "page_current"    => (int) $page, 
                  "page_limit"      => $limit,
                  "total"           => DB::table("student")->count(),
                  "content"         => $process,   
                  );
    }
    else
    {
      $status     = 200;
      $msg        = "no_data_available";
    }


    $result     = array(
                    "status"        => $status, 
                    "msg"           => $msg, 
                    "data"          => $data,
                );

    return response()->json($result);
  }

  public function save(Request $request)
  {
    // defined var
    $request    = $request->all();
    $mStudent   = new student_model();
    
    // initialization
    $status     = 500;
    $msg        = "error";
    $data       = FALSE;

    // main process
    if (is_array($request) && count($request) > 0 && !isset($request['student_uuid'])) 
    {
      $process  = $mStudent->saveData($request);
      if ($process == TRUE) 
      {
        $status = 200;
        $msg    = "success";
        $data   = TRUE;
      }
      else
      {
        $msg      = "failed_save_data";
        $data     = FALSE;
      }
    }

    $result     = array(
                "status"        => $status, 
                "msg"           => $msg, 
                "data"          => $data,
                );

    return response()->json($result);
  }

  public function detail(Request $request)
  {
    // defined var
    $request    = $request->all();
    $mStudent   = new student_model();
    
    // initialization
    $status     = 500;
    $msg        = "error";
    $data       = array();

    // main process
    if (isset($request['student_uuid']) && $request['student_uuid'] !== "") 
    {
      $student_uuid   = $request['student_uuid'];
      $process        = $mStudent->detailData($student_uuid);

      if (count($process) > 0) 
      {
        $status = 200;
        $msg    = "success";
        $data   = $process;
      }
      else
      {
        $msg      = "failed_detail_data";
        $data     = array();
      }
    }

    $result     = array(
                "status"        => $status, 
                "msg"           => $msg, 
                "data"          => $data,
                );

    return response()->json($result);
  }

  public function update(Request $request)
  {
    // defined var
    $request    = $request->all();
    $mStudent   = new student_model();
    
    // initialization
    $status     = 500;
    $msg        = "error";
    $data       = FALSE;

    // main process
    if (is_array($request) && count($request) > 0 && isset($request['student_uuid'])) 
    {
      $process  = $mStudent->updateData($request);
      if ($process == TRUE) 
      {
        $status = 200;
        $msg    = "success";
        $data   = TRUE;
      }
      else
      {
        $msg      = "failed_update_data";
        $data     = FALSE;
      }
    }

    $result     = array(
                "status"        => $status, 
                "msg"           => $msg, 
                "data"          => $data,
                );

    return response()->json($result);
  }

  public function delete(Request $request)
  {
    // defined var
    $request    = $request->all();
    $mStudent     = new student_model();
    
    // initialization
    $status     = 500;
    $msg        = "error";
    $data       = FALSE;

    if (isset($request['student_uuid'])) 
    {
      $process  = $mStudent->deleteData($request['student_uuid']);
      if ($process == TRUE) 
      {
        $status = 200;
        $msg    = "success";
        $data   = TRUE;
      }
      else
      {
        $msg      = "failed_delete_data";
        $data     = FALSE;
      }
    }

    $result     = array(
                "status"        => $status, 
                "msg"           => $msg, 
                "data"          => $data,
                );

    return response()->json($result);
  }
  /* ============================== CRUD ============================== */


}
