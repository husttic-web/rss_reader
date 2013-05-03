
<?php

include 'function.php';
$xml = file_get_contents("http://rss.sina.com.cn/tech/rollnews.xml");
echo $xml;
domdocument($xml, "item");
?>
