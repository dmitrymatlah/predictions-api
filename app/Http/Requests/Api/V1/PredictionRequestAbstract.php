<?php

namespace App\Http\Requests\Api\V1;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;


Abstract class PredictionRequestAbstract extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @param Validator $validator
     */
    public function failedValidation(Validator $validator): void
    {
        Log::notice('Input error', ['input' => $this->input()]);
        throw new HttpResponseException(response()->json($validator->errors(), 400));
    }

}
