<?php
$required_text = 'Заполните это поле';
$rules_text = 'Данное значение должно быть числовым';
$errors_required = $errors['errors_required'];
$errors_rules = $errors['errors_rules'];
?>
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

    <form class="form form--add-lot container <?= !empty($errors_required) || !empty($errors_rules) ? 'form--invalid' : '' ?>"
          action="/add.php" method="post" enctype="multipart/form-data">
        <h2>Добавление лота</h2>
        <div class="form__container-two">
            <div class="form__item <?= in_array('lot-name', $errors_required) ? 'form__item--invalid' : ''; ?>">
                <label for="lot-name">Наименование</label>
                <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота"
                       value="<?= $_POST['lot-name'] ?? ''; ?>">
                <?php if (in_array('lot-name', $errors_required)): ?>
                    <span class="form__error"><?= $required_text; ?></span>
                <?php endif; ?>

            </div>
            <div class="form__item <?= in_array('category', $errors_required) ? 'form__item--invalid' : ''; ?>">
                <label for="category">Категория</label>
                <select id="category" name="category">
                    <option selected value="">Выберите категорию</option>
                    <?php foreach ($cats as $cat): ?>
                        <option value="<?= $cat; ?>" <?= $_POST['category'] == $cat ? 'selected' : '' ?>><?= $cat; ?></option>
                    <?php endforeach; ?>
                </select>
                <?php if (in_array('category', $errors_required)): ?>
                    <span class="form__error"><?= $required_text; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <div class="form__item form__item--wide <?= in_array('message', $errors_required) ? 'form__item--invalid' : ''; ?>">
            <label for="message">Описание</label>
            <textarea id="message" name="message"
                      placeholder="Напишите описание лота"><?= $_POST['message'] ?? ''; ?></textarea>
            <?php if (in_array('message', $errors_required)): ?>
                <span class="form__error"><?= $required_text; ?></span>
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
            <div class="form__item form__item--small <?= (in_array('lot-rate', $errors_required) || in_array('lot-rate', $errors_rules)) ? 'form__item--invalid' : ''; ?>">
                <label for="lot-rate">Начальная цена</label>
                <input id="lot-rate" type="number" name="lot-rate" placeholder="0"
                       value="<?= $_POST['lot-rate'] ?? ''; ?>">
                <?php if (in_array('lot-rate', $errors_required)): ?>
                    <span class="form__error"><?= $required_text; ?></span>
                <?php endif; ?>
                <?php if (in_array('lot-rate', $errors_rules)): ?>
                    <span class="form__error"><?= $rules_text; ?></span>
                <?php endif; ?>
            </div>
            <div class="form__item form__item--small <?= (in_array('lot-step', $errors_required) || in_array('lot-step', $errors_rules)) ? 'form__item--invalid' : ''; ?>">
                <label for="lot-step">Шаг ставки</label>
                <input id="lot-step" type="number" name="lot-step" placeholder="0"
                       value="<?= $_POST['lot-step'] ?? ''; ?>">
                <?php if (in_array('lot-step', $errors_required)): ?>
                    <span class="form__error"><?= $required_text; ?></span>
                <?php endif; ?>
                <?php if (in_array('lot-step', $errors_rules)): ?>
                    <span class="form__error"><?= $rules_text; ?></span>
                <?php endif; ?>
            </div>
            <div class="form__item <?= in_array('lot-date', $errors_required) ? 'form__item--invalid' : ''; ?>">
                <label for="lot-date">Дата завершения</label>
                <input class="form__input-date" id="lot-date" type="text" name="lot-date" placeholder="20.05.2017"
                       value="<?= $_POST['lot-date'] ?? ''; ?>">
                <?php if (in_array('lot-date', $errors_required)): ?>
                    <span class="form__error"><?= $required_text; ?></span>
                <?php endif; ?>
            </div>
        </div>
        <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
        <button type="submit" class="button">Добавить лот</button>
    </form>
</main>