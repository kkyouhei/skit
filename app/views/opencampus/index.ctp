<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="ja" xml:lang="ja" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
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
		<h4 class="selectorH4">オープンキャンパスの予約を行う画面です opencampus/index.ctp</h4>
		<div id="form">
			<?php	
			//検索フォームの作成
			echo $form->create(null,array('type'=>'post','action'=>'./'));
			echo $form->label('Sankasha.tel','電話番号');
			echo $form->text('Sankasha.tel') ;
			echo "<br />" ;
			echo $form->label('Sankasha.sei_kana','姓カナ');
			echo $form->text('Sankasha.sei_kana');
			echo "<br />";
			echo $form->label('Sankasha.mei_kana','名カナ');
			echo $form->text('Sankasha.mei_kana');
			echo $form->end("検索");
			?>

			<!--検索結果を表示するフォーム-->
			<?php
			//参加者の人数分送信フォームを表示するfor文
			if(!empty($sankashas)){
				for($i=0 ; $i<count($sankashas) ; $i++){
				$sankasha = $sankashas[$i]['Sankasha'];
				echo $form->create(null,array('type'=>'post','action'=>"reserv"));
				echo $exform->hiddenArray('sankasha[]', $sankasha);
				echo '<p>' , $sankasha['sei'] . $sankasha['mei'] . 'さんの予約を行います' , '</p>' ;
				echo $form->end("予約");
				}
			}
			?>

		</div>
	</div>
</body>
</html>
