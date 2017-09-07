<main>
    <nav class="nav">
        <ul class="nav__list container">
            <li class="nav__item">
                <a href="all-lots.html">Доски и лыжи</a>
            </li>
            <li class="nav__item">
                <a href="all-lots.html">Крепления</a>
            </li>
            <li class="nav__item">
                <a href="all-lots.html">Ботинки</a>
            </li>
            <li class="nav__item">
                <a href="all-lots.html">Одежда</a>
            </li>
            <li class="nav__item">
                <a href="all-lots.html">Инструменты</a>
            </li>
            <li class="nav__item">
                <a href="all-lots.html">Разное</a>
            </li>
        </ul>
    </nav>

    <form class="form form--add-lot container <?= !empty($errors) ? 'form--invalid' : '' ?>"
          action="/add.php" method="post" enctype="multipart/form-data" novalidate>
        <h2>Добавление лота</h2>
        <div class="form__container-two">
            <div class="form__item <?= key_exists('lot-name', $errors) ? 'form__item--invalid' : ''; ?>">
                <label for="lot-name">Наименование</label>
                <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота"
                       value="<?= $_POST['lot-name'] ?? ''; ?>">
                <?php if (key_exists('lot-name', $errors)): ?>
                    <span class="form__error">
                        <?php echo implode(', ', $errors['lot-name']) ?>
                    </span>
                <?php endif; ?>

            </div>
            <div class="form__item <?= key_exists('category', $errors) ? 'form__item--invalid' : ''; ?>">
                <label for="category">Категория</label>
                <select id="category" name="category">
                    <option selected value="">Выберите категорию</option>
                    <?php foreach ($cats as $cat): ?>
                        <option value="<?= $cat; ?>" <?= $_POST['category'] == $cat ? 'selected' : '' ?>><?= $cat; ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (key_exists('category', $errors)): ?>
                    <span class="form__error">
                        <?php echo implode(', ', $errors['category']) ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form__item form__item--wide <?= key_exists('message', $errors) ? 'form__item--invalid' : ''; ?>">
            <label for="message">Описание</label>
            <textarea id="message" name="message"
                      placeholder="Напишите описание лота"><?= $_POST['message'] ?? ''; ?></textarea>
            <?php if (key_exists('message', $errors)): ?>
                <span class="form__error">
                        <?php echo implode(', ', $errors['message']) ?>
                    </span>
            <?php endif; ?>
        </div>
        <div class="form__item form__item--file <?= $file_error_text ? 'form__item--invalid' : ''; ?>">
            <label>Изображение</label>
            <div class="preview">
                <button class="preview__remove" type="button">x</button>
                <div class="preview__img">
                    <img src="../img/avatar.jpg" width="113" height="113" alt="Изображение лота">
                </div>
            </div>
            <div class="form__input-file">
                <input class="visually-hidden" type="file" id="photo2" value="" name="lot-file">
                <label for="photo2">
                    <span>+ Добавить</span>
                </label>
            </div>
            <?php if ($file_error_text): ?>
                <span class="form__error"><?= $file_error_text; ?></span>
            <?php endif; ?>
        </div>
        <div class="form__container-three">
            <div class="form__item form__item--small <?= key_exists('lot-rate', $errors) ? 'form__item--invalid' : ''; ?>">
                <label for="lot-rate">Начальная цена</label>
                <input id="lot-rate" type="number" name="lot-rate" placeholder="0"
                       value="<?= $_POST['lot-rate'] ?? ''; ?>">
                <?php if (key_exists('lot-rate', $errors)): ?>
                    <span class="form__error">
                        <?php echo implode(', ',$errors['lot-rate']) ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="form__item form__item--small <?= key_exists('lot-step', $errors) ? 'form__item--invalid' : ''; ?>">
                <label for="lot-step">Шаг ставки</label>
                <input id="lot-step" type="number" name="lot-step" placeholder="0"
                       value="<?= $_POST['lot-step'] ?? ''; ?>">
                <?php if (key_exists('lot-step', $errors)): ?>
                    <span class="form__error">
                        <?php echo implode(', ',$errors['lot-step']) ?>
                    </span>
                <?php endif; ?>
            </div>
            <div class="form__item <?= key_exists('lot-date', $errors) ? 'form__item--invalid' : ''; ?>">
                <label for="lot-date">Дата завершения</label>
                <input class="form__input-date" id="lot-date" type="text" name="lot-date" placeholder="20.05.2017"
                       value="<?= $_POST['lot-date'] ?? ''; ?>">
                <?php if (key_exists('lot-date', $errors)): ?>
                    <span class="form__error">
                        <?php echo implode(', ',$errors['lot-date']) ?>
                    </span>
                <?php endif; ?>
            </div>
        </div>
        <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
        <button type="submit" class="button">Добавить лот</button>
    </form>
</main>