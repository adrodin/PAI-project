<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("head.php") ;?>
    <link rel="stylesheet" type="text/css" href="public/css/newYerba.css">
</head>

<body>

    <?php include("navigation.php") ;?>
    <div class="tmp"></div>
    <div class="content">
        <?php
        if(isset($message)){
            foreach($message as $messag) {
                ?>
                <h1> <?php echo $messag;?></h1>
                <?php
            }
        }
        ?>
        <h1>Dodaj Yerbe</h1>
        <form action="newYerba" method="POST" enctype="multipart/form-data">
            <div class="form-item">
                <label>Nazwa</label>
                <input name="name" type="text" placeholder="Nazwa">
            </div>
            <div class="form-item">
                <label>Opis</label>
                <textarea name="description" type="text" placeholder="Opis" cols="100" rows="20"></textarea>
            </div>
            <div class="form-item">
                <label>Zdjęcie</label>
                <input class="photo" type="file" name="file">
            </div>
            <label>Kraj pochodzenia</label>
            <div class="form-radio">

            <?php foreach ($origins as $origin):  ?>
                <div class="radio-item">
                    <input type="radio" id="<?= $origin->getId() ?>" name="origin" value="<?php echo($origin->getId()) ?>">
                    <label for="<?= $origin->getId() ?>"><?php echo(ucfirst($origin->getName())) ?></label>
                </div>
            <?php endforeach; ?>
            </div>
            <label>Typ</label>
            <div class="form-radio">

                <?php foreach ($types as $type):  ?>
                <div class="radio-item">
                    <input type="radio" id="<?= $type->getId() ?>" name="type" value="<?php echo($type->getId()) ?>">
                    <label for="<?= $type->getId() ?>"><?php echo(ucfirst($type->getName())) ?></label>
                </div>
                <?php endforeach; ?>
            </div>
            <div class="form-item">
                <label>Dodatki</label>
                <input name="addons" type="text" placeholder="Wymień użyte dodatki po przecinku, np. guarana, mięta, trawa cytrynowa">
            </div>
            <div class="form-item">
            <button class="settings-button" type="submit">Dodaj yerbe</button>
            </div>
        </form>


    </div>
</body>