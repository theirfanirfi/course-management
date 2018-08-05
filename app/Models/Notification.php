<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Course;

class Notification extends Model
{
    //

    protected $table = "notifications";
    protected $primaryKey = "n_id";

    public function getCourseName()
    {
      return Course::where('c_id','=',$this->c_id)->first()->courseName;
    }
}
