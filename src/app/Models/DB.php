<?php
namespace App\Models;

use PDO;

class DB extends PDO
{
    const HOST = 'localhost';
    const PORT = '3306';
    const USER = 'root';
    const PASS = '13579@Ser8642';
    const DB_NAME = 'random_numbers';

    private static $_db;
    private static $stmt;
    private static $error;

    /**
     * @return PDO
     */
    public static function getDBConnect(): PDO
    {
        $dsn = "mysql:host=" . self::HOST . ";port=" . self::PORT . ";dbname=" . self::DB_NAME;
        $option = array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

        try {
            self::$_db = new PDO($dsn, self::USER, self::PASS, $option);
        } catch (\PDOException $e) {
            echo $e->getMessage();
            self::$error = $e->getMessage();
        }

        return self::$_db;
    }

    /**
     * @param string $table
     * @return array
     */
    public static function getAll(string $table): array
    {
        self::$stmt = self::getDBConnect()->prepare("SELECT * FROM $table");
        self::$stmt->execute();

        $staffsData = array();
        while ($d = self::$stmt->fetchAll(PDO::FETCH_ASSOC)) {
            $staffsData[] = $d;
        }
        return $staffsData;
    }

    /**
     * @param string $table
     * @param int $id
     * @return mixed
     */
    public static function getById(string $table, int $id)
    {
        if (!self::checkRecord($id)) {
            return "Record not exist";
        }
        self::$stmt = self::getDBConnect()->prepare("SELECT * FROM $table WHERE id=$id");
        self::$stmt->execute();
        return self::$stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @return string
     */
    public static function insertData(): string
    {
        $randomNum = rand(1, 100);
        self::$stmt = self::getDBConnect()->prepare("INSERT INTO random_numbers (number) VALUES ('$randomNum')");
        self::$stmt->execute();
        return "Created";
    }

    /**
     * @param int $id
     * @return string
     */
    public static function updateData(int $id): string
    {
        parse_str(file_get_contents("php://input"), $post);
        $randomNum = rand(1, 100);
        if (!self::checkRecord($id)) {
            return "Record not exist";
        }
        self::$stmt = self::getDBConnect()->prepare("UPDATE random_numbers SET number='$randomNum' WHERE id=$id");
        self::$stmt->execute();

        return "Updated";
    }

    /**
     * @param int $id
     * @return string
     */
    public static function deleteData(int $id): string
    {
        self::$stmt = self::getDBConnect()->prepare("DELETE FROM random_numbers WHERE id=$id");
        self::$stmt->execute();

        return "Deleted";
    }

    /**
     * @param int $id
     * @return bool
     */
    private static function checkRecord(int $id): bool
    {
        $stmt = self::getDBConnect()->prepare("SELECT id FROM random_numbers WHERE id = $id");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$row) {
            return false;
        }
        return true;
    }

}

