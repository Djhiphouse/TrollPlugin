<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Console extends Model
{
    use HasFactory;


    public static function getLogs($serverid){
        return Console::query()
            ->where("server_id", $serverid)
            ->get();
    }
}
