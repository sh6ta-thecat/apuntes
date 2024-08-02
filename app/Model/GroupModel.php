<?php
class GroupModel {
    private $conn;

    public function __construct() {
        require 'conn.php';
        $this->conn = $conn;
    }

    public function getAllGroups() {
        $sql = "SELECT * FROM groups";
        $result = $this->conn->query($sql);
        $groups = [];
        while ($row = $result->fetch_assoc()) {
            $groups[] = $row;
        }
        return $groups;
    }

    public function getGroupByNamelink($namelink) {
        $namelink = $this->conn->real_escape_string($namelink);
        $sql = "SELECT * FROM groups WHERE namelink = '$namelink'";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    public function getGroupPosts($groupId) {
        $groupId = (int)$groupId;
        $sql = "SELECT * FROM group_posts WHERE group_id = $groupId";
        $result = $this->conn->query($sql);
        $posts = [];
        while ($row = $result->fetch_assoc()) {
            $posts[] = $row;
        }
        return $posts;
    }
    public function updateGroupImage($groupId, $imagePath) {
        $groupId = (int)$groupId;
        $imagePath = $this->conn->real_escape_string($imagePath);
        $sql = "UPDATE groups SET image_path = '$imagePath' WHERE id = $groupId";
        if ($this->conn->query($sql) === FALSE) {
            throw new Exception("Error al actualizar la imagen del grupo: " . $this->conn->error);
        }
    }
    
    public function createGroup($name, $description, $type, $adminId, $imagePath) {
        $adminId = (int)$adminId;
        $userCheckSql = "SELECT * FROM users WHERE id = $adminId";
        $userCheckResult = $this->conn->query($userCheckSql);
    
        if ($userCheckResult->num_rows === 0) {
            throw new Exception("Usuario con ID $adminId no existe.");
        }
    
        $namelink = $this->conn->real_escape_string($name);
        $checkNamelinkSql = "SELECT * FROM groups WHERE namelink = '$namelink'";
        $checkNamelinkResult = $this->conn->query($checkNamelinkSql);
    
        while ($checkNamelinkResult->num_rows > 0) {
            $namelink = $name . chr(rand(65, 90));
            $checkNamelinkSql = "SELECT * FROM groups WHERE namelink = '$namelink'";
            $checkNamelinkResult = $this->conn->query($checkNamelinkSql);
        }
    
        $name = $this->conn->real_escape_string($name);
        $description = $this->conn->real_escape_string($description);
        $type = $this->conn->real_escape_string($type);
        $imagePath = $this->conn->real_escape_string($imagePath);
        
        $sql = "INSERT INTO groups (name, description, type, admin_id, image_path, namelink) 
                VALUES ('$name', '$description', '$type', $adminId, '$imagePath', '$namelink')";
        if ($this->conn->query($sql) === TRUE) {
            return ['id' => $this->conn->insert_id, 'namelink' => $namelink];
        } else {
            throw new Exception("Error al crear el grupo: " . $this->conn->error);
        }
    }
    
    

    public function joinGroup($groupId, $userId) {
        $groupId = (int)$groupId;
        $userId = (int)$userId;
        $sql = "INSERT INTO group_members (group_id, user_id) VALUES ($groupId, $userId)";
        if ($this->conn->query($sql) === FALSE) {
            throw new Exception("Error al unirse al grupo: " . $this->conn->error);
        }
    }

    public function leaveGroup($groupId, $userId) {
        $groupId = (int)$groupId;
        $userId = (int)$userId;
        $sql = "DELETE FROM group_members WHERE group_id = $groupId AND user_id = $userId";
        if ($this->conn->query($sql) === FALSE) {
            throw new Exception("Error al dejar el grupo: " . $this->conn->error);
        }
    }

    public function requestJoinGroup($groupId, $userId) {
        $groupId = (int)$groupId;
        $userId = (int)$userId;
        $sql = "INSERT INTO group_join_requests (group_id, user_id) VALUES ($groupId, $userId)";
        if ($this->conn->query($sql) === FALSE) {
            throw new Exception("Error al solicitar unirse al grupo: " . $this->conn->error);
        }
    }

    public function approveJoinRequest($requestId) {
        $requestId = (int)$requestId;
        $sql = "UPDATE group_join_requests SET status = 'approved' WHERE id = $requestId";
        if ($this->conn->query($sql) === FALSE) {
            throw new Exception("Error al aprobar la solicitud de unión: " . $this->conn->error);
        }
    }

    public function rejectJoinRequest($requestId) {
        $requestId = (int)$requestId;
        $sql = "UPDATE group_join_requests SET status = 'rejected' WHERE id = $requestId";
        if ($this->conn->query($sql) === FALSE) {
            throw new Exception("Error al rechazar la solicitud de unión: " . $this->conn->error);
        }
    }

    public function makeAdmin($groupId, $userId) {
        $groupId = (int)$groupId;
        $userId = (int)$userId;
        $sql = "UPDATE group_members SET is_admin = 1 WHERE group_id = $groupId AND user_id = $userId";
        if ($this->conn->query($sql) === FALSE) {
            throw new Exception("Error al hacer administrador al usuario: " . $this->conn->error);
        }
    }
    public function getGroupMembers($groupId) {
        $groupId = (int)$groupId;
        $sql = "SELECT * FROM group_members WHERE group_id = $groupId";
        $result = $this->conn->query($sql);
        $members = [];
        while ($row = $result->fetch_assoc()) {
            $members[] = $row;
        }
        return $members;
    }
    public function blockUser($groupId, $userId) {
        $groupId = (int)$groupId;
        $userId = (int)$userId;
        $sql = "UPDATE group_members SET is_blocked = 1 WHERE group_id = $groupId AND user_id = $userId";
        if ($this->conn->query($sql) === FALSE) {
            throw new Exception("Error al bloquear al usuario: " . $this->conn->error);
        }
    }

    public function unblockUser($groupId, $userId) {
        $groupId = (int)$groupId;
        $userId = (int)$userId;
        $sql = "UPDATE group_members SET is_blocked = 0 WHERE group_id = $groupId AND user_id = $userId";
        if ($this->conn->query($sql) === FALSE) {
            throw new Exception("Error al desbloquear al usuario: " . $this->conn->error);
        }
    }
    public function updateGroup($groupId, $name, $description, $type, $imagePath) {
        $groupId = (int)$groupId;
        $name = $this->conn->real_escape_string($name);
        $description = $this->conn->real_escape_string($description);
        $type = $this->conn->real_escape_string($type);
    
        $sql = "UPDATE groups SET name='$name', description='$description', type='$type'";
    
        if ($imagePath !== null) {
            $imagePath = $this->conn->real_escape_string($imagePath);
            $sql .= ", image='$imagePath'";
        }
    
        $sql .= " WHERE id=$groupId";
    
        if ($this->conn->query($sql) === TRUE) {
            $sql = "SELECT namelink FROM groups WHERE id=$groupId";
            $result = $this->conn->query($sql);
            $row = $result->fetch_assoc();
            return $row['namelink'];
        } else {
            throw new Exception("Error al actualizar el grupo: " . $this->conn->error);
        }
    }
    
    public function getGroupSettings($groupId) {
        $groupId = (int)$groupId;
        $sql = "SELECT * FROM groups WHERE id = $groupId";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }
    
    public function updateGroupSettings($namelink, $name, $description, $type) {
        $namelink = $this->conn->real_escape_string($namelink);
        $name = $this->conn->real_escape_string($name);
        $description = $this->conn->real_escape_string($description);
        $type = $this->conn->real_escape_string($type);
    
        $sql = "UPDATE groups SET name = '$name', description = '$description', type = '$type' WHERE namelink = '$namelink'";
        if ($this->conn->query($sql) === FALSE) {
            throw new Exception("Error al actualizar la configuración del grupo: " . $this->conn->error);
        }
    }
    public function removeGroupMember($groupId, $userId) {
        $groupId = (int)$groupId;
        $userId = (int)$userId;
        $sql = "DELETE FROM group_members WHERE group_id = $groupId AND user_id = $userId";
        if ($this->conn->query($sql) === FALSE) {
            throw new Exception("Error al eliminar al miembro del grupo: " . $this->conn->error);
        }
    }
    
    public function addGroupPost($groupId, $userId, $content) {
        $groupId = (int)$groupId;
        $userId = (int)$userId;
        $content = $this->conn->real_escape_string($content);
    
        $sql = "INSERT INTO group_posts (group_id, user_id, content) VALUES ($groupId, $userId, '$content')";
        if ($this->conn->query($sql) === FALSE) {
            throw new Exception("Error al agregar la publicación del grupo: " . $this->conn->error);
        }
    }
    
    public function removeGroupPost($postId) {
        $postId = (int)$postId;
        $sql = "DELETE FROM group_posts WHERE id = $postId";
        if ($this->conn->query($sql) === FALSE) {
            throw new Exception("Error al eliminar la publicación del grupo: " . $this->conn->error);
        }
    }
    public function addMember($groupId, $userId, $role) {
        
        $sql = "INSERT INTO group_members (group_id, user_id, role) VALUES (:group_id, :user_id, :role)";;
        $result = $this->conn->query($sql);
    }


    public function getUserRoleInGroup($groupId, $userId) {
        $sql = "SELECT role FROM group_members WHERE group_id = ? AND user_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param('ii', $groupId, $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row ? $row['role'] : 'guest';
    }

}
?>
