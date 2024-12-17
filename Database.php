<?php

class Database{

    public $pdo;
    
    public function __construct($config){
        $dsn = "mysql:" . http_build_query($config, "", ";" );
        $this->pdo = new PDO($dsn);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    }

    public function query($sql){
        // 1. sagatavot vaicajumu (statement)
        $statement = $this->pdo->prepare($sql);
        // 2. Izpildit statement
        $statement->execute();
        // 3. dabut rezultatu
        return $statement;
    }

}