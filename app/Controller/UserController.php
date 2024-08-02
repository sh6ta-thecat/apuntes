<?php
require_once 'app/model/UserModel.php';

class UserController
{

    private $userModel;
    private $apunteModel;

    public function profile($username)
    {
        $userModel = new UserModel();
        $user = $userModel->getUserByUsername($username);
        if ($user) {
            require_once 'app/views/profile.php';
        } else {
            echo "User not found";
        }
    }

    public function editProfile()
    {
        if (!isset($_SESSION['user_id'])) {
            header('Location: /conecter/login');
            exit();
        }
        $userModel = new UserModel();
        $user = $userModel->getUserById($_SESSION['user_id']);
        require_once 'app/views/edit_profile.php';
    }

    // UserController.php

    public function showEditProfile()
    {
        $userModel = new UserModel();
        $user = $userModel->getUserById($_SESSION['user_id']); // Assuming user ID is stored in session
        include 'views/editProfile.php';
    }

    public function updateProfile()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userModel = new UserModel();

            // Get user input
            $name = $_POST['name'];
            $last_name = $_POST['last_name'];
            $email = $_POST['email'];
            $institutional_email = $_POST['institutional_email'];
            $semester = $_POST['semester'];
            $career_id = $_POST['career_id'];
            $screen_name = $_POST['screen_name'];

            // You might also want to handle file uploads here for profile images

            // Update user in the database
            $userModel->updateUser($_SESSION['user_id'], $name, $last_name, $email, $institutional_email, $semester, $career_id, $screen_name);

            // Redirect to profile or dashboard
            header('Location: dashboard.php');
        }
    }
    public function showApuntesByUserId($user_id) {
        $apuntes = $this->apunteModel->getApuntesByUserId($user_id);
        include 'app/views/apuntes/user_apuntes.php';
    }
}
