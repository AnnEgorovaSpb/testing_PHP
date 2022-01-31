<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Моя галерея</title>
    <link rel="stylesheet" type="text/css" href="css/style.css?<?=rand(1, 1000000);?>"/>
</head>
<body>
    <div id="main">
    <div class="post_title"><h2>Моя галерея</h2></div>
        <div class="gallery">
            <?php foreach ($images as $name): ?>
            <a rel="gallery" class="photo" href="<?=$bigPath?><?=$name?>"><img src="<?=$smallPath?><?=$name?>" width="150" height="100" /></a>
            <?php endforeach; ?>
        </div>
        <div>
            <form method="post" enctype="multipart/form-data">
                <input type="file" name="myFile">
                <input type="submit" name="submit" value="Загрузить">
            </form>
            <div><?=$viewMessage?></div>
        </div>
    </div>
</body>
</html>