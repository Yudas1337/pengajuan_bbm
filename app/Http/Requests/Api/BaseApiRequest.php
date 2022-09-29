<?php

namespace App\Http\Requests\Api;

use App\Helpers\ResponseFormatter;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

abstract class BaseApiRequest extends FormRequest
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
     * Get the validation rules that apply to the request.
     *
     * @return array
     */

    abstract public function rules(): array;

    /**
     * Return failed validation
     * @param Validator $validator
     * @return void
     */

    protected function failedValidation(Validator $validator): void
    {
        $errors = $validator->errors()->messages();
        ResponseFormatter::error($errors, "Form validation errors", Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Return failed authorization
     * 
     * @return void
     */

    protected function failedAuthorization(): void
    {
        ResponseFormatter::error(null, "Form validation errors", Response::HTTP_UNAUTHORIZED);
    }
}
