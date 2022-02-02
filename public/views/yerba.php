<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("head.php") ;?>
    <link rel="stylesheet" type="text/css" href="public/css/rank.css">
    <link rel="stylesheet" type="text/css" href="public/css/yerba.css">
</head>
<body>
<?php session_start() ;?>
<?php isset($_SESSION['user']) ? $userId = unserialize($_SESSION['user'])->getId(): $userId = -1 ;?>
<?php include("navigation.php") ;?>

<div class="tmp">
</div>
<div class="content">
        <div class="content-item">
            <div class="item-top">
                <a href="#" class="yerba-name"><?php echo($yerba['y']->getName()) ?></a>
                <div class="add">
                    <?php if(!array_key_exists($userId,$comments)):?>
                    <i class="fas fa-plus"></i>
                    <a href="addOpinion?id=<? echo($yerba['y']->getId())?>" class="add-button">Dodaj opinie</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="item-body">
                <div class="photo-ratings">
                    <img src="public/uploads/yerba/<?= $yerba['y']->getImage()?>">

                    <div class="rating">
                        <div class="rating-top">
                            <p><?php echo(($yerba['r']->getNumOfRatings() == 0) ? 0 :  $yerba['r']->getGeneral()/$yerba['r']->getNumOfRatings()) ?>/5</p>
                        </div>
                        <img class="flag" src="public/uploads/flags/<?= $origins[$yerba['y']->getOrigin()]->getFlag()?>">
                        <div class="rating-item">
                            <p>Pył</p>
                            <div class="stars">
                                <p><?php echo(($yerba['r']->getNumOfRatings() == 0) ? 0 :  $yerba['r']->getDust()/$yerba['r']->getNumOfRatings()) ?>/5</p>
                            </div>
                        </div>
                        <div class="rating-item">
                            <p>Zielone nuty</p>
                            <div class="stars">
                                <!--                                <i class="fas fa-star"></i>-->
                                <p><?php echo(($yerba['r']->getNumOfRatings() == 0) ? 0 :  $yerba['r']->getGreen()/$yerba['r']->getNumOfRatings()) ?>/5</p>
                            </div>
                        </div>
                        <div class="rating-item">
                            <p>Dymne nuty</p>
                            <div class="stars">
                                <p><?php echo(($yerba['r']->getNumOfRatings() == 0) ? 0 :  $yerba['r']->getSmoke()/$yerba['r']->getNumOfRatings()) ?>/5</p>
                            </div>
                        </div>
                        <div class="rating-item">
                            <p>Intensywność</p>
                            <div class="stars">
                                <p><?php echo(($yerba['r']->getNumOfRatings() == 0) ? 0 :  $yerba['r']->getIntensity()/$yerba['r']->getNumOfRatings()) ?>/5</p>
                            </div>
                        </div>
                        <div class="rating-item">
                            <p>Pobudzenie</p>
                            <div class="stars">
                                <p><?php echo(($yerba['r']->getNumOfRatings() == 0) ? 0 :  $yerba['r']->getStrength()/$yerba['r']->getNumOfRatings()) ?>/5</p>
                            </div>
                        </div>
                        <div class="rating-item">
                            <p>Dodatki</p>
                            <div class="stars">
                                <p><?php echo(($yerba['r']->getNumOfRatings() == 0) ? 0 :  $yerba['r']->getAddons()/$yerba['r']->getNumOfRatings()) ?>/5</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="item-description">
                    <p><?php echo($yerba['y']->getDescription()) ?></p>
                </div>
            </div>
        </div>
        <div class="comments">
            <?php foreach ($comments as $commentUserId => $commentData): ?>
            <div class="comment">
                <div class="comment-top">
                    <p>Ocena: <?php echo($commentData['r']->getGeneral())  ?></p>
                    <div class="comment-owner">
                        <p><?php echo($commentData['name'])  ?></p>

                    </div>
                </div>
                <div class="comment-ratings">
                    <p>Pył: <?php echo($commentData['r']->getDust())  ?></p>
                    <p>Zielone nuty: <?php echo($commentData['r']->getGreen())  ?></p>
                    <p>Nuty dymne: <?php echo($commentData['r']->getSmoke())  ?></p>
                    <p>Intensywność: <?php echo($commentData['r']->getIntensity())  ?></p>
                    <p>Pobudzenie: <?php echo($commentData['r']->getStrength())  ?></p>
                    <p>Dodatki: <?php echo($commentData['r']->getAddons())  ?></p>
                </div>
                <div class="comment-des">
                    <p> <?php echo($commentData['c']->getContent())  ?></p>
                </div>
                </div>
            <?php endforeach; ?>
        </div>

</div>
</body>
</html>