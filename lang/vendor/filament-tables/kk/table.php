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
            'label' => 'Выбрать/снять все элементы для массовых действий.',
        ],

        'bulk_select_record' => [
            'label' => 'Выбрать/отменить :key для массовых действий.',
        ],

        'bulk_select_group' => [
            'label' => 'Выбрать/отменить сводку :title для массовых действий.',
        ],

        'search' => [
            'label' => 'Поиск',
            'placeholder' => 'Поиск',
            'indicator' => 'Поиск',
        ],

    ],

    'summary' => [

        'heading' => 'Сводка',

        'subheadings' => [
            'all' => 'Все :label',
            'group' => 'Cводка :group',
            'page' => 'Эта страница',
        ],

        'summarizers' => [

            'average' => [
                'label' => 'Среднее',
            ],

            'count' => [
                'label' => 'Кол.',
            ],

            'sum' => [
                'label' => 'Сумма',
            ],

        ],

    ],

    'actions' => [

        'disable_reordering' => [
            'label' => 'Сохранить порядок',
        ],

        'enable_reordering' => [
            'label' => 'Изменить порядок',
        ],

        'filter' => [
            'label' => 'Фильтр',
        ],

        'group' => [
            'label' => 'Группировать',
        ],

        'open_bulk_actions' => [
            'label' => 'Открыть действия',
        ],

        'toggle_columns' => [
            'label' => 'Переключить столбцы',
        ],

    ],

    'empty' => [

        'heading' => 'Не найдено :model',

        'description' => 'Создать :model для старта.',

    ],

    'filters' => [

        'actions' => [

            'apply' => [
                'label' => 'Применить фильтры',
            ],

            'remove' => [
                'label' => 'Удалить фильтр',
            ],

            'remove_all' => [
                'label' => 'Очистить фильтры',
                'tooltip' => 'Очистить фильтры',
            ],

            'reset' => [
                'label' => 'Сбросить',
            ],

        ],

        'heading' => 'Фильтры',

        'indicator' => 'Активные фильтры',

        'multi_select' => [
            'placeholder' => 'Все',
        ],

        'select' => [
            'placeholder' => 'Все',
        ],

        'trashed' => [

            'label' => 'Удаленные записи',

            'only_trashed' => 'Только удаленные записи',

            'with_trashed' => 'С удаленными записями',

            'without_trashed' => 'Без удаленных записей',

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

        'selected_count' => '1 жазба таңдалынды|:count жазба таңдалынды',

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
