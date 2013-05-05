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
    $type = $_GET['channel'];
    if(domdocument($xmlurl, $type)){
        return 1;
        die();
    }
    else{
        return 0;
    }
}

/*
 * 该函数接收发送来的关于请求更多的新闻信息的请求，以XML文档的形式返回，用来JS进行解析
 */
function morenews(){
    $channeltitle = $_GET['title'];
    
}
?>
