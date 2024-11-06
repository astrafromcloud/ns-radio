<?php

return [

    'label' => 'Сұрау құрастырушы',

    'form' => [

        'operator' => [
            'label' => 'Оператор',
        ],

        'or_groups' => [

            'label' => 'Топтар',

            'block' => [
                'label' => 'Дизъюнкция (НЕМЕСЕ)',
                'or' => 'НЕМЕСЕ',
            ],

        ],

        'rules' => [

            'label' => 'Ережелер',

            'item' => [
                'and' => 'ЖӘНЕ',
            ],

        ],

    ],

    'no_rules' => '(Ереже жоқ)',

    'item_separators' => [
        'and' => 'ЖӘНЕ',
        'or' => 'НЕМЕСЕ',
    ],

    'operators' => [

        'is_filled' => [

            'label' => [
                'direct' => 'Толтырылған',
                'inverse' => 'Бос',
            ],

            'summary' => [
                'direct' => ':attribute толтырылған',
                'inverse' => ':attribute бос',
            ],

        ],

        'boolean' => [

            'is_true' => [

                'label' => [
                    'direct' => 'Шын',
                    'inverse' => 'Жалған',
                ],

                'summary' => [
                    'direct' => ':attribute шын',
                    'inverse' => ':attribute жалған',
                ],

            ],

        ],

        'date' => [

            'is_after' => [

                'label' => [
                    'direct' => 'Кейін',
                    'inverse' => 'Кейін емес',
                ],

                'summary' => [
                    'direct' => ':attribute :date кейін',
                    'inverse' => ':attribute :date кейін емес',
                ],

            ],

            'is_before' => [

                'label' => [
                    'direct' => 'Бұрын',
                    'inverse' => 'Бұрын емес',
                ],

                'summary' => [
                    'direct' => ':attribute :date бұрын',
                    'inverse' => ':attribute :date бұрын емес',
                ],

            ],

            'is_date' => [

                'label' => [
                    'direct' => 'Күні',
                    'inverse' => 'Күні емес',
                ],

                'summary' => [
                    'direct' => ':attribute бұл :date',
                    'inverse' => ':attribute бұл емес :date',
                ],

            ],

            'is_month' => [

                'label' => [
                    'direct' => 'Ай',
                    'inverse' => 'Ай емес',
                ],

                'summary' => [
                    'direct' => ':attribute бұл :month',
                    'inverse' => ':attribute бұл емес :month',
                ],

            ],

            'is_year' => [

                'label' => [
                    'direct' => 'Жыл',
                    'inverse' => 'Жыл емес',
                ],

                'summary' => [
                    'direct' => ':attribute бұл :year',
                    'inverse' => ':attribute бұл емес :year',
                ],

            ],

            'form' => [

                'date' => [
                    'label' => 'Күні',
                ],

                'month' => [
                    'label' => 'Ай',
                ],

                'year' => [
                    'label' => 'Жыл',
                ],

            ],

        ],

        'number' => [

            'equals' => [

                'label' => [
                    'direct' => 'Тең',
                    'inverse' => 'Тең емес',
                ],

                'summary' => [
                    'direct' => ':attribute тең :number',
                    'inverse' => ':attribute тең емес :number',
                ],

            ],

            'is_max' => [

                'label' => [
                    'direct' => 'Максимум',
                    'inverse' => 'Көбірек',
                ],

                'summary' => [
                    'direct' => ':attribute максимум :number',
                    'inverse' => ':attribute көбірек :number',
                ],

            ],

            'is_min' => [

                'label' => [
                    'direct' => 'Минимум',
                    'inverse' => 'Аздау',
                ],

                'summary' => [
                    'direct' => ':attribute минимум :number',
                    'inverse' => ':attribute аздау :number',
                ],

            ],

            'aggregates' => [

                'average' => [
                    'label' => 'Орташа',
                    'summary' => 'Орташа :attribute',
                ],

                'max' => [
                    'label' => 'Макс',
                    'summary' => 'Макс :attribute',
                ],

                'min' => [
                    'label' => 'Мин',
                    'summary' => 'Мин :attribute',
                ],

                'sum' => [
                    'label' => 'Жиын',
                    'summary' => 'Жиын :attribute',
                ],

            ],

            'form' => [

                'aggregate' => [
                    'label' => 'Сводка',
                ],

                'number' => [
                    'label' => 'Сан',
                ],

            ],

        ],

        'relationship' => [

            'equals' => [

                'label' => [
                    'direct' => 'Ие',
                    'inverse' => 'Ие емес',
                ],

                'summary' => [
                    'direct' => ':count :relationship ие',
                    'inverse' => ':count :relationship ие емес',
                ],

            ],

            'has_max' => [

                'label' => [
                    'direct' => 'Максимум ие',
                    'inverse' => 'Көбірек ие',
                ],

                'summary' => [
                    'direct' => 'Максимум :count :relationship ие',
                    'inverse' => 'Көбірек :count :relationship ие',
                ],

            ],

            'has_min' => [

                'label' => [
                    'direct' => 'Минимум ие',
                    'inverse' => 'Аздау ие',
                ],

                'summary' => [
                    'direct' => 'Минимум :count :relationship ие',
                    'inverse' => 'Аздау :count :relationship ие',
                ],

            ],

            'is_empty' => [

                'label' => [
                    'direct' => 'Бос',
                    'inverse' => 'Бос емес',
                ],

                'summary' => [
                    'direct' => ':relationship бос',
                    'inverse' => ':relationship бос емес',
                ],

            ],

            'is_related_to' => [

                'label' => [

                    'single' => [
                        'direct' => 'Байланысты',
                        'inverse' => 'Байланысты емес',
                    ],

                    'multiple' => [
                        'direct' => 'Қамтиды',
                        'inverse' => 'Қамтымайды',
                    ],

                ],

                'summary' => [

                    'single' => [
                        'direct' => ':relationship бұл :values',
                        'inverse' => ':relationship бұл емес :values',
                    ],

                    'multiple' => [
                        'direct' => ':relationship қамтиды :values',
                        'inverse' => ':relationship қамтымайды :values',
                    ],

                    'values_glue' => [
                        0 => ', ',
                        'final' => ' немесе ',
                    ],

                ],

                'form' => [

                    'value' => [
                        'label' => 'Мән',
                    ],

                    'values' => [
                        'label' => 'Мәндер',
                    ],

                ],

            ],

            'form' => [

                'count' => [
                    'label' => 'Саны',
                ],

            ],

        ],

        'select' => [

            'is' => [

                'label' => [
                    'direct' => 'Болып табылады',
                    'inverse' => 'Болып табылмайды',
                ],

                'summary' => [
                    'direct' => ':attribute бұл :values',
                    'inverse' => ':attribute бұл емес :values',
                    'values_glue' => [
                        ', ',
                        'final' => ' немесе ',
                    ],
                ],

                'form' => [

                    'value' => [
                        'label' => 'Мән',
                    ],

                    'values' => [
                        'label' => 'Мәндер',
                    ],

                ],

            ],

        ],

        'text' => [

            'contains' => [

                'label' => [
                    'direct' => 'Қамтиды',
                    'inverse' => 'Қамтымайды',
                ],

                'summary' => [
                    'direct' => ':attribute қамтиды :text',
                    'inverse' => ':attribute қамтымайды :text',
                ],

            ],

            'ends_with' => [

                'label' => [
                    'direct' => 'Аяқталады',
                    'inverse' => 'Аяқталмайды',
                ],

                'summary' => [
                    'direct' => ':attribute аяқталады :text',
                    'inverse' => ':attribute аяқталмайды :text',
                ],

            ],

            'equals' => [

                'label' => [
                    'direct' => 'Тең',
                    'inverse' => 'Тең емес',
                ],

                'summary' => [
                    'direct' => ':attribute тең :text',
                    'inverse' => ':attribute тең емес :text',
                ],

            ],

            'starts_with' => [

                'label' => [
                    'direct' => 'Басталады',
                    'inverse' => 'Басталмайды',
                ],

                'summary' => [
                    'direct' => ':attribute басталады :text',
                    'inverse' => ':attribute басталмайды :text',
                ],

            ],

            'form' => [

                'text' => [
                    'label' => 'Мәтін',
                ],

            ],

        ],

    ],

];
