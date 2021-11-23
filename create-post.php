<?php

declare(strict_types=1);

$pubDate = empty($_POST['date']) ? null : $_POST['date'];
$image = empty($_POST['imagePost']) ? null : $_POST['imagePost'];
$postText = empty($_POST['headline']) ? null : $_POST['headline'];

$data_array;