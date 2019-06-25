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

//    запрос /picture/add
    public function addAction(){
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            // если get запрос, отображаем форму
            $data = [
                'title'=>'Добавление картины'
            ];
            echo parent::renderPage('add_picture.php',
                'template.php', $data);
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
                'addResult' => $addResult
            ];
            echo parent::renderPage('add_picture.php',
                'template.php', $data);

        }

    }

    public function showAction($id) {
        $picture = $this->pictureRepository->getById($id);
        var_dump($picture);
        $data = [
            'title'=>$picture['title'],
            'picture' => $picture
        ];
        echo parent::renderPage('picture.php',
            'template.php', $data);
    }

}