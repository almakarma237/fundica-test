<?php
class Database
{
    protected $connection = null;
    public function __construct(
        private string $host,
        private string $user,
        private string $password,
        private string $name,
    ) {
        try {
            $this->connection = new mysqli($host, $user, $password);

            if (mysqli_connect_errno()) {
                throw new Exception("Could not connect to database.");
            }

            // Create database
            $sql = "CREATE DATABASE IF NOT EXISTS " .DB_NAME;
            if ($this->connection->query($sql) === TRUE) {
                // echo "Database created successfully";
            } else {
                // echo "Error creating database: " . $this->connection->error;
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function getConnection(): mysqli
    {
        // Create connection
        $conn = new mysqli($this->host, $this->user, $this->password, $this->name);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // echo "Connected successfully";

        return $conn;
    }
}