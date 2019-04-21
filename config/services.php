<?php

return [

    /*
      |--------------------------------------------------------------------------
      | Third Party Services
      |--------------------------------------------------------------------------
      |
      | This file is for storing the credentials for third party services such
      | as Stripe, Mailgun, SparkPost and others. This file provides a sane
      | default location for this type of information, allowing packages
      | to have a conventional place to find your various credentials.
      |
     */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],
    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],
    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],
    'stripe' => [
        'model' => App\Modelos\Usuarios::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'google' => [
        'client_id' => '898107245113-39gikpr3hk68ld5rfujjd8ouh5lljkun.apps.googleusercontent.com',
        'client_secret' => 'PadM-hcBw90eHLJGWjD47DMr',
        'redirect' => env('APP_BASE_PATH', 'http://localhost/psp/public_html/') . 'social/callback/google',
    ],
    'facebook' => [
        'client_id' => '570433106500573',
        'client_secret' => '35e6fe2f4de7f5f4df5af87b3865150e',
        'redirect' => env('APP_BASE_PATH', 'http://localhost/psp/public_html/') . 'social/callback/facebook',
    ],
    'twitter' => [
        'client_id' => 'z3iA5Ow8jR0eIh2j5zeGXcu1A',
        'client_secret' => 'Gac16WqAR6ObsHIMsqhTieNuOujk0hHebUOL2onFGQzdeTzI6v',
        'redirect' => env('APP_BASE_PATH', 'http://localhost/psp/public_html/'). 'social/callback/twitter',
    ],
];
