<?php


if (isset($_POST["headline"]) && isset($_POST["image"]) && 
isset($_POST["date"]) && isset($_POST["lieu"]) &&
isset($_POST["message"])) 
{

    $nom = $_POST["headline"];
    $image = $_POST["image"];
    $date = $_POST["date"];
    $lieu = $_POST["lieu"];
    $message = $_POST["message"];

    $data = array();
    $post = new Publication($data);
}
