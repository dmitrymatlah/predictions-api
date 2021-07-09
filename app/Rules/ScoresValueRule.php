<?php

namespace App\Rules;

use App\Models\Predictions;
use Illuminate\Contracts\Validation\Rule;

class ScoresValueRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $scores = explode(':', $value);

        $scores = array_filter($scores, function ($var) {
            return filter_var($var, FILTER_VALIDATE_INT);
        });
        return sizeof($scores) == 2;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return ':attribute must be score value like \'1:2\'';
    }
}
