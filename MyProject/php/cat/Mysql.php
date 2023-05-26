<?php
namespace MyProject\php\cat;

class Mysql {

  
    private static ?Mysql $instance = null;

    public static function getInstance(): Mysql {
        if (!self::$instance) {
            self::$instance = new Mysql();
        }
        return self::$instance;
    }

    private \mysqli $db;

    private function __construct() {  
        $this->connect(); //-> connect establishes a connection to the MySQL database
    }

    private function connect(): void {
        // Mysqli-Objekt erstellen und Verbindung aufbauen
        $this->db = new \mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
        // Zeichensatz mitteilen
        $this->db->set_charset("utf8");
    }

    public function escape(string $value): string {
        return $this->db->real_escape_string($value);
    }

    public function query(string $sqlQuery): \mysqli_result|bool {
        $result = $this->db->query($sqlQuery);
        return $result;
    }
}
