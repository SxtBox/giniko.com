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
preg_match('/title:"(.*?)".source:"(http.*?)"/',$link,$matches);
$stream = $matches[2];
$stream = str_replace("\/", "/", $stream);
$title = $matches[1];
if (is_null($matches[1]))
{
echo "Stream is NULL";
}
else
{
header('Content-Type: text/plain');
echo "#EXTM3U #TRC4 Streaming Tools"."\n";
echo "#EXTVLCOPT--http-reconnect=true"."\n";
echo "#EXTVLCOPT:http-user-agent=Vari Karin"."\n";
echo "#EXTVLCOPT:http-referrer=http://www.giniko.com"."\n";
echo "#EXTINF:-1,$title"."\n";
echo "$stream"."\n";
}
?>