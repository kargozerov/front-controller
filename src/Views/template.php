<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title;?></title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<nav>
    <ul>
        <li><a href="/">Главная</a></li>
        <li><a href="/info/rules">Правила</a></li>
        <li><a href="/info/contacts">Контакты</a></li>
        <li><a href="/article/show">Статьи</a></li>
    </ul>
</nav>

<div>
    <?php include_once $content;?>
</div>

</body>
</html>