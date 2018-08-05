<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\Course;

class Enrollment extends Model
{
    //

    protected $table = "enrollment";
    protected $primaryKey = "e_id";

    public function getStudent()
    {
      return User::find($this->user_id);
    }

    public function getCourse()
    {
      return Course::find($this->c_id);
    }
}
