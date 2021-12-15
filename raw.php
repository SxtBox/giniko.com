<?php
// GET ?id=ID
$id = isset($_GET["id"]) && !empty($_GET["id"]) ? $_GET["id"] : "1239";
ini_set("user_agent","iPhone");

function get_data($url) {
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    //curl_setopt($ch, CURLOPT_USERAGENT, "iPhone");
    curl_setopt($ch, CURLOPT_REFERER, "http://www.giniko.com");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

$link = get_data("http://www.giniko.com/watch.php?id=" . $id);
preg_match('/source:"(http.*?)"/',$link,$matches);
$stream = $matches[1];
$stream = str_replace("\/", "/", $stream);
echo $stream;
?>