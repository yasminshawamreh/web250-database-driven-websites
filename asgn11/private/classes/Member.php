<?php
declare(strict_types=1);

final class Member
{
    private static PDO $database;

    public ?int $id = null;
    public string $first_name = '';
    public string $last_name = '';
    public string $email = '';
    public string $username = '';
    public string $password_hash = '';
    public string $role = 'member';

    public static function set_database(PDO $database): void
    {
        self::$database = $database;
    }

    public function create(): bool
    {
        $sql = "INSERT INTO members
                (first_name, last_name, email, username, password_hash, role)
                VALUES
                (:first_name, :last_name, :email, :username, :password_hash, :role)";

        $stmt = self::$database->prepare($sql);

        $result = $stmt->execute([
            ':first_name' => $this->first_name,
            ':last_name' => $this->last_name,
            ':email' => $this->email,
            ':username' => $this->username,
            ':password_hash' => $this->password_hash,
            ':role' => 'member'
        ]);

        if ($result) {
            $this->id = (int) self::$database->lastInsertId();
        }

        return $result;
    }

    public static function find_by_username(string $username): ?self
    {
        $sql = "SELECT * FROM members WHERE username = :username LIMIT 1";
        $stmt = self::$database->prepare($sql);
        $stmt->execute([':username' => $username]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? self::from_row($row) : null;
    }

    public static function find_by_email(string $email): ?self
    {
        $sql = "SELECT * FROM members WHERE email = :email LIMIT 1";
        $stmt = self::$database->prepare($sql);
        $stmt->execute([':email' => $email]);

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? self::from_row($row) : null;
    }

    private static function from_row(array $row): self
    {
        $member = new self();
        $member->id = (int) $row['id'];
        $member->first_name = $row['first_name'];
        $member->last_name = $row['last_name'];
        $member->email = $row['email'];
        $member->username = $row['username'];
        $member->password_hash = $row['password_hash'];
        $member->role = $row['role'];

        return $member;
    }
}
