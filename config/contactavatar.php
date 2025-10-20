<?php

return [
    'jpg_image_type' => 'jpg',

    'sizes' => [
        'small' => [
            'height' => 300,
            'width' => 300,
        ],
        'medium' => [
            'height' => 600,
            'width' => 600,
        ],
        'big' => [
            'height' => 800,
            'width' => 800,
        ],
    ],
    'jpg_compression' => 80,
    'originals_path' => 'images/contacts/originals',
    'variants_path_pattern' => 'images/contacts/variants/%sx%s',
];
