<?php

return [

    /*
     * Настройки изображений.
     */

    'images' => [
        'quality' => 75,
        'conversions' => [
            'user' => [
                'image' => [
                    'default' => [
                        [
                            'name' => 'image_default',
                            'size' => [
                                'width' => 256,
                                'height' => 256,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],

    /*
     * Настройки связей.
     */

    'relationships' => [
        /* Relationship example
        'comments' => function($self) {
            return $self->hasMany(CommentModel::class, 'user_id', 'id');
        },
        */
    ],
];
