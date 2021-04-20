<?php

namespace App\Http\Requests;

use App\Traits\ApiRespone;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

abstract class ApiRequest extends FormRequest
{
    use ApiRespone;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    abstract public function rules();

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException($this->apiError(
            $validator->errors(),
            Response::HTTP_UNPROCESSABLE_ENTITY
        ));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    protected function failedAuthorization()
    {
        throw new HttpResponseException($this->apiError(
            null,
            Response::HTTP_UNAUTHORIZED
        ));
    }
}