<?php

namespace App\Http\Controllers;

use App\Models\Console;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LogController extends Controller
{
    public function updateLog(Request $request)
    {
        // Decode the JSON payload from the request
        $requestData = json_decode($request->getContent(), true);

        // Extract log and server IP from the JSON payload
        $logMessage = $requestData['log'] ?? null;
        $serverIp = $requestData['serverIp'] ?? null;

        // Validate that log and server IP are present
        if ($logMessage !== null && $serverIp !== null) {
            // Create a new Console entry in the database
            Console::query()
                ->insert([
                    'log' => $logMessage,
                    'server_id' => Server::query()
                        ->where("ip", "1.1.1.1")
                    ->get()->first()->id,
                ]);



            // Additional logic if needed...

            return response()->json(['success' => true]);
        } else {
            // Log an error if log or server IP is missing
            Log::error('Invalid JSON payload received');

            return response()->json(['error' => 'Invalid JSON payload'], 400);
        }
    }
}
