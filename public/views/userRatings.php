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

    <?php foreach ($ratings as $commentID => $comment): ?>
        <div class="content-item">
            <div class="item-top">

                <a href="yerba?id=<?php echo($comment['c']->getIdYerba()) ?>" class="yerba-name"><?php echo($yerba[$comment['c']->getIdYerba()]->getName()) ?></a>
                <div class="add">
                <a href="editOpinion?id=<? echo($comment['c']->getId())?>" class="add-button">Edytuj opinie</a>
                </div>
            </div>

            <div class="item-body">
                <div class="photo-ratings">
                    <img src="public/uploads/yerba/<?= $yerba[$comment['c']->getIdYerba()]->getImage()?>">

                    <div class="rating">
                        <div class="rating-top">
                            <p><?php echo( $comment['r']->getGeneral()) ?>/5</p>
                        </div>

                        <img class="flag" src="public/uploads/flags/<?= $origins[$yerba[$comment['c']->getIdYerba()]->getOrigin()]->getFlag()?>">
                        <div class="rating-item">
                            <p>Pył</p>
                            <div class="stars">
                                <p><?php echo( $comment['r']->getDust()) ?>/5</p>
                            </div>
                        </div>
                        <div class="rating-item">
                            <p>Zielone nuty</p>
                            <div class="stars">
                                <!--                                <i class="fas fa-star"></i>-->
                                <p><?php echo( $comment['r']->getGreen()) ?>/5</p>
                            </div>
                        </div>
                        <div class="rating-item">
                            <p>Dymne nuty</p>
                            <div class="stars">
                                <p><?php echo( $comment['r']->getSmoke()) ?>/5</p>
                            </div>
                        </div>
                        <div class="rating-item">
                            <p>Intensywność</p>
                            <div class="stars">
                                <p><?php echo( $comment['r']->getIntensity()) ?>/5</p>
                            </div>
                        </div>
                        <div class="rating-item">
                            <p>Pobudzenie</p>
                            <div class="stars">
                                <p><?php echo( $comment['r']->getStrength()) ?>/5</p>
                            </div>
                        </div>
                        <div class="rating-item">
                            <p>Dodatki</p>
                            <div class="stars">
                                <p><?php echo( $comment['r']->getAddons()) ?>/5</p>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="item-description">
                    <p><?php echo($comment['c']->getContent()) ?></p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

</div>

</body>
</html>