<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ' :attribute debe ser aceptado.',
    'active_url'           => ' :attribute no es una URL valida.',
    'after'                => ' :attribute debe ser una fecha despues de :date.',
    'after_or_equal'       => ' :attribute debe ser una fecha igual o despues de :date.',
    'alpha'                => ' :attribute solo puede tener letras.',
    'alpha_dash'           => ' :attribute solo puede tener letras, números y guiones.',
    'alpha_num'            => ' :attribute solo puede tener letras y números.',
    'array'                => ' :attribute debe ser un  arreglo.',
    'before'               => ' :attribute debe ser una fecha antes de :date.',
    'before_or_equal'      => ' :attribute debe ser una fecha igual o antes de :date.',
    'between'              => [
        'numeric' => ' :attribute debe ser entre :min y :max.',
        'file'    => ' :attribute debe ser entre :min y :max kilobytes.',
        'string'  => ' :attribute debe ser entre :min y :max caracteres.',
        'array'   => ' :attribute debe tener entre :min y :max items.',
    ],
    'boolean'              => 'El campo :attribute debe ser verdadero o falso.',
    'confirmed'            => ' :attribute confirmación no coincide.',
    'date'                 => ' :attribute no es una fecha valida.',
    'date_format'          => ' :attribute no coincide con el formato :format.',
    'different'            => ' :attribute y :other deben ser diferentes.',
    'digits'               => ' :attribute debe ser :digits digitos.',
    'digits_between'       => ' :attribute debe ser entre :min y :max digitos.',
    'dimensions'           => ' :attribute tiene una dimension de imagne invalida.',
    'distinct'             => ' :attribute tiene un valor duplicado.',
    'email'                => ' :attribute debe ser una derección de Email válida.',
    'exists'               => ' :attribute escojido es invalido.',
    'file'                 => ' :attribute debe ser un archivo.',
    'filled'               => ' :attribute debe ser un valor.',
    'image'                => ' :attribute debe ser una imagen.',
    'in'                   => ' :attribute escogido no es valido.',
    'in_array'             => ' campo :attribute no existe en :other.',
    'integer'              => ' :attribute debe ser un entero.',
    'ip'                   => ' :attribute debe ser una dirección IP válida.',
    'ipv4'                 => ' :attribute debe ser una dirección IPv4 válida.',
    'ipv6'                 => ' :attribute debe ser una dirección IPv6 válida.',
    'json'                 => ' :attributedebe ser una cadena JSON válida.',
    'max'                  => [
        'numeric' => ' :attribute may not be greater than :max.',
        'file'    => ' :attribute may not be greater than :max kilobytes.',
        'string'  => ' :attribute may not be greater than :max characters.',
        'array'   => ' :attribute may not have more than :max items.',
    ],
    'mimes'                => 'The :attribute must be a file of type: :values.',
    'mimetypes'            => 'The :attribute must be a file of type: :values.',
    'min'                  => [
        'numeric' => 'The :attribute must be at least :min.',
        'file'    => 'The :attribute must be at least :min kilobytes.',
        'string'  => 'The :attribute must be at least :min characters.',
        'array'   => 'The :attribute must have at least :min items.',
    ],
    'not_in'               => 'The selected :attribute is invalid.',
    'not_regex'            => 'The :attribute format is invalid.',
    'numeric'              => 'The :attribute must be a number.',
    'present'              => 'The :attribute field must be present.',
    'regex'                => 'The :attribute format is invalid.',
    'required'             => 'The :attribute field is required.',
    'required_if'          => 'The :attribute field is required when :other is :value.',
    'required_unless'      => 'The :attribute field is required unless :other is in :values.',
    'required_with'        => 'The :attribute field is required when :values is present.',
    'required_with_all'    => 'The :attribute field is required when :values is present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => 'The :attribute and :other must match.',
    'size'                 => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'string'               => 'The :attribute must be a string.',
    'timezone'             => 'The :attribute must be a valid zone.',
    'unique'               => 'The :attribute has already been taken.',
    'uploaded'             => 'The :attribute failed to upload.',
    'url'                  => 'The :attribute format is invalid.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
