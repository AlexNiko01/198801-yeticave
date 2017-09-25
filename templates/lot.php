<main>
    <section class="lot-item container">
        <h2><?= $product['title'] ?></h2>
        <div class="lot-item__content">
            <div class="lot-item__left">
                <div class="lot-item__image">
                    <?php if ($product['photo']): ?>
                        <img src="<?= $product['photo'] ?>" width="730" height="548" alt="photo"
                             style="width: 100%;height: 100%;">
                    <?php else: ?>
                        <img src="http://placehold.it/730x550"/>
                    <?php endif; ?>
                </div>
                <p class="lot-item__category">Категория: <span><?= $product['cat'] ?></span></p>
                <p class="lot-item__description">
                    <?= $product['description']; ?>
                </p>
            </div>
            <div class="lot-item__right">
                <?php if (isUserAuthenticated() && empty($usersId)): ?>
                    <div class="lot-item__state">
                        <div class="lot-item__timer timer" style="width: auto;display: inline-block;">
                            <?= gmdate('d-m-y', strtotime($product['expire_date'])); ?>
                        </div>
                        <div class="lot-item__cost-state">
                            <div class="lot-item__rate">
                                <span class="lot-item__amount">Текущая цена</span>
                                <span class="lot-item__cost"><?= $product['start_price'] ?></span>
                            </div>
                            <div class="lot-item__min-cost">
                                Мин. ставка <span><?= $product['rate_step'] ?? '100' ?></span>
                            </div>
                        </div>
                        <form class="lot-item__form" action="lot.php?id=<?= $_GET['id'] ?>" method="post">
                            <p class="lot-item__form-item <?= key_exists('cost', $errors) ? 'form__item--invalid' : '' ?>">
                                <label for="cost">Ваша ставка</label>
                                <input id="cost" type="number" name="cost" placeholder="<?= $product['start_price'] ?>"
                                       value="<?= $_POST['cost'] ?>">
                                <?php if (key_exists('cost', $errors)): ?>
                                    <span class="form__error"><?= implode(', ', $errors['cost']) ?></span>
                                <?php endif; ?>
                            </p>
                            <input id="lot-id" type="hidden" name="lot-id" value="<?= $_GET['id'] ?>">
                            <input id="lot_start_price" type="hidden" name="lot_start_price" value="<?= $product['start_price'] ?>">
                            <input id="lot_rate_step" type="hidden" name="lot_rate_step" value="<?= $product['rate_step'] ?? '100' ?>">
                            <button type="submit" class="button">Сделать ставку</button>
                        </form>
                    </div>
                <?php endif; ?>
                <?php if($rates): ?>
                <div class="history">
                    <h3>История ставок (<span>4</span>)</h3>
                    <table class="history__list">
                        <?php foreach ($rates as $rate): ?>
                            <tr class="history__item">
                                <td class="history__name"><?= $rate['name']; ?></td>
                                <td class="history__price"><?= $rate['price']; ?> р</td>
                                <td class="history__time"><?= timeFormat($rate['ts']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
</main>
