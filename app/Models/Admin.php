<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $guarded=[];




    public function role()
    {

        return $this->belongsTo(Role::class);
  }


    public function roleUser()
    {
        return $this->hasOne(RoleUser::class);

  }

}//end class
