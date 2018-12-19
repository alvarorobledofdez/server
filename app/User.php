<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{   

  protected $table = 'users';
  protected $fillable = ['name', 'email', 'password', 'id_rols'];
  public $timestamps = false;

	public function categories()
    {
   		return $this->hasMany('App\Category');
    } 

    public function passwords()
    {
   		return $this->hasMany('App\Password');
    }

    public function roles()
    {
   		return $this->belongsTo('App\Rol');
    } 
}
