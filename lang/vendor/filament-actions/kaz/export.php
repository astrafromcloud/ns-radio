<?php

return [

    'label' => 'Экспорт :label',

    'modal' => [

        'heading' => 'Экспорт :label',

        'form' => [

            'columns' => [

                'label' => 'Қатарлар',

                'form' => [

                    'is_enabled' => [
                        'label' => ':column қосылды',
                    ],

                    'label' => [
                        'label' => ':column белгі',
                    ],

                ],

            ],

        ],

        'actions' => [

            'export' => [
                'label' => 'Экспорт',
            ],

        ],

    ],

    'notifications' => [

        'completed' => [

            'title' => 'Экспорт аяқталды',

            'actions' => [

                'download_csv' => [
                    'label' => '.csv жүктеу',
                ],

                'download_xlsx' => [
                    'label' => '.xlsx  жүктеу',
                ],

            ],

        ],

        'max_rows' => [
            'title' => 'Экспорт тым үлкен',
            'body' => 'Бір уақытта 1 жолдан артық экспорттай алмайсыз.|Бір уақытта :count жолынан артық экспорттау мүмкін емес.',
        ],

        'started' => [
            'title' => 'Экспорт басталды',
            'body' => 'Экспорттау басталды және 1 жол фондық режимде өңделеді.|Сіздің экспортыңыз басталды және :count жолдары фондық режимде өңделеді.',
        ],

    ],

    'file_name' => 'export-:export_id-:model',

];
