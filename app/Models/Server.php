<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;
    public $timestamps = false;


    public static function getAllServers(){
        return Server::query()
            ->get();
    }

    public static function getIpFromServer($id){
        return Server::query()
            ->where("id", $id)
            ->get()->first()->ip;
    }

    public static function registerServer($name, $ip, $state){
        if (Server::query()->where("name", $name)->where("ip" , $ip)->count() > 0){
            return Server::query()
                ->where("ip",$ip)
                ->update([
                    'online_user' => '0',
                    'state' => $state,
                ]);
        }
        return Server::query()
            ->whereNot("ip",$ip)
            ->insert([
                'name' => $name,
                'ip' => $ip,
                'online_user' => '0',
                'state' => '1',
                'infected_at' => Carbon::now()->setTimezone("Europe/Berlin"),
            ]);
    }


    public static function setOnlineState($ip,$online){
        return Server::query()
            ->where("ip",$ip)
            ->update([
                'online' => $online,
            ]);
    }

    public static function setOnlineUser($ip, $user){
        return Server::query()
            ->where("ip",$ip)
            ->update([
                'online_user' => $user,
            ]);
    }
}
