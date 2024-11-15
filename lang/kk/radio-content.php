<?php

return [
    'navigation_group_label' => 'Контент Радио',

    "tracks" => [
        'navigation_label' => 'Тректер',
        'plural_label' => 'Тректер',
        'model_label' => 'Трек',

        'labels' => [
            'id' => 'ID',
            'image' => 'Қаптама',
            'name' => 'Атауы',
            'sanitized' => 'Нормаланған атау',
            'author' => 'Автор',
            'likes' => 'Лайктар',
            'details' => 'Трек мәліметтері',
            'updated' => 'Өзгерту күні',
            'created' => 'Жасалған күні',

            'created_from' => 'Жасалған уақыты',
            'created_until' => 'Осы уақытқа дейін жасалған',

            'tabs' => [
                'all' => 'Барлығы',
                'today' => 'Бүгін',
                'yesterday' => 'Кеше',
                'this_week' => 'Осы аптада',
                'this_month' => 'Осы айда',
                'this_year' => 'Осы жылы',
            ],

            'stats' => [
                'total' => 'Барлық тректер',
                'no_likes' => 'Лайксыз тректер',
                'avg_likes' => 'Орташа лайк саны',
                'today' => 'Бүгін жасалған тректер',
            ]
        ]
    ],

    "authors" => [
        'navigation_label' => 'Авторлар',
        'plural_label' => 'Авторлар',
        'model_label' => 'Автор',

        'labels' => [
            'id' => 'ID',
            'name' => 'Аты',
            'sanitized' => 'Нормаланған аты',
            'details' => 'Мәліметтер',
            'track_count' => 'Трек саны',

            "tracks" => ':author тректері'
        ]
    ],

    "top-charts" => [
        'navigation_label' => 'Топ чарттар',
        'plural_label' => 'Топ чарттар',
        'model_label' => 'Топ чарт',

        'labels' => [
            'id' => 'ID',
            'name' => 'Атауы',
            'details' => 'Мәліметтер',
            "track" => 'Трек',

            'updated' => 'Чарт өзгерту күні',
            'created' => 'Чарт жасау күні',

            'track_updated' => 'Трек өзгерту күні',
            'track_created' => 'Трек жасау күні',

            "tracks" => ':author тректері'
        ]
    ],

    "history" => [
        'navigation_label' => 'Тарих',
        'plural_label' => 'Тарихтар',
        'model_label' => 'Тарих',

        'labels' => [
            'id' => 'ID',
            'image' => 'Қаптама',
            'name' => 'Атау',
            'sanitized' => 'Нормаланған атау',
            'author' => 'Автор',
            "track" => 'Трек',
            'broadcast' => 'Таратылым',
            'details' => 'Таратылым мәліметтері',
            'updated' => 'Өзгерту күні',
            'created' => 'Таратылым күні',

            'created_from' => 'Жасалған уақыты',
            'created_until' => 'Осы уақытқа дейін жасалған',

            'track_updated' => 'Трек өзгертілген күні',
            'track_created' => 'Трек жасалған күні',

            "except_track_name" => 'Тректерді шығарып тастау',
            "except_track_name_indicator" => 'Шығарылған тректер: :tracks',

            "except_author_name" => 'Авторларды шығарып тастау',
            "except_author_name_indicator" => 'Шығарылған авторлар: :authors'
        ]
    ]
];
