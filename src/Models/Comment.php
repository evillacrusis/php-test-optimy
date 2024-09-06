<?php

namespace App\Models;

/**
 * Class Comment
 * Represents a comment associated with a news item.
 */
class Comment
{
    private int $id;
    private string $body;
    private \DateTime $createdAt;
    private int $newsId;

    /**
     * Gets the ID of the comment.
     *
     * @return int The ID of the comment.
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Sets the ID of the comment.
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
     * Gets the body of the comment.
     *
     * @return string The body of the comment.
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * Sets the body of the comment.
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
     * Gets the creation date of the comment.
     *
     * @return \DateTime The creation date of the comment.
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * Sets the creation date of the comment.
     *
     * @param \DateTime $createdAt The creation date to set.
     * @return self
     */
    public function setCreatedAt(\DateTime $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Gets the ID of the news item associated with the comment.
     *
     * @return int The news ID associated with the comment.
     */
    public function getNewsId(): int
    {
        return $this->newsId;
    }

    /**
     * Sets the ID of the news item associated with the comment.
     *
     * @param int $newsId The news ID to set.
     * @return self
     */
    public function setNewsId(int $newsId): self
    {
        $this->newsId = $newsId;
        return $this;
    }
}
