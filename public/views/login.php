<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("head.php") ;?>
    <link rel="stylesheet" type="text/css" href="public/css/login.css">
</head>

<body>
    <?php session_start()?>
    <?php if($_SESSION["user"]) {?>
    <?php $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/rank");}?>
    <div class="content-container up">
        <object class="logo" type="image/svg+xml" data="public/img/logov2.svg">
            Your browser does not support SVG.
        </object>
    </div>


    <div class="content-container down">
        <div class="login-container">
            <h1>Logowanie</h1>
            <?php
            if(isset($message)){
                foreach($message as $messag) {
                    echo $messag;
                }
            }
            ?>
            <form action="login" method="POST">
                <div class="form-item">
                    <label>Email</label>
                    <div class="form-input-window">
                        <input name="email" type="text" placeholder="email@email.com">

                        <div class="icons">
                            <i class="fas fa-check-circle"></i>
                            <i class="fas fa-times-circle"></i>
                        </div>
                    </div>
                </div>


                <div class="form-item">
                    <label>Hasło</label>
                    <div class="form-input-window">
                        <input name="password" type="password" placeholder="password">

                        <div class="icons">
                            <i class="fas fa-eye"></i>
                            <i class="fas fa-question"></i>
                        </div>
                    </div>
                </div>

                <button type="submit">Zaloguj się</button>
            </form>
            <div class="registration-text">
                <p>Nie masz jeszcze konta? </p>
                <a href="registration"> Zarejestruj się </a>
            </div>
        </div>
    </div>
</body>

</html>