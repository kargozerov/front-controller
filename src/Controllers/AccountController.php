<?php
namespace Web\FrontController\Controllers;

use Web\FrontController\Core\Controller;
use Web\FrontController\Models\UserRepository;

class AccountController extends Controller
{
    private $userRepository;
    public function __construct()
    {
        $this->userRepository = new UserRepository();
    }

    //'/account/registration'
    public function registrationAction(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            $data =[
                'title'=>'Регистрация'
            ];
            echo $this->renderPage('registration.php',
                'template.php', $data);
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $post = $_POST;
            $params = [
                'username' => $post['name'],
                'email' => $post['email'],
                'phone'=>$post['phone'],
                'role'=>'USER',
                'hash'=>password_hash($post['password'], PASSWORD_DEFAULT)
            ];
            if($this->userRepository->save($params) === false){
                $data =[
                    'title'=>'Регистрация'
                ];
                echo $this->renderPage('registration.php',
                    'template.php', $data);
            } else {
                header('Location: /');
            }
        }
    }

    public function authAction(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $post = $_POST;
            if (!$this->userRepository->isAuth($post)){
                header('Location: /');
            }
            header('Location: /account');
        }
    }
    public function indexAction(){
        session_start();
        if(!isset($_SESSION['name'])) header('Location: /');
        $accountPage = ($_SESSION['role'] == 'ADMIN') ? 'admin_account.php'
                                                : 'user_account.php';
        $data = [
            'title' => 'Личный кабинет',
            'name' => $_SESSION['name'],
            'auth' => isset($_SESSION['name'])
        ];

        echo $this->renderPage($accountPage, 'template.php', $data);
    }

    public function logoutAction(){
        session_start();
        session_destroy();
        $_SESSION = [];
        header('Location: /');
    }

}