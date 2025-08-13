<?php

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/ping', function () {

    $user = app(User::class);

    $users = $user::all();

    Log::info('Teste de log no Elasticsearch NOVO', ['user' => 'Matheus', 'users' => $users]);

    return response()->json(['message' => 'pong']);
});
