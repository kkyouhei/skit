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
			echo $form->label('Reserv.id','名カナ');
			echo $form->text('Reserv.id');
			echo "<br />";
			echo $form->label('Sankasha.tel','電話番号');
			echo $form->text('Sankasha.tel') ;
			echo "<br />" ;
			echo $form->label('Sankasha.sei_kana','姓カナ');
			echo $form->text('Sankasha.sei_kana');
			echo "<br />";
			echo $form->label('Sankasha.mei_kana','名カナ');
			echo $form->text('Sankasha.mei_kana');
			echo $form->end('次へ');	
		?>
		</div>
	</div>
<body>
</html>
