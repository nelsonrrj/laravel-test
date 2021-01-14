<?php

namespace App\Http\Requests;

use App\Http\Requests\ApiRequest;

class ApplicationRequest extends ApiRequest
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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'company' => 'sometimes|string',
            'phase_id' => 'required|exists:phases,id'
        ];
    }
}
