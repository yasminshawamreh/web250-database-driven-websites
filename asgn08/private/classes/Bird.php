<?php

declare(strict_types=1);

/**
 * GRADED ASSIGNMENT STARTER. Implement the TODOs yourself.
 * This is a read-only slice of Active Record; saving records comes later.
 */
final class Bird
{
    private static ?PDO $database = null;

    public int $id = 0;
    public string $common_name = '';
    public string $scientific_name = '';
    public string $family_name = '';
    public string $primary_habitat = '';
    public string $seasonal_status = '';
    public string $description = '';

    public static function set_database(PDO $pdo): void
    {
        self::$database = $pdo;
    }

    /** @return Bird[] */
    public static function find_all(): array
    {
        $sql = 'SELECT * FROM birds ORDER BY common_name';
        $statement = self::$database->query($sql);
        $rows = $statement->fetchAll(PDO::FETCH_ASSOC);
    
        $birds = [];
    
        foreach ($rows as $row) {
            $birds[] = self::from_row($row);
        }
    
        return $birds;
    }

    public static function find_by_id(int $id): ?self
    {
        $sql = 'SELECT * FROM birds WHERE id = :id LIMIT 1';
        $statement = self::$database->prepare($sql);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    
        $row = $statement->fetch(PDO::FETCH_ASSOC);
    
        if ($row === false) {
            return null;
        }
    
        return self::from_row($row);
    }

    // Refactoring task: both query methods should reuse this single mapper.
    private static function from_row(array $row): self
    {
        $bird = new self();
    
        $bird->id = (int) $row['id'];
        $bird->common_name = (string) $row['common_name'];
        $bird->scientific_name = (string) $row['scientific_name'];
        $bird->family_name = (string) $row['family_name'];
        $bird->primary_habitat = (string) $row['primary_habitat'];
        $bird->seasonal_status = (string) $row['seasonal_status'];
        $bird->description = (string) $row['description'];
    
        return $bird;
    }

    public static function count_all(): int
    {
        $sql = 'SELECT COUNT(*) FROM birds';
        $statement = self::$database->query($sql);
    
        return (int) $statement->fetchColumn();
    }
}
