<?php

namespace App\Tests\Models;

use App\Models\Comment;
use PHPUnit\Framework\TestCase;

class CommentTest extends TestCase
{
    private Comment $comment;

    protected function setUp(): void
    {
        $this->comment = new Comment();
    }

    public function testSetAndGetId()
    {
        $this->comment->setId(1);
        $this->assertEquals(1, $this->comment->getId());
    }

    public function testSetAndGetBody()
    {
        $this->comment->setBody('Sample Comment');
        $this->assertEquals('Sample Comment', $this->comment->getBody());
    }

    public function testSetAndGetCreatedAt()
    {
        $date = new \DateTime('2024-01-01');
        $this->comment->setCreatedAt($date);
        $this->assertEquals($date, $this->comment->getCreatedAt());
    }

    public function testSetAndGetNewsId()
    {
        $this->comment->setNewsId(1);
        $this->assertEquals(1, $this->comment->getNewsId());
    }
}
