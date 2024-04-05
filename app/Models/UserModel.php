<?php

namespace App\Models;
use App\Models\LevelModel;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserModel extends Model
{
    use HasFactory;
    
    protected $table = 'm_user';            // mendefinisikan tabel yang digunakan
    protected $primaryKey = 'user_id';     // mendefinisikan primary key tabel yang digunakan
    // protected $fillable = ['level_id','username','nama','password'];

    // protected $fillable = ['level_id','username','nama'];
    protected $fillable = ['level_id','username','nama','password'];

   
    public function level():BelongsTo
    {
        return $this->belongsTo(LevelModel::class, 'level_id', 'level_id');
    }
}