# PHP Test

## 1. Installation

1. **Database Setup:**
   - Create an empty database named "phptest" on your MySQL server.
   - Import the `dbdump.sql` into the "phptest" database.
   - Create a `.env` file in the root directory, use `.env.example` as a template.
   - Set the following environment variables in your `.env` file:
   
      ```dotenv
      DATABASE_HOST=localhost:3306
      DATABASE_PORT=3306
      DATABASE_NAME=phptest
      DATABASE_USER=root
      DATABASE_PASSWORD=pass
      DATABASE_DRIVER=pdo_mysql


2. **Install Dependencies:**
   - Ensure you have [Composer](https://getcomposer.org/) installed.
   - Run `composer install` to install the project's dependencies.

3. **Run the Application:**
   - You can test the demo script by running `php index.php` in your shell.

## 2. Running Tests

1. **Install PHPUnit:**
   - If not already installed, you can install PHPUnit by running:
     ```bash
     composer require --dev phpunit/phpunit
     ```

2. **Run Tests:**
   - Execute tests using PHPUnit by running:
     ```bash
     ./vendor/bin/phpunit
     ```

## 3. Expectations

This application has been enhanced to improve the codebase from a monolithic style to a more modern, maintainable structure. Changes include:

- **Refactored Code:**
  - Improved code readability and maintainability by applying object-oriented principles and best practices.
  - Added comments and PHPDoc for better documentation and understanding.

- **Code Structure:**
  - Introduced a `Manager` pattern for handling business logic.
  - Separated concerns by creating `Model` classes for data representation.
  - Use interface and dependency injection to enhance flexibility and testing.

- **Database Interaction:**
  - Replaced raw SQL queries with Doctrine DBAL for better database abstraction and easier query management.

- **Testing:**
  - Added unit tests for core functionality using PHPUnit.

Feel free to explore and extend the functionality as needed.

