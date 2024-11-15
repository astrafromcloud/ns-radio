<?php

return [
    'navigation_group_label' => 'Radio Content',

    "tracks" => [
        'navigation_label' => 'Tracks',
        'plural_label' => 'Tracks',
        'model_label' => 'Track',

        'labels' => [
            'id' => 'ID',
            'image' => 'Cover',
            'name' => 'Title',
            'sanitized' => 'Sanitized Title',
            'author' => 'Author',
            'likes' => 'Likes',
            'details' => 'Track Details',
            'updated' => 'Updated Date',
            'created' => 'Creation Date',

            'created_from' => 'Created From',
            'created_until' => 'Created Until',

            'tabs' => [
                'all' => 'All',
                'today' => 'Today',
                'yesterday' => 'Yesterday',
                'this_week' => 'This Week',
                'this_month' => 'This Month',
                'this_year' => 'This Year',
            ],

            'stats' => [
                'total' => 'Total Tracks',
                'no_likes' => 'Tracks Without Likes',
                'avg_likes' => 'Average Likes',
                'today' => 'Tracks Created Today',
            ]
        ]
    ],

    "authors" => [
        'navigation_label' => 'Authors',
        'plural_label' => 'Authors',
        'model_label' => 'Author',

        'labels' => [
            'id' => 'ID',
            'name' => 'Name',
            'sanitized' => 'Sanitized Name',
            'details' => 'Details',
            'track_count' => 'Number of Tracks',

            "tracks" => 'Tracks by :author'
        ]
    ],

    "top-charts" => [
        'navigation_label' => 'Top Charts',
        'plural_label' => 'Top Charts',
        'model_label' => 'Top Chart',

        'labels' => [
            'id' => 'ID',
            'name' => 'Name',
            'details' => 'Details',
            "track" => 'Track',

            'updated' => 'Chart Updated Date',
            'created' => 'Chart Creation Date',

            'track_updated' => 'Track Updated Date',
            'track_created' => 'Track Creation Date',

            "tracks" => 'Tracks by :author'
        ]
    ],

    "history" => [
        'navigation_label' => 'History',
        'plural_label' => 'Histories',
        'model_label' => 'History',

        'labels' => [
            'id' => 'ID',
            'image' => 'Cover',
            'name' => 'Title',
            'sanitized' => 'Sanitized Title',
            'author' => 'Author',
            "track" => 'Track',
            'broadcast' => 'Broadcast',
            'details' => 'Broadcast Details',
            'updated' => 'Date Updated',
            'created' => 'Date of Broadcast',

            'created_from' => 'Created From',
            'created_until' => 'Created Until',

            'track_updated' => 'Track Updated Date',
            'track_created' => 'Track Created Date',

            "except_track_name" => 'Exclude Tracks',
            "except_track_name_indicator" => 'Excluding Tracks: :tracks',

            "except_author_name" => 'Exclude Authors',
            "except_author_name_indicator" => 'Excluding Authors: :authors'
        ]
    ]
];
