# WEB 250 - Assignment 09: Create a Record with Active Record

## Assignment Overview

In Assignment 09, I expanded the WNC Birds application from Assignment 08 by adding the Create portion of CRUD (Create, Read, Update, Delete). The application now allows users to enter information about a new bird through an HTML form and save it to the MySQL database.

This assignment focuses only on Create. Update and Delete will be covered in a later assignment.

## Database

The application uses the existing `wnc_birds` MySQL database and the `birds` table.

The `Bird` class uses PDO to communicate with MySQL. The `Database` class establishes the connection, and `initialize.php` passes the PDO connection to the Bird class using `Bird::set_database($pdo)`.

## Create Functionality

I added a Create Bird link above the directory table in `public/birds.php`. This link opens `public/bird_new.php`, which contains the HTML form.

When the form is submitted, PHP collects the values from `$_POST`, trims unnecessary whitespace, and assigns the values to a new Bird object.

The form requires a common name and scientific name. If either value is missing, the application displays an error message instead of inserting a record.

If the required information is provided, `$bird->create()` inserts the record into the database. After a successful insert, the application redirects back to the bird directory.

## PDO Prepared Statements

The `create()` method in `private/classes/Bird.php` uses a PDO prepared `INSERT` statement with six named placeholders.

The `prepare()` method prepares the SQL statement, and `bindValue()` assigns each Bird property to its corresponding placeholder. The `execute()` method runs the statement.

Using prepared statements keeps submitted values separate from the SQL query and helps prevent SQL injection.

After a successful insert, `lastInsertId()` retrieves the automatically generated record ID and assigns it to the Bird object.

## MVC Structure

The application is beginning to follow the Model-View-Controller (MVC) pattern.

- **Model:** `private/classes/Bird.php` represents bird records and handles database operations.
- **View:** `public/birds.php` displays the bird directory.
- **Request handling:** `public/bird_new.php` processes form submissions and displays the Create Bird form.

This is not a complete MVC application because `bird_new.php` handles both the form processing and HTML output.

## Testing

I tested the application locally using MAMP and MySQL.

I confirmed that the existing database summary, bird directory, and bird details pages still work.

I also created a new record for Wilson's Warbler. The record was successfully inserted with ID 9, and its details page displayed the correct information.

This test confirmed that PDO prepared statements correctly handle apostrophes without manually escaping them.

I also tested the required-field validation. Submitting the form without the required names displayed the expected error message.

## Git Branch Workflow

I created the `dev-create` branch from the updated `main` branch.

I completed the Create functionality and committed the Assignment 09 files on `dev-create`. After completing the remaining documentation and testing, I will push the branch to GitHub, merge it into `main`, and push the updated main branch.

## Running the Application Locally

1. Place the `asgn09` folder inside the WEB 250 project directory in MAMP.
2. Start the MAMP Apache and MySQL servers.
3. Use the existing `wnc_birds` database.
4. Copy `private/db_credentials.example.php` to `private/db_credentials.php` and enter the local database connection settings.
5. Open `http://localhost:8888/web250/asgn09/public/index.php` in a browser.
6. Select Bird Directory to view records or Create Bird to add a new record.

The actual `db_credentials.php` file is excluded from Git using `.gitignore` to protect database credentials.

## Project Links

**GitHub Repository:** https://github.com/yasminshawamreh/web250-database-driven-websites

**Assignment 09 GitHub:** https://github.com/yasminshawamreh/web250-database-driven-websites/tree/main/asgn09

**Hosted Assignment 09:** https://yshawamreh.com/web250/asgn09/public/birds.php

The Assignment 09 GitHub and hosted links will be verified after merging and deployment.
