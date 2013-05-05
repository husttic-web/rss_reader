<?php
/*
 * 该文件中的函数用来处理通过XMLHttpRequest传来的信息，同时进行回递
 */
include 'XMLReader.php';

/*
 * 该函数接收发送来的关于订阅RSS的请求，成功返回1,否则返回0
 */
function subscription(){
    $xmlurl = $_GET['xmlurl'];
    $channel = $_GET['channel'];
    if(!domdocument($xmlurl, $channel)){
        setcookie("error","连接失败，请核实RSS源",time()+3600);
        header("Location: index.php");
        return 0;
        die();
    }
    else{
        return 1;
    }
}

/*
 * 该函数接收发送来的关于请求更多的新闻信息的请求，以XML文档的形式返回，用来JS进行解析
 */
function morenews(){
    
}
?>
