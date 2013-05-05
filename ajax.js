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
function subscription(xmlurl,channel){
    var xmlhttp = createXMLHttp();
    var url;
    var loc = window.location.href;
    url = loc.substring(0,loc.lastIndexOf('/'));
    url = url + "/xmlhttp.php";
    url = url + "?xmlurl="+xmlurl;
    url = url + "&channel="+channel;
    url = url + "&type=subscription";
    url = url + "&id=" + Math.random();
    xmlhttp.onreadystatechange = function stateChangeOnSubscription(){
                                            var state,error;
                                            state = document.getElementById("state");
                                            error = document.getElementById("error");
                                            if(xmlhttp.readystate !== 4 && xmlhttp.readystate !== "complete"){
                                                    state.innerHTML = "正在连接中，请稍后";
                                            }
                                            else{
                                                    if(xmlhttp.responseText === "success")
                                                        state.innerHTML = "连接成功！";
                                                    else
                                                        error.innerHTML = xmlhttp.responseText;
                                            }
                                    };
    xmlhttp.open("GET",url,true);
    xmlhttp.send();
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
    query = query + "&type=morenews";
    query = query + "&id=" + Math.random();
    xmlhttp.onreadystatechange = stateChangeOnMoreNews();
    xmlhttp.open("GET",xmlhttp,true);
    xmlttp.send();
}

function stateChangeOnMoreNews(){
    //这里的代码应该解析服务器返回的XML文档，并且将其输出到网页中
}