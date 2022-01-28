<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Yerba.php';
require_once __DIR__.'/../models/Type.php';
require_once __DIR__.'/../models/Origin.php';

class YerbaRepository extends Repository{

    public function addYerba($yerba,$addons){
        $stmt = $this->database->connect()->prepare("
            INSERT INTO yerba (id_origin, id_type, name, description, image) 
            VALUES (?,?,?,?,?)
        ");

        $stmt->execute([
            $yerba->getOrigin(),
            $yerba->getType(),
            $yerba->getName(),
            $yerba->getDescription(),
            $yerba->getImage(),
        ]);

        $stmt = $this->database->connect()->prepare("
            SELECT id FROM yerba where name = :name;
        ");
        $stmt->bindParam(':name',$yerba->getName());
        $stmt->execute();
        $id = $stmt->fetch()['id'];
        $this->initRating($id);
        $this->addAddons($id, $addons);
    }

    private function initRating($id){
        $stmt = $this->database->connect()->prepare("
            INSERT INTO average_rating (id_yerba) values (?)
        ");
        $stmt->execute([$id]);

    }

    private function addAddons($yerbaId, $addons){
        foreach ($addons as $addon){
            $addon = strtolower($addon);
            // czy jest dodatek w bazie
            $stmt = $this->database->connect()->prepare("
                SELECT * FROM addons where name = :name
            ");
            $stmt->bindParam(':name',$addon,PDO::PARAM_STR);
            $stmt->execute();

            if($stmt->fetch(PDO::FETCH_ASSOC) != true){
                //jak nie ma to insert
                $stmt = $this->database->connect()->prepare("
                    INSERT INTO addons (name) VALUES (?)");
                $stmt->execute([
                   $addon
                ]);
            }

            $stmt = $this->database->connect()->prepare("
                    INSERT INTO addons_yerba
                        SELECT id,:yerbaId from addons where name = :name
                    ");
            $stmt->bindParam(':name', $addon);
            $stmt->bindParam(':yerbaId', $yerbaId);
            $stmt->execute();



        }


    }

    public function getAddons($yerbaId){

        $stmt = $this->database->connect()->prepare("
                SELECT a.id, a.name from yerba
                full join addons_yerba ay on yerba.id = ay.id_yerba
                full join addons a on a.id = ay.id_addons
                where yerba.id = :id and a.name notnull;
            ");
        $stmt->bindParam(':id',$yerbaId,PDO::PARAM_STR);
        $stmt->execute();
        //TODO
    }

    public function getTypes(){
        $stmt = $this->database->connect()->prepare("
            SELECT * FROM type
        ");
        $stmt->execute();
        $toReturn = [];
        $types = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($types as $type){
            $typeToPush = new Type($type['name']);
            $typeToPush->setId($type['id']);
            array_push($toReturn,$typeToPush);
        }
        return $toReturn;
    }

    public function getOrigins(){
        $stmt = $this->database->connect()->prepare("
            SELECT * FROM origin
        ");
        $stmt->execute();
        $toReturn = [];
        $origins = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($origins as $origin){
            $originToPush = new Origin($origin['country'],$origin['flag']);
            $originToPush->setId($origin['id']);
            array_push($toReturn,$originToPush);

        }
        return $toReturn;
    }

}