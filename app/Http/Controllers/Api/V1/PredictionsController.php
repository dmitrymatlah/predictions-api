<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\CreatePredictionRequest;
use App\Http\Requests\Api\V1\UpdatePredictionStatusRequest;
use App\Models\Predictions;
use App\Repositories\PredictionsRepositoryInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PredictionsController extends Controller
{
    /**
     * @var PredictionsRepositoryInterface
     */
    protected $repository;

    /**
     * PredictionsController constructor.
     * @param PredictionsRepositoryInterface $repository
     */
    public function __construct(PredictionsRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * GET /api/v1/predictions
     * returns application/json collection with all the predictions
     *
     * @return mixed
     */
    public function index()
    {
        return response()->json($this->repository->all());
    }

    /**
     * POST /api/v1/predictions
     * gets application/json content type
     *
     * @param CreatePredictionRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(CreatePredictionRequest $request) :JsonResponse
    {
        $this->repository->create($request->only([
            'event_id', 'market_type', 'prediction']));

        return response()->json(null, Response::HTTP_NO_CONTENT);

    }

    /**
     * PUT /api/v1/predictions/:id/status
     * allows to set status of the given prediction
     *
     * @param UpdatePredictionStatusRequest $request
     * @param Predictions $prediction
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateStatus(UpdatePredictionStatusRequest $request, Predictions $prediction): JsonResponse
    {
        $prediction->update($request->only(['status']));

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
