# asgn07 - WNC Birds Database Check

## 1. Why does this many-to-many design use three tables instead of putting one `bird_id` in `bird_images`?

The database uses three tables: `birds`, `bird_images`, and `bird_image_links`. The `birds` table stores species, the `bird_images` table stores image metadata, and the linking table connects them. This design allows one species to have multiple images and one image to be associated with multiple species. The composite primary key prevents the same bird-image relationship from being entered twice.

## 2. What happens to the links, image records, and physical JPEG files when a species record is deleted?

When a species is deleted from the `birds` table, the foreign key's `ON DELETE CASCADE` rule automatically removes its related records from `bird_image_links`. The image records in `bird_images` and the physical JPEG files remain because deleting a species does not delete the images themselves. Deleting an image record removes its associated links but does not delete the physical JPEG file.

## 3. What does the PDO DSN contain, and why is `Database::$connection` static?

The PDO DSN contains the database driver, host, port, database name, and character set. The username and password are passed separately to PDO. The static `Database::$connection` property stores the PDO connection so the `connect()` method can reuse it during the current PHP request without creating another connection.

## 4. What is the difference between `query()` and `fetchColumn()` in the count example?

The `query()` method executes a SQL statement and returns a `PDOStatement` object containing the query result. The `fetchColumn()` method retrieves a single column value from the next result row. For example, `SELECT COUNT(*) FROM birds` asks the database to count the bird records, and `fetchColumn()` retrieves that count for PHP to display.

## Database Record Counts

The working database contains the following records:

| Table              | Rows | Purpose                     |
| ------------------ | ---: | --------------------------- |
| `birds`            |    8 | Species records             |
| `bird_images`      |   17 | Image file metadata         |
| `bird_image_links` |   18 | Bird-to-image relationships |

These counts match the supplied seed-only totals.

## Incorrect Database Name Test

I temporarily changed `DB_NAME` in my local credentials file to an incorrect database name. The page displayed the generic database failure message instead of showing a successful connection or displaying zero counts. I restored `DB_NAME` to `wnc_birds` and confirmed that the database connection and record counts worked again.

No database passwords or raw error logs are included in this README.

## Assignment 08 - Active Record Refactor

I replaced the direct SQL bird count in index.php with Bird::count_all() so the Bird class handles database queries related to birds. This keeps the database code organized in one place and makes it easier to reuse in other pages.
