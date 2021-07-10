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

    /**
     * GET /v1/predictions
     * returns application/json collection with all the predictions
     *
     * @return mixed
     */
    public function index()
    {
        return $this->repository->all();
    }

    /**
     * POST /v1/predictions
     * gets application/json content type
     *
     * @param CreatePredictionRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CreatePredictionRequest $request)
    {
        $prediction = $this->repository->create($request->only([
            'event_id', 'market_type', 'prediction']));

        return response()->json(null, Response::HTTP_NO_CONTENT);

    }

    /**
     * PUT /v1/predictions/:id/status
     * allows to set status of the given prediction
     *
     * @param UpdatePredictionStatusRequest $request
     * @param Predictions $prediction
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(UpdatePredictionStatusRequest $request, Predictions $prediction)
    {
        $prediction->update($request->only(['status']));

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
