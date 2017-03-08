<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menus Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in menu items throughout the system.
    | Regardless where it is placed, a menu item can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'title' => 'Access Management',

            'roles' => [
                'all' => 'All Roles',
                'create' => 'Create Role',
                'edit' => 'Edit Role',
                'management' => 'Role Management',
                'main' => 'Roles',
            ],

            'users' => [
                'all' => 'All Users',
                'change-password' => 'Change Password',
                'create' => 'Create User',
                'deactivated' => 'Deactivated Users',
                'deleted' => 'Deleted Users',
                'edit' => 'Edit User',
                'main' => 'Users',
            ],
        ],

        'unit' => [
            'applications' => [
                'name' => 'Applications',
                'settings' => 'Application Settings',
                'custom-fields' => 'Custom Fields',

            ],
            'documentation' => [
                'name' => 'Documentation',
                'page' => 'Page',
                'section' => 'Section',
                'category' => 'Category',
                'tags' => 'Tags'
            ],
            'calendar' => [
                'name' => 'Calendar',
                'calendar' => 'Calendar',
                'schedule-event' => 'Schedule Event',
                'schedule-training' => 'Schedule Training',
                'schedule-school' => 'Schedule School',

            ],
            'personnel-files' => [
                'name' => 'Personnel Files',
                'bad-conduct' => 'Bad Conduct',
                'promotion-points' => 'Promotion Points',
                'service-history' => 'Service History',
                'teamspeak' => 'Teamspeak',
                'awards' => 'Awards',
                'all-awards' => 'All Awards',
                'create-award' => 'Create Award',
                'deleted-awards' => 'Deleted Awards',
                'operation' => 'Operation',
                'qualifications' => 'Qualification',
                'all-qualifications' => 'All Qualifications',
                'create-qualification' => 'Create Qualification',
                'deleted-qualifications' => 'Deleted Qualifications',
                'school' => 'School',
                'training' => 'Training'
            ],
            'unit-organization' => [
                'name' => 'Unit Organization',
                'ranks' => 'Ranks',
                'groups' => 'Groups',
                'assignments' => 'Assignments',
            ],
        ],

        'log-viewer' => [
            'main' => 'Log Viewer',
            'dashboard' => 'Dashboard',
            'logs' => 'Logs',
        ],

        'sidebar' => [
            'dashboard' => 'Dashboard',
            'general' => 'General',
        ],
    ],

    'language-picker' => [
        'language' => 'Language',
        /**
         * Add the new language to this array.
         * The key should have the same language code as the folder name.
         * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
         * Be sure to add the new language in alphabetical order.
         */
        'langs' => [
            'ar' => 'Arabic',
            'da' => 'Danish',
            'de' => 'German',
            'en' => 'English',
            'es' => 'Spanish',
            'fr' => 'French',
            'it' => 'Italian',
            'pt-BR' => 'Brazilian Portuguese',
            'sv' => 'Swedish',
        ],
    ],
];
