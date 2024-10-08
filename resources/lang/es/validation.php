<?php

return [

    'accepted' => 'El :attribute debe ser aceptado.',
    'active_url' => 'El :attribute no es una URL válida.',
    'after' => 'El :attribute debe ser una fecha posterior a :date.',
    'after_or_equal' => 'El :attribute debe ser una fecha posterior o igual a :date.',
    'alpha' => 'El :attribute solo puede contener letras.',
    'alpha_dash' => 'El :attribute solo puede contener letras, números, guiones y guiones bajos.',
    'alpha_num' => 'El :attribute solo puede contener letras y números.',
    'array' => 'El :attribute debe ser un conjunto.',
    'before' => 'El :attribute debe ser una fecha anterior a :date.',
    'before_or_equal' => 'El :attribute debe ser una fecha anterior o igual a :date.',
    'between' => [
        'numeric' => 'El :attribute tiene que estar entre :min - :max.',
        'file' => 'El :attribute debe pesar entre :min - :max kilobytes.',
        'string' => 'El :attribute tiene que tener entre :min - :max caracteres.',
        'array' => 'El :attribute tiene que tener entre :min - :max elementos.',
    ],
    'boolean' => 'El campo :attribute debe tener un valor verdadero o falso.',
    'confirmed' => 'La confirmación de :attribute no coincide.',
    'date' => 'El :attribute no es una fecha válida.',
    'date_equals' => 'El :attribute debe ser una fecha igual a :date.',
    'date_format' => 'El :attribute no corresponde al formato :format.',
    'different' => 'El :attribute y :other deben ser diferentes.',
    'digits' => 'El :attribute debe tener :digits dígitos.',
    'digits_between' => ':attribute debe tener entre :min y :max dígitos.',
    'dimensions' => 'El :attribute tiene dimensiones de imagen inválidas.',
    'distinct' => 'El campo :attribute tiene un valor duplicado.',
    'email' => 'El :attribute debe ser una dirección de correo válida.',
    'exists' => 'El :attribute seleccionado es inválido.',
    'file' => 'El :attribute debe ser un archivo.',
    'filled' => 'El campo :attribute debe tener un valor.',
    'gt' => [
        'numeric' => 'El :attribute debe ser mayor que :value.',
        'file' => 'El :attribute debe pesar más de :value kilobytes.',
        'string' => 'El :attribute debe tener más de :value caracteres.',
        'array' => 'El :attribute debe tener más de :value elementos.',
    ],
    'gte' => [
        'numeric' => 'El :attribute debe ser como mínimo :value.',
        'file' => 'El :attribute debe pesar como mínimo :value kilobytes.',
        'string' => 'El :attribute debe tener como mínimo :value caracteres.',
        'array' => 'El :attribute debe tener como mínimo :value elementos.',
    ],
    'image' => 'El :attribute debe ser una imagen.',
    'in' => 'El :attribute es inválido.',
    'in_array' => 'El campo :attribute no existe en :other.',
    'integer' => 'El :attribute debe ser un número entero.',
    'ip' => 'El :attribute debe ser una dirección IP válida.',
    'ipv4' => 'El :attribute debe ser una dirección IPv4 válida.',
    'ipv6' => 'El :attribute debe ser una dirección IPv6 válida.',
    'json' => 'El :attribute debe ser una cadena JSON válida.',
    'lt' => [
        'numeric' => 'El :attribute debe ser menor que :value.',
        'file' => 'El :attribute debe pesar menos de :value kilobytes.',
        'string' => 'El :attribute debe tener menos de :value caracteres.',
        'array' => 'El :attribute debe tener menos de :value elementos.',
    ],
    'lte' => [
        'numeric' => 'El :attribute debe ser como máximo :value.',
        'file' => 'El :attribute debe pesar como máximo :value kilobytes.',
        'string' => 'El :attribute debe tener como máximo :value caracteres.',
        'array' => 'El :attribute debe tener como máximo :value elementos.',
    ],
    'max' => [
        'numeric' => 'El :attribute no debe ser mayor a :max.',
        'file' => 'El :attribute no debe ser mayor que :max kilobytes.',
        'string' => 'El :attribute no debe ser mayor que :max caracteres.',
        'array' => 'El :attribute no debe tener más de :max elementos.',
    ],
    'mimes' => 'El :attribute debe ser un archivo con formato: :values.',
    'mimetypes' => 'El :attribute debe ser un archivo con formato: :values.',
    'min' => [
        'numeric' => 'El tamaño de :attribute debe ser de al menos :min.',
        'file' => 'El tamaño de :attribute debe ser de al menos :min kilobytes.',
        'string' => 'La :attribute debe contener al menos :min caracteres.',
        'array' => 'El :attribute debe tener al menos :min elementos.',
    ],
    'not_in' => 'El :attribute es inválido.',
    'not_regex' => 'El formato de :attribute es inválido.',
    'numeric' => 'El :attribute debe ser numérico.',
    'password' => 'La contraseña es incorrecta.',
    'present' => 'El campo :attribute debe estar presente.',
    'regex' => 'El formato de :attribute es inválido.',
    'required' => 'El campo :attribute es obligatorio.',
    'required_if' => 'El campo :attribute es obligatorio cuando :other es :value.',
    'required_unless' => 'El campo :attribute es obligatorio a menos que :other esté en :values.',
    'required_with' => 'El campo :attribute es obligatorio cuando :values está presente.',
    'required_with_all' => 'El campo :attribute es obligatorio cuando :values están presentes.',
    'required_without' => 'El campo :attribute es obligatorio cuando :values no está presente.',
    'required_without_all' => 'El campo :attribute es obligatorio cuando ninguno de :values están presentes.',
    'same' => 'La :other no coincide.',
    'size' => [
        'numeric' => 'El tamaño de :attribute debe ser :size.',
        'file' => 'El tamaño de :attribute debe ser de :size kilobytes.',
        'string' => 'El :attribute debe contener :size caracteres.',
        'array' => 'El :attribute debe contener :size elementos.',
    ],
    'starts_with' => 'El :attribute debe comenzar con uno de los siguientes valores: :values',
    'string' => 'El :attribute debe ser una cadena de texto.',
    'timezone' => 'El :attribute debe ser una zona horaria válida.',
    'unique' => 'El :attribute ya ha sido registrado.',
    'uploaded' => 'Subir :attribute ha fallado.',
    'url' => 'El formato :attribute es inválido.',
    'uuid' => 'El :attribute debe ser un UUID válido.',

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    'attributes' => [
        'name' => 'nombre',
        'telefono' => 'teléfono',
        'email' => 'correo electrónico',
        'password' => 'contraseña',
        'passwordRepeat' => 'repetir contraseña',
    ],

];
