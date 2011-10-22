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
			echo $form->create(null,array('type'=>'post', 'action'=>'selectQr'));
			echo $form->radio('qr',array('Event'=>'イベント','Reserv'=>'個別'),
						 array('legend'=>'QR生成単位を選択', 'value'=>'Event'));
			echo $form->end('次へ');	
		?>
		</div>
	</div>
<body>
</html>
