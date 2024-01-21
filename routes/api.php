<?php

use App\Http\Controllers\LogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/liveupdate', function (Request $request) {
    return \App\Http\Controllers\ServerUpdater::getAllServerUpdate();
});

Route::post('/registeruser', function (Request $request) {
    $username = strval($request->header('username'));
    $permissions = strval($request->header('permissions'));
    $server_id = strval($request->header('id'));

    if (!\App\Http\Controllers\Minecraft_UserControler::checkExistUser($username,$server_id)){
        \App\Http\Controllers\Minecraft_UserControler::registerUser($username,$permissions,$server_id);
    }

    return "true";
});

Route::post('/onlineuser', function (Request $request) {
    $username = strval($request->header('username'));
    $permissions = boolval($request->header('permissions')); // Assuming permissions is a boolean
    $server_id = intval($request->header('id')); // Assuming server_id is an integer

    if (\App\Http\Controllers\Minecraft_UserControler::checkExistUser($username, $server_id)){
        \App\Http\Controllers\Minecraft_UserControler::registerOnlineUser($username, $permissions, $server_id);
    } else {
        \App\Http\Controllers\Minecraft_UserControler::registerUser($username, $permissions, $server_id);
    }

    return "true";
});


Route::post('/offlineuser', function (Request $request) {
    $username = strval($request->header('username'));
    $permissions = strval($request->header('permissions'));
    $server_id = strval($request->header('id'));

    if (\App\Http\Controllers\Minecraft_UserControler::checkExistUser($username,$server_id)){
        \App\Http\Controllers\Minecraft_UserControler::registerOfflineUser($username,$permissions,$server_id);
    }else{
        \App\Http\Controllers\Minecraft_UserControler::registerUser($username,$permissions,$server_id);
    }

    return "true";
});

Route::post('/updatelog', [LogController::class, 'updateLog']);
Route::get('/chat/{server_id}', [\App\Http\Controllers\ChatControler::class, 'getAllChatMessages']);
Route::post('/chat', [\App\Http\Controllers\ChatControler::class, 'updateChat']);
Route::get('/logs/{server_id}', [\App\Http\Controllers\LogUpdater::class, 'getAllLogs']);


Route::get('/logs', function (Request $request) {
    $server_id = strval($request->header('id'));
    return \App\Http\Controllers\LogUpdater::getAllLogs($server_id);
});

Route::post('/minecraft', function (Request $request) {
    $name = strval($request->header('name'));
    $ip = strval($request->header('ip'));
    $state = strval($request->header('state'));

    return \App\Models\Server::registerServer($name, $ip,$state);
});

Route::post('/online', function (Request $request) {
    $state= strval($request->header('state'));
    $ip = strval($request->header('ip'));

    return \App\Models\Server::setOnlineState($ip, $state);
});

Route::post('/user', function (Request $request) {
    $user = strval($request->header('user'));
    $ip = strval($request->header('ip'));

    return \App\Models\Server::setOnlineUser($ip, $user);
});
