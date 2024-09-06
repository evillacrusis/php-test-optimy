<?php

namespace App\Tests\Manager;

use App\Interfaces\DatabaseInterface;
use App\Manager\CommentManager;
use App\Models\Comment;
use PHPUnit\Framework\TestCase;

class CommentManagerTest extends TestCase
{
    private $database;
    private $commentManager;

    protected function setUp(): void
    {
        $this->database = $this->createMock(DatabaseInterface::class);
        $this->commentManager = new CommentManager($this->database);
    }

    public function testListComments()
    {
        $rows = [
            ['id' => 1, 'body' => 'Comment 1', 'created_at' => '2024-01-01', 'news_id' => 1],
            ['id' => 2, 'body' => 'Comment 2', 'created_at' => '2024-01-02', 'news_id' => 1],
        ];

        $this->database->expects($this->once())
            ->method('select')
            ->with('SELECT * FROM `comment`')
            ->willReturn($rows);

        $comments = $this->commentManager->listComments();

        $this->assertCount(2, $comments);
        $this->assertInstanceOf(Comment::class, $comments[0]);
        $this->assertEquals('Comment 1', $comments[0]->getBody());
    }

    public function testAddCommentForNews()
    {
        $this->database->expects($this->once())
            ->method('insert')
            ->with('comment', [
                'body' => 'New Comment',
                'created_at' => (new \DateTime())->format('Y-m-d'),
                'news_id' => '1',
            ]);

        $this->database->expects($this->once())
            ->method('lastInsertId')
            ->willReturn('1');

        $id = $this->commentManager->addCommentForNews('New Comment', 1);
        $this->assertEquals('1', $id);
    }

    public function testDeleteComment()
    {
        $this->database->expects($this->once())
            ->method('delete')
            ->with('comment', ['id' => 1]);

        $this->commentManager->deleteComment(1);
    }
}
