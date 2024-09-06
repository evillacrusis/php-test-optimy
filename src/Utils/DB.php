<?php

namespace App\Utils;

use App\Interfaces\DatabaseInterface;
use Doctrine\DBAL\Connection;

/**
 * Class DB
 * Provides an implementation of DatabaseInterface using Doctrine DBAL for database operations.
 */
class DB implements DatabaseInterface
{
    private Connection $connection;

    /**
     * DB constructor.
     *
     * @param Connection $connection The Doctrine DBAL connection instance.
     */
    public function __construct(Connection $connection)
    {
        $this->connection = $connection;
    }

    /**
     * Executes a SELECT query and returns the results as an associative array.
     *
     * @param string $sql The SQL SELECT query to execute.
     * @return array An array of associative arrays representing the rows returned by the query.
     */
    public function select(string $sql): array
    {
        return $this->connection->fetchAllAssociative($sql);
    }

    /**
     * Executes a SQL query that does not return results, such as an INSERT or UPDATE statement.
     *
     * @param string $sql The SQL query to execute.
     * @return int The number of rows affected by the query.
     */
    public function exec(string $sql): int
    {
        return $this->connection->executeStatement($sql);
    }

    /**
     * Retrieves the ID of the last inserted row.
     *
     * This method is typically used after an INSERT operation to get the ID of the newly created record.
     *
     * @return string The ID of the last inserted row.
     */
    public function lastInsertId(): string
    {
        return $this->connection->lastInsertId();
    }

    /**
     * Inserts a new record into a specified table.
     *
     * @param string $table The name of the table where the record will be inserted.
     * @param array $params An associative array of column names and their corresponding values to insert.
     * @return void
     */
    public function insert(string $table, array $params): void
    {
        $this->connection->insert($table, $params);
    }

    /**
     * Deletes records from a specified table based on given criteria.
     *
     * @param string $table The name of the table from which records will be deleted.
     * @param array $criteria An associative array where the keys are column names and the values are the values to match for deletion.
     * @return void
     */
    public function delete(string $table, array $criteria): void
    {
        $this->connection->delete($table, $criteria);
    }
}
