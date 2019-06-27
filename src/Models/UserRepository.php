<?php
namespace Web\FrontController\Models;
use Web\FrontController\Core\DB;
use Web\FrontController\Core\Repository;

class UserRepository implements Repository
{
    private $db;
    public function __construct()
    {
        $this->db = DB::getDB();
    }

    public function getAll()
    {
    }

    public function getById(int $id)
    {
    }

    public function save($params)
    {
        $sql = 'INSERT INTO User (email, `name`, hash, phone, role)
                VALUES (:email, :username, :hash, :phone, :role)';
        return $this->db->nonSelectQuery($sql, $params);
    }

    public function isAuth($post){
        $sql = 'SELECT * FROM User WHERE email=:email';
        $params = [
            'email'=>$post['email']
        ];
        $result = $this->db->paramsGetOne($sql, $params);
        if (!$result) return false;
        if (!password_verify($post['password'], $result['hash'])) return false;
        session_start();
        $_SESSION['name'] = $result['name'];
        $_SESSION['role'] = $result['role'];
        return true;
    }


}