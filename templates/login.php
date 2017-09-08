<main>
    <?php renderCatMenu(); ?>
    <form class="form container <?= !empty($errors) ? 'form--invalid' : '' ?>" action="login.php" method="post">
        <!-- form--invalid -->
        <h2>Вход</h2>
        <div class="form__item <?= key_exists('email', $errors) ? 'form__item--invalid' : ''; ?>"> <!-- form__item--invalid -->
            <label for="email">E-mail*</label>
            <input id="email" type="text" name="email" placeholder="Введите e-mail"
                   value="<?= $_POST['email'] ?? ''; ?>">
            <?php if (key_exists('email', $errors)): ?>
                <span class="form__error">
                    <?php echo implode(', ', $errors['email']) ?>
                </span>
            <?php endif; ?>
        </div>
        <div class="form__item form__item--last  <?= (key_exists('password', $errors) || $passwordErrorMessage )? 'form__item--invalid' : ''; ?>">
            <label for="password">Пароль*</label>
            <input id="password" type="text" name="password" placeholder="Введите пароль">
            <?php if (key_exists('password', $errors)): ?>
                <span class="form__error">
                    <?php echo implode(', ', $errors['password']) ?>
                </span>
            <?php endif; ?>
            <?php if($passwordErrorMessage): ?>
                <span class="form__error">
                    <?= $passwordErrorMessage ?>
                </span>
            <?php endif; ?>
        </div>
        <button type="submit" class="button">Войти</button>
    </form>
</main>