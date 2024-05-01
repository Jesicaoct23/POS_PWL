<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable implements JWTSubject

{

public function getJWTIdentifier(){
     return 'user_id';

}

public function getJWTCustomClaims(){
    return [];

}

protected $table = 'm_user';
protected $primaryKey ='user_id';
protected $filiable =['level_id','username','nama','password'];


}