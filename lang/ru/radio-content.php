<?php

return [
    'navigation_group_label' => 'Контент Радио',

    "tracks" => [
        'navigation_label' => 'Треки',
        'plural_label' => 'Треки',
        'model_label' => 'Трек',

        'labels' => [
            'id' => 'ID',
            'image' => 'Обложка',
            'name' => 'Название',
            'sanitized' => 'Нормализованное название',
            'author' => 'Автор',
            'likes' => 'Лайки',
            'details' => 'Детали трека',
            'updated' => 'Дата изменения',
            'created' => 'Дата создания',

            'created_from' => 'Создан от',
            'created_until' => 'Создан до',

            'tabs' => [
                'all' => 'Всё',
                'today' => 'Сегодня',
                'yesterday' => 'Вчера',
                'this_week' => 'В эту неделю',
                'this_month' => 'В этот месяц',
                'this_year' => 'В этот год',
            ],

            'stats' => [
                'total' => 'Всего треков',
                'no_likes' => 'Треки без лайков',
                'avg_likes' => 'Среднее количество лайков',
                'today' => 'Треки созданные сегодня',
            ]

        ]
    ],

    "authors" => [
        'navigation_label' => 'Авторы',
        'plural_label' => 'Авторы',
        'model_label' => 'Автор',

        'labels' => [
            'id' => 'ID',
            'name' => 'Название',
            'sanitized' => 'Нормализованное название',
            'details' => 'Детали',
            'track_count' => 'Кол-во Треков',

            "tracks" => 'Треки :author'
        ]
    ],

    "top-charts" => [
        'navigation_label' => 'Топ чарты',
        'plural_label' => 'Топ чарты',
        'model_label' => 'Топ чарт',

        'labels' => [
            'id' => 'ID',
            'name' => 'Название',
            'details' => 'Детали',
            "track" => 'Трек',

            'updated' => 'Дата изменения чарта',
            'created' => 'Дата создания чарта',

            'track_updated' => 'Дата изменения трека',
            'track_created' => 'Дата создания трека',
        ]
    ]
];
