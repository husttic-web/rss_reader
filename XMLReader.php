<?php
/*
 * 该文件中的函数用来解析XML文档，并且存入数据库相应的表中
 */

include 'dbOperations.php';
//用来去除指定字符串中的多余空格
function nospace($str){
    $str=explode(" ",$str);
	for($i=0,$j=0;$i<count($str);$i++)
	{
	   if($str[$i]!=' ')
	   {
	    $stb[$j]=$str[$i];
		$j++;
	    }
	}
	$string = implode(" ",$stb);
        return $string;
}

/****************用DOMDocument操作XML文档************************
 *****************成功返回 1 ，否则返回0************************/
function domdocument($xmlsrc,$sheet){
    $xml = new DOMDocument();
    if(!$xml->loadXML($xmlsrc)){
        setcookie("error","无法解析的RSS地址",time()+3600);
        header("Loaction: error.php");
        return 0;
        die();
    }
    $channelTag = $xml->getElementsByTagName("channel");
    $itemTag = $xml->getElementsByTagName("item");
    //给channel赋值，获取关于频道的信息
    foreach($channelTag as $value){
        $channel['title'] = nospace($value->getElementsByTagName("title")->item(0)->nodeValue);
        $channel['description'] = nospace($value->getElementsByTagName("description")->item(0)->nodeValue);
        $channel['link'] = str_replace(" ","",$value->getElementsByTagName("link")->item(1)->nodeValue);
        $channel['pubdate'] = $value->getElementsByTagName("pubDate")->item(0)->nodeValue;
    }
    //获取关于频道下的项目的信息,存入表中
    $id=0; //id表示item的列号
    foreach($itemTag as $value){
        $item[$id]['title'] = nospace($value->getElementsByTagName("title")->item(0)->nodeValue);
        $item[$id]['description'] = nospace($value->getElementsByTagName("description")->item(0)->nodeValue);
        $item[$id]['link'] = str_replace(" ","",$value->getElementsByTagName("link")->item(0)->nodeValue);
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
