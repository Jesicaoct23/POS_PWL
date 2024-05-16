<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
// use Illuminate\Contracts\Auth\Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserModel extends Authenticatable implements JWTSubject
{

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
    protected $table = 'm_user';
    protected $primaryKey = 'user_id';

    protected $fillable =
    [
        'level_id',
        'username',
        'nama',
        'password',
        'image' //tambahan
    ];

    public function level(): BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
    // protected function image(): Attribute
    // {
    //     return Attribute::make(
    //         get: fn ($image) => url('/storage/posts/' . $image),
    //     );
    // }
}

// class UserModel extends Model implements Authenticatable
// {
//     use HasFactory;

//     protected $table = 'm_user';
//     protected $primaryKey = 'user_id';
//     protected $fillable = [
//         'level_id',
//         'username',
//         'nama',
//         'password',
//     ];

//     public function level(): BelongsTo
//     {
//         return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
//     }

//     // protected $guarded = [];
//     public function getAuthIdentifierName()
//     {
//         return 'user_id';
//     }

//     public function getAuthIdentifier()
//     {
//         return $this->user_id;
//     }

//     public function getAuthPassword()
//     {
//         return $this->password;
//     }

//     public function getRememberToken()
//     {
//         return $this->remember_token;
//     }

//     public function setRememberToken($value)
//     {
//         $this->remember_token = $value;
//     }

//     public function getRememberTokenName()
//     {
//         return 'remember_token';
//     }
// }