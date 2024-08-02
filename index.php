<?php
session_start();

// Autocarga de clases del controlador y del modelo
spl_autoload_register(function ($class_name) {
    if (file_exists('app/Controller/' . $class_name . '.php')) {
        require_once 'app/Controller/' . $class_name . '.php';
    } elseif (file_exists('app/Model/' . $class_name . '.php')) {
        require_once 'app/Model/' . $class_name . '.php';
    }
});

// Obtener la URI y dividirla en segmentos
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', trim($uri, '/'));

// Enrutamiento dinámico
$controller = null;

if (isset($uri[0]) && $uri[0] == 'conecter') {
    if (isset($uri[1])) {
        switch ($uri[1]) {
            case '':
                $controller = new AuthController();
                $controller->index();
                break;
            case 'login':
                $controller = new AuthController();
                $controller->login();
                break;
            case 'register':
                $controller = new AuthController();
                $controller->register();
                break;
            case 'dashboard':
                if (isset($_SESSION['user_id'])) {
                    $controller = new AuthController();
                    $controller->dashboard();
                } else {
                    header('Location: /conecter/login');
                }
                break;
            case 'edit_profile':
                if (isset($_SESSION['user_id'])) {
                    require_once 'app/Controller/UserController.php';
                    $controller = new UserController();
                    $controller->editProfile();
                } else {
                    header('Location: /conecter/login');
                }
                break;
            case 'group':
                if (isset($uri[2])) {
                    switch ($uri[2]) {
                        case 'create':
                            require_once 'app/Controller/GroupController.php';
                            $controller = new GroupController();
                            $controller->create();
                            break;
                        case 'store':
                            require_once 'app/Controller/GroupController.php';
                            $controller = new GroupController();
                            $controller->store();
                            break;
                        case 'show':
                            if (isset($uri[3])) {
                                $controller = new GroupController();
                                $controller->show($uri[3]); // Muestra un grupo específico
                            } else {
                                echo "404 Not Found";
                            }
                            break;
                        case 'update':
                            require_once 'app/Controller/GroupController.php';
                            $controller = new GroupController();
                            $controller->update($namelink);
                            break;
                        case 'join':
                            if (isset($uri[3])) {
                                require_once 'app/Controller/GroupController.php';
                                $controller = new GroupController();
                                $controller->join($uri[3]);
                            } else {
                                echo "404 Not Found";
                            }
                            break;
                        case 'leave':
                            if (isset($uri[3])) {
                                require_once 'app/Controller/GroupController.php';
                                $controller = new GroupController();
                                $controller->leave($uri[3]);
                            } else {
                                echo "404 Not Found";
                            }
                            break;
                        case 'update-settings':
                            if (isset($uri[3])) {
                                require_once 'app/Controller/GroupController.php';
                                $controller = new GroupController();
                                $controller->updateSettings($uri[3]);
                            } else {
                                echo "404 Not Found";
                            }
                            break;
                        case 'remove-member':
                            if (isset($uri[3]) && isset($uri[4])) {
                                require_once 'app/Controller/GroupController.php';
                                $controller = new GroupController();
                                $controller->removeMember($uri[3], $uri[4]);
                            } else {
                                echo "404 Not Found";
                            }
                            break;
                        case 'add-post':
                            if (isset($uri[3])) {
                                require_once 'app/Controller/GroupController.php';
                                $controller = new GroupController();
                                $controller->addPost($uri[3]);
                            } else {
                                echo "404 Not Found";
                            }
                            break;
                        case 'remove-post':
                            if (isset($uri[3])) {
                                require_once 'app/Controller/GroupController.php';
                                $controller = new GroupController();
                                $controller->removePost($uri[3]);
                            } else {
                                echo "404 Not Found";
                            }
                            break;
                        default:
                            echo "404 Not Found";
                            break;
                    }
                } else {
                    // Acciones para mostrar la lista de grupos
                    require_once 'app/Controller/GroupController.php';
                    $controller = new GroupController();
                    $controller->index();
                }
                break;
            case 'g':
                require_once 'app/Controller/GroupController.php';
                $controller = new GroupController();
                if (isset($uri[2])) {
                    if (isset($uri[3])) {
                        switch ($uri[3]) {
                            case 'edit':
                                $controller->edit($uri[2]); // Ruta para editar un grupo
                                break;
                            case 'manage':
                                $controller->manage($uri[2]); // Ruta para administrar un grupo
                                break;
                            case 'add-post':
                                $controller->addPost($uri[3]);
                                break;
                            default:
                                $controller->show($uri[2]); // Muestra un grupo específico
                                break;
                        }
                    } else {
                        $controller->show($uri[2]); // Muestra un grupo específico
                    }
                } else {
                    echo "404 Not Found";
                }
                break;

            case 'create-group':
                require_once 'app/Controller/GroupController.php';
                $controller = new GroupController();
                $controller->create();
                break;
            case 'store-group':
                require_once 'app/Controller/GroupController.php';
                $controller = new GroupController();
                $controller->store();
                break;
            case 'join-group':
                if (isset($uri[2])) {
                    require_once 'app/Controller/GroupController.php';
                    $controller = new GroupController();
                    $controller->join($uri[2]);
                } else {
                    echo "404 Not Found";
                }
                break;
            case 'leave-group':
                if (isset($uri[2])) {
                    require_once 'app/Controller/GroupController.php';
                    $controller = new GroupController();
                    $controller->leave($uri[2]);
                } else {
                    echo "404 Not Found";
                }
                break;
            case 'search':
                $controller = new SearchController();
                $controller->search();
                break;
            case 'apt':
                require_once 'app/controller/ApunteController.php';
                $controller = new ApunteController();
                if (isset($uri[2])) {
                    switch ($uri[2]) {
                        case 'upload':
                            $controller->showUploadForm();
                            break;
                        case 'storeApunte':
                            $controller->storeApunte();
                            break;
                        case 'list':
                            $controller->listApuntes();
                            break;
                        case 'view':
                            if (isset($uri[3])) {
                                $apunteId = intval($uri[3]);
                                $controller->viewApunte($apunteId);
                            } else {
                                echo "404 Not Found";
                            }
                            break;
                        case 'toggleLike':
                            $controller->toggleLike();
                            break;
                        case 'user':
                            if (isset($uri[3])) {
                                $user_id = intval($uri[3]);
                                $controller->showApuntesByUserId($user_id);
                            } else {
                                echo "404 Not Found";
                            }
                            break;
                        default:
                            echo "404 Not Found";
                            break;
                    }
                } else {
                    $controller->listApuntes();
                }
                break;
            case 'logout':
                $controller = new AuthController();
                $controller->logout();
                break;
            default:
                if (substr($uri[1], 0, 1) == '@') {
                    $username = substr($uri[1], 1);
                    $controller = new AuthController();
                    $controller->profile($username);
                } else {
                    echo "404 Not Found";
                }
                break;
        }
    } else {
        $controller = new AuthController();
        $controller->index();
    }
}
?>
