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
                'mimetypes:text/xml,text/plain,text/csv'
            ]
        ];
    }
    
    /**
     * Return the custom messages for validation errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The name of the demo is required.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'name.unique' => 'A demo with this name already exists.',
            'device_type_id.required' => 'The device type ID is required.',
            'device_type_id.exists' => 'The selected device type does not exist.',
            'software_id.required' => 'The software ID is required.',
            'software_id.exists' => 'The selected software does not exist.',
            'demo.required' => 'You must provide a demo file.',
            'demo.mimetypes' => 'The demo file must be of type: XML or plain text.',
        ];
    }
}
