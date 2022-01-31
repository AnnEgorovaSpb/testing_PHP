<?php

$bigPath = "/gallery_img/big/";
$smallPath = "/gallery_img/small/";
 
define("DIR_BIG",__DIR__ . $bigPath);
define("DIR_SMALL",__DIR__ . $smallPath);

$images = getImages(DIR_BIG);

function getImages($path)
{
    return array_splice(scandir($path), 2);
}

$messages = [
    'ok' => 'Файл загружен',
    'error' => 'Ошибка загрузки',
];

if (!empty($_FILES)) {
    $path = DIR_BIG . $_FILES['myFile']['name'];

    //size check
    if ($_FILES['myFile']['size'] > 1024*1*1024) {
        echo "Размер файла не больше 5 мб";
        exit;
    }

    //extension check
    $blacklist = array(".php", ".phtml", ".php3", ".php4");
        foreach ($blacklist as $item) {
            if(preg_match("/$item\$/i", $_FILES['myFile']['name'])) {
                echo "Загрузка PHP-файлов запрещена";
                exit;
            }
        }

    //file type check
    $imageinfo = getimagesize($_FILES['myFile']['tmp_name']);
        if($imageinfo['mime'] != 'image/gif' && $imageinfo['mime'] != 'image/jpeg') {
            echo "Можно загружать только GIF и JPEG файлы";
            exit;
        }

    if (move_uploaded_file($_FILES['myFile']['tmp_name'], $path)) {
        //change the size here
        $image = new SimpleImage();
        $image->load($path);
        $image->resizeToWidth(250);
        $image->save(DIR_SMALL . $_FILES['myFile']['name']);

        $message = "ok";
    } else {
        $message = "error";
    }
    header("location:" . $_SERVER['PHP_SELF'] . "?message=" . $message);
    die();	
}

$viewMessage = $messages[$_GET['message']];