<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository{

    private function createUser($userData){
        $user = new User($userData['email'], $userData['password'], $userData['name']);
        $user->setAvatar($userData['avatar']);
        $user->setId($userData["id"]);
        $user->setRoleId($userData["id_role"]);
        return $user;

    }

    public function getUserByEmail($email){
    //
        $stmt = $this->database->connect()->prepare("
            SELECT * FROM users where email = :email
        ");
        $stmt->bindParam(':email',$email,PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user == false){
            //TODO user not found.....
            return null;
        }
        return self::createUser($user);
    }

    public function getUserByName($name){
        //
        $stmt = $this->database->connect()->prepare("
            SELECT * FROM users where name = :name
        ");
        $stmt->bindParam(':name',$name,PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user == false){
            //TODO user not found.....
            return null;
        }
        return self::createUser($user);
    }

    public function getUserById($id){
        //
        $stmt = $this->database->connect()->prepare("
            SELECT * FROM users where id = :id
        ");
        $stmt->bindParam(':id',$id,PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if($user == false){
            //TODO user not found.....
            return null;
        }
        return self::createUser($user);
    }

    public function addUser($user){

        $stmt = $this->database->connect()->prepare("
            SELECT * FROM users where email = :email OR name = :name
        ");
        $stmt->bindParam(':email',$user->getEmail(),PDO::PARAM_STR);
        $stmt->bindParam(':name',$user->getName(),PDO::PARAM_STR);
        $stmt->execute();

        $userTest = $stmt->fetch(PDO::FETCH_ASSOC);
        if($userTest == true){
            return false;
        }


        $stmt = $this->database->connect()->prepare("
            INSERT INTO users (ID_role, name, email, password, avatar) 
            VALUES (?,?,?,?,?)
        ");
        $stmt->execute([
            1,
            $user->getName(),
            $user->getEmail(),
            $user->getPassword(),
            $user->getAvatar(),
        ]);
        return true;

    }

    public function changeAvatar($avatar,$userId){
        $stmt = $this->database->connect()->prepare("
            UPDATE users SET avatar = :avatar WHERE id = :id
        ");
        $stmt->bindParam(':avatar',$avatar,PDO::PARAM_STR);
        $stmt->bindParam(':id',$userId,PDO::PARAM_STR);
        $stmt->execute();

    }

    public function changePassword($password,$userId){
        $stmt = $this->database->connect()->prepare("
            UPDATE users SET password = :password WHERE id = :id
        ");
        $stmt->bindParam(':password',$password,PDO::PARAM_STR);
        $stmt->bindParam(':id',$userId,PDO::PARAM_INT);
        $stmt->execute();
    }



}