<?php

declare(strict_types=1);

namespace HexagonalArchitecture;

use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class ConnectionFactory
{
    private static array $connectionParams = [
        'dbname' => 'idy',
        'user' => 'user',
        'password' => 'password',
        'host' => 'servicedb',
        'driver' => 'pdo_mysql',
    ];

    protected function __construct()
    {
    }

    /**
     * @psalm-suppress ArgumentTypeCoercion, MixedArgumentTypeCoercion
     *
     * @throws \Doctrine\DBAL\Exception
     *
     * @return Connection
     */
    public static function create(): Connection
    {
        $config = new Configuration();

        return DriverManager::getConnection(static::$connectionParams, $config);
    }

    public static function truncateTables(): void
    {
        $conn = static::create();

        $schemaManager = $conn->createSchemaManager();
        $tables = $schemaManager->listTables();

        foreach ($tables as $table) {
            $dbPlatform = $conn->getDatabasePlatform();

            // TODO - https://github.com/doctrine/DoctrineMigrationsBundle/issues/393
            //$conn->beginTransaction();

            try {
                $conn->executeQuery('SET FOREIGN_KEY_CHECKS=0');
                $q = $dbPlatform->getTruncateTableSql($table->getName());
                $conn->executeStatement($q);
                $conn->executeQuery('SET FOREIGN_KEY_CHECKS=1');
                //$conn->commit();
            } catch (\Exception $e) {
                //$conn->rollback();
            }
        }
    }
}
