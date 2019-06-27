<?php
namespace Web\FrontController\Controllers;
use Web\FrontController\Core\Controller;
use Web\FrontController\Models\PictureRepository;

class PictureController extends Controller
{
    private $pictureRepository;
    public function __construct()
    {
        $this->pictureRepository = new PictureRepository();
    }

//    запрос /article/add
    public function addAction(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            header('Location: /');
        } else
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                session_start();
            // если post запрос, обрабатываем данные
            $post = $_POST;
            $files = $_FILES;
            $params = [
                'title' => $post['title'],
                'description' => $post['description'],
                'yearCreated' => explode("-", $post['yearCreated'])[0],
                'img' => $files['img']['name']
            ];
            if ($this->pictureRepository->save($params) === false) {
                $addResult = 'Картина не была добавлена';
            } else {
                $addResult = 'Картина добавлена';
            }

            $data = [
                'title'=>'Добавление картины',
                'addResult' => $addResult,
                'auth' => isset($_SESSION['name'])
            ];
            echo parent::renderPage('admin_account.php',
                'template.php', $data);

        }

    }

    public function showAction($id) {
        $picture = $this->pictureRepository->getById($id);
        $data = [
            'title'=>$picture['title'],
            'picture' => $picture
        ];
        echo parent::renderPage('picture.php',
            'template.php', $data);
    }

}