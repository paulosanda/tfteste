<?php

namespace App\Actions;

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

abstract class BaseAction
{
    /**
     * Get the validation rules that apply to the service.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }

    /**
     * Get the validation messages that apply to the service.
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }

    public function validate($data): bool
    {
        if ($data instanceof Request) {
            $data = $data->all();
        }

        Validator::make($data, $this->rules(), $this->messages())
            ->validate();

        return true;
    }
}
