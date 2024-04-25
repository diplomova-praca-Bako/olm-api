<?php

namespace App\GraphQL\Validators;

use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Validation\Validator;

class UpdateDemoInputValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'exists:demos,id'
            ],
            'name' => [
                'required',
                'max:255',
                Rule::unique('demos', 'name')->ignore($this->arg('id'), 'id')
            ],
            'device_type_id' => [
                'required',
                'exists:device_types,id',
            ],
            'software_id' => [
                'required',
                'exists:software,id',
            ],
            'note' => [
                'nullable',
                'string'
            ],
            'demo' => [
                'mimetypes:text/xml,text/plain'
            ]
        ];
    }
}
