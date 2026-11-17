# WEB 250 - Assignment 11: Members, Login, and Bird Permissions

## Assignment Overview

In Assignment 11, I continued working on my WNC Birds application from Assignment 10. I added member registration, login, logout, and permissions to control who can make changes to bird records.

Visitors can view the Bird Directory and individual bird details, but they cannot create, update, or delete birds. Registered members can log in and use all four CRUD features.

I also used Composer and environment variables to manage the project and keep database credentials private.

## Project Folder Structure

- `private/classes/Bird.php` — Contains the Bird class and database methods for creating, reading, updating, and deleting bird records.
- `private/classes/Member.php` — Handles member registration and member lookups.
- `private/classes/Database.php` — Handles the PDO database connection.
- `private/functions/auth_functions.php` — Contains the login and permission-checking functions.
- `private/initialize.php` — Loads the required files, environment variables, and database connection.
- `public/index.php` — Displays the application homepage.
- `public/birds.php` — Displays the Bird Directory and navigation links.
- `public/bird.php` — Displays individual bird information.
- `public/bird_new.php` — Contains the form for creating a bird.
- `public/bird_edit.php` — Contains the form for updating a bird.
- `public/bird_delete.php` — Displays the confirmation page for deleting a bird.
- `public/register.php` — Allows visitors to create a member account.
- `public/login.php` — Allows registered members to log in.
- `public/logout.php` — Logs members out.
- `composer.json` — Lists the Composer dependencies.
- `composer.lock` — Records the installed dependency versions.
- `vendor/` — Contains the installed Composer packages.
- `.env` — Stores private database connection settings.
- `.env.example` — Provides example environment settings without real credentials.
- `.gitignore` — Excludes private credentials, dependencies, and unnecessary files from Git.

## Database and Active Record

The application uses the existing `wnc_birds` MySQL database.

The `birds` table stores bird information, and I added a `members` table to store registered member information.

The `Bird` class handles database operations using PDO prepared statements.

The `find_all()` method retrieves all bird records and displays them in the Bird Directory. The `find_by_id()` method retrieves one bird using its ID. The `from_row()` method converts database results into Bird objects so the application can work with the information more easily.

The Bird class also includes `create()`, `update()`, and `delete()` methods for making changes to bird records.

The `Database` class handles the PDO connection, and `initialize.php` passes the connection to the Bird and Member classes.

## Member Registration

I created a `Member` class to handle member registration and lookups.

The `create()` method adds a new member to the database using a prepared SQL INSERT statement.

The `find_by_username()` method searches for a member using their username, and `find_by_email()` checks whether an email address is already registered.

I created `public/register.php` with fields for first name, last name, email, username, password, and password confirmation.

The registration form checks that:

- All required fields are completed.
- The email address is valid.
- The username is not already registered.
- The email address is not already registered.
- The password contains at least eight characters.
- The password and confirmation match.

Passwords are protected using `password_hash()` before being stored in the database.

New users are assigned the `member` role.

## Login and Logout

I created `public/login.php` so registered members can log in using their username and password.

The application uses `password_verify()` to compare the entered password with the stored password hash.

After a successful login, the application stores the member ID, username, and role in the PHP session. The password is not stored in the session.

I also created `public/logout.php` to clear the member session and redirect the user to the Bird Directory.

After logging out, the user returns to visitor permissions.

## Authentication and Bird Permissions

I added authentication functions in `private/functions/auth_functions.php`.

The `is_logged_in()` function checks whether a member is logged in.

The `require_login()` function redirects visitors to the Login page when they try to access a protected page.

I updated the Bird Directory navigation so visitors see Birds, Register, and Login.

Logged-in members see Birds, their username, and Logout.

Visitors can view the Bird Directory and individual bird details, but they cannot create, update, or delete bird records.

Logged-in members can create, read, update, and delete bird records.

I also updated the Bird Directory to hide the Create, Update, and Delete links from visitors.

To make sure visitors cannot bypass these restrictions, I added `require_login()` to `bird_new.php`, `bird_edit.php`, and `bird_delete.php`.

