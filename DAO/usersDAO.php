<?php

namespace DAO;

use Models\User;
use DAO\Connection;
use PDOException;

class usersDAO
{

    private $table = "Users";
    private $connection;

    public function registerUser(User $user)
    {

        try {
            $query = "INSERT INTO " . $this->table . " (userEmail, userPass, userType) VALUES (:userEmail, :userPass, :userType);";

            $parameters["userEmail"] = $user->getEmail();
            $parameters["userPass"] = $user->getPass();
            $parameters["userType"] = $user->getUserType();
            $this->connection = Connection::GetInstance();

            $this->connection->ExecuteNonQuery($query, $parameters);
        } catch (PDOException $ex) {
            //throw $ex;
        }
    }

    function getUser($username, $userpass)
    {

        try {
            $query = "SELECT * FROM Users WHERE userEmail='$username' AND userPass='$userpass'";
            $this->connection = Connection::GetInstance();

            $result = $this->connection->Execute($query);

            if (!empty($result)) {
                $user = new User($result[0]["userEmail"], $result[0]["userPass"], $result[0]["userType"]);
                $user->setUserID($result[0]["id_User"]);
            }
        } catch (PDOException $e) {
            echo 'Something went wrong, try again.....';
        }
        if (isset($user)) return $user;
        else return null;
    }

    function getAll()
    {
        $arrayUsers = array();
        try {
            $query = "SELECT * FROM" . $this->table;
            $this->connection = Connection::GetInstance();
            $result = $this->connection->Execute($query);
            foreach ($result as $user) {
                $user = new User($user->getUserName(), $user->getUserPass(), $user->getUserType());
                array_push($arrayUsers, $user);
            }
        } catch (PDOException $e) {
        }
        return $arrayUsers;
    }
}
