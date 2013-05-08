<!DOCTYPE html>
<?php include 'XMLReader.php'; ?>
<html>
<head>
	<meta charset="utf-8">
	<title>google reader</title>
	<style type="text/css"></style>
	<link rel="stylesheet" type="text/css" href="css/theme.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="ajax.js"></script>
		<script src="showmore.js"></script>
	
        <script>
            var category="news";
            $(document).ready(function(){
                $("div#news").click(function(){
                    $("div#newsinfo").slideToggle("slow");
                });
                $("div#tech").click(function(){
                    $("div#techinfo").slideToggle("slow");
                });
                $("div#economic").click(function(){
                    $("div#economicinfo").slideToggle("slow");
                });
            });
            function onClickForSubscription(){
                var xmlurl = document.getElementById("xmlurl");
                var error = document.getElementById("error");
                if(xmlurl.value === ""){
                    error.innerHTML = "请输入RSS源";
                }
                else{
                    error.innerHTML = "";
                    subscription(xmlurl.value,category);
                }
            }
            function getCategory(str){
                category = str;
            }
        </script>
</head>
<body>
	<div id="first">
		<a class="one">+您</a>
		<a class="one">搜索</a>
		<a class="one">图片</a>
		<a class="one">地图</a>
		<a class="one">PLAY</a>
		<a class="one">Youtube</a>
		<a class="one">新闻</a>
		<a class="one">Gmail</a>
		<a class="one">云端硬盘</a>
		<a class="one">日历</a>
		<a class="one">更多</a>
	</div>
	<div id="second">
                <p class="search">搜索：<input type="text" name="search">
		<input type="button" value="search"></p>
	</div>
	<div id="fourth">
		<div id="three">
                        <input type="text" id="xmlurl" style='height:18px;' />
                        <input type="button" value="订阅" onclick="onClickForSubscription();" /><br><br>
                        <input type="radio" name="category" checked="checked" value="news" onclick="getCategory('news');"/>新闻&nbsp;|
                        <input type="radio" name="category" value="tech" onclick="getCategory('tech');"/>科技&nbsp;|
                        <input type="radio" name="category" value="economic" onclick="getCategory('economic');"/>经济<br><br>
                        <div id="state"></div>
                        <div id="error"></div>
		</div>
		<div id="four">
			<h2>分类</h2>
                            <div class="channel" id="news">新闻</div>
                                <div class="category" id="newsinfo">
                                    <p class="category">你好！</p>
                                    <p class="category">hello!</p>
                                </div>
                            <div class="channel" id="tech">科技</div>
                                <div class="category" id="techinfo">
                                    
                                </div>
                            <div class="channel" id="economic">经济</div>
                                <div class="category" id="economicinfo">
                                    
                                </div>
		</div>
	</div>
	<div id="third">
		<input type="button" value="刷新">
		<input type="button" value="所有条目">
		<input type="button" value="全部标为已读">
		<input type="button" value="视图设置">
	</div>
	<div id="fifth">
		<button type="button" onclick="showHint('a')"> showmore</button> 
		<p id="a">sdsd <p>
	
	
	
</body>
</html>