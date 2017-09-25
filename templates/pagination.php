<ul class="pagination-list">
    <li class="pagination-item pagination-item-prev">
        <?php if(($currentPage != 1)): ?>
        <a
                href="<?= $baseUrl . (($currentPage != 1 && $currentPage > 2) ? 'page=' . ($currentPage - 1) : ''); ?>">Назад</a>
        <?php endif; ?>
    </li>
    <?php for ($i = 1; $i <= $pagesQuantity; $i++) {
        $class = '';
        if ($i == $currentPage) {
            $class = 'pagination-item-active';
        };
        $url = $baseUrl;
        if ($i != 1) {
            $url = $baseUrl . 'page=' . $i;
        }
        ?>
        <li class="pagination-item <?= $class; ?>"><a href="<?= $url; ?>"><?= $i; ?></a></li>
    <?php } ?>
    <li class="pagination-item pagination-item-next">
        <?php if($currentPage != $pagesQuantity): ?>
        <a
                href="<?= $baseUrl . ($currentPage != $pagesQuantity ? 'page=' . ($currentPage + 1) : ''); ?>">Вперед</a>
        <?php endif; ?>
    </li>
</ul>