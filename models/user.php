<?php
class Event {

    private $conn;
    private $table = "user";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Fetch all events
    public function getAllUsers() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY user_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>
