<?php

return [
    'mode' => 'utf-8',
    'format' => 'A4',
    'author' => '',
    'subject' => 'Audit Plan by CAG AMMS',
    'keywords' => 'Audit Plan',
    'creator' => 'CAG AMMS',
    'display_mode' => 'fullpage',
    'font_path' => base_path('public/assets/font/'),
    'font_data' => [
        'nikoshpdf' => [
            'R' => 'Nikosh.ttf',
            'useOTL' => 0xFF,    // required for complicated langs like Persian, Arabic and Chinese
            'useKashida' => 75,  // required for complicated langs like Persian, Arabic and Chinese
        ],
        'sutonnymj' => [
            'R' => 'SutonnyMJ.ttf',
        ],
    ],
    'tempDir' => base_path('../temp/'),
    'pdf_a' => false,
    'pdf_a_auto' => false,
    'icc_profile_path' => '',
];
