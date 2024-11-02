<?php

return [

    'label' => 'Пагинация',

    'overview' => ':first мен :last аралығындағы көрсетілді',

    'fields' => [

        'records_per_page' => [

            'label' => 'бетке',

            'options' => [
                'all' => 'Барлығы',
            ],

        ],

    ],

    'actions' => [

        'first' => [
            'label' => 'Бірінші',
        ],

        'go_to_page' => [
            'label' => ':page бетке өту',
        ],

        'last' => [
            'label' => 'Соңғы',
        ],

        'next' => [
            'label' => 'Келесі',
        ],

        'previous' => [
            'label' => 'Алдыңғы',
        ],

    ],

];
