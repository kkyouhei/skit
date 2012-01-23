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
		<p>attend/conf.ctp　参加者の出席管理を行う画面です</p>
		<p>氏名 午前参加分野　午後参加分野　電話番号</p>

		<?php
			echo $reservData['name'] . "：";
			echo $reservData['am_field'] . "：";
			echo $reservData['pm_field'] . " ：";
			echo $reservData['tel'] . "：";
			//予約レコードのattend項目を出席にアップデートするために必要な項目
			//予約番号から検索するので一件しかヒットしない事が前提
			echo $form->create(null, array('type'=>'post', 'action'=>'updateRecord'));
			echo $form->hidden('Reserv.am_id', array('value'=>$reservData['am_id']));
			echo $form->hidden('Reserv.pm_id', array('value'=>$reservData['pm_id']));
			echo $form->end('出席');
		?>	
	</div>
<body>
</html>
