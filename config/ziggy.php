<?php

return [
    'only'=>[''],
    'groups' => [
        'admin' => ['*'],
        'user' => ['!admin.*']
    ]
];