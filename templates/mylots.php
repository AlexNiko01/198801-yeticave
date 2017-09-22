<main>
    <?= $catMenu; ?>
    <section class="rates container">
        <h2>Мои ставки</h2>
        <table class="rates__list">
            <?php foreach ($ratedProducts as $key => $rate): ?>
                <?php $currentTime = strtotime('now');
                $rateData = gmdate(strtotime($rate['expire_date']) - $currentTime);
                $itemClass = ''; ?>
                <?php if ($rateData < 0) {
                    $itemClass = 'rates__item--end';
                } ?>
                <tr class="rates__item <?= $itemClass; ?>">
                    <td class="rates__info">
                        <div class="rates__img">
                            <img src="<?= $rate['photo']; ?>" width="54" height="40"
                                 alt="Сноуборд">
                        </div>
                        <h3 class="rates__title"><a href="lot.php?id=<?= $rate['lot_id'] ?>"><?= $rate['title']; ?></a>
                        </h3>
                    </td>
                    <td class="rates__category">
                        <?= $rate['cat_name']; ?>
                    </td>
                    <td class="rates__timer">
                        <?php $timerClass = ''; ?>
                        <?php if ($rateData <= 86400 && $rateData > 0): ?>
                            <?php $timerClass = 'timer--finishing' ?>
                        <?php endif; ?>
                        <?php if ($rateData <= 86400): ?>
                            <div class="timer <?= $timerClass; ?>">
                                <?= gmdate('H:i:s', $rateData); ?>
                            </div>
                        <?php endif; ?>
                    </td>
                    <td class="rates__price">
                        <?= $rate['price'] . ' p'; ?>
                    </td>
                    <td class="rates__time">
                        <?= $rate['date']; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>
</main>