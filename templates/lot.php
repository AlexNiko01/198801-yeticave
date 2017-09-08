<main>
    <?php renderCatMenu(); ?>
    <section class="lot-item container">
        <h2><?= $product['title'] ?></h2>
        <div class="lot-item__content">
            <div class="lot-item__left">
                <div class="lot-item__image">
                    <?php if ($product['img_url']): ?>
                        <img src="<?= $product['img_url'] ?>" width="730" height="548" alt="Сноуборд"
                             style="width: 100%;height: auto;">
                    <?php else: ?>
                        <img src="http://placehold.it/730x550"/>
                    <?php endif; ?>
                </div>
                <p class="lot-item__category">Категория: <span><?= $product['cat'] ?></span></p>
                <p class="lot-item__description">
                    <?php if ($product['descr'] != ''): ?>
                        <?= $product['descr']; ?>
                    <?php else: ?>
                    Легкий маневренный сноуборд, готовый дать жару в любом парке, растопив
                    снег
                    мощным щелчкоми четкими дугами. Стекловолокно Bi-Ax, уложенное в двух направлениях, наделяет этот
                    снаряд
                    отличной гибкостью и отзывчивостью, а симметричная геометрия в сочетании с классическим прогибом
                    кэмбер
                    позволит уверенно держать высокие скорости. А если к концу катального дня сил совсем не останется,
                    просто
                    посмотрите на Вашу доску и улыбнитесь, крутая графика от Шона Кливера еще никого не оставляла
                    равнодушным.</p>
                <?php endif; ?>
            </div>
            <div class="lot-item__right">
                <?php
                $idAtCookie = getLotIdFromCookie($_GET['id']);
                ?>
                <?php if (isUserAuthenticated() && $idAtCookie === false): ?>
                    <div class="lot-item__state">
                        <div class="lot-item__timer timer">
                            10:54:12
                        </div>
                        <div class="lot-item__cost-state">
                            <div class="lot-item__rate">
                                <span class="lot-item__amount">Текущая цена</span>
                                <span class="lot-item__cost">11 500</span>
                            </div>
                            <div class="lot-item__min-cost">
                                Мин. ставка <span><?= $product['price'] ?></span>
                            </div>
                        </div>
                        <form class="lot-item__form" action="lot.php?id=<?= $_GET['id'] ?>" method="post">
                            <p class="lot-item__form-item <?= key_exists('cost', $errors) ? 'form__item--invalid' : '' ?>">
                                <label for="cost">Ваша ставка</label>
                                <input id="cost" type="number" name="cost" placeholder="12 000"
                                       value="<?= $_POST['cost'] ?>">
                                <?php if (key_exists('cost', $errors)): ?>
                                    <span class="form__error"><?= implode(', ', $errors['cost']) ?></span>
                                <?php endif; ?>
                            </p>
                            <input id="lot-id" type="hidden" name="lot-id" value="<?= $_GET['id'] ?>">
                            <button type="submit" class="button">Сделать ставку</button>
                        </form>
                    </div>
                <?php endif; ?>
                <div class="history">
                    <h3>История ставок (<span>4</span>)</h3>
                    <!-- заполните эту таблицу данными из массива $bets-->
                    <table class="history__list">
                        <?php foreach ($bets as $item): ?>
                            <tr class="history__item">
                                <td class="history__name"><?= $item['name']; ?></td>
                                <td class="history__price"><?= $item['price']; ?> р</td>
                                <td class="history__time"><?= timeFormat($item['ts']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>
