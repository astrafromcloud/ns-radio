<?php

return [
    'required' => 'Поле :attribute обязательно для заполнения.',
    'string' => 'Поле :attribute должно быть строкой.',
    'max' => [
        'string' => 'Поле :attribute не должно превышать :max символов.',
    ],
    'unique' => 'Значение поля :attribute уже используется.',
    'email' => 'Поле :attribute должно быть корректным email-адресом.',
    'min' => [
        'string' => 'Поле :attribute должно содержать минимум :min символов.',
    ],
    'confirmed' => 'Поле :attribute не совпадает с подтверждением.',

    // Attribute names
    'attributes' => [
        'name' => 'Имя',
        'last_name' => 'Фамилия',
        'phone' => 'Номер телефона',
        'email' => 'Email',
        'password' => 'Пароль',
    ],
];
