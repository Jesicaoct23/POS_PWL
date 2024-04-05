<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// pengerjaan jobsheet 4 praktikum 2.7 bagian 1
use Illuminate\Database\Eloquent\Relations\HasMany;

// pengerjaan jobsheet 4 praktikum 2.7 bagian 1
class LevelModel extends Model
{
    use HasFactory;
    protected $table = "m_level";
    protected $primaryKey = "level_id";

    protected $fillable = [
        'level_kode', 'level_nama'
    ];

    public function user():HasMany{
        // return $this ->hasMany(User::class);
        return $this ->hasMany(UserModel::class, 'level_id', 'level_id');
    }

}