This protects the actual PHP pages instead of only hiding the links.

## Composer and Environment Variables

I used Composer to install the `vlucas/phpdotenv` package.

This package allows the application to load database settings from a `.env` file.

The `.env` file contains the database host, database name, username, password, and port.

Instead of writing these settings directly into the PHP files, the application loads them through environment variables.

I added `.env` and `vendor/` to `.gitignore` so the real credentials and installed dependencies are not committed to GitHub.

The `.env.example` file contains example settings without private information.

The `composer.json` and `composer.lock` files are included in Git so the dependencies can be installed using `composer install`.

## Testing

I tested the application locally using MAMP, PHP, and MySQL.

I tested member registration by creating an account and checking that the registration process worked.

I also tested login using the correct password and an incorrect password.

After logging in, I confirmed that the Bird Directory displayed the member's username and the Logout link.

I tested the visitor view by logging out and checking that the Register and Login links appeared.

I also confirmed that visitors could still view all nine original bird records and their details.

The Create, Update, and Delete links were hidden from visitors.

I tested the direct URLs for the Create, Update, and Delete pages while logged out. Each page redirected me to the Login page.

After logging in, I confirmed that all three pages were accessible.

I also created a temporary test bird, updated its information, and deleted it to verify that the CRUD functionality still worked.

These tests confirmed that the new member permissions did not prevent logged-in users from using the existing Bird application.

## Bluehost Hosting and Testing

I uploaded Assignment 11 to Bluehost and configured the application to use my hosted MySQL database.

I created a separate `.env` file on Bluehost with the correct database settings. I also uploaded the Composer dependencies so the application could load the required packages.

During testing, I found that the hosted database was missing the `members` table. I used phpMyAdmin to create the table and then tested registration again.

After fixing the database issue, I successfully registered a member account and logged in.

I confirmed that the Bird Directory displayed the logged-in username along with the Create, Update, Delete, and Logout options.

I also created a temporary bird, updated it, checked the changes, and deleted it.

After logging out, I confirmed that the Create, Update, and Delete links disappeared. I also tried opening the Create Bird page directly while logged out and was redirected to the Login page.

These tests confirmed that the application worked on Bluehost and that the member permissions were working correctly.

## Git Branch Workflow

I created the `dev-users-login` branch to work on Assignment 11 separately from the completed assignments.

I copied the previous Bird application into a new `asgn11` folder and added the member registration, login, logout, Composer, environment variables, and permissions features.

I used `.gitignore` to keep private credentials and installed dependencies out of the repository.

After completing the application and documentation, I committed my changes to the `dev-users-login` branch and pushed the branch to GitHub.

I then switched to `main`, merged the development branch, and pushed the updated main branch to GitHub.

## Running the Application Locally

1. Place the `asgn11` folder inside the WEB 250 project directory in MAMP.
2. Start Apache and MySQL in MAMP.
3. Make sure the `wnc_birds` database and `members` table are available.
4. Open a terminal inside the `asgn11` folder.
5. Run `composer install` to install the required dependencies.
6. Copy `.env.example` to `.env` and enter the local database settings.
7. Open http://localhost:8888/web250/asgn11/public/birds.php in a browser.
8. Register for an account or log in using an existing member account.
9. Use the Bird Directory to view records and, when logged in, create, update, or delete birds.

The real `.env` file should never be uploaded to GitHub.

## Screenshots

The following screenshots can be used to document the Assignment 11 features:

- Member registration form.
- Member login form.
- Bird Directory while logged out, showing Register and Login.
- Bird Directory while logged in, showing the username, Logout, and CRUD options.
- Login page displayed after a visitor attempts to access a protected CRUD page.

## Project Links

**GitHub Repository:** https://github.com/yasminshawamreh/web250-database-driven-websites

**Assignment 11 GitHub:** https://github.com/yasminshawamreh/web250-database-driven-websites/tree/main/asgn11

**Hosted Assignment 11:** https://yshawamreh.com/web250/asgn11/public/birds.php

I successfully uploaded Assignment 11 to Bluehost and tested the hosted application. The completed code is also available on GitHub's `main` branch.
