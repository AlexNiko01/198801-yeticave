<main>
    <form class="form container <?= !empty($errors) ? 'form--invalid' : '' ?>" action="/sign-up.php" method="post" enctype="multipart/form-data" >
        <h2>Регистрация нового аккаунта</h2>
        <div class="form__item <?= key_exists('email', $errors) ? 'form__item--invalid' : ''; ?>">
            <label for="email">E-mail*</label>
            <input id="email" type="text" name="email" placeholder="Введите e-mail" value="<?= $_POST['email']; ?>">
            <?php if (key_exists('email', $errors)): ?>
                <span class="form__error">
                        <?php echo implode(', ', $errors['email']) ?>
                    </span>
            <?php endif; ?>
        </div>
        <div class="form__item <?= key_exists('password', $errors) ? 'form__item--invalid' : ''; ?>">
            <label for="password">Пароль*</label>
            <input id="password" type="password" name="password" placeholder="Введите пароль">
            <?php if (key_exists('password', $errors)): ?>
                <span class="form__error">
                        <?php echo implode(', ', $errors['password']) ?>
                    </span>
            <?php endif; ?>
        </div>
        <div class="form__item <?= key_exists('name', $errors) ? 'form__item--invalid' : ''; ?>">
            <label for="name">Имя*</label>
            <input id="name" type="text" name="name" placeholder="Введите имя" value="<?= $_POST['name']; ?>">
            <?php if (key_exists('name', $errors)): ?>
                <span class="form__error">
                        <?php echo implode(', ', $errors['name']) ?>
                    </span>
            <?php endif; ?>
        </div>
        <div class="form__item <?= key_exists('message', $errors) ? 'form__item--invalid' : ''; ?>">
            <label for="message">Контактные данные*</label>
            <textarea id="message" name="message" placeholder="Напишите как с вами связаться"><?= $_POST['message']; ?></textarea>
            <?php if (key_exists('message', $errors)): ?>
                <span class="form__error">
                        <?php echo implode(', ', $errors['message']) ?>
                    </span>
            <?php endif; ?>
        </div>
        <div class="form__item form__item--file form__item--last <?= $file_error_text ? 'form__item--invalid' : ''; ?>">
            <label>Изображение</label>
            <div class="preview">
                <button class="preview__remove" type="button">x</button>
                <div class="preview__img">
                    <img src="../img/avatar.jpg" width="113" height="113" alt="Изображение лота">
                </div>
            </div>
            <div class="form__input-file">
                <input class="visually-hidden" type="file" id="photo2" value="<?= $_FILES['file']; ?>" name="file">
                <label for="photo2">
                    <span>+ Добавить</span>
                </label>
            </div>
            <?php if ($file_error_text): ?>
                <span class="form__error"><?= $file_error_text; ?></span>
            <?php endif; ?>
        </div>
        <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
        <button type="submit" class="button">Зарегистрироваться</button>
        <a class="text-link" href="login.php">Уже есть аккаунт</a>
    </form>
</main>