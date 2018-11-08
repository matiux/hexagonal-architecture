<?php

namespace HexagonalArchitecture;

use Doctrine\DBAL\Connection;

class ConnectionFactory
{
    private static $connectionParams = [
        'dbname' => 'idy',
        'user' => 'user',
        'password' => 'password',
        'host' => 'servicedb',
        'driver' => 'pdo_mysql',
    ];

    protected function __construct()
    {
    }

    public static function create(): Connection
    {
        $config = new \Doctrine\DBAL\Configuration();

        $conn = \Doctrine\DBAL\DriverManager::getConnection(static::$connectionParams, $config);

        return $conn;
    }

    public static function truncateTables()
    {
        $conn = static::create();

        $schemaManager = $conn->getSchemaManager();
        $tables = $schemaManager->listTables();

        foreach ($tables as $table) {

            $dbPlatform = $conn->getDatabasePlatform();
            $conn->beginTransaction();

            try {

                $conn->query('SET FOREIGN_KEY_CHECKS=0');
                $q = $dbPlatform->getTruncateTableSql($table->getName());
                $conn->executeUpdate($q);
                $conn->query('SET FOREIGN_KEY_CHECKS=1');
                $conn->commit();

            } catch (\Exception $e) {

                $conn->rollback();
            }
        }
    }

}
