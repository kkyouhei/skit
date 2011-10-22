<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xml:lang="ja" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
<?php echo $html->charset(); ?>	
<title>
	<?php echo $title_for_layout ?>
</title>
<?php
	echo $html->css('addstudent.layout');
?>
</head>
<body>
	<div id="contents">
		<p>参加者情報の入力後に確認する画面です addstudent/conf.ctp</p><br />
		氏名：	<?php echo h($form->value("Sankasha.sei")); ?>
			     	<?php echo h($form->value("Sankasha.mei")); ?>
				<br />
		シメイ：	<?php echo h($form->value("Sankasha.sei_kana")); ?>
			     	<?php echo h($form->value("Sankasha.mei_kana")); ?>
				<br />
		性別：		<?php echo h($form->value("Sankasha.sex")); ?>
				<br />
		誕生日：	<?php echo h($form->value("Sankasha.birthday")); ?>
				<br />
		郵便番号：	<?php echo h($form->value("Sankasha.post_id")); ?>
				<br />
		住所：		<?php echo h($form->value("Sankasha.state")); ?>
				<?php echo h($form->value("Sankasha.city")); ?>
				<?php echo h($form->value("Sankasha.addr")); ?>
				<?php echo h($form->value("Sankasha.build")); ?>
				<br />
		電話番号：	<?php echo h($form->value("Sankasha.tel")); ?>
				<br />
		メールアドレス：<?php echo h($form->value("Sankasha.mail")); ?>
				<br />
		国籍：		<?php echo h($form->value("Sankasha.country")); ?>
				<br />
		職業：		<?php echo h($form->value("Sankasha.job")); ?>
				<br />
		学校名：	<?php echo h($form->value("Sankasha.school_name")); ?>
				<br />
		学年：		<?php echo h($form->value("Sankasha.school_grade")); ?>

				<!--登録用送信フォーム-->
				<?php
				echo $form->create(null,array('type'=>'post', 'action'=>'addRecord')); 
				echo $form->hidden('Sankasha.sei', array('value'=> $form->value('Sankasha.sei')));
				echo $form->hidden('Sankasha.mei', array('value'=> $form->value('Sankasha.mei')));
				echo $form->hidden('Sankasha.sei_kana', array('value'=> $form->value('Sankasha.sei_kana')));
				echo $form->hidden('Sankasha.mei_kana', array('value'=> $form->value('Sankasha.mei_kana')));
				echo $form->hidden('Sankasha.sex', array('value'=> $form->value('Sankasha.sex')));
				echo $form->hidden('Sankasha.birthday', array('value'=> $form->value('Sankasha.birthday')));
				echo $form->hidden('Sankasha.post_id', array('value'=> $form->value('Sankasha.post_id')));
				echo $form->hidden('Sankasha.state', array('value'=> $form->value('Sankasha.state')));
				echo $form->hidden('Sankasha.city', array('value'=> $form->value('Sankasha.city')));
				echo $form->hidden('Sankasha.addr', array('value'=> $form->value('Sankasha.addr')));
				echo $form->hidden('Sankasha.build', array('value'=> $form->value('Sankasha.build')));
				echo $form->hidden('Sankasha.tel', array('value'=> $form->value('Sankasha.tel')));
				echo $form->hidden('Sankasha.mail', array('value'=> $form->value('Sankasha.mail')));
				echo $form->hidden('Sankasha.country', array('value'=> $form->value('Sankasha.country')));
				echo $form->hidden('Sankasha.job', array('value'=> $form->value('Sankasha.job')));
				echo $form->hidden('Sankasha.school_name', array('value'=> $form->value('Sankasha.school_name')));
				echo $form->hidden('Sankasha.school_grade', array('value'=> $form->value('Sankasha.school_grade')));
				echo $form->end("登録");
				?>

				<!--戻る用送信フォーム-->
				<?php
				echo $form->create(null,array('type'=>'post', 'action'=>'index')); 
				echo $form->hidden('Sankasha.sei');
				echo $form->hidden('Sankasha.mei');
				echo $form->hidden('Sankasha.sei_kana');
				echo $form->hidden('Sankasha.mei_kana');
				echo $form->hidden('Sankasha.sex');
				echo $form->hidden('Sankasha.post_id');
				echo $form->hidden('Sankasha.state');
				echo $form->hidden('Sankasha.city');
				echo $form->hidden('Sankasha.addr');
				echo $form->hidden('Sankasha.build');
				echo $form->hidden('Sankasha.tel');
				echo $form->hidden('Sankasha.mail');
				echo $form->hidden('Sankasha.country');
				echo $form->hidden('Sankasha.job');
				echo $form->hidden('Sankasha.school_name');
				echo $form->hidden('Sankasha.school_grade');
				echo $form->end("戻る");
				?>
	</div>
</body>
</html>
