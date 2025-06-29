<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;

Route::post('/chatbot', [ChatbotController::class, 'responder'])
    ->middleware('mi.middleware');
if ($request->input('token') !== '12345') {
    return response()->json(['error' => 'No autorizado'], 401);
}