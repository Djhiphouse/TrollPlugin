<?php

namespace App\Http\Controllers;

use App\Models\MinecraftUser;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Minecraft_UserControler extends Controller
{


    public static  function checkExistUser($username, $serverid){
        $check = MinecraftUser::query()
            ->where('username', $username)
            ->where('server_id', $serverid)
            ->count();

        if ($check > 0)
            return true;
        else
            return  false;
    }
    public  static function registerUser($username, $permissions,$serverid){
        MinecraftUser::query()
            ->insert([
                'username' => $username,
                'state' => 1,
                'op' => $permissions,
                'last_join' => Carbon::now(),
                'server_id' => $serverid
            ]);
    }

    public  static function registerOnlineUser($username, $permissions,$serverid){
        MinecraftUser::query()
            ->update([
                'username' => $username,
                'state' => 1,
                'op' => $permissions,
                'last_join' => Carbon::now(),
                'server_id' => $serverid
            ]);
    }

    public static function registerOfflineUser($username, $permissions, $serverid)
    {
        MinecraftUser::query()
            ->update([
                'username' => $username,
                'state' => 0,
                'op' => $permissions, // Convert permissions to integer
                'last_leave' => Carbon::now(),
                'server_id' => intval($serverid), // Convert serverid to integer
            ]);
    }

}
