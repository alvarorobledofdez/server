<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	protected $table = 'categories';
 	protected $fillable = ['name'];
 	public $timestamps = false;
 	
    public function passwords()
    {
   		return $this->hasMany('App\Password');
    }

    public function users()
    {
   		return $this->belongsTo('App\User');
    } 
}
