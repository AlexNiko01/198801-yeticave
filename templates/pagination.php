<ul class="pagination-list">
    <li class="pagination-item pagination-item-prev"><a
                href="/index.php<?= ($currentPage != 1 && $currentPage > 2) ? '?page=' . ($currentPage - 1) : ''; ?>">Назад</a></li>
    <?php for ($i = 1; $i <= $pagesQuantity; $i++) {
        $class = '';
        if ($i == $currentPage) {
            $class = 'pagination-item-active';
        };
        $url = '/index.php';
        if ($i != 1) {
            $url = '/index.php?page=' . $i;
        }
        ?>
        <li class="pagination-item <?= $class; ?>"><a href="<?= $url; ?>"><?= $i; ?></a></li>
    <?php } ?>

    <li class="pagination-item pagination-item-next"><a href="/index.php<?= $currentPage != $pagesQuantity ? '?page=' . ($currentPage + 1) : ''; ?>">Вперед</a></li>
</ul>