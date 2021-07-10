<?php

namespace App\Http\Requests\Api\V1;

use App\Models\Predictions;
use App\Rules\ScoresValueRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;

class CreatePredictionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function failedValidation(Validator $validator) {
        //dd($validator);
        Log::notice('Input error', ['input' => $this->input()]);
        throw new HttpResponseException(response()->json($validator->errors(), 400));
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'event_id' => ['required', 'integer'],
            'market_type' => ['required', Rule::in([
                Predictions::MARKET_TYPE_1x2, Predictions::MARKET_TYPE_CORRECT_SCORE
            ])],
            'prediction' => ['required']
        ];
        if ($this->input('market_type') == Predictions::MARKET_TYPE_1x2) {
            $rules['prediction'][] = Rule::in(Predictions::PREDICTIONS_1X2_VALUES);
        }
        if ($this->input('market_type') == Predictions::MARKET_TYPE_CORRECT_SCORE) {
            $rules['prediction'][] = new ScoresValueRule;
        }
        return $rules;
    }
}
