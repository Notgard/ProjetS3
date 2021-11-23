<?php
function randomId($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
$imgId = randomId(4);
$fileName = $_FILES['image']['tmp_name'];
$base_file_url = basename($fileName);
$file_url = str_replace("tmp", explode("/", $_FILES['image']['type'])[1], $base_file_url);
$url = __DIR__ . DIRECTORY_SEPARATOR ."img" . DIRECTORY_SEPARATOR . "img-post" . DIRECTORY_SEPARATOR . $imgId . $file_url;
echo $url;