<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SimpleModel extends Model
{
	 public $table = "user";
	 protected $primaryKey = 'user_id';
   /*protected $table = 'user';
   protected $primaryKey='user_id';
   protected $fillable = ['name', 'email', 'password'];*/
}
