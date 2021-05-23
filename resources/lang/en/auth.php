<?php

return [
    'failed' => 'These credentials do not match our records.',
    'password' => 'The provided password is incorrect.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',

    'login' => [
        'title' => 'Welcome back.',
        'details' => 'Log in in order to access your account.',

        'inputs' => [
            'email' => 'E-mail',
            'password' => 'Password'
        ],

        'remember_me' => 'Remember me',
        'forgot_password' => 'Forgot your password?',

        'button' => 'Log in',
        'register' => "Don't have an account yet?",
        'register_link' => 'Register'
    ],

    'register' => [
        'title' => 'Welcome.',
        'details' => 'Create an account to start using the product.',

        'inputs' => [
            'name' => 'Name',
            'email' => 'E-mail',
            'password' => 'Password'
        ],

        'button' => 'Register',
        'login' => "Already have an account?",
        'login_link' => 'Log in'
    ],

    'forgot-password' => [
        'title' => 'Forgot your password?',
        'details' => 'We will email you a password reset link that will allow you to choose a new password',

        'inputs' => [
            'email' => 'E-mail'
        ],

        'button' => 'Email Password Reset Link'
    ],

    'reset-password' => [
        'title' => 'Reset your password',
        'details' => 'Be careful, resetting a password is definitive and irreversible.',

        'inputs' => [
            'email' => 'E-mail',
            'password' => 'Password'
        ],

        'button' => 'Reset Password'
    ],

    'verify-email' => [
        'title' => 'Thanks for signing up!',
        'details' => 'Could you enter the code we just emailed you?',

        'button' => 'Resend Verification Code',

        'resend' => 'Resend',
        'sent' => 'Sent'
    ],
    'confirm-password' => [
        'title' => 'Please confirm your password.',
        'details' => 'This is a secure area of the application. Please confirm your password before continuing.',

        'inputs' => [
            'password' => 'Password'
        ],

        'button' => 'Confirm my password'
    ],

    'logout' => [
        'title' => 'Are you sure you want to sign out?',
        'button' => 'Sign out'
    ]
];
