<?php

namespace App\Tests\Utils;

use App\Utils\DB;
use Doctrine\DBAL\Connection as DBALConnection;
use PHPUnit\Framework\TestCase;

class DBTest extends TestCase
{
    private DB $db;
    private DBALConnection $connection;

    protected function setUp(): void
    {
        // Mock the Doctrine DBAL connection
        $this->connection = $this->createMock(DBALConnection::class);

        // Mock the fetchAllAssociative method
        $this->connection->method('fetchAllAssociative')
            ->willReturn([
                ['id' => 1, 'title' => 'Sample Title'],
            ]);
        
        // Mock the executeStatement method
        $this->connection->method('executeStatement')
            ->willReturn(1);
        
        // Mock the lastInsertId method
        $this->connection->method('lastInsertId')
            ->willReturn('1');
        
        // Mock the insert method
        $this->connection->method('insert')
            ->willReturn(1);
        
        // Mock the delete method
        $this->connection->method('delete')
            ->willReturn(1);
            

        // Instantiate the DB class with mocked dependencies
        $this->db = new DB($this->connection);
    }

    public function testSelect()
    {
        $result = $this->db->select('SELECT * FROM news');
        $this->assertIsArray($result);
        $this->assertArrayHasKey(0, $result);
        $this->assertEquals('Sample Title', $result[0]['title']);
    }

    public function testExec()
    {
        $result = $this->db->exec('INSERT INTO news (title) VALUES ("Sample Title")');
        $this->assertEquals(1, $result);
    }

    public function testLastInsertId()
    {
        $result = $this->db->lastInsertId();
        $this->assertEquals('1', $result);
    }
}
