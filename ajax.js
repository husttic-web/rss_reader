/*
 * 建立XMLHttpRequest对象,返回一个对象实体
 */
function createXMLHttp(){
    var xmlhttp;
    if(window.XMLHttpRequest)
        xmlhttp = new XMLHttpRequest();
    else
        xmlhttp = new ActiveObject("Microsoft.XMLHTTP");
    return xmlhttp;
}
/*
 * 以下函数实现订阅的功能
 */
function subscription(xmlurl){
    var xmlhttp = createXMLHttp();
    var url;
    url = "xmlhttp.php";
    url = url + "?xmlurl="+xmlurl;
    url = url + "&id=" + Math.random();
    xmlhttp.onreadystatechange = stateChangeOnSubscription();
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
}

function stateChangeOnSubscription(){
    var state;
    state = document.getElementById("state");
    if(xmlhttp.readystate === 4){
        state.innerHTML = "正在连接中，请稍后";
    }
}

/*
 * 以下函数实现动态加载新闻功能
 */
function moreNews(channeltitle){
    var xmlhttp;
    var query;
    xmlhttp = creatXMLHttp();
    query = "xmlhttp.php";
    query = query + "?title=" + channeltitle;
    query = query + "&id=" + Math.random();
    xmlhttp.onreadystatechange = stateChangeOnMoreNews();
    xmlhttp.open("GET",xmlhttp,true);
    xmlttp.send();
}

function stateChangeOnMoreNews(){
    //这里的代码应该解析服务器返回的XML文档，并且将其输出到网页中
}