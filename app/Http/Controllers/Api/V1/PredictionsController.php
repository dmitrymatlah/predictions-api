<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CreatePredictionRequest;
use App\Http\Requests\Api\V1\UpdatePredictionStatusRequest;
use App\Models\Predictions;
use App\Repositories\PredictionsRepository;
use App\Repositories\PredictionsRepositoryEloquent;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PredictionsController extends Controller
{
    /**
     * @var PredictionsRepository
     */
    protected $repository;

    public function __construct(PredictionsRepositoryEloquent $repository)
    {
        $this->repository = $repository;
    }


    public function index()
    {
        return $this->repository->all();
    }

    public function store(CreatePredictionRequest $request)
    {
        $prediction = $this->repository->create($request->only([
            'event_id', 'market_type', 'prediction']));

        return response()->json(null, Response::HTTP_NO_CONTENT);

    }

    public function updateStatus(UpdatePredictionStatusRequest $request, Predictions $prediction)
    {
        $prediction->update($request->only(['status']));

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
