<!DOCTYPE html PUBLIC "./W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang = "ja" xml:lang="ja" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>
	<?php echo $title_for_layout; ?>
</title>
<head>
<?php echo $html->css('createqr.layout'); ?>
</head>
<body>
	<div id="contents">
	<h4 class="selectorH4">QRコードを生成する単位を選択</h4>
		<div id="form">
			<?php
				echo $form->create(null,array('type'=>'post','action'=>'qrPrint'));
				for($i=0 ; $i<count($event) ; $i++){
					echo $form->checkbox($i+1, array('value'=>$event[$i]['Event']['event_day']));
					echo $form->label($i+1, $event[$i]['Event']['event_day']);
					echo $form->label($event[$i]['Event']['event_name'] ,$event[$i]['Event']['event_name']);
					echo "<br>";
				}
				echo $form->end('印刷');
			?>
		</div>
	</div>
<body>
</html>
