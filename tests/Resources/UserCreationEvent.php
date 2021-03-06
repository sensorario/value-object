<?php

/**
 * This file is part of sensorario/resources repository
 *
 * (c) Simone Gentili <sensorario@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Resources;

use Sensorario\Resources\Resource;

final class UserCreationEvent extends Resource
{
    const TYPE     = 'type';
    const USERNAME = 'username';

    public function mandatory()
    {
        return [
            UserCreationEvent::TYPE,
            UserCreationEvent::USERNAME => [
                'when' => [
                    'property' => 'type',
                    'has_value' => [
                        'human',
                        'guest',
                    ]
                ]
            ]
        ];
    }

    public function allowedValues()
    {
        return [
            UserCreationEvent::TYPE => [
                'guest',
                'human',
                'bot'
            ],
        ];
    }
}
