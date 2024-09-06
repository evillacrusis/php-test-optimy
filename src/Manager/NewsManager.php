<?php

namespace App\Manager;

use App\Models\News;
use App\Interfaces\DatabaseInterface;
use DateTime;

/**
 * Class NewsManager
 * Handles operations related to news management, including listing, adding, and deleting news.
 */
class NewsManager
{
    private DatabaseInterface $database;
    private CommentManager $commentManager;

    /**
     * NewsManager constructor.
     *
     * @param DatabaseInterface $database The database interface instance used for database operations.
     * @param CommentManager $commentManager The comment manager instance used to manage comments related to news.
     */
    public function __construct(DatabaseInterface $database, CommentManager $commentManager)
    {
        $this->database = $database;
        $this->commentManager = $commentManager;
    }

    /**
     * Retrieves all news records from the database.
     *
     * This method fetches all news records from the `news` table and maps them to News objects.
     *
     * @return News[] An array of News objects.
     */
    public function listNews(): array
    {
        // Fetch all news records from the database
        $rows = $this->database->select('SELECT * FROM `news`');

        $newsArray = [];
        foreach ($rows as $row) {
            // Create a News object and set its properties
            $news = new News();
            $news->setId((int) $row['id'])
                ->setTitle($row['title'])
                ->setBody($row['body'])
                ->setCreatedAt(new DateTime($row['created_at'])); // Convert string to DateTime

            $newsArray[] = $news;
        }

        return $newsArray;
    }

    /**
     * Adds a new news record to the database.
     *
     * This method inserts a new news record into the `news` table and returns the ID of the newly inserted news record.
     *
     * @param string $title The title of the news.
     * @param string $body The body of the news.
     * @return int The ID of the newly inserted news record.
     */
    public function addNews(string $title, string $body): int
    {
        $createdAt = (new DateTime())->format('Y-m-d');
        
        // Insert new news record into the database
        $this->database->insert('news', [
            'title' => $title,
            'body' => $body,
            'created_at' => $createdAt,
        ]);

        // Return the ID of the newly inserted news record
        return $this->database->lastInsertId();
    }

    /**
     * Deletes a news record from the database along with associated comments.
     *
     * This method deletes a news record and all comments related to that news from the database.
     *
     * @param int $id The ID of the news record to be deleted.
     * @return void
     */
    public function deleteNews(int $id): void
    {
        // Fetch comments associated with the news ID
        $comments = $this->commentManager->listComments();

        // Delete comments related to the news ID
        foreach ($comments as $comment) {
            if ($comment->getNewsId() === $id) {
                $this->commentManager->deleteComment($comment->getId());
            }
        }

        // Delete the news record from the database
        $this->database->delete('news', ['id' => $id]);
    }
}
