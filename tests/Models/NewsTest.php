<?php

namespace App\Tests\Models;

use App\Models\News;
use PHPUnit\Framework\TestCase;

class NewsTest extends TestCase
{
    private News $news;

    protected function setUp(): void
    {
        $this->news = new News();
    }

    public function testSetAndGetId()
    {
        $this->news->setId(1);
        $this->assertEquals(1, $this->news->getId());
    }

    public function testSetAndGetTitle()
    {
        $this->news->setTitle('Sample Title');
        $this->assertEquals('Sample Title', $this->news->getTitle());
    }

    public function testSetAndGetBody()
    {
        $this->news->setBody('Sample Body');
        $this->assertEquals('Sample Body', $this->news->getBody());
    }

    public function testSetAndGetCreatedAt()
    {
        $date = new \DateTime('2024-01-01');
        $this->news->setCreatedAt($date);
        $this->assertEquals($date, $this->news->getCreatedAt());
    }
}
