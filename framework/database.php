<?php

namespace Framework;

use PDO;

class Database
{
    private $connection;
    private $statement;

    public function __construct()
    {
        $dsn = 'mysql:host=127.0.0.1;dbname=web-php;charset=utf8mb4';   
        $this->connection = new PDO($dsn, 'root', '');
    }

    public function query($sql, $params = [])
    {
        //>fetchAll(PDO::FETCH_ASSOC) es interesante transofrma en un arreglo asociativo los datos que traemos con le query
        //si trabajamos con parametros no debemos usar metodo query porque estariamos vulnerables a una inyeccion AQL por eso debemos suar el otro sistema de PDO
        $this->statement = $this->connection->prepare($sql);
        $this->statement->execute($params);

        return $this;
    }

    public function get() 
    {
        return $this->statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function firstOrFail()
    {
       $result = $this->statement->fetch(PDO::FETCH_ASSOC);

       if (!$result) {
        exit('404 Not Found');
       }

       return $result;
    }
}