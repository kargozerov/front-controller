<?php
namespace Web\FrontController\Controllers;

use Web\FrontController\Core\Controller;
use Web\FrontController\Models\PictureRepository;

class IndexController extends Controller
{
    private $pictureRepository;

    public function __construct()
    {
        $this->pictureRepository = new PictureRepository();
    }

    public function indexAction(){
        $content='main.php';
        $template='template.php';
        $pictures = $this->pictureRepository->getAll();
        $data=[
            'title'=>'Главная',
            'pictures' => $pictures
        ];
        //вывели страничку $page
        echo $this->renderPage($content,$template,$data);
    }

}

