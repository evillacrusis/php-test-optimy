<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Manager\CommentManager;
use App\Manager\NewsManager;
use App\Utils\DB;
use Doctrine\DBAL\DriverManager;
use Symfony\Component\Dotenv\Dotenv;

try {

    // Load environment variables from .env file
    $dotenv = new Dotenv();
    $dotenv->load(__DIR__ . '/.env');

    // Create the database connection
    $connectionParams = [
        'host' => $_ENV['DATABASE_HOST'],
        'port' => $_ENV['DATABASE_PORT'],
        'dbname' => $_ENV['DATABASE_NAME'],
        'user' => $_ENV['DATABASE_USER'],
        'password' => $_ENV['DATABASE_PASSWORD'],
        'driver' => $_ENV['DATABASE_DRIVER'],
    ];
    $connection = DriverManager::getConnection($connectionParams);

    // Instantiate your DB with the interface
    $db = new DB($connection);

    // Create instances of managers
    $commentManager = new CommentManager($db);
    $newsManager = new NewsManager($db, $commentManager);

    // List and display news
    foreach ($newsManager->listNews() as $news) {
        echo "############ NEWS " . $news->getTitle() . " ############\n";
        echo $news->getBody() . "\n";
        foreach ($commentManager->listComments() as $comment) {
            if ($comment->getNewsId() === $news->getId()) {
                echo "Comment " . $comment->getId() . " : " . $comment->getBody() . "\n";
            }
        }
    }
} catch (\Exception $e) {
    echo "An error occurred: " . $e->getMessage();
}
