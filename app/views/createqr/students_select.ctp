<!DOCTYPE html PUBLIC "./W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang = "ja" xml:lang="ja" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
	<?php echo $title_for_layout; ?>
</title>
<head>
<?php
	echo $html->css('createqr.layout');
?>
</head>
<body>
	<div id="contents">
	<p>QRコードを生成する単位を選択</p>
		<div id="form">
		<?php
			$dayTemp = null;
			$idTemp = null;
			if($opencampus != null){
				echo "オープンキャンパス" . "<br />";
			}
			for($i=0 ; $i < count($opencampus) ; $i++){
				if($dayTemp != $opencampus[$i]['Event']['event_day']){
					echo $opencampus[$i]['Event']['event_day'] . "<br />";
				}
				
				echo $opencampus[$i]['Sankasha']['sei'];
				echo $opencampus[$i]['Sankasha']['mei'] . "<br />";
				$dayTemp = $opencampus[$i]['Event']['event_day'];
			}
		?>
		</div>
	</div>
<body>
</html>
