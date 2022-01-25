<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/User.php';

class UserRepository extends Repository{

    public function getUser($email){
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
        $newUser = new User($user['email'], $user['password'], $user['name']);
        $newUser->setAvatar($user['avatar']);
        $newUser->setId($user["id"]);
        $newUser->setRoleId($user["id_role"]);
        return $newUser;
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
            //TODO user exist
            return null;
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

    }

}