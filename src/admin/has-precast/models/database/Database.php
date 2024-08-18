<?php
class Database
{
    private $connection;

    public function __construct(array $config)
    {
        extract($config);
        try {
            $this->connection = new PDO("$DB:host=$DB_HOST;dbname=$DB_NAME", $DB_USER, $DB_PASS);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
