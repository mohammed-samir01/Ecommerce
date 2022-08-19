<?php

return [
    'mode'                      => '',
    'format'                    => 'A4',
    'default_font_size'         => '12',
    'default_font'              => 'sans-serif',
    'margin_left'               => 10,
    'margin_right'              => 10,
    'margin_top'                => 10,
    'margin_bottom'             => 10,
    'margin_header'             => 0,
    'margin_footer'             => 0,
    'orientation'               => 'P',
    'title'                     => 'Laravel mPDF',
    'author'                    => '',
    'watermark'                 => '',
    'show_watermark'            => false,
    'watermark_font'            => 'sans-serif',
    'display_mode'              => 'fullpage',
    'watermark_text_alpha'      => 0.1,
    'custom_font_dir'           => base_path('public/fonts/'),
    'custom_font_data' 	        => [
        'almarai' => [
            'R'  => 'Almarai-Regular.ttf',    // regular font
            'B'  => 'Almarai-Bold.ttf',       // optional: bold font
            'I'  => 'Almarai-Light.ttf',     // optional: italic font
            'BI' => 'Almarai-ExtraBold.ttf', // optional: bold-italic font
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ]
    ],
    'auto_language_detection'   => false,
    'temp_dir'                  => base_path('storage/app/pdf/'),
    'pdfa' 			            => false,
    'pdfaauto' 		            => false,
];
