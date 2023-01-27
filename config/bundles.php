<?php

declare(strict_types=1);

use FriendsOfBehat\SymfonyExtension\Bundle\FriendsOfBehatSymfonyExtensionBundle;
use PcComponentes\Apixception\ApixceptionBundle;
use PcComponentes\DocumentationBundle\DocumentationBundle;
use PcComponentes\SymfonyMessengerBundle\SymfonyMessengerBundle;
use Symfony\Bundle\FrameworkBundle\FrameworkBundle;
use Symfony\Bundle\MonologBundle\MonologBundle;
use Symfony\Bundle\SecurityBundle\SecurityBundle;

return [
    FrameworkBundle::class => [
        'all' => true,
    ],
    ApixceptionBundle::class => [
        'all' => true,
    ],
    MonologBundle::class => [
        'all' => true,
    ],
    SymfonyMessengerBundle::class => [
        'all' => true,
    ],
    SecurityBundle::class => [
        'all' => true,
    ],
    FriendsOfBehatSymfonyExtensionBundle::class => [
        'test' => true,
    ],
    DocumentationBundle::class => [
        'all' => true,
    ],
];
