<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinecraftUser extends Model
{
    use HasFactory;

public $timestamps = false;
    public  static function getAllUsers($serverid){
        return MinecraftUser::query()
            ->where("server_id", $serverid)
            ->get();
    }
}
