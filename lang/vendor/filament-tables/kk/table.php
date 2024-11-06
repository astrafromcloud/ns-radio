<?php

return [

    'column_toggle' => [

        'heading' => 'Қатарлар',

    ],

    'columns' => [

        'text' => [

            'actions' => [
                'collapse_list' => ':count жасыру',
                'expand_list' => 'Тағы :count көрсету',
            ],

            'more_list_items' => 'және :count бар',

        ],

    ],

    'fields' => [

        'bulk_select_page' => [
            'label' => 'Барлық элементтерді жаппай әрекеттерге таңдау/алып тастау.',
        ],

        'bulk_select_record' => [
            'label' => ':key жаппай әрекеттерге таңдау/алып тастау.',
        ],

        'bulk_select_group' => [
            'label' => ':title топтамасын жаппай әрекеттерге таңдау/алып тастау.',
        ],

        'search' => [
            'label' => 'Іздеу',
            'placeholder' => 'Іздеу',
            'indicator' => 'Іздеу',
        ],

    ],

    'summary' => [

        'heading' => 'Қысқаша мазмұны',

        'subheadings' => [
            'all' => 'Барлық :label',
            'group' => ':group топтамасы',
            'page' => 'Осы бет',
        ],

        'summarizers' => [

            'average' => [
                'label' => 'Орташа',
            ],

            'count' => [
                'label' => 'Саны',
            ],

            'sum' => [
                'label' => 'Сомасы',
            ],

        ],

    ],

    'actions' => [

        'disable_reordering' => [
            'label' => 'Тәртіпті сақтау',
        ],

        'enable_reordering' => [
            'label' => 'Тәртіпті өзгерту',
        ],

        'filter' => [
            'label' => 'Фильтр',
        ],

        'group' => [
            'label' => 'Топтау',
        ],

        'open_bulk_actions' => [
            'label' => 'Әрекеттерді ашу',
        ],

        'toggle_columns' => [
            'label' => 'Бағандарды ауыстыру',
        ],

    ],

    'empty' => [

        'heading' => 'Құрамында :model табылмады',

        'description' => 'Бастау үшін :model құрыңыз.',

    ],

    'filters' => [

        'actions' => [

            'apply' => [
                'label' => 'Фильтрлерді қолдану',
            ],

            'remove' => [
                'label' => 'Фильтрді жою',
            ],

            'remove_all' => [
                'label' => 'Фильтрлерді тазалау',
                'tooltip' => 'Фильтрлерді тазалау',
            ],

            'reset' => [
                'label' => 'Қалпына келтіру',
            ],

        ],

        'heading' => 'Фильтрлер',

        'indicator' => 'Белсенді фильтрлер',

        'multi_select' => [
            'placeholder' => 'Барлығы',
        ],

        'select' => [
            'placeholder' => 'Барлығы',
        ],

        'trashed' => [

            'label' => 'Жойылған жазбалар',

            'only_trashed' => 'Тек жойылған жазбалар',

            'with_trashed' => 'Жойылған жазбалармен бірге',

            'without_trashed' => 'Жойылған жазбаларсыз',

        ],

    ],

    'grouping' => [

        'fields' => [

            'group' => [
                'label' => 'Топтау',
                'placeholder' => 'Топтау',
            ],

            'direction' => [

                'label' => 'Бағыты',

                'options' => [
                    'asc' => 'Өсу бойынша',
                    'desc' => 'Кему бойынша',
                ],

            ],

        ],

    ],

    'reorder_indicator' => 'Тізім реттілігін өзгерту үшін жазбаларды тартыңыз',

    'selection_indicator' => [

        'selected_count' => '1 жазба таңдалды|:count жазба таңдалды',

        'actions' => [

            'select_all' => [
                'label' => 'Барлық :count таңдау',
            ],

            'deselect_all' => [
                'label' => 'Барлық белгілерді алу',
            ],

        ],

    ],

    'sorting' => [

        'fields' => [

            'column' => [
                'label' => 'Сұрыптау',
            ],

            'direction' => [

                'label' => 'Бағыты',

                'options' => [
                    'asc' => 'Өсу бойынша',
                    'desc' => 'Кему бойынша',
                ],

            ],

        ],

    ],

];
