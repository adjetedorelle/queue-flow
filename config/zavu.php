<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Zavu.dev API Key
    |--------------------------------------------------------------------------
    |
    | Your Zavu.dev API key for sending messages via WhatsApp and SMS.
    | Get your API key from https://zavu.dev
    |
    */
    'api_key' => env('ZAVUDEV_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | OTP Template ID
    |--------------------------------------------------------------------------
    |
    | The template ID for OTP verification messages on WhatsApp.
    | This template must be created and approved in your Zavu.dev dashboard.
    |
    */
    'otp_template_id' => env('ZAVUDEV_OTP_TEMPLATE_ID', 'otp_verification'),

    /*
    |--------------------------------------------------------------------------
    | Default Channel
    |--------------------------------------------------------------------------
    |
    | Default channel for sending messages: 'whatsapp' or 'sms'.
    | WhatsApp will be used by default if available.
    |
    */
    'default_channel' => env('ZAVUDEV_DEFAULT_CHANNEL', 'whatsapp'),

    /*
    |--------------------------------------------------------------------------
    | OTP Settings
    |--------------------------------------------------------------------------
    |
    | Settings for OTP generation and validation.
    |
    */
    'otp' => [
        'length' => 6,
        'expires_in' => 5, // minutes
        'max_attempts' => 3,
    ],
];
