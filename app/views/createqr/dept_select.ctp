<?php
	$fields = array("1"=>'ゲーム分野',
					"2"=>'CG分野',
					"3"=>'アニメーション分野',
					"4"=>'デザイン分野',
					"5"=>'ミュージック分野',
					"6"=>'IT分野',
					"7"=>'電気・電子分野');
	$depts = array("JZ"=>'高度情報処理科',
				   "AW"=>'Webデザイン科',
				   "CR"=>'ゲーム企画科',
				   "KJ"=>'電気工学科',
				   "AV"=>'CG映像科');
?>
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
				echo $form->create(null,array('type'=>'post','action'=>'studentsSelect'));
				echo $form->submit('印刷', array('name'=>'print'));
				echo $form->submit('詳細', array('name'=>'studentsSelect'));
				//選択したイベントの数だけループして、分野or学科のチェックボックスを出力させる
				for($i=0 ; $i<count($event) ; $i++){
					if($event[$i]['Event']['event_name'] == 'オープンキャンパス'){
						echo "<p>イベント日" . $event[$i]['Event']['event_day'] . "</p>";
						//チェックボックスを出力する配列
						echo $form->input('Field.' . $event[$i]['Event']['event_day'] , array('type'=>'select', 
										  'multiple'=>'checkbox', 'options'=>$fields,
										  'label'=>'出力したい分野を選択してください'));
						echo "<br>";
					}else{
						echo "<p>イベント日" . $event[$i]['Event']['event_day'] . "</p>";
						echo $form->input("Dept." . $event[$i]['Event']['event_day'] , array('type'=>'select',
										  'multiple'=>'checkbox', 'options'=>$depts,
										  'label'=>'出力したい学科を選択してください'));
						echo "<br>";
					}//if
				}//for
				echo $form->submit('詳細', array('name'=>'studentsSelect'));
				echo $form->end("印刷")
			
			?>
		</div>
	</div>
<body>
</html>
