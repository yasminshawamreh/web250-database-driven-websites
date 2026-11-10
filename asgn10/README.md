# WEB 250 - Assignment 10: Update and Delete a Bird

## Assignment Overview

In Assignment 10, I continued working on my WNC Birds application from Assignment 09. I added the Update and Delete parts of CRUD (Create, Read, Update, Delete). The application now allows users to create new bird records, view existing records, edit bird information, and delete records from the MySQL database.

## Project Folder Structure

- `private/classes/Bird.php` — Contains the Bird class and database methods for creating, reading, updating, and deleting records.
- `private/classes/Database.php` — Handles the PDO database connection.
- `private/initialize.php` — Loads the required files and initializes the database connection.
- `private/db_credentials.example.php` — Provides an example of the database settings without exposing actual credentials.
- `public/index.php` — Displays the Assignment 10 homepage.
- `public/birds.php` — Displays the bird directory with links to create, view, update, and delete records.
- `public/bird.php` — Displays information about an individual bird.
- `public/bird_new.php` — Contains the form for creating a bird.
- `public/bird_edit.php` — Contains the form for updating a bird.
- `public/bird_delete.php` — Displays the confirmation page for deleting a bird.
- `.gitignore` — Excludes database credentials and unnecessary system files from Git.

## Database and Active Record

The application uses the existing `wnc_birds` MySQL database and the `birds` table.

The `Bird` class in `private/classes/Bird.php` handles database operations using PDO prepared statements. The `Database` class manages the database connection, and `initialize.php` passes the connection to the Bird class using `Bird::set_database($pdo)`.

## Update Functionality

I added an `update()` method to the Bird class that uses a prepared SQL `UPDATE` statement to change an existing bird record.

The statement updates the common name, scientific name, family name, primary habitat, seasonal status, and description. It uses named placeholders and `bindValue()` to pass the values safely to the database.

The `WHERE id = :id` condition makes sure only the selected bird record is updated.

I created `public/bird_edit.php` to handle editing. When a user clicks Update in the bird directory, the page uses a GET request to find the bird by its ID and fill the form with its current information.

When the user submits the form, a POST request processes the changes. The common name and scientific name are required. After a successful update, the user is redirected to the bird directory.

## Delete Functionality

I added a `delete()` method to the Bird class using a prepared SQL `DELETE` statement.

The statement uses `WHERE id = :id` to delete only the selected record. The ID is bound as an integer, and the method checks whether exactly one row was deleted.

I also created `public/bird_delete.php` to display a confirmation page before deleting a bird.

A GET request displays the selected bird's ID and common name, along with a Delete Bird button and a Cancel link. The actual deletion only happens after the user submits the confirmation form using POST.

The Cancel link returns to the bird directory without deleting anything.

## CRUD Functionality

The application now supports all four CRUD operations:

- **Create:** `bird_new.php` allows users to add a new bird.
- **Read:** `birds.php` displays the directory, and `bird.php` displays individual bird details.
- **Update:** `bird_edit.php` allows users to edit existing bird information.
- **Delete:** `bird_delete.php` allows users to confirm and delete a bird.

The Bird class handles the database operations, while the public PHP pages handle the forms and display information.

## Testing

I tested the application locally using MAMP and MySQL.

I created a temporary test bird, checked that it appeared in the directory, and tested the Update functionality. I also checked the Delete confirmation page and tested the Cancel link before confirming deletion.

After deleting the temporary bird, I verified that it was removed from the directory and that the original nine bird records were still there.

I also checked that the PHP files had no syntax errors.

## Git Branch Workflow

I created the `dev-update-delete` branch from `main` and copied Assignment 09 into a new `asgn10` folder.

I completed the Update and Delete functionality and committed the Assignment 10 files on this branch.

After finishing the documentation, I will push the branch to GitHub, merge it into `main`, and push the updated main branch.

## Running the Application Locally

1. Place the `asgn10` folder inside the WEB 250 project directory in MAMP.
2. Start the Apache and MySQL servers in MAMP.
3. Make sure the `wnc_birds` database is available.
4. Copy `private/db_credentials.example.php` to `private/db_credentials.php` and enter the local database settings.
5. Open `http://localhost:8888/web250/asgn10/public/index.php` in a browser.
6. Open the Bird Directory to create, view, update, or delete bird records.

The actual `db_credentials.php` file is excluded from Git using `.gitignore`. The `.DS_Store` files are also excluded.

## Project Links

**GitHub Repository:** https://github.com/yasminshawamreh/web250-database-driven-websites

**Assignment 10 GitHub:** https://github.com/yasminshawamreh/web250-database-driven-websites/tree/main/asgn10

**Hosted Assignment 10:** https://yshawamreh.com/web250/asgn10/public/birds.php

The Assignment 10 GitHub and hosted links will be verified after merging and deployment.
