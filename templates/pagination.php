<ul class="pagination-list">
    <li class="pagination-item pagination-item-prev"><a href="/index.php?page=1">Назад</a></li>
    <?php for ($i = 1; $i <= $pagesQuantity; $i++) {
        $class = '';
        if ($i == $currentPage) {
            $class = 'pagination-item-active';
        } ?>
        <li class="pagination-item"><a href="/index.php?page=<?= $i; ?>"><?= $i; ?></a></li>
    <?php } ?>

    <li class="pagination-item pagination-item-next"><a href="/index.php?page=<?= $pagesQuantity; ?>">Вперед</a></li>
</ul>