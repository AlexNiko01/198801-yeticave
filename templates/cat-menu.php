<nav class="nav">
    <ul class="nav__list container">
   <?php foreach ($cats as $key=>$cat) { ?>
        <li class="nav__item">
            <a href="/category.php?cat_id=<?= $cat['id']; ?>"><?= $cat['name'] ?></a>
        </li>
   <?php } ?>
     </ul>
</nav>