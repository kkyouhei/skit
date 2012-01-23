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
	echo $html->css('attend.layout');
?>
</head>
<body>
	<div id="contents">
		<h4 class="selectorH4">attend/index.ctp　参加者を検索する画面です</h4>
		<?php
			echo $form->create(null, array('type'=>'post', 'action'=>'ifEvent'));
			echo $form->label('Sankasha.id', '参加者ID');
			echo $form->text('Sankasha.id'); 
			echo $form->end('検索');
		?>	
	</div>
<body>
</html>
