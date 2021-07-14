<?php
namespace App;
use \PDO;

class Database {

    private $db_name = 'tpgrafikart';
    private $db_user = 'root';
    private $db_pass = '';
    private $db_host = 'localhost';
    private $pdo;

    public function __construct($db_name, $db_user, $db_pass, $db_host)
    {
        $this->db_name = $db_name;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_host = $db_host;
    }

    private function getPDO()
    {
        if ($this->pdo === null) {
            $pdo = new PDO('mysql:dbname='. $this->db_name .';host='. $this->db_host, $this->db_user, $this->db_pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }
        return $this->pdo;
    }

    public function query(string $statement,  array $class_name)
    {
        $req = $this->getPDO()->query($statement);
        $datas = $req->fetchAll(PDO::FETCH_CLASS, $class_name);
        return $datas;
    }

    public function prepare(string $statement, array $options, string $class_name, $one = false)
    {
        $request = $this->getPDO()->prepare($statement);
        $request->execute($options);
        $request->setFetchMode(PDO::FETCH_CLASS, $class_name);

        if ($one) {
            $datas = $request->fetch();
        } else {
            $datas = $request->fetchAll();
        }
        
        return $datas;
    }
}