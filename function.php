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
//向指定项目表中插入数据,成功返回1，否则返回0
function insert_item($sheet,$title,$link,$description,$pubdate){
    $con = con();
    $sql = "insert into $sheet(title,link,description,pubdate) value('$title','$link','$description','$pubdate')";
    if(!mysqli_query($con,$sql)){
        setcookie("error","Error in inserting into sheet:"."<br>".mysqli_error($con),time()+3600);
        header("Loction: error.php");
        return 0;
        die();
    }
    mysqli_close($con);
    return 1;
}

//从指定项目表中提取指定数量的数据,返回一张表
function select_item($sheet,$begin,$num){
    $con = con();
    $sql = "select * from $sheet limit $begin,$num";
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

//更新频道信息,成功返回1，否则返回0
function update_channel($title,$link,$description,$pubdate){
    $con = con();
    $sql = "update channel set link='$link' and description='$description' and pubdate='$pubdate' where title='$title'";
    if(!mysqli_query($con,$sql)){
        setcookie("error","Error in updating channel:"."<br>".mysqli_error($con));
        header("Location: error.php");
        return 0;
        die();
    }
    mysqli_close($con);
    return 1;
}

/****************用DOMDocument操作XML文档************************
 *****************成功返回 1 ，否则返回0************************/
function domdocument($xmlsrc,$sheet){
    $xml = new DOMDocument();
    if(!$xml->load($xmlsrc)){
        setcookie("error","无法解析的RSS地址",time()+3600);
        header("Loaction: error.php");
        return 0;
        die();
    }
    $xml->load($xmlsrc);
    $channelTag = $xml->getElementsByTagName("channel");
    $itemTag = $xml->getElementsByTagName("item");
    //给channel赋值，获取关于频道的信息
    foreach($channelTag as $value){
        $channel['title'] = $value->getElementsByTagName("title")->item(0)->nodeValue;
        $channel['description'] = $value->getElementsByTagName("description")->item(0)->nodeValue;
        $channel['link'] = $value->getElementsByTagName("link")->item(1)->nodeValue;
        $channel['pubdate'] = $value->getElementsByTagName("pubDate")->item(0)->nodeValue;
    }
    //获取关于频道下的项目的信息,存入表中
    $id=0; //id表示item的列号
    foreach($itemTag as $value){
        $item[$id]['title'] = $value->getElementsByTagName("title")->item(0)->nodeValue;
        $item[$id]['description'] = $value->getElementsByTagName("description")->item(0)->nodeValue;
        $item[$id]['link'] = $value->getElementsByTagName("link")->item(0)->nodeValue;
        $item[$id]['pubdate'] = $value->getElementsByTagName("pubDate")->item(0)->nodeValue;
        $id++;  
    }
    update_channel($channel['title'],$channel['link'],$channel['description'],$channel['pubdate']);
    foreach($item as $row){
        insert_item($sheet,$row['title'],$row['link'],$row['description'],$row['pubdate']);
    }
    return 1;
}





/***************用XMLReader读取XML文档，方法待完善******************
//读取XML文档，并调用函数插入相对应的表中
function xmlparse($xmlsrc,$sheet){
    $reader = new XMLReader();
    $channel = array();
    $item = array();
    if(!$reader->open($xmlsrc)){
        setcookie("error","无法解析的RSS地址",time()+3600);
        header("Location: error.php");
        die();
    }
    $reader->open($xmlsrc);
    $i = 0;
    //读取整个XML文档，并将相应的节点的值赋给数组$channel 和 $item
    while($reader->read() && $reader->name!=="item"){
                switch($reader->name){
                    case "title":
                        while($reader->read()){
                            if($reader->name==="#text" && $reader->value!=="" && $reader->nodeType===XMLReader::CDATA)
                                 $channel['title'] = $reader->value;break;
                        }
                    case "description":
                        while($reader->read()){
                            if($reader->name==="#text" && $reader->value!=="" && $reader->nodeType!==XMLReader::ELEMENT)
                                 $channel['description'] = $reader->value;break;
                        }
                    case "link":
                        while($reader->read()){
                            if($reader->name==="#text" && $reader->value!=="" && $reader->nodeType!==XMLReader::ELEMENT)
                                 $channel['link'] = $reader->value;break;
                        }
                    case "pubdate":
                        while($reader->read()){
                            if($reader->name==="#text" && $reader->value!=="" && $reader->nodeType!==XMLReader::ELEMENT)
                                 $channel['pubdate'] = $reader->value;break;
                        }
                }
    }
    while($reader->read()){
            switch($reader->name){
                case "title":
                    $item[$i]['title'] = $reader->value;
                case "link":
                    $item[$i]['link'] = $reader->value;
                case "description":
                    $item[$i]['description'] = $reader->value;
                case "pubdate":
                    $item[$i]['pubdate'] = $reader->value; 
            }
            echo $i;
            $i++;
            $reader->read();
        }
    update_channel($channel['title'],$channel['link'],$channel['description'],$channel['pubdate']);
    foreach($item as $row){
        insert_item($sheet,$row['title'],$row['link'],$row['description'],$row['pubdate']);
    }
    foreach($channel as $value){
        echo $value;
    }
}*/
?>
