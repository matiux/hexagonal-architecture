<?php

declare(strict_types=1);

require __DIR__.'/../../vendor/autoload.php';

use HexagonalArchitecture\ConnectionFactory;
use HexagonalArchitecture\Request;
use HexagonalArchitecture\Step04\Idea\Infrastructure\Communication\Http\Controller\IdeaController;

ConnectionFactory::truncateTables();

$controller = new IdeaController();

$ideaId = $controller->createAction(
    new Request(
        [
            'title' => 'Flying pig',
            'author' => 'Matteo',
            'description' => 'A flying pig',
        ]
    )
);

$controller->rateAction(new Request(['id' => (string) $ideaId, 'rating' => 5]));
$controller->rateAction(new Request(['id' => (string) $ideaId, 'rating' => 16]));
