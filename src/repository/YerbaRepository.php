<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Yerba.php';
require_once __DIR__.'/../models/AverageRating.php';
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
        if(!empty($addons[0])){
            $this->addAddons($id, $addons);
        }
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
                        SELECT :yerbaId,id from addons where name = :name
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

    public function getOriginsWithId(){
        $stmt = $this->database->connect()->prepare("
            SELECT * FROM origin
        ");
        $stmt->execute();
        $toReturn = [];
        $origins = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($origins as $origin){
            $originToPush = new Origin($origin['country'],$origin['flag']);
            $originToPush->setId($origin['id']);
            $toReturn[$origin['id']] = $originToPush;

        }
        return $toReturn;
    }

    public function getAllWithAverageRatings(){
        $stmt = $this->database->connect()->prepare("
            SELECT * from yerba
            join average_rating ar on yerba.id = ar.id_yerba  
            ORDER BY ar.general;
        ");
        $stmt->execute();
        $dataToReturn = [];
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $yerba){
            $newYerba = new Yerba($yerba['id_origin'],$yerba['id_type'],$yerba['name'],$yerba['description'],$yerba['image']);
            $newYerba->setId($yerba['yerba.id']);
            $newAverageRating = new AverageRating($yerba['id_yerba'],$yerba['num_of_ratings'],
                $yerba['general'],$yerba['dust'],$yerba['green'],$yerba['smoke'],
                $yerba['intensity'],$yerba['strength'],$yerba['addons']);
            $dataToReturn[$yerba['id_yerba']] = ['y' => $newYerba, 'r'=>$newAverageRating];
        }
        return $dataToReturn;
    }

    public function getYerbaByID($id){
        $stmt = $this->database->connect()->prepare("
             SELECT * from yerba
             join average_rating ar on yerba.id = ar.id_yerba  
             WHERE yerba.id = :id;
        ");
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $yerba = $stmt->fetch(PDO::FETCH_ASSOC);
        $newYerba = new Yerba($yerba['id_origin'],$yerba['id_type'],$yerba['name'],$yerba['description'],$yerba['image']);
        $newYerba->setId($id);
        $newAverageRating = new AverageRating($yerba['id_yerba'],$yerba['num_of_ratings'],
            $yerba['general'],$yerba['dust'],$yerba['green'],$yerba['smoke'],
            $yerba['intensity'],$yerba['strength'],$yerba['addons']);
        return ['y' => $newYerba, 'r'=>$newAverageRating];
    }


    public function getAll(){
        $stmt = $this->database->connect()->prepare("
             SELECT * from yerba;
        ");
        $stmt->execute();
        $dataToReturn = [];
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $yerba){
            $newYerba = new Yerba($yerba['id_origin'],$yerba['id_type'],$yerba['name'],$yerba['description'],$yerba['image']);
            $newYerba->setId($yerba['id']);
            $dataToReturn[$yerba['id']] = $newYerba;
        }
        return $dataToReturn;
    }

}