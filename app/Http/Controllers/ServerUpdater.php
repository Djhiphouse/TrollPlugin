<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Http\Request;

class ServerUpdater extends Controller
{
    public static function getAllServerUpdate(){
        $response = Server::query()
            ->get();

        return response()->json($response);
    }
}
