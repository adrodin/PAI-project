<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("head.php") ;?>
    <link rel="stylesheet" type="text/css" href="public/css/rank.css">
</head>
<body>
    <?php session_start() ;?>
    <?php include("navigation.php") ;?>

    <div class="tmp">
    </div>
    <div class="content">
<!--        <div class="filtr-sort">-->
<!--            <p>Filtruj</p>-->
<!--            <p>Sortuj</p>-->
<!--        </div>-->
        <?php foreach ($yerba as $yerbaId => $data): ?>


        <div class="content-item">
            <div class="item-top">
                <a href="yerba?id=<?php echo($yerbaId) ?>" class="yerba-name"><?php echo($data['y']->getName()) ?></a>
            </div>

            <div class="item-body">
                <div class="photo-ratings">
                    <img src="public/uploads/yerba/<?= $data['y']->getImage()?>">

                    <div class="rating">
                        <div class="rating-top">
                            <p><?php echo(($data['r']->getNumOfRatings() == 0) ? 0 :  round($data['r']->getGeneral()/$data['r']->getNumOfRatings(),2)) ?>/5</p>
                        </div>

                        <img class="flag" src="public/uploads/flags/<?= $origins[$data['y']->getOrigin()]->getFlag()?>">
                        <div class="rating-item">
                            <p>Pył</p>
                            <div class="stars">
                                <p><?php echo(($data['r']->getNumOfRatings() == 0) ? 0 :  round($data['r']->getDust()/$data['r']->getNumOfRatings(),2)) ?>/5</p>
                            </div>
                        </div>
                        <div class="rating-item">
                            <p>Zielone nuty</p>
                            <div class="stars">
<!--                                <i class="fas fa-star"></i>-->
                                <p><?php echo(($data['r']->getNumOfRatings() == 0) ? 0 :  round($data['r']->getGreen()/$data['r']->getNumOfRatings(),2)) ?>/5</p>
                            </div>
                        </div>
                        <div class="rating-item">
                            <p>Dymne nuty</p>
                            <div class="stars">
                                <p><?php echo(($data['r']->getNumOfRatings() == 0) ? 0 :  round($data['r']->getSmoke()/$data['r']->getNumOfRatings(),2)) ?>/5</p>
                            </div>
                        </div>
                        <div class="rating-item">
                            <p>Intensywność</p>
                            <div class="stars">
                                 <p><?php echo(($data['r']->getNumOfRatings() == 0) ? 0 :  round($data['r']->getIntensity()/$data['r']->getNumOfRatings(),2)) ?>/5</p>
                            </div>
                        </div>
                        <div class="rating-item">
                            <p>Pobudzenie</p>
                            <div class="stars">
                                <p><?php echo(($data['r']->getNumOfRatings() == 0) ? 0 :  round($data['r']->getStrength()/$data['r']->getNumOfRatings(),2)) ?>/5</p>
                            </div>
                        </div>
                        <div class="rating-item">
                            <p>Dodatki</p>
                            <div class="stars">
                                <p><?php echo(($data['r']->getNumOfRatings() == 0) ? 0 :  round($data['r']->getAddons()/$data['r']->getNumOfRatings(),2)) ?>/5</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="item-description">
                    <p><?php echo($data['y']->getDescription()) ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

    </div>

</body>
</html>