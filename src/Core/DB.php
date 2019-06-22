<?php
namespace Web\FrontController\Core;


class DB
{
    // данные, необходимые для подключения к базе данных
    // TODO: вынести в config файл
    private $server = 'localhost';
    private $dbName = 'frontcontroller';
    private $username = 'root';
    private $pwd = '';

    private static $db; // в данном свойстве будем хранить объект DB класса
    private $connection;

    // делаем конструктор приватным, чтобы объект можно было создать только внутри класса
    private function __construct()
    {
        // при создании объекта DB в $connection сохранится объект pdo (его мы будем использовать для соединения с бд)
        $this->connection = new \PDO(
            "mysql:host=$this->server;dbname=$this->dbName", $this->username, $this->pwd, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
    }

    // метод создает в случае необходимости объект DB класса или возвращает уже созданный объект
    // при таком подходе будет создать лишь один объект DB на всю программу
    public static function getDB(){
        if (self::$db == null) self::$db = new DB();
        return self::$db;
    }

    // для запросов вида SELECT * FROM Table;
    // метод вернет все записи из таблицы по запросу $sql, метод вернет данные, как массив объектов класса $class
    public function getAll($sql, $class){
        $statement = $this->connection->query($sql);
        if (!$statement) return false;
        $statement->setFetchMode(\PDO::FETCH_CLASS, $class);
        return $statement->fetchAll();
    }

    //для запросов вида DELETE FROM table WHERE id=:id;
    // метод выполнит запрос подготовленный $sql, передав в него параметры $params
    public function nonSelectQuery($sql, $params){
        $statement = $this->connection->prepare($sql);
        if (!$statement) return false;
        return $statement->execute($params);
    }


    //для запросов вида SELECT * FROM Table WHERE age > :age; для получения нескольких записей
    // метод выполнит запрос подготовленный $sql, передав в него параметры $params,
    //метод вернет данные, как массив объектов класса $class
    public function paramsGetAll($sql, $params, $class) {
        $statement = $this->connection->prepare($sql);
        if (!$statement) return false;
        $statement->execute($params);
        $statement->setFetchMode(\PDO::FETCH_CLASS, $class);
        return $statement->fetchAll();
    }

    //для запросов вида SELECT * FROM Table WHERE id=:id; для получения нодной записи
    // метод выполнит запрос подготовленный $sql, передав в него параметры $params,
    //метод вернет данные, как объект класса $class
    public function paramsGetOne($sql, $params, $class){
        $statement = $this->connection->prepare($sql);
        if (!$statement) return false;
        $statement->execute($params);
        $statement->setFetchMode(\PDO::FETCH_CLASS, $class);
        return $statement->fetch();
    }
}