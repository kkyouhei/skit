<!DOCTYPE html PUBLIC "./W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang = "ja" xml:lang="ja" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>
	<?php echo $title_for_layout ; ?>
</title>
<style type="text/css">
	*{margin:0px;}
</style>
<?php 
	echo $html->css('skit.layout');
	echo $scripts_for_layout;
 ?>
</head>
<body>
	<div id="pagebody">
	
		<!-- Header -->
		<div id="header">
			<ul>
				<li id="menu01"><a href="http://localhost/skit/index">HOME</a></li>
				<li id="menu02"><a href="http://localhost/skit/addstudent">個人情報登録</a></li>
				<li id="menu03"><a href="http://localhost/skit/opencampus">オープンキャンパス予約</a></li>
				<li id="menu04"><a href="http://localhost/skit/experience">体験入学予約</a></li>
				<li id="menu05"><a href="http://localhost/skit/attend/">出欠登録</a></li>
				<li id="menu06"><a href="http://localhost/skit/confattend/">出欠確認</a></li>
				<li id="menu06"><a href="http://localhost/skit/createqr/">ハガキ作成</a></li>
			</ul>
		</div>
		<!-- Header End-->
		
		<!-- Contents -->
		<div id="contents">
			<?php
				echo $content_for_layout;
			?>
		</div>
		<!-- Content End -->
		

		
		<!-- Footer  -->
		<div id="footer">
			<address>Copyright</address>
		</div>
		<!-- Footer End -->
		
	</div>	
</body>
