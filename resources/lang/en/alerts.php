<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Alert Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain alert messages for various scenarios
    | during CRUD operations. You are free to modify these language lines
    | according to your application's requirements.
    |
    */

    'backend' => [
        'roles' => [
            'created' => 'The role was successfully created.',
            'deleted' => 'The role was successfully deleted.',
            'updated' => 'The role was successfully updated.',
        ],

        'users' => [
            'confirmation_email' => 'A new confirmation e-mail has been sent to the address on file.',
            'created' => 'The user was successfully created.',
            'deleted' => 'The user was successfully deleted.',
            'deleted_permanently' => 'The user was deleted permanently.',
            'restored' => 'The user was successfully restored.',
            'updated' => 'The user was successfully updated.',
            'updated_password' => "The user's password was successfully updated.",
        ],
        'awards' => [
            'created' => 'The award was successfully created.',
            'deleted' => 'The award was successfully deleted.',
            'deleted_permanently' => 'The award was deleted permanently.',
            'restored' => 'The award was successfully restored.',
            'updated' => 'The award was successfully updated.',
        ],
        'qualifications' => [
            'created' => 'The qualification was successfully created.',
            'deleted' => 'The qualification was successfully deleted.',
            'deleted_permanently' => 'The qualification was deleted permanently.',
            'restored' => 'The qualification was successfully restored.',
            'updated' => 'The qualification was successfully updated.',
        ],
        'calendars' => [
            'created' => 'The event was successfully created.',
            'deleted' => 'The event was successfully deleted.',
            'updated' => 'The event was successfully updated.',
        ],
    ],
    'frontend' => [
        'calendar' => [
            'timezone_update' => 'Timezone has been successfully updated.'
        ],
    ],
];