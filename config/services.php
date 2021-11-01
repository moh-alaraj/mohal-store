<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'paypal' => [
        'client_id' => env('PAYPAL_CLIENT_ID'),
        'client_secret' => env('PAYPAL_CLIENT_SECRET'),
    ],
    'fatoorah'=>[
        'fatoorah_token' => env('FATOORAH_TOKEN'),
        'fatoorah_success' => env('FATOORAH_SUCCESS_URL'),
        'fatoorah_failed' => env('FATOORAH_FAILED_URL'),
        'fatoorah_base' => env('FATOORAH_BASE_URL'),
    ],
    'coingate'=>[
        'coin_token' => env('COINGATE_TOKEN'),
        'coin_callback' => env('COINGATE_CALLBACK_URL'),
        'coin_success' => env('COINGATE_SUCCESS_URL'),
        'coin_base' => env('COINGATE_BASE_URL'),
        'coin_cancel' => env('COINGATE_CANCEL')
        ],



];
