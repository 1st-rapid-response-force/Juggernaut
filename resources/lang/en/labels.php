<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'general' => [
        'all' => 'All',
        'yes' => 'Yes',
        'no' => 'No',
        'custom' => 'Custom',
        'actions' => 'Actions',
        'buttons' => [
            'save' => 'Save',
            'update' => 'Update',
        ],
        'hide' => 'Hide',
        'none' => 'None',
        'show' => 'Show',
        'toggle_navigation' => 'Toggle Navigation',
    ],

    'backend' => [
        'access' => [
            'roles' => [
                'create' => 'Create Role',
                'edit' => 'Edit Role',
                'management' => 'Role Management',

                'table' => [
                    'number_of_users' => 'Number of Users',
                    'permissions' => 'Permissions',
                    'role' => 'Role',
                    'sort' => 'Sort',
                    'total' => 'role total|roles total',
                ],
            ],

            'users' => [
                'active' => 'Active Users',
                'all_permissions' => 'All Permissions',
                'change_password' => 'Change Password',
                'change_password_for' => 'Change Password for :user',
                'create' => 'Create User',
                'deactivated' => 'Deactivated Users',
                'deleted' => 'Deleted Users',
                'edit' => 'Edit User',
                'management' => 'User Management',
                'no_permissions' => 'No Permissions',
                'no_roles' => 'No Roles to set.',
                'permissions' => 'Permissions',

                'table' => [
                    'confirmed' => 'Confirmed',
                    'created' => 'Created',
                    'email' => 'E-mail',
                    'id' => 'ID',
                    'last_updated' => 'Last Updated',
                    'name' => 'Name',
                    'no_deactivated' => 'No Deactivated Users',
                    'no_deleted' => 'No Deleted Users',
                    'roles' => 'Roles',
                    'total' => 'user total|users total',
                ],
            ],
        ],
        'calendar' => [
            'name' => 'Calendar',
            'management' => 'Calendar Management',
            'add_event' => 'Add Event',
            'edit_event' => 'Edit Event',
        ],
        'personnel-files' => [
            'awards' => [
                'name' => 'Awards',
                'create' => 'Create Award',
                'edit' => 'Edit Award',
                'deleted' => ' Deleted Awards',
                'management' => 'Award Management',
                'published' => 'Published Awards',
                'table' => [
                    'id' => 'ID',
                    'name' => 'Name',
                    'promotion-points' => 'Promotion Points',
                    'published' => 'Published',
                    'last_updated' => 'Last Updated',
                    'created' => 'Created',
                ],
            ],
            'qualifications' => [
                'name' => 'Qualifications',
                'create' => 'Create Qualification',
                'edit' => 'Edit Qualification',
                'deleted' => ' Deleted Qualifications',
                'management' => 'Qualification Management',
                'published' => 'Published Qualifications',
                'table' => [
                    'id' => 'ID',
                    'name' => 'Name',
                    'promotion-points' => 'Promotion Points',
                    'published' => 'Published',
                    'last_updated' => 'Last Updated',
                    'created' => 'Created',
                ],
            ],
        ],
        'documentation' => [
            'name' => 'Documentation',
            'categories' => 'Categories',
            'category' => [
                'table' => [
                    'id' => 'ID',
                    'name' => 'Name',
                    'sort_order' => 'Sort Order',
                    'published' => 'Published',
                    'last_updated' => 'Last Updated',
                    'created' => 'Created',
                ],
            ],
            'sections' => 'Sections',
            'section' => 'Section',
            'pages' => 'Pages',
            'page' => 'Page'
        ]
    ],

    'frontend' => [

        'auth' => [
            'login_box_title' => 'Login',
            'login_button' => 'Login',
            'login_with' => 'Login with :social_media',
            'register_box_title' => 'Register',
            'register_button' => 'Register',
            'remember_me' => 'Remember Me',
        ],

        'passwords' => [
            'forgot_password' => 'Forgot Your Password?',
            'reset_password_box_title' => 'Reset Password',
            'reset_password_button' => 'Reset Password',
            'send_password_reset_link_button' => 'Send Password Reset Link',
        ],

        'macros' => [
            'country' => [
                'alpha' => 'Country Alpha Codes',
                'alpha2' => 'Country Alpha 2 Codes',
                'alpha3' => 'Country Alpha 3 Codes',
                'numeric' => 'Country Numeric Codes',
            ],

            'macro_examples' => 'Macro Examples',

            'state' => [
                'mexico' => 'Mexico State List',
                'us' => [
                    'us' => 'US States',
                    'outlying' => 'US Outlying Territories',
                    'armed' => 'US Armed Forces',
                ],
            ],

            'territories' => [
                'canada' => 'Canada Province & Territories List',
            ],

            'timezone' => 'Timezone',
        ],

        'user' => [
            'passwords' => [
                'change' => 'Change Password',
            ],

            'profile' => [
                'avatar' => 'Avatar',
                'created_at' => 'Created At',
                'edit_information' => 'Edit Information',
                'email' => 'E-mail',
                'last_updated' => 'Last Updated',
                'name' => 'Name',
                'update_information' => 'Update Information',
                'timezone' => 'Timezone'
            ],
        ],

    ],
];
