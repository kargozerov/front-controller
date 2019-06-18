<?php

interface Repository
{
    public function getAll(); // получение всех записей
    public function getById(int $id); // получение записи по id
}