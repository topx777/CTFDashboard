<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted'        => 'debe ser aceptado.',
    'active_url'      => 'no es una URL válida.',
    'after'           => 'debe ser una fecha posterior a :date.',
    'after_or_equal'  => 'debe ser una fecha posterior o igual a :date.',
    'alpha'           => 'sólo debe contener letras.',
    'alpha_dash'      => 'sólo debe contener letras, números y guiones.',
    'alpha_num'       => 'sólo debe contener letras y números.',
    'array'           => 'debe ser un conjunto.',
    'before'          => 'debe ser una fecha anterior a :date.',
    'before_or_equal' => 'debe ser una fecha anterior o igual a :date.',
    'between'         => [
        'numeric' => 'tiene que estar entre :min - :max.',
        'file'    => 'debe pesar entre :min - :max kilobytes.',
        'string'  => 'tiene que tener entre :min - :max caracteres.',
        'array'   => 'tiene que tener entre :min - :max ítems.',
    ],
    'boolean'        => 'El campo debe tener un valor verdadero o falso.',
    'confirmed'      => 'La confirmación no coincide.',
    'date'           => 'no es una fecha válida.',
    'date_equals'    => 'debe ser una fecha igual a :date.',
    'date_format'    => 'no corresponde al formato :format.',
    'different'      => 'y :other deben ser diferentes.',
    'digits'         => 'debe tener :digits dígitos.',
    'digits_between' => 'debe tener entre :min y :max dígitos.',
    'dimensions'     => 'Las dimensiones de la imagen no son válidas.',
    'distinct'       => 'El campo contiene un valor duplicado.',
    'email'          => 'no es un correo válido',
    'ends_with'      => 'El campo debe finalizar con uno de los siguientes valores: :values',
    'exists'         => 'es inválido.',
    'file'           => 'El campo debe ser un archivo.',
    'filled'         => 'El campo es obligatorio.',
    'gt'             => [
        'numeric' => 'El campo debe ser mayor que :value.',
        'file'    => 'El campo debe tener más de :value kilobytes.',
        'string'  => 'El campo debe tener más de :value caracteres.',
        'array'   => 'El campo debe tener más de :value elementos.',
    ],
    'gte' => [
        'numeric' => 'El campo debe ser como mínimo :value.',
        'file'    => 'El campo debe tener como mínimo :value kilobytes.',
        'string'  => 'El campo debe tener como mínimo :value caracteres.',
        'array'   => 'El campo debe tener como mínimo :value elementos.',
    ],
    'image'    => 'debe ser una imagen.',
    'in'       => 'es inválido.',
    'in_array' => 'El campo no existe en :other.',
    'integer'  => 'debe ser un número entero.',
    'ip'       => 'debe ser una dirección IP válida.',
    'ipv4'     => 'debe ser un dirección IPv4 válida',
    'ipv6'     => 'debe ser un dirección IPv6 válida.',
    'json'     => 'El campo debe tener una cadena JSON válida.',
    'lt'       => [
        'numeric' => 'El campo debe ser menor que :value.',
        'file'    => 'El campo debe tener menos de :value kilobytes.',
        'string'  => 'El campo debe tener menos de :value caracteres.',
        'array'   => 'El campo debe tener menos de :value elementos.',
    ],
    'lte' => [
        'numeric' => 'El campo debe ser como máximo :value.',
        'file'    => 'El campo debe tener como máximo :value kilobytes.',
        'string'  => 'El campo debe tener como máximo :value caracteres.',
        'array'   => 'El campo debe tener como máximo :value elementos.',
    ],
    'max' => [
        'numeric' => 'no debe ser mayor a :max.',
        'file'    => 'no debe ser mayor que :max kilobytes.',
        'string'  => 'no debe ser mayor que :max caracteres.',
        'array'   => 'no debe tener más de :max elementos.',
    ],
    'mimes'     => 'debe ser un archivo con formato: :values.',
    'mimetypes' => 'debe ser un archivo con formato: :values.',
    'min'       => [
        'numeric' => 'El tamaño de debe ser de al menos :min.',
        'file'    => 'El tamaño de debe ser de al menos :min kilobytes.',
        'string'  => 'debe contener al menos :min caracteres.',
        'array'   => 'debe tener al menos :min elementos.',
    ],
    'not_in'               => 'es inválido.',
    'not_regex'            => 'El formato del campo no es válido.',
    'numeric'              => 'Debe ser numérico.',
    'password'             => 'La contraseña es incorrecta.',
    'present'              => 'El campo debe estar presente.',
    'regex'                => 'El formato de es inválido.',
    'required'             => 'El campo es obligatorio.',
    'required_if'          => 'El campo es obligatorio cuando :other es :value.',
    'required_unless'      => 'El campo es obligatorio a menos que :other esté en :values.',
    'required_with'        => 'El campo es obligatorio cuando :values está presente.',
    'required_with_all'    => 'El campo es obligatorio cuando :values está presente.',
    'required_without'     => 'El campo es obligatorio cuando :values no está presente.',
    'required_without_all' => 'El campo es obligatorio cuando ninguno de :values estén presentes.',
    'same'                 => 'El campo y :other deben coincidir.',
    'size'                 => [
        'numeric' => 'El tamaño de debe ser :size.',
        'file'    => 'El tamaño de debe ser :size kilobytes.',
        'string'  => 'debe contener :size caracteres.',
        'array'   => 'debe contener :size elementos.',
    ],
    'starts_with' => 'El campo debe comenzar con uno de los siguientes valores: :values',
    'string'      => 'El campo debe ser una cadena de caracteres.',
    'timezone'    => 'El debe ser una zona válida.',
    'unique'      => 'El campo ya ha sido registrado.',
    'uploaded'    => 'Subir ha fallado.',
    'url'         => 'El formato es inválido.',
    'uuid'        => 'El campo debe ser un UUID válido.',

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
        'password' => [
            'min' => 'La debe contener más de :min caracteres',
            'confirmed' => 'La confirmacion de password no coinciden',
        ],
        'email' => [
            'unique' => 'El correo ya ha sido registrado.',
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

    'attributes' => [
        'address'               => 'dirección',
        'age'                   => 'edad',
        'body'                  => 'contenido',
        'city'                  => 'ciudad',
        'content'               => 'contenido',
        'country'               => 'país',
        'date'                  => 'fecha',
        'day'                   => 'día',
        'description'           => 'descripción',
        'email'                 => 'correo electrónico',
        'excerpt'               => 'extracto',
        'first_name'            => 'nombre',
        'gender'                => 'género',
        'hour'                  => 'hora',
        'last_name'             => 'apellido',
        'message'               => 'mensaje',
        'minute'                => 'minuto',
        'mobile'                => 'móvil',
        'month'                 => 'mes',
        'name'                  => 'nombre',
        'password'              => 'contraseña',
        'password_confirmation' => 'confirmación de la contraseña',
        'phone'                 => 'teléfono',
        'price'                 => 'precio',
        'second'                => 'segundo',
        'sex'                   => 'sexo',
        'subject'               => 'asunto',
        'terms'                 => 'términos',
        'time'                  => 'hora',
        'title'                 => 'título',
        'username'              => 'usuario',
        'year'                  => 'año',
    ],
];
