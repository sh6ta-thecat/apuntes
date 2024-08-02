<?php

class UserModel {
    private $conn;

    public function __construct() {
        require 'conn.php';
        $this->conn = $conn;
    }

    public function login($email, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }

    public function registerUser($name, $lastName, $email, $semester, $careerId, $password, $defaultImage) {
        $stmt = $this->conn->prepare("INSERT INTO users (name, last_name, email, semester, career_id, password, image_path) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param('sssssss', $name, $lastName, $email, $semester, $careerId, $password, $defaultImage);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function updateScreenName($userId, $screenname) {
        $stmt = $this->conn->prepare("UPDATE users SET screenname = ? WHERE id = ?");
        $stmt->bind_param('si', $screenname, $userId);
        $stmt->execute();
    }

    public function getUserById($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
    public function updateUser($user_id, $name, $last_name, $email, $institutional_email, $semester, $career_id, $screen_name) {
        $stmt = $this->conn->prepare("UPDATE users SET name = ?, last_name = ?, email = ?, institutional_email = ?, semester = ?, career_id = ?, screen_name = ? WHERE id = ?");
        $stmt->bind_param('ssssiisi', $name, $last_name, $email, $institutional_email, $semester, $career_id, $screen_name, $user_id);
        return $stmt->execute();
    }

    public function getUserByUsername($username) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE screenname = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function searchUsers($query) {
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE name LIKE ? OR last_name LIKE ? OR screen_name LIKE ?");
        $likeQuery = '%' . $query . '%';
        $stmt->bind_param('sss', $likeQuery, $likeQuery, $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();
        $users = [];
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
        return $users;
    }
    
}
?>
