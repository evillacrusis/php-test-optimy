<?php

namespace App\Tests\Manager;

use App\Manager\CommentManager;
use App\Manager\NewsManager;
use App\Models\News;
use App\Interfaces\DatabaseInterface;
use PHPUnit\Framework\TestCase;
use DateTime;

class NewsManagerTest extends TestCase
{
    private $connection;
    private $commentManager;
    private $newsManager;

    protected function setUp(): void
    {
        $this->connection = $this->createMock(DatabaseInterface::class);
        $this->commentManager = $this->createMock(CommentManager::class);
        $this->newsManager = new NewsManager($this->connection, $this->commentManager);
    }

    public function testListNews()
    {
        $rows = [
            ['id' => 1, 'title' => 'News 1', 'body' => 'Body 1', 'created_at' => '2024-01-01'],
            ['id' => 2, 'title' => 'News 2', 'body' => 'Body 2', 'created_at' => '2024-01-02'],
        ];

        $this->connection->expects($this->once())
            ->method('select')
            ->with('SELECT * FROM `news`')
            ->willReturn($rows);

        $news = $this->newsManager->listNews();

        $this->assertCount(2, $news);
        $this->assertInstanceOf(News::class, $news[0]);
        $this->assertEquals('News 1', $news[0]->getTitle());
    }

    public function testAddNews()
    {
        $this->connection->expects($this->once())
            ->method('insert')
            ->with('news', [
                'title' => 'New News',
                'body' => 'New Body',
                'created_at' => (new DateTime())->format('Y-m-d'),
            ]);

        $this->connection->expects($this->once())
            ->method('lastInsertId')
            ->willReturn('1');

        $id = $this->newsManager->addNews('New News', 'New Body');
        $this->assertEquals(1, $id);
    }

    public function testDeleteNews()
    {
        $commentManager = $this->createMock(CommentManager::class);
        $commentManager->expects($this->once())
            ->method('listComments')
            ->willReturn([]);

        $commentManager->expects($this->never())
            ->method('deleteComment');

        $this->newsManager = new NewsManager($this->connection, $commentManager); // Update instance with mock

        $this->connection->expects($this->once())
            ->method('delete')
            ->with('news', ['id' => 1]);

        $this->newsManager->deleteNews(1);
    }
}
