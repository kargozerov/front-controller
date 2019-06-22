<?php
namespace Web\FrontController\Models;

use Web\FrontController\Core\Repository;
use Web\FrontController\Models\Picture;

class PictureRepository implements Repository
{
    private $pictures = [];
    public function __construct()
    {
        $this->pictures = [
            new Picture(1, 'Picture 1', 'description', ['Chrysanthemum.jpg', 'Chrysanthemum.jpg']),
            new Picture(2, 'Picture 2', 'description', ['Koala.jpg', 'Koala.jpg']),
            new Picture(3, 'Picture 3', 'description', ['Tulips.jpg', 'Tulips.jpg']),
            new Picture(4, 'Picture 4', 'description', ['Desert.jpg', 'Desert.jpg']),
        ];
    }

    public function getAll()
    {
        // возвращает все картины
        return $this->pictures;
    }

    public function getById(int $id)
    {
        foreach ($this->pictures as $picture){
            if ($id == $picture->getId()){
                return $picture;
            }
        }
    }

}