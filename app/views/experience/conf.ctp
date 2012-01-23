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
	echo $html->css('addstudent.layout');
?>
</head>
<body>
	<div id="contents">
		<p>イベントの予約情報を入力後確認を行う画面です reserv/conf.ctp</p>
		氏名：<?php echo $sankasha[1] . $sankasha[2]; ?>
		<br />
		シメイ：<?php echo $sankasha[3] . $sankasha[4]; ?>
		<br />		
		性別：<?php echo $sankasha[5]; ?>
		<br />
		誕生日：<?php echo $sankasha[6]; ?>
		<br />
		郵便番号：<?php echo $sankasha[7]; ?>
		<br />
		住所：<?php echo $sankasha[8]; ?>
		      <?php echo $sankasha[9]; ?>
		      <?php echo $sankasha[10]; ?>
		      <?php echo $sankasha[11]; ?>
		<br />
		電話番号：<?php echo $sankasha[12]; ?>
		<br />
		メールアドレス：<?php echo $sankasha[13]; ?>
		<br />
		国籍：<?php echo $sankasha[14]; ?>
		<br />
		職業：<?php echo $sankasha[15]; ?>
		<br />
		学校名：<?php echo $sankasha[16]; ?>
		<br />
		学年：<?php echo $sankasha[17]; ?>
		<br />
		イベント日：<?php echo $reserv['event_day']; ?>
		<br />
		参加希望コース：<?php echo $reserv['dept']; ?>
	
		<?php
		echo $form->create(null, array('type'=>'post', 'action'=>'addRecord'));
		echo $form->hidden('Reserv.sankasha_id', array('value'=>$sankasha[0]));
		echo $form->hidden('Reserv.event_day', array('value'=>$reserv['event_day']));
		echo $form->hidden('Reserv.dept_id', array('value'=>$reserv['dept']));
		echo $form->end('登録');
		?>

	</div>
</body>
</html>
