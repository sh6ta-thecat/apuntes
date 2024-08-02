<?php
require_once 'app/model/UserModel.php';

class SearchController {
    public function search() {
        if (!isset($_GET['query'])) {
            echo "No search query provided.";
            return;
        }

        $query = $_GET['query'];
        $userModel = new UserModel();
        $users = $userModel->searchUsers($query);
        require_once 'app/views/search_results.php'; // Asegúrate de tener esta vista creada
    }
}
?>
