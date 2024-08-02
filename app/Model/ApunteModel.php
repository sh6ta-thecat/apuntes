<?php

class ApunteModel {
    private $conn;

    public function __construct() {
        require 'conn.php';
        $this->conn = $conn;
    }

    public function addApunte($apunteDetails) {
        $stmt = $this->conn->prepare("INSERT INTO apuntes (nombre, descripcion, archivo, tipo, fecha, tags, user_id) VALUES (?, ?, ?, ?, NOW(), ?, ?)");
        $stmt->bind_param("sssssi", 
            $apunteDetails['nombre'], 
            $apunteDetails['descripcion'], 
            $apunteDetails['archivo'], 
            $apunteDetails['tipo'], 
            $apunteDetails['tags'], 
            $apunteDetails['user_id']
        );
        $stmt->execute();
    }

    public function getApuntesByUserId($user_id) {
        $stmt = $this->conn->prepare("SELECT * FROM apuntes WHERE user_id = ?");
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getApuntesById($apunteId) {
        $stmt = $this->conn->prepare("SELECT apuntes.*, users.screenname FROM apuntes 
        JOIN users ON apuntes.user_id = users.id 
        WHERE apuntes.id = ?");
        $stmt->bind_param("i", $apunteId);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function incrementView($apunteId, $userId) {
        $stmt = $this->conn->prepare("INSERT IGNORE INTO apunte_views (apunte_id, user_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $apunteId, $userId);
        $stmt->execute();

        $stmt = $this->conn->prepare("SELECT COUNT(*) AS views FROM apunte_views WHERE apunte_id = ?");
        $stmt->bind_param("i", $apunteId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['views'];
    }

    public function toggleLike($apunteId, $userId) {
        $this->conn->begin_transaction();

        $stmt = $this->conn->prepare("SELECT COUNT(*) AS liked FROM apunte_likes WHERE apunte_id = ? AND user_id = ?");
        $stmt->bind_param("ii", $apunteId, $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row['liked'] > 0) {
            $stmt = $this->conn->prepare("DELETE FROM apunte_likes WHERE apunte_id = ? AND user_id = ?");
            $stmt->bind_param("ii", $apunteId, $userId);
            $stmt->execute();
        } else {
            $stmt = $this->conn->prepare("INSERT INTO apunte_likes (apunte_id, user_id) VALUES (?, ?)");
            $stmt->bind_param("ii", $apunteId, $userId);
            $stmt->execute();
        }

        $stmt = $this->conn->prepare("SELECT COUNT(*) AS likes FROM apunte_likes WHERE apunte_id = ?");
        $stmt->bind_param("i", $apunteId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $this->conn->commit();
        return $row['likes'];
    }
    public function getApuntesByUser($user_id) {
        $query = "SELECT * FROM apuntes WHERE user_id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $apuntes = $result->fetch_all(MYSQLI_ASSOC);
        $stmt->close();
        return $apuntes;
    }

}
