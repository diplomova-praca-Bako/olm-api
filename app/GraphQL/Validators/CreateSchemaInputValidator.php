<?php

namespace App\GraphQL\Validators;

use App\Models\Schema;
use Illuminate\Validation\Rule;
use Nuwave\Lighthouse\Validation\Validator;

class CreateSchemaInputValidator extends Validator
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
                Rule::unique('schemas', 'name')
            ],
            'type'=> [
                'required',
                Rule::in(Schema::AVAILABLE_TYPES)
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
            'arguments' => [
                'array',
            ],
            'arguments.*.name' => [
                'required',
                'max:255',
            ],
            'arguments.*.label' => [
                'required',
                'max:255',
            ],
            'arguments.*.default_value' => [
                'nullable',
                'max:255',
            ],
            'arguments.*.row' => [
                'integer',
                'required'
            ],
            'arguments.*.order' => [
                'integer',
                'required'
            ],
            'arguments.*.options' => [
                'array',
            ],
            'arguments.*.options.*.name' => [
                'required',
                'max:255',
            ],
            'arguments.*.options.*.value' => [
                'required',
                'max:255',
            ],
            'arguments.*.options.*.output_value' => [
                'required',
                'max:255',
            ],
            'schema' => [
                'required',
                'mimetypes:text/xml,application/octet-stream'
            ],
            'preview' => [
                'mimetypes:image/jpg,image/jpeg,image/png',
            ],
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
            'name.required' => 'The name of the schema is required.',
            'name.max' => 'The name may not be greater than 255 characters.',
            'name.unique' => 'A schema with this name already exists.',
            'type.required' => 'The type of the schema is required.',
            'type.in' => 'The selected type is invalid.',
            'device_type_id.required' => 'The device type ID is required.',
            'device_type_id.exists' => 'The selected device type does not exist.',
            'software_id.required' => 'The software ID is required.',
            'software_id.exists' => 'The selected software does not exist.',
            'arguments.*.name.required' => 'The name of the argument is required.',
            'arguments.*.name.max' => 'The name of the argument may not be greater than 255 characters.',
            'arguments.*.label.required' => 'The label of the argument is required.',
            'arguments.*.label.max' => 'The label of the argument may not be greater than 255 characters.',
            'arguments.*.default_value.max' => 'The default value of the argument may not be greater than 255 characters.',
            'arguments.*.row.required' => 'The row of the argument is required.',
            'arguments.*.row.integer' => 'The row of the argument must be an integer.',
            'arguments.*.order.required' => 'The order of the argument is required.',
            'arguments.*.order.integer' => 'The order of the argument must be an integer.',
            'arguments.*.options.*.name.required' => 'The name of the option is required.',
            'arguments.*.options.*.name.max' => 'The name of the option may not be greater than 255 characters.',
            'arguments.*.options.*.value.required' => 'The value of the option is required.',
            'arguments.*.options.*.value.max' => 'The value of the option may not be greater than 255 characters.',
            'arguments.*.options.*.output_value.required' => 'The output value of the option is required.',
            'arguments.*.options.*.output_value.max' => 'The output value of the option may not be greater than 255 characters.',
            'schema.required' => 'You must provide a schema file.',
            'schema.mimetypes' => 'The schema file must be of type: XML or binary.',
            'preview.mimetypes' => 'The preview image must be of type: JPG, JPEG, or PNG.',
        ];
    }
}
