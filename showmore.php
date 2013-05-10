<?php
//随便加点什么

header('Content-Type: text/xml');
header("Cache-Control: no-cache, must-revalidate");
//A date in the past
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");


$q=$_GET["q"];
$con = mysqli_connect("localhost", "root", "123456", "rss_reader");
    if(mysqli_connect_error($con)){
        setcookie("error","Error in connecting to database："."<br>".mysqli_connect_error(),time()+3600);
        header("Location: error.php");
        die();
    }


$sql="SELECT  * FROM  item  WHERE id=1";

$result = mysqli_query($con,$sql);

echo '<?xml version="1.0" encoding="ISO-8859-1"?>
<item>';
$k=1;

while($row = mysqli_fetch_array($result))
 {
 if($k==1)
    {
      echo "<channel>" . $row['channeltitle'] . "</channel>";
      echo "<title>" . $row['title'] . "</title>";
      echo "<link>" . $row['link'] . "</link>";
      echo "<description>" . $row['description'] . "</description>";
      echo "<pubdate>" . $row['pubdate'] . "</pubdate>";
     }
 }
echo "</item>";

mysqli_close($con);

?>