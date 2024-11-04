<?php

return [

    'label' => ':label импорт жасау',

    'modal' => [

        'heading' => ':label импорт жасау',

        'form' => [

            'file' => [
                'label' => 'Файл',
                'placeholder' => 'CSV-файл жүктеу',
            ],

            'columns' => [
                'label' => 'Қатарлар',
                'placeholder' => 'Қатарды таңдаңыз',
            ],

        ],

        'actions' => [

            'download_example' => [
                'label' => 'CSV-файл мысалын жүктеу',
            ],

            'import' => [
                'label' => 'Импорт',
            ],

        ],

    ],

    'notifications' => [

        'completed' => [

            'title' => 'Импорт аяқталды',

            'actions' => [

                'download_failed_rows_csv' => [
                    'label' => 'Сәтсіз жол туралы ақпаратты жүктеу|Сәтсіз жол туралы ақпаратты жүктеу',
                ],

            ],

        ],

        'max_rows' => [
            'title' => 'Жүктеп салынған CSV файл тым үлкен',
            'body' => 'Бір уақытта 1 жолдан артық импорттай алмайсыз.|Бір уақытта :count жолынан артық импорттау мүмкін емес.',
        ],

        'started' => [
            'title' => 'Импорт басталды',
            'body' => 'Импорттау басталды және 1 жол фондық режимде өңделеді.|Импорттау басталды және :count жолдары фондық режимде өңделеді.',
        ],

    ],

    'example_csv' => [
        'file_name' => ':importer-example',
    ],

    'failure_csv' => [
        'file_name' => 'import-:import_id-:csv_name-failed-rows',
        'error_header' => 'Қате',
        'system_error' => 'Жүйе қатесі, қолдау қызметіне хабарласыңыз.',
    ],

];
