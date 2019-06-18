<h2>Главная страница</h2>
<!--$pictures-->
<div class="grid">
    <?php foreach ($pictures as $picture): ?>
    <div>
<!--        заголовок статьи-->
        <h2><?php echo $picture->getTitle(); ?></h2>
        <a href="/picture/show/<?php echo $picture->getId();?>">
            <img src="/img/<?php echo $picture->getPaths()[0]; ?>">
        </a>
    </div>
    <?php endforeach; ?>
</div>