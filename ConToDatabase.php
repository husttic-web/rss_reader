<?php
//连接数据库
function con(){
    $con = mysqli_connect("localhost", "rss_reader", "123456", "rss_reader");
    if(mysqli_connect_error($con)){
        setcookie("error","Error in connecting to database："."<br>".mysqli_connect_error(),time()+3600);
        header("Location: error.php");
        die();
    }
    return $con;
}
?>
