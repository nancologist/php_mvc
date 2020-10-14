<?php
class User {
    private $db;

    public function __construct() {
        $this->db = new Database;
    }

    public function findUserByEmail($email) {
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single(); // Hä?! Wofür ist das?!
        $userExists = $this->db->rowCount() > 0;
        return $userExists;
    }
}