<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xml:lang="ja" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />	
<?php echo $html->charset(); ?>	
<title>
	<?php echo $title_for_layout ?>
</title>
<?php
	echo $html->css('opencampus.layout');
?>
</head>
<body>
	<div id="contents">
		<p>イベントの予約を行う画面です event/reserv.ctp</p>
		<?php
			echo $form->error('Reserv.event_day');
			echo $form->error('Reserv.amField');
			echo "<p>" , "{$sankasha[1]}{$sankasha[2]}さんの予約を行います" , "</p>";
			//イベント予約フォーム
			echo $form->create(null,array('type'=>'post','action'=>"conf/{$sankasha[0]}"));
			echo $form->select('Reserv.event_day',$event_day,null,
					array('empty'=>'日付を選択して下さい'),null);	
			//分野を表示させるリストボックスを生成
			echo '<p>' , '午前の部' , '</p>';
			echo $this->element('select_am_opencampus');
			echo '<br />';

			echo '<p>', '午後の部' , '</p>';
			echo $this->element('select_pm_opencampus');
			echo $exform->hiddenArray('sankasha[]', $sankasha);
			echo $form->end('登録');
		?>

		<div id="form">
		</div>
	</div>
</body>
</html>
