<?php

//define("DIR_SMALL", $_SERVER['DOCUMENT_ROOT']); 
//define("DIR_BIG",__DIR__ . "/gallery_img/big/");
//define("DIR_SMALL",__DIR__ . "/gallery_img/small/");

$images = getImages ();

function getImages ()
{
	return array_splice(scandir('gallery_img/small'), 2);
}

$messages = [
	'ok' => 'Файл загружен',
	'error' => 'Ошибка загрузки',
	'wrong_size' => 'Недопустимый размер',
	'wrong_format' => 'Недопустимый формат',
];

if (!empty($_FILES)) {

	$path = "gallery_img/small/" . $_FILES['myFile']['name'];

	//check the file here
	var_dump($FILES['myFile']['size']);
	if ($FILES['myFile']['size'] > 1024 * 1 * 1024) {

		echo "Размер файла не больше 5 мб";
		exit;
	} else {

		if (move_uploaded_file($_FILES['myFile']['tmp_name'], $path)) {

		//change the size here
		$message = "ok";

	} else {

		$message = "error";

	}
	header("location: mygallery.php?message=" . $message);
	die();

	}

	
}
$viewMessage = $messages[$_GET['message']];

?>
<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<title>Моя галерея</title>
	<link rel="stylesheet" type="text/css" href="style.css?<?=rand(1, 1000000);?>"/>
</head>
<body>
	<div id="main">
	<div class="post_title"><h2>Моя галерея</h2></div>
		<div class="gallery">
			<?php foreach ($images as $value): ?>
			<a rel="gallery" class="photo" href="gallery_img/big/<?=$value?>"><img src="gallery_img/small/<?=$value?>" width="150" height="100" /></a>
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
