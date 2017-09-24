<main class="container">
    <section class="lots">
        <div class="lots__header">
            <h2>Результаты поиска по запросу <?= ''; ?></h2>
        </div>
        <?php if (!empty($searchedData)): ?>
        <ul class="lots__list">
            <?php foreach ($searchedData as $key => $product): ?>
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
    <?= $pagination; ?>
    <?php else: ?>
        <p>по данному запросу нет результатов</p>
    <?php endif; ?>
</main>