<?php

require __DIR__ . '/../vendor/autoload.php';

use Doctrine\DBAL\Schema\Table;
use HexagonalArchitecture\ConnectionFactory;

$conn = ConnectionFactory::create();

$schemaManager = $conn->createSchemaManager();

if (!$schemaManager->tablesExist(['ideas'])) {

    $ideas = new Table('ideas');
    $ideas->addColumn('id', 'string', ['length' => 36]);
    $ideas->setPrimaryKey(array('id'));
    $ideas->addColumn('title', 'string');
    $ideas->addColumn('description', 'text');
    $ideas->addColumn('rating', 'decimal', ['unsigned' => true, 'default' => 0, 'precision' => 15, 'scale' => 1]);
    $ideas->addColumn('votes', 'integer', ['unsigned' => true, 'default' => 0]);
    $ideas->addColumn('author', 'string');

    $schemaManager->createTable($ideas);
}
