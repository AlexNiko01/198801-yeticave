<?php if (isset($_SESSION['id'])): ?>
    <div class="user-menu__image">
        <img src="<?= $user_avatar; ?>" width="40" height="40" alt="Пользователь">

    </div>
    <div class="user-menu__logged">
        <p><?= $_SESSION['user']; ?></p>
        <a href="logout.php">Выйти</a>
    </div>
<?php else : ?>
    <ul class="user-menu__list">
        <li class="user-menu__item">
            <a href="sign-up.php">Регистрация</a>
        </li>
        <li class="user-menu__item">
            <a href="login.php">Вход</a>
        </li>
    </ul>
<?php endif; ?>
