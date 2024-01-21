<?php

namespace App\Http\Controllers;

use App\Models\Console;
use Illuminate\Http\Request;

class LogUpdater extends Controller
{
    public static function getAllLogs($serverid){
        $response = Console::query()
            ->where("server_id", $serverid)
            ->get();

        return response()->json($response);
    }
}
