<?php

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

Route::post('/box/{code}/{password}', function ($code, $password) {
    if ($password != "123456")
        return "false";

    $order = \App\Models\Order::where("order_code", $code)->first();
    if (!$order)
        return "false";

    if ($order->order_status != "payment confirmed")
        return "false";

    $order->order_status = "dropped off";
    $order->save();

    return "true";
});
