<?php


    class User {

    public $connection;

    public function __construct ()
    {
         $this->connection = new PDO("mysql:host=localhost;dbname=user-database;charset=utf8;", 'Vasily',
             'Ddr.io7JVol_)vri');
    }

    public function create(array $data) : void
    {
        try {
            $statement = $this-> connection->prepare("INSERT INTO user(id,first_name,last_name,age,email,date_created) values (NULL,:first_name,
                                                        :last_name,:age,:email,:date)");
            $dt = new DateTime();
            $data['date'] = $dt->format('Y-m-d H:i:s');

            $statement->execute($data);
        } catch (PDOException $e) {
           echo $e->getMessage();
        }
    }

        public function update(array $data): void
        {
            try {
                $statement = $this->connection->prepare("UPDATE `user` SET `first_name`=:first_name,
                  `last_name`=:last_name,`age`=:age, `email`=:email, `id` = :id");
                $statement->execute($data);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function delete(int $id): void
        {
            try {
                $statement = $this->connection->prepare("DELETE FROM `user` WHERE `id` = :id");
                $statement->bindValue('id', $id);
                $statement->execute();
                header('Location: /index.php');
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        public function list() : array
        {
            try {
                $statement = $this->connection->prepare("SELECT * FROM `user`");
                $statement->execute();
                $result = $statement->fetchAll();
                return $result;
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return $result;
        }

    }
