<main class="container">
    <section class="promo">
        <h2 class="promo__title">Нужен стафф для катки?</h2>
        <p class="promo__text">На нашем интернет-аукционе ты найдёшь самое эксклюзивное сноубордическое и горнолыжное
            снаряжение.</p>
        <ul class="promo__list">
            <?php foreach ($cats as $cat): ?>
                <li class="promo__item promo__item--boards">
                    <a class="promo__link" href="all-lots.html"
                       style="background-image: url(../img/category-<?= $cat['id']; ?>.jpg);"><?= $cat['name']; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
    <section class="lots">
        <div class="lots__header">
            <h2>Открытые лоты</h2>
            <select class="lots__select">
                <?php foreach ($cats as $cat): ?>
                    <option><?= $cat['name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <ul class="lots__list">
            <?php foreach ($products as $key => $product): ?>
                <li class="lots__item lot">
                    <div class="lot__image">
                        <img src="<?= $product['photo']; ?>" width="350" height="260" alt="Сноуборд">
                    </div>
                    <div class="lot__info">
                        <span class="lot__category"><?= $product['cat']; ?></span>
                        <h3 class="lot__title"><a class="text-link"
                                                  href="lot.php?id=<?= $product['id'] ?>"><?= filterContent($product['title']); ?></a>
                        </h3>
                        <div class="lot__state">
                            <div class="lot__rate">
                                <span class="lot__amount">Стартовая цена</span>
                                <span class="lot__cost"><?= filterContent($product['start_price']); ?><b
                                            class="rub">р</b></span>
                            </div>
                            <div class="lot__timer timer">
                                <?= gmdate('d-m-y', strtotime($product['expire_date'])); ?>
                            </div>
                        </div>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </section>
</main>