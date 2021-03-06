<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Comment.php';
require_once __DIR__.'/../models/Rating.php';
require_once __DIR__.'/../models/AverageRating.php';


class CommentsRepository extends Repository{


    public function getCommentsWithRatesByYerbaId($yerbaId){
        $stmt = $this->database->connect()->prepare("
            select * from comment c
            left join users u on c.id_user = u.id
            left join rating r on c.id = r.id_comment
            where id_yerba = :yerbaId
        ");
        $stmt->bindParam(':yerbaId',$yerbaId);
        $stmt->execute();
        $toReturn = [];
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($data as $line){
            $comment = new Comment($line['id_user'], $line['id_yerba'],$line['content']);
            $comment->setId($line['c.id']);

            $rating = new Rating($line['c.id'],$line['general'],$line['dust'],$line['green'],$line['smoke'],
                                $line['intensity'],$line['strength'],$line['addons']);
            $rating->setId($line['r.id']);

            $toReturn[$line['id_user']] = ['c'=>$comment, 'r'=>$rating, 'avatar'=>$line['avatar'], 'name'=>$line['name']];
        }
        return $toReturn;
    }

    public function hasUserCommentedYerba($idYerba, $idUser){
        $stmt = $this->database->connect()->prepare("
            SELECT id from comment
            WHERE id_user = :idUser
            AND id_yerba = :idYerba
        ");
        $stmt->bindParam(':idUser',$idUser);
        $stmt->bindParam(':idYerba',$idYerba);
        $stmt->execute();
        $data = $stmt->fetch();
        return isset($data['id']);
    }

    public function addComment($idYerba,$idUser,$content,$general,$dust,$green,$smoke,$intensity,$strength,$addons){
        $stmt = $this->database->connect()->prepare("
            INSERT INTO comment ( ID_USER, ID_YERBA, CONTENT) values (?,?,?)
            RETURNING id
        ");
        $stmt->execute([$idUser,$idYerba,$content]);
        $commentId = $stmt->fetch()['id'];
        $stmt = $this->database->connect()->prepare("
            INSERT INTO rating ( id_comment, general, dust, green, smoke, intensity, strength, addons) 
            values (?,?,?,?,?,?,?,?)
        ");
        $stmt->execute([$commentId, $general, $dust, $green, $smoke, $intensity, $strength, $addons]);

        $stmt = $this->database->connect()->prepare("
            UPDATE average_rating
            SET general = general + :general,
                dust = dust + :dust,
                green = green + :green,
                smoke = smoke + :smoke,
                intensity = intensity + :intensity,
                strength = strength + :strength,
                addons = addons + :addons,
                num_of_ratings = num_of_ratings + 1
            WHERE id_yerba = :idYerba
        ");
        $stmt->bindParam(':general', $general);
        $stmt->bindParam(':dust', $dust);
        $stmt->bindParam(':green', $green);
        $stmt->bindParam(':smoke', $smoke);
        $stmt->bindParam(':intensity', $intensity);
        $stmt->bindParam(':strength', $strength);
        $stmt->bindParam(':addons', $addons);
        $stmt->bindParam(':idYerba', $idYerba);

        $stmt->execute();

    }

    public function getCommentsByUserId($userId){
        $stmt = $this->database->connect()->prepare("
            SELECT * from comment
            join rating r on comment.id = r.id_comment
            WHERE id_user = :idUser
        ");
        $stmt->bindParam(':idUser',$userId);
        $stmt->execute();

        $data = $stmt->fetchAll();
        $toReturn = [];
        foreach ($data as $line){
            $newComment = new Comment($line['id_user'],$line['id_yerba'],$line['content']);
            $newComment->setId($line['id_comment']);
            $newRating = new Rating($line['id_comment'],$line['general'],$line['dust'],$line['green'],$line['smoke'],
                                    $line['intensity'],$line['strength'],$line['addons']);
            $newRating->setId($line['r.id']);
            $toReturn[$line['id_comment']] = ['c' => $newComment, 'r' => $newRating];
        }
        return $toReturn;
    }

    public function getById($id){
        $stmt = $this->database->connect()->prepare("
            SELECT * from comment
            join rating r on comment.id = r.id_comment
            WHERE comment.id = :id
        ");
        $stmt->bindParam(':id',$id);
        $stmt->execute();
        $data = $stmt->fetch();
        $newComment = new Comment($data['id_user'],$data['id_yerba'],$data['content']);
        $newComment->setId($data['id_comment']);
        $newRating = new Rating($data['id_comment'],$data['general'],$data['dust'],$data['green'],$data['smoke'],
            $data['intensity'],$data['strength'],$data['addons']);
        $newRating->setId($data['id']);

        return ['c'=>$newComment,'r'=>$newRating];
    }

    public function editComment($oldOpinion,$general ,$dust,$green,$smoke, $intensity, $strength, $addons, $text){
       // $this->database->connect()->beginTransaction();
        $stmt = $this->database->connect()->prepare("
            UPDATE average_rating
            SET general = general + :general - :oldGeneral,
                dust = dust + :dust - :oldDust,
                green = green + :green - :oldGreen,
                smoke = smoke + :smoke - :oldSmoke,
                intensity = intensity + :intensity - :oldIntensity,
                strength = strength + :strength - :oldStrength,
                addons = addons + :addons - :oldAddons
            WHERE id_yerba = :idYerba
        ");
        $stmt->bindParam(':general', $general);
        $stmt->bindParam(':dust', $dust);
        $stmt->bindParam(':green', $green);
        $stmt->bindParam(':smoke', $smoke);
        $stmt->bindParam(':intensity', $intensity);
        $stmt->bindParam(':strength', $strength);
        $stmt->bindParam(':addons', $addons);
        $stmt->bindParam(':oldGeneral', $oldOpinion['r']->getGeneral());
        $stmt->bindParam(':oldDust', $oldOpinion['r']->getDust());
        $stmt->bindParam(':oldGreen', $oldOpinion['r']->getGreen());
        $stmt->bindParam(':oldSmoke', $oldOpinion['r']->getSmoke());
        $stmt->bindParam(':oldIntensity', $oldOpinion['r']->getIntensity());
        $stmt->bindParam(':oldStrength', $oldOpinion['r']->getStrength());
        $stmt->bindParam(':oldAddons', $oldOpinion['r']->getAddons());
        $stmt->bindParam(':idYerba', $oldOpinion['c']->getIdYerba());
        // ????
        $stmt->execute();

        $stmt = $this->database->connect()->prepare("
            UPDATE rating
            SET general = :general,
                dust = :dust,
                green = :green,
                smoke = :smoke,
                intensity = :intensity,
                strength = :strength,
                addons = :addons
            WHERE id = :id
        ");
        $stmt->bindParam(':general', $general);
        $stmt->bindParam(':dust', $dust);
        $stmt->bindParam(':green', $green);
        $stmt->bindParam(':smoke', $smoke);
        $stmt->bindParam(':intensity', $intensity);
        $stmt->bindParam(':strength', $strength);
        $stmt->bindParam(':addons', $addons);
        $stmt->bindParam(':id', $oldOpinion['r']->getId());
        $stmt->execute();

        $stmt = $this->database->connect()->prepare("
            UPDATE comment
            SET content = :content
            WHERE id = :id
        ");
        $stmt->bindParam(':content', $text);
        $stmt->bindParam(':id', $oldOpinion['c']->getId());
        $stmt->execute();
       // $this->database->connect()->commit();
    }

    public function deleteComment($opinion){
        $stmt = $this->database->connect()->prepare("
            UPDATE average_rating
            SET general = general - :general,
                dust = dust - :dust,
                green = green - :green,
                smoke = smoke - :smoke,
                intensity = intensity - :intensity,
                strength = strength - :strength,
                addons = addons - :addons,
                num_of_ratings = num_of_ratings - 1
            WHERE id_yerba = :idYerba
        ");
        $stmt->bindParam(':general', $opinion['r']->getGeneral());
        $stmt->bindParam(':dust', $opinion['r']->getDust());
        $stmt->bindParam(':green', $opinion['r']->getGreen());
        $stmt->bindParam(':smoke', $opinion['r']->getSmoke());
        $stmt->bindParam(':intensity', $opinion['r']->getIntensity());
        $stmt->bindParam(':strength', $opinion['r']->getStrength());
        $stmt->bindParam(':addons', $opinion['r']->getAddons());
        $stmt->bindParam(':idYerba', $opinion['c']->getIdYerba());
        $stmt->execute();

        $stmt = $this->database->connect()->prepare("
            DELETE FROM rating
            WHERE id = :id
        ");
        $stmt->bindParam(':id', $opinion['r']->getId());
        $stmt->execute();
        $stmt = $this->database->connect()->prepare("
            DELETE FROM comment
            WHERE id = :id
        ");
        $stmt->bindParam(':id', $opinion['c']->getId());
        $stmt->execute();
    }

}