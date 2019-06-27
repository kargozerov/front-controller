<?php
namespace Web\FrontController\Controllers;

use Web\FrontController\Core\Controller;

class ArticleController extends Controller
{

    public function showAction(){
//        echo "Генерация страницы статей";
        $content='articles.php';
        $template='template.php';
        $data=[
            'title'=>'Статьи'
        ];
        //вывели страничку $page
        echo $this->renderPage($content,$template,$data);
    }

}