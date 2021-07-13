<?php

namespace App\Http\Requests\Api\V1;

use App\Models\Predictions;
use Illuminate\Validation\Rule;

class UpdatePredictionStatusRequest extends PredictionRequestAbstract
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'status' => ['required', Rule::in(Predictions::PREDICTIONS_STATUS_VALUES)]
        ];
    }
}
