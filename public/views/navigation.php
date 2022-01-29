<nav>
    <?php session_start()?>
    <?php $user = unserialize($_SESSION['user'])?>

    <object class="logo-nav nav-item" type="image/svg+xml" data="public/img/logov2.svg">
        Your browser does not support SVG.
    </object>
    <div class="nav-item">
        <i class="fas fa-medal"></i>
        <a href="rank" class="nav-button">Ranking</a>
    </div>
    <div class="nav-item">
        Szukaj
    </div>
    <?php if($user) { ?>
    <div class="nav-item">
        <i class="fas fa-medal"></i>
        <a href="#" class="nav-button">Twoje oceny</a>
    </div>
        <?php if($user->getRoleId() > 1) {?>
    <div class="nav-item">
        <i class="fas fa-plus"></i>
        <a href="newYerba" class="nav-button">Dodaj yerbe</a>
    </div>
            <?php } ?>
    <div class="nav-item user-info">
        <img class='nav-avatar' src="public/uploads/avatars/<?= $user->getAvatar()?>">
         <?php echo($user->getName())?>
    </div>
    <div class="nav-item">
        <i class="fas fa-cog"></i>
        <a href="settings" class="nav-button">Ustawienia</a>
    </div>
    <div class="nav-item">
        <i class="fas fa-sign-out-alt"></i>
        <a href="logout" class="nav-button">Wyloguj się</a>

    </div>
    <?php }else { ?>
    <div class="">
        <div class="login-item">
            <i class="fas fa-sign-in-alt"></i>
            <a href="login" class="nav-button user-info">Zaloguj się</a>
        </div>
        <div class="login-text">
            Nie masz konta? <a href="registration">Zarejestruj się</a>
        </div>
    </div>
    <?php }?>
</nav>
