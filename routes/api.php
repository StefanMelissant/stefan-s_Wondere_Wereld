<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;

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

Route::post('/generate-api-token', function (Request $request) {
    // Hardcoded user data
    $userData = [
        'id' => 1,
        'name' => 'Hardcoded User',
        'email' => 'hardcoded@email.com',
        'password' => bcrypt('hardcoded_password'), // bcrypt gebruiken om het wachtwoord te hashen
    ];


    $user = \App\Models\User::find($userData['id']);

    if (!$user) {

        $user = \App\Models\User::create($userData);
    }

    // Hardcoded token
    $token = $user->createToken('api-token')->plainTextToken;

    return response()->json(['token' => $token]);
});

// New POST route for saving messages
Route::post('/save-message', function (Request $request) {
    // Validate incoming request data
    $request->validate([
        'name' => 'required|string',
        'subject' => 'required|string',
        'message' => 'required|string',
    ]);

    // Insert data into the 'messages' table
    $savedId = DB::table('messages')->insertGetId([
        'name' => 'John Doe',  // Hardcoded name
        'subject' => 'Test Subject',  // Hardcoded subject
        'message' => 'This is a test message.',  // Hardcoded message
    ]);

    return response()->json(['saved_id' => $savedId], 201);
});

// Corrected placement of the get-messages route
Route::get('/get-messages', function () {
    // Retrieve all messages from the 'messages' table
    $messages = DB::table('messages')->get();

    // Return the messages in JSON format
    return response()->json(['messages' => $messages], 200);
});
