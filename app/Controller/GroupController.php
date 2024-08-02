<?php
require_once 'app/model/GroupModel.php';

class GroupController
{
    public function index()
    {
        $groupModel = new GroupModel();
        $groups = $groupModel->getAllGroups();
        require_once 'app/views/group/index.php';
    }

    public function show($namelink) {
        $groupModel = new GroupModel();
        $group = $groupModel->getGroupByNamelink($namelink);
        if (!$group) {
            echo "Grupo no encontrado";
            return;
        }

        $userRole = 'guest'; // Valor por defecto para usuarios no miembros
        if (isset($_SESSION['user_id'])) {
            $userRole = $groupModel->getUserRoleInGroup($group['id'], $_SESSION['user_id']);
        }

        $members = $groupModel->getGroupMembers($group['id']);
        $posts = $groupModel->getGroupPosts($group['id']);
        require_once 'app/views/group/show.php';
    }

    public function create()
    {
        require_once 'app/views/group/create.php';
    }
    private function generateNamelink($name)
    {
        // Función para generar un enlace único basado en el nombre del grupo
        return strtolower(preg_replace('/[^a-zA-Z0-9]+/', '-', $name));
    }
    public function store()
    {
        $groupModel = new GroupModel();

        // Obtener los datos del formulario
        $name = $_POST['name'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $creatorId = $_SESSION['user_id']; // Asumiendo que el ID del usuario está almacenado en la sesión

        // Generar el namelink único
        $namelink = $this->generateNamelink($name);

        // Guardar la imagen de portada
        $imagePath = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $imagePath = 'public/img/groups/' . $namelink . '/cover/';
            if (!file_exists($imagePath)) {
                mkdir($imagePath, 0777, true);
            }
            $imagePath .= basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
        }

        // Insertar el nuevo grupo en la base de datos
        $groupModel->createGroup($name, $description, $type, $namelink, $imagePath);

        // Obtener el ID del grupo recién creado
        $groupId = $groupModel->getGroupByNamelink($namelink)['id'];

        // Agregar el creador del grupo como miembro y administrador
        $groupModel->addMember($groupId, $creatorId, 'admin');

        // Redirigir a la página del grupo
        header('Location: /conecter/g/' . $namelink);
    }




    public function join($groupId)
    {
        $groupModel = new GroupModel();
        $userId = $_SESSION['user_id'];
        $groupModel->joinGroup($groupId, $userId);
        header('Location: /conecter/group/' . $groupId);
    }

    public function leave($groupId)
    {
        $groupModel = new GroupModel();
        $userId = $_SESSION['user_id'];
        $groupModel->leaveGroup($groupId, $userId);
        header('Location: /conecter/group/' . $groupId);
    }

    public function requestJoin($groupId)
    {
        $groupModel = new GroupModel();
        $userId = $_SESSION['user_id'];
        $groupModel->requestJoinGroup($groupId, $userId);
        header('Location: /conecter/group/' . $groupId);
    }

    public function approveRequest($requestId)
    {
        $groupModel = new GroupModel();
        $groupModel->approveJoinRequest($requestId);
        header('Location: /conecter/group/requests');
    }

    public function rejectRequest($requestId)
    {
        $groupModel = new GroupModel();
        $groupModel->rejectJoinRequest($requestId);
        header('Location: /conecter/group/requests');
    }

    public function makeAdmin($groupId, $userId)
    {
        $groupModel = new GroupModel();
        $groupModel->makeAdmin($groupId, $userId);
        header('Location: /conecter/group/' . $groupId);
    }

    public function blockUser($groupId, $userId)
    {
        $groupModel = new GroupModel();
        $groupModel->blockUser($groupId, $userId);
        header('Location: /conecter/group/' . $groupId);
    }

    public function unblockUser($groupId, $userId)
    {
        $groupModel = new GroupModel();
        $groupModel->unblockUser($groupId, $userId);
        header('Location: /conecter/group/' . $groupId);
    }
    public function edit($namelink)
    {
        $groupModel = new GroupModel();
        $group = $groupModel->getGroupByNamelink($namelink);
        if (!$group) {
            echo "Grupo no encontrado";
            return;
        }
        require_once 'app/views/group/edit.php';
    }

    public function update($namelink)
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /conecter/login');
            exit();
        }

        $groupId = $_POST['group_id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        $type = $_POST['type'];

        $groupModel = new GroupModel();
        $group = $groupModel->getGroupByNamelink($namelink);



        $imagePath = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $targetDir = "public/images/group/$namelink/cover/";
            $imagePath = $targetDir . basename($_FILES["image"]["name"]);
            move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
        }

        $groupModel = new GroupModel();
        try {
            $namelink = $groupModel->updateGroup($groupId, $name, $description, $type, $imagePath);
            echo json_encode(['status' => 'success', 'namelink' => $namelink]);
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
    public function manage($namelink) {
        $groupModel = new GroupModel();
        $group = $groupModel->getGroupByNamelink($namelink);
        if (!$group) {
            echo "Grupo no encontrado";
            return;
        }

        $userRole = 'guest'; // Valor por defecto para usuarios no miembros
        if (isset($_SESSION['user_id'])) {
            $userRole = $groupModel->getUserRoleInGroup($group['id'], $_SESSION['user_id']);
        }

        $members = $groupModel->getGroupMembers($group['id']);
        $posts = $groupModel->getGroupPosts($group['id']);
        $settings = $groupModel->getGroupSettings($group['id']);
        require_once 'app/views/group/manage.php';
    }

    public function updateSettings($namelink)
    {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $groupModel = new GroupModel();
        try {
            $groupModel->updateGroupSettings($namelink, $name, $description, $type);
            header("Location: /conecter/g/$namelink/manage");
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function removeMember($namelink, $userId)
    {
        $groupModel = new GroupModel();
        $group = $groupModel->getGroupByNamelink($namelink);
        if (!$group) {
            echo "Grupo no encontrado";
            return;
        }
        try {
            $groupModel->removeGroupMember($group['id'], $userId);
            header("Location: /conecter/g/$namelink/manage");
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function addPost($namelink)
    {
        $content = $_POST['content'];
        $userId = $_SESSION['user_id'];
        $groupModel = new GroupModel();
        $group = $groupModel->getGroupByNamelink($namelink);
        if (!$group) {
            echo "Grupo no encontrado";
            return;
        }
        try {
            $groupModel->addGroupPost($group['id'], $userId, $content);
            header("Location: /conecter/g/$namelink/manage");
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function removePost($postId)
    {
        $groupModel = new GroupModel();
        try {
            $groupModel->removeGroupPost($postId);
            header('Location: /conecter/group/manage/' . $postId);
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
