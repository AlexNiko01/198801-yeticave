<main>
    <?= $catMenu;?>
    <section class="rates container">
        <h2>Мои ставки</h2>
        <table class="rates__list">
            <?php foreach ($ratedProducts as $key => $rate): ?>
                <?php if (!$rate['product']) {
                    continue;
                } ?>
                <tr class="rates__item">
                    <td class="rates__info">
                        <div class="rates__img">
                            <img src="<?= $rate['product']['img_url']; ?>" width="54" height="40"
                                 alt="Сноуборд">
                        </div>
                        <h3 class="rates__title"><a href="lot.php?id=<?= $rate['lot-id'] ?>"><?= $rate['product']['title']; ?></a></h3>
                    </td>
                    <td class="rates__category">
                        <?= $rate['product']['cat']; ?>
                    </td>
                    <td class="rates__timer">
                        <div class="timer timer--finishing">07:13:34

                        </div>
                    </td>
                    <td class="rates__price">
                        <?= $rate['cost'] . ' p'; ?>
                    </td>
                    <td class="rates__time">
                        <?php
                        $currentTime = strtotime('now');
                        $reteData = gmdate($currentTime - $rate['data']) ?>
                        <?= timeFormat($reteData); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </section>
</main>