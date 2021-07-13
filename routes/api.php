<?php

use App\Repositories\PredictionsRepositoryEloquent;
use App\Repositories\PredictionsRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\PredictionsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
\Illuminate\Support\Facades\App::bind(PredictionsRepositoryInterface::class, PredictionsRepositoryEloquent::class);

Route::get('predictions', [PredictionsController::class, 'index']);
Route::post('predictions', [PredictionsController::class, 'store']);
Route::put('predictions/{prediction}/status', [PredictionsController::class, 'updateStatus']);
