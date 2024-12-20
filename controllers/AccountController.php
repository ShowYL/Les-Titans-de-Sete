<?php
require_once __DIR__ . '/../models/UserModel.php';

class AccountController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function createAccount($nomUtilisateur, $password) {
        if ($this->userModel->createUser($nomUtilisateur, $password)) {
            header('Location: ../index.html');
        } else {
            return "Error: Unable to create account";
        }
    }

    public function login($nomUtilisateur, $password) {
        $user = $this->userModel->getUser($nomUtilisateur);
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['ID_User'];
            $cookie_duration = time() + (60 * 60 * 24) ; // 1 jour
            setcookie('auth','true',$cookie_duration,"/");
            header('Location: ../views/accueil.php');
            exit();
        } else {
            return 'Invalid email or password';
        }
    }
}
?>