<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("head.php") ;?>
    <link rel="stylesheet" type="text/css" href="public/css/settings.css">

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
        <div>
        <h1>Zmiana hasła</h1>
        <form action="changePassword" method="POST">
            <div class="form-item">
                <label>Aktualne hasło</label>
                <input name="actualPassword" type="password" placeholder="Aktualne hasło">
            </div>
            <div class="form-item">
                <label>Nowe hasło</label>
                <input name="newPassword" type="password" placeholder="Nowe hasło">
            </div>
            <div class="form-item">
                <label>Powtórz nowe hasło</label>
                <input name="repeatNewPassword" type="password" placeholder="Powtórz nowe hasło">
            </div>
            <div class="form-item">
            <button class="settings-button" type="submit">Zmień hasło</button>
            </div>
        </form>
        </div>

        <div>
            <h1>Zmiana avatara</h1>

            <form action="changeAvatar" method="POST" enctype="multipart/form-data">
                <div class="form-item">
                <input class="input-avatar " type="file" name="file">
                </div>
                <div class="form-item">
                <button class="settings-button" type="submit">Zmień avatar</button>
                </div>
            </form>
        </div>

    </div>
</body>
