<?php
require_once 'app/model/UserModel.php';

class AuthController {
    public function __construct() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        if (isset($_SESSION['user_id'])) {
            $this->dashboard();
        } else {
            require_once 'app/views/login.php';
        }
    }

    public function login() {
        $userModel = new UserModel();
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        if ($email && $password) {
            $user = $userModel->login($email, $password);
            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['screenname'];
                header('Location: /conecter/dashboard');
                exit();
            } else {
                echo "Invalid email or password";
            }
        } else {
            echo "Please provide email and password";
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Obtiene los datos del formulario
            $firstName = $_POST['first_name'] ?? null;
            $lastName = $_POST['last_name'] ?? null;
            $email = ($_POST['email'] ?? null);
            $semester = $_POST['semester'] ?? null;
            $careerId = $_POST['career_id'] ?? null;
            $password = $_POST['password'] ?? null;
            $defaultImage = 'public/imges/users/default.gif';

            // Verifica si todos los campos están presentes
            if ($firstName && $lastName && $email && $semester && $careerId && $password) {
                $password = password_hash($password, PASSWORD_DEFAULT);

                $userModel = new UserModel();
                $userId = $userModel->registerUser($firstName, $lastName, $email, $semester, $careerId, $password, $defaultImage);

                // Generar screen name y actualizar el usuario
                $screenName = $firstName;
                $userModel->updateScreenName($userId, $screenName);

                // Crear carpeta para el usuario si no existe
                $userDir = "public/img/users/$screenName";
                if (!file_exists($userDir)) {
                    mkdir($userDir, 0777, true);
                }

                // Redirige al usuario a la página de login
                header('Location: /conecter');
                exit();
            } else {
                echo "Please fill all required fields.";
            }
        } else {
            require_once 'app/views/register.php';
        }
    }

    public function dashboard() {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /conecter/');
            exit();
        }
        require_once 'app/views/dashboard.php';
    }

    public function profile($username) {
        $userModel = new UserModel();
        $user = $userModel->getUserByUsername($username);
        if ($user) {
            require_once 'app/views/profile.php';
        } else {
            echo "User not found";
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        header('Location: /conecter/');
        exit();
    }
}
?>
