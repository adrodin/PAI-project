<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("head.php") ;?>
    <link rel="stylesheet" type="text/css" href="public/css/rank.css">
    <link rel="stylesheet" type="text/css" href="public/css/yerba.css">
    <link rel="stylesheet" type="text/css" href="public/css/newYerba.css">
</head>
<body>
<?php include("navigation.php") ;?>

<div class="tmp">
</div>
<div class="content">
    <div>
        <div class="item-top">
            <a href="#" class="yerba-name"><?php echo($yerba['y']->getName()) ?></a>
        </div>
        <div class="item-body">
            <div class="photo-ratings">
                <img src="public/uploads/yerba/<?= $yerba['y']->getImage()?>">
                <div class="ratings-from">
                    <form action="addOpinion?id=<? $yerba['y']->getId()?>" method="POST">
                        <p>Ogólnie</p>
                        <div class="one-rating">
                        <?php foreach (range(1,5) as $id):  ?>
                            <div class="radio-item">
                                <input type="radio" id="<?= $id ?>" name="general" value="<?php echo($id) ?>">
                                <label for=""><?php echo($id) ?></label>
                            </div>
                        <?php endforeach; ?>
                        </div>
                        <p>Pył</p>
                        <div class="one-rating">
                        <?php foreach (range(1,5) as $id):  ?>
                            <div class="radio-item">
                                <input type="radio" id="<?= $id ?>" name="dust" value="<?php echo($id) ?>">
                                <label for=""><?php echo($id) ?></label>
                            </div>
                        <?php endforeach; ?>
                        </div>
                        <p>Dymne nuty</p><div class="one-rating">
                        <?php foreach (range(1,5) as $id):  ?>
                            <div class="radio-item">
                                <input type="radio" id="<?= $id ?>" name="smoke" value="<?php echo($id) ?>">
                                <label for=""><?php echo($id) ?></label>
                            </div>
                        <?php endforeach; ?>
                        </div>
                        <p>Zielone nuty</p><div class="one-rating">
                            <?php foreach (range(1,5) as $id):  ?>
                                <div class="radio-item">
                                    <input type="radio" id="<?= $id ?>" name="green" value="<?php echo($id) ?>">
                                    <label for=""><?php echo($id) ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <p>Intensywność</p>
                        <div class="one-rating">
                        <?php foreach (range(1,5) as $id):  ?>
                            <div class="radio-item">
                                <input type="radio" id="<?= $id ?>" name="intensity" value="<?php echo($id) ?>">
                                <label for=""><?php echo($id) ?></label>
                            </div>
                        <?php endforeach; ?>
                        </div>
                        <p>Pobudzenie</p>
                        <div class="one-rating">
                        <?php foreach (range(1,5) as $id):  ?>
                            <div class="radio-item">
                                <input type="radio" id="<?= $id ?>" name="strength" value="<?php echo($id) ?>">
                                <label for=""><?php echo($id) ?></label>
                            </div>
                        <?php endforeach; ?>
                        </div>
                        <p>Dodatki</p>
                        <div class="one-rating">
                        <?php foreach (range(1,5) as $id):  ?>
                            <div class="radio-item">
                                <input type="radio" id="<?= $id ?>" name="addons" value="<?php echo($id) ?>">
                                <label for=""><?php echo($id) ?></label>
                            </div>
                        <?php endforeach; ?>
                        </div>
                        <textarea name="commentText" type="text" placeholder="Twój komentarz..." cols="100" rows="20"></textarea>



                        <button class="add-comment-button" type="submit" value="<?php echo($yerba['y']->getId()) ?>">Dodaj komentarz</button>
                    </form>

                </div>

            </div>
        </div>
    </div>
</div>
</body>
</html>