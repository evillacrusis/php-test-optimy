<?php

namespace App\Models;

use DateTime;

/**
 * Class News
 * Represents a news item with associated properties.
 */
class News
{
    protected int $id;
    protected string $title;
    protected string $body;
    protected DateTime $createdAt;

    /**
     * Sets the ID of the news item.
     *
     * @param int $id The ID to set.
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets the ID of the news item.
     *
     * @return int The ID of the news item.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Sets the title of the news item.
     *
     * @param string $title The title to set.
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Gets the title of the news item.
     *
     * @return string The title of the news item.
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Sets the body of the news item.
     *
     * @param string $body The body to set.
     * @return self
     */
    public function setBody(string $body): self
    {
        $this->body = $body;
        return $this;
    }

    /**
     * Gets the body of the news item.
     *
     * @return string The body of the news item.
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Sets the creation date of the news item.
     *
     * @param DateTime $createdAt The creation date to set.
     * @return self
     */
    public function setCreatedAt(DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Gets the creation date of the news item.
     *
     * @return DateTime The creation date of the news item.
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}
