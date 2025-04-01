<?php

return [

    /*
    |----------------------------------------------------------------------
    | Authentication Defaults
    |----------------------------------------------------------------------
    |
    | This option controls the default authentication "guard" and password
    | reset options for your application. You may change these defaults
    | as required, but they're a perfect start for most applications.
    |
    */

    'defaults' => [
        'guard' => 'web', // Default guard set to 'web' for administrators
        'passwords' => 'users',
    ],

    /*
    |----------------------------------------------------------------------
    | Authentication Guards
    |----------------------------------------------------------------------
    |
    | Here you may define every authentication guard for your application.
    | We have provided a great default configuration for you here.
    | 
    | For administrators and technicians, two guards are set: 'web' and 'technicien'.
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'administrateur', // Uses the 'administrateur' provider for admins
        ],

        'technicien' => [
            'driver' => 'session',
            'provider' => 'technicien', // Uses the 'technicien' provider for technicians
        ],
    ],

    /*
    |----------------------------------------------------------------------
    | User Providers
    |----------------------------------------------------------------------
    |
    | All authentication drivers have a user provider. This defines how the
    | users are retrieved out of your database or other storage mechanisms.
    |
    | In this case, two providers are defined for 'administrateur' and 'technicien'.
    |
    */

    'providers' => [
        'administrateur' => [
            'driver' => 'eloquent', // Uses Eloquent to retrieve administrator data
            'model' => App\Models\Administrateur::class, // Points to the Administrateur model
        ],

        'technicien' => [
            'driver' => 'eloquent', // Uses Eloquent to retrieve technician data
            'model' => App\Models\Technicien::class, // Points to the Technicien model
        ],
    ],

    /*
    |----------------------------------------------------------------------
    | Password Reset Configurations
    |----------------------------------------------------------------------
    |
    | You may specify multiple password reset configurations if you have
    | more than one user type (administrators, technicians) and need
    | separate password reset settings for each.
    |
    */

    'passwords' => [
        'users' => [
            'provider' => 'users', // Password resets for the 'users' provider (can be extended for admins/techs)
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800, // Timeout for password resets

];
