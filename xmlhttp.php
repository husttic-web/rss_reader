<?php
/*
 * 接收ajax请求，并调用reponseFunction中的函数对请求进行处理
 */
include 'reponseFunction.php';
/*
 * 接收请求，判断请求类型
 */
if(isset($_GET['type'])){
    if($_GET['type']==="subscription"){
        if(subscription())
            echo "success";
        else
            echo "fail";
    }
    else{
        morenews();
    }
}
?>
