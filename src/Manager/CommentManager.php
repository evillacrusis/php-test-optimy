<?php

namespace App\Manager;

use App\Interfaces\DatabaseInterface;
use App\Models\Comment;

/**
 * Class CommentManager
 * Manages operations related to comments, including listing, adding, and deleting comments.
 */
class CommentManager
{
    private DatabaseInterface $database;

    /**
     * CommentManager constructor.
     *
     * @param DatabaseInterface $database The database interface instance used for database operations.
     */
    public function __construct(DatabaseInterface $database)
    {
        $this->database = $database;
    }

    /**
     * Retrieves all comments from the database.
     *
     * This method fetches all comment records from the database and maps them to Comment objects.
     *
     * @return Comment[] An array of Comment objects.
     */
    public function listComments(): array
    {
        // Fetch all rows from the `comment` table
        $rows = $this->database->select('SELECT * FROM `comment`');

        $comments = [];
        foreach ($rows as $row) {
            // Create a Comment object and set its properties
            $comment = new Comment();
            $comment->setId($row['id'])
                ->setBody($row['body'])
                ->setCreatedAt(new \DateTime($row['created_at'])) // Convert string to DateTime
                ->setNewsId($row['news_id']);
            
            $comments[] = $comment;
        }

        return $comments;
    }

    /**
     * Adds a new comment for a specific news entry.
     *
     * This method inserts a new comment record into the `comment` table and returns the ID of the newly inserted comment.
     *
     * @param string $body The body of the comment.
     * @param int $newsId The ID of the news entry the comment is related to.
     * @return int The ID of the newly inserted comment.
     */
    public function addCommentForNews(string $body, int $newsId): int
    {
        // Insert a new comment record into the `comment` table
        $this->database->insert('comment', [
            'body' => $body,
            'created_at' => (new \DateTime())->format('Y-m-d'),
            'news_id' => $newsId,
        ]);

        // Return the ID of the newly inserted comment
        return $this->database->lastInsertId();
    }

    /**
     * Deletes a comment from the database.
     *
     * This method removes a comment record from the `comment` table based on the provided comment ID.
     *
     * @param int $id The ID of the comment to delete.
     * @return void
     */
    public function deleteComment(int $id): void
    {
        // Delete the comment record from the `comment` table
        $this->database->delete('comment', ['id' => $id]);
    }
}
