<?php

namespace App\Interfaces;

/**
 * Interface DatabaseInterface
 * Defines methods for interacting with a database.
 */
interface DatabaseInterface
{
    /**
     * Executes a SELECT query and returns the results as an associative array.
     *
     * @param string $sql The SQL SELECT query to execute.
     * @return array An array of associative arrays representing the rows returned by the query.
     */
    public function select(string $sql): array;

    /**
     * Executes a SQL query that does not return results, such as an INSERT or UPDATE statement.
     *
     * @param string $sql The SQL query to execute.
     * @return int The number of rows affected by the query.
     */
    public function exec(string $sql): int;

    /**
     * Retrieves the ID of the last inserted row.
     *
     * This method is typically used after an INSERT operation to get the ID of the newly created record.
     *
     * @return string The ID of the last inserted row.
     */
    public function lastInsertId(): string;

    /**
     * Inserts a new record into a specified table.
     *
     * @param string $table The name of the table where the record will be inserted.
     * @param array $params An associative array of column names and their corresponding values to insert.
     * @return void
     */
    public function insert(string $table, array $params): void;

    /**
     * Deletes records from a specified table based on given criteria.
     *
     * @param string $table The name of the table from which records will be deleted.
     * @param array $criteria An associative array where the keys are column names and the values are the values to match for deletion.
     * @return void
     */
    public function delete(string $table, array $criteria): void;
}
