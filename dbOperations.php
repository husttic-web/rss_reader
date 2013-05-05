<?php
/*
 * 该文件中的函数用来对数据库进行读/写操作
 */

include 'ConToDatabase.php';
/***********向指定项目表中插入数据,如果没有检索到的话插入，如果已有数据，就更新数据*******
****************************************成功返回1，否则返回0******************************/
function insert_item($sheet,$channeltitle,$title,$link,$description,$pubdate){
    $con = con();
    if(0 === isset_item($sheet,$title)){
        $sql = "insert into $sheet(channeltitle,title,link,description,pubdate) value('$channeltitle','$title','$link','$description','$pubdate')";
    }
    else{
        $sql = "update $sheet set channeltitle='$channeltitle', description='$description' , link='$link' , pubdate='$pubdate' where title='$title'";
    }
    if(!mysqli_query($con,$sql)){
        setcookie("error","Error in inserting into sheet:"."<br>".mysqli_error($con),time()+3600);
        header("Loction: error.php");
        return 0;
        die();
    }
    mysqli_close($con);
    return 1;
}

//判断指定表中是否有指定标题的这一项，如果是返回1，没有检索到返回0，查询出现异常返回-1
function isset_item($sheet,$title){
    $con = con();
    if($sheet==="channel")
        $sql = "select * from $sheet where channeltitle='$title'";
    else 
        $sql = "select * from $sheet where title='$title'";
    if(!mysqli_query($con,$sql)){
            setcookie("error","Error in selecting from sheet".mysqli_error($con),time()+3600);
            header("Location: error.php");
            die();
            return -1;
    }
    $result = mysqli_query($con,$sql);
    //判断取出的元素是否为空
    if(0 === mysqli_num_rows($result))
        return 0;
    mysqli_close($con);
    return 1;
}

//从指定项目表中提取指定数量的数据,返回一张表
function select_item($sheet,$begin,$num){
    $con = con();
    $sql = "select * from $sheet ORDER BY pubdate DESC limit $begin,$num";
    if(!mysqli_query($con,$sql)){
        setcookie("error","Error in querying from sheet:"."<br>".mysqli_error($con),time()+3600);
        header("Location: error.php");
        die();
    }
    $result = mysqli_query($con,$sql);
    $i=0;
    while($row = mysqli_fetch_array($result)){
        $item[$i] = $row;
        $i++;
    }
    mysqli_close($con);
    return $item;
}

/**********更新频道信息,如果已有频道，则更新，如果没有，就新建一个频道*****
 ******************成功返回1，否则返回0************************************/
function update_channel($type,$channeltitle,$link,$description,$pubdate){
    $con = con();
    if(1 === isset_item("channel", $channeltitle)){
        $sql = "update channel set type='$type', link='$link', description='$description' , pubdate='$pubdate' where channeltitle='$channeltitle'";
    }
    else{
        $sql = "insert into channel(type,channeltitle,description,link,pubdate) values('$type','$channeltitle','$description','$link','$pubdate')";
    }
    if(!mysqli_query($con,$sql)){
        setcookie("error","Error in updating channel:"."<br>".mysqli_error($con),time()+3600);
        header("Location: error.php");
        return 0;
        die();
    }
    mysqli_close($con);
    return 1;
}
?>
