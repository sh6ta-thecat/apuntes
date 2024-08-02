<?php
class ApunteController {
    private $apunteModel;
    private $userModel;

    public function __construct() {
        $this->apunteModel = new ApunteModel();
        $this->userModel = new UserModel();
    }

    public function showUploadForm() {
        include 'app/views/apuntes/upload.php';
    }

    public function storeApunte() {
        if (isset($_FILES['archivo'])) {
            $nombre = $_POST['nombre'];
            $descripcion = $_POST['descripcion'];
            $tags = $_POST['tags'];
            $user_id = $_SESSION['user_id'];
            $user = $this->userModel->getUserById($user_id);
            $screenname = $user['screenname'];

            $filename = $_FILES['archivo']['name'];
            $fileTmpName = $_FILES['archivo']['tmp_name'];
            $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);
            $fileMimeType = mime_content_type($fileTmpName);

            $newFileName = uniqid() . '.' . $fileExtension;
            $uploadDir = "public/archivos/apuntes/$screenname/";

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $uploadPath = $uploadDir . $newFileName;

            if (move_uploaded_file($fileTmpName, $uploadPath)) {
                $apunteDetails = [
                    'nombre' => $nombre,
                    'descripcion' => $descripcion,
                    'archivo' => $uploadPath,
                    'tipo' => $fileMimeType,
                    'tags' => $tags,
                    'user_id' => $user_id
                ];
                $this->apunteModel->addApunte($apunteDetails);
                header('Location: index.php?action=listApuntes');
                exit();
            } else {
                echo "Error al subir el archivo.";
            }
        } else {
            echo "No se ha seleccionado ningún archivo.";
        }
    }

    public function listApuntes() {
        $user_id = $_SESSION['user_id'];
        $apuntes = $this->apunteModel->getApuntesByUserId($user_id);
        include 'app/views/apuntes/index.php';
    }

    public function viewApunte($apunteId) {
        $user_id = $_SESSION['user_id'];
        $apunte = $this->apunteModel->getApuntesById($apunteId);

        if (!$apunte) {
            echo "Apunte no encontrado";
            return;
        }

        // Incrementar vista solo si no se ha visto antes
        $views = $this->apunteModel->incrementView($apunteId, $user_id);
        $apunte['views'] = $views;

        // Manejar likes
        $likes = $this->apunteModel->toggleLike($apunteId, $user_id);
        $apunte['likes'] = $likes;

        require_once 'app/views/apuntes/view.php';
    }
    public function toggleLike() {
        if (!isset($_SESSION['user_id'])) {
            echo json_encode(['success' => false]);
            exit();
        }

        $apunteId = $_POST['apunte_id'];
        $userId = $_SESSION['user_id'];

        $result = $this->apunteModel->toggleLike($apunteId, $userId);
        $apunte = $this->apunteModel->getApuntesById($apunteId);

        $response = [
            'success' => $result,
            'likes' => $apunte['likes'],
            'liked' => $apunte['liked']
        ];

        echo json_encode($response);
        exit();
    }
    public function showApuntesByUserId($user_id) {
        $apuntes = $this->apunteModel->getApuntesByUserId($user_id);
        include 'app/views/apuntes/user_apunte.php';
    }
}
