<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("head.php") ;?>
    <link rel="stylesheet" type="text/css" href="public/css/login.css">

</head>

<body>
    <div class="content-container up">
        <object class="logo" type="image/svg+xml" data="public/img/logov2.svg">
            Your browser does not support SVG.
        </object>
    </div>


    <div class="content-container down">
        <div class="login-container">
            <h1>Rejestracja</h1>
            <?php
            if(isset($message)){
                foreach($message as $messag) {
                    echo $messag;
                }
            }
            ?>
            <form method="post" action="registration">

                <div class="form-item">
                    <label>Imie</label>
                    <div class="form-input-window">
                        <input name="name" type="text" placeholder="NoName">
                    </div>
                </div>

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

                <div class="form-item">
                    <label>Powtórz hasło</label>
                    <div class="form-input-window">
                        <input name="confirmedPassword" type="password" placeholder="password">

                        <div class="icons">
                            <i class="fas fa-eye"></i>
                            <i class="fas fa-question"></i>
                        </div>
                    </div>
                </div>

                <button type="submit">Zarejestruj się</button>
            </form>
            <div class="registration-text">
                <p>Masz już konto? </p>
                <a href="login"> Zaloguj się </a>
            </div>
        </div>
    </div>
</body>

</html>