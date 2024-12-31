<?php
return [
    'aliases' => [
        '@webroot' => dirname(__DIR__) . '/../web', // Mengarah ke folder 'web' di aplikasi Anda
        '@web' => 'http://localhost/SiPondok', // Sesuaikan dengan URL aplikasi Anda
    ],
    
    'components' => [
        'request' => [
            'cookieValidationKey' => 'your-cookie-validation-key',
            // Pengaturan lainnya
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            // Pengaturan lainnya
        ],
        // Pengaturan komponen lainnya...
    ],

    'adminEmail' => 'admin@example.com',
];
