<?php

namespace App\GraphQL\Validators;

use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Validation\Validator;

class CreateDemoInputValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:255',
                Rule::unique('demos', 'name')
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
                'required',
                'mimetypes:text/xml,text/plain'
            ]
        ];
    }
}
