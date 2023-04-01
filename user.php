<?php


    class User {

    public $connection;

    public function __construct ()
    {
         $this->connection = new PDO("mysql:host=localhost;dbname=user-database;charset=utf8;",
             'Vasily', 'Ddr.io7JVol_)vri');

    }

    public function create($statement, $connection)
    {
       $this->$statement = $connection->prepare('');
    }

    }

   // $query = new User();