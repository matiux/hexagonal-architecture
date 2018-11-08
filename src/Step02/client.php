<?php

require __DIR__ . '/../../vendor/autoload.php';

use HexagonalArchitecture\ConnectionFactory;
use HexagonalArchitecture\Request;
use HexagonalArchitecture\Step02\IdeaController;

ConnectionFactory::truncateTables();

$controller = new IdeaController();

$ideaId = $controller->createAction(new Request(['title' => 'Flying pig', 'author' => 'Matteo', 'description' => 'A flying pig']));


$controller->rateAction(new Request(['id' => $ideaId->toString(), 'rating' => 5]));
