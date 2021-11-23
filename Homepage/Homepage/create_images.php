<?php

declare(strict_types = 1);
$files = empty($_POST['images']) ? null : $_POST['images'];

$stmt = MyPDO::getInstance()->prepare(<<<SQL
    INSERT INTO image VALUES (:file)
SQL
);

foreach ($files as $filesName) {
    $file = file_get_contents($fileName);
    if (file_put_contents($url, $file)){
        echo $url;
    }
}