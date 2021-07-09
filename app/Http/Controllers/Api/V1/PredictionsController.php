<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CreatePredictionRequest;
use App\Http\Requests\Api\V1\UpdatePredictionStatusRequest;
use App\Models\Predictions;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class PredictionsController extends Controller
{

    public function index()
    {
        return Predictions::all();
    }

    public function store(CreatePredictionRequest $request)
    {
        if ($prediction = Predictions::create($request->only([
            'event_id', 'market_type', 'prediction']))) {
        }
        {
            return response()->json($prediction, 204);
        }
    }

    public function updateStatus(UpdatePredictionStatusRequest $request, Predictions $prediction)
    {
        $prediction->update($request->only(['status']));

        return response()->json($prediction, 204);
    }
}
