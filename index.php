<!DOCTYPE html>
<?php include 'XMLReader.php'; ?>
<html>
<head>
	<meta charset="utf-8">
	<title>google reader</title>
	<style type="text/css"></style>
	<link rel="stylesheet" type="text/css" href="css/theme.css">
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
                        <input type="button" value="订阅" /><br><br>
                        <input type="radio" name="category" checked="checked" />新闻&nbsp;|
                        <input type="radio" name="category" />科技&nbsp;|
                        <input type="radio" name="category" />经济
                        <div id="state"></div>
                        <div id="error"></div>
		</div>
		<div id="four">
			<h2>分类</h2>
			<ul class="category">
                            <li>新闻</li>
                            <li>科技</li>
                            <li>经济</li>
                            <?php //根据XML文件来源进行分类 ?>
			</ul>
		</div>
	</div>
	<div id="third">
		<input type="button" value="刷新">
		<input type="button" value="所有条目">
		<input type="button" value="全部标为已读">
		<input type="button" value="视图设置">
	</div>
	<div id="fifth">
		
	</div>
	
</body>