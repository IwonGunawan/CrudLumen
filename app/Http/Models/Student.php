<?php 
namespace App\Http\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model {

	protected $table 				= "student";
	protected $primaryKey 	= "student_id";
	protected $guarded 			= array('student_id');
	public $timestamps 			= false;

}
