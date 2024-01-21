<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Console;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ChatControler extends Controller
{
    public function updateChat(Request $request)
    {
        // Decode the JSON payload from the request
        $requestData = json_decode($request->getContent(), true);

        // Extract log and server IP from the JSON payload
        $message = $requestData['message'] ?? null;
        $sender = $requestData['sender'] ?? null;
        $serverIp = $requestData['serverIp'] ?? null;

        // Validate that log and server IP are present
        if ($message !== null && $serverIp !== null) {
            // Create a new Console entry in the database
            Chat::query()
                ->insert([
                    'message' => $message,
                    'username' => $sender,
                    'server_id' => '1',
                ]);



            // Additional logic if needed...

            return response()->json(['success' => true]);
        } else {
            // Log an error if log or server IP is missing
            Log::error('Invalid JSON payload received');

            return response()->json(['error' => 'Invalid JSON payload'], 400);
        }
    }

    public static function getAllChatMessages($server_id)
    {
        $response = Chat::query()
            ->where("server_id", 1)
            ->get();

        return response()->json($response);

    }
}
