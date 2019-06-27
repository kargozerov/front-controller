<h2><?php echo $name?>, добро пожаловать в личный кабинет</h2>


<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#addpicture" role="tab" aria-controls="home" aria-selected="true">Добавить картину</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#addArticle" role="tab" aria-controls="profile" aria-selected="false">Добавить статью</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="addpicture" role="tabpanel" aria-labelledby="home-tab">
<!--        Форма добавления картины-->
        <div class="margin-50 offset-3 col-6">
            <?php require_once "add_picture.php"?>
        </div>
    </div>
    <div class="tab-pane fade" id="addArticle" role="tabpanel" aria-labelledby="profile-tab">
        Форма добавления статьи
    </div>
</div>



