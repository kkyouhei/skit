<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
<?php echo $html->charset(); ?>	
<title>
<?php echo $title_for_layout ?>
</title>
<?php
	echo $html->css('confattend.layout');
?>
</head>
<body>
	<div id="contents">
		<h4 class="selectorH4">イベントを選択する画面です confattend/index.ctp</h4>

		<div id="form">
			<?php
			//検索情報入力フォーム
			echo "イベント名　イベント日 <br />";
			//コントローラから受け取ったイベント日をfor文で繰り返し表示
			for($i=0; $i<count($events); $i++){
				echo $events[$i]['Event']['event_name'];
				echo $events[$i]['Event']['event_day'];

				//イベント日とイベント名をviewに送信するフォーム
				echo $form->create(null, array('type'=>'post', 'action'=>'ifEvent'));
				echo $form->hidden('Reserv.event_day', array('value'=>$events[$i]['Event']['event_day']));
				echo $form->hidden('Reserv.event_name', array('value'=>$events[$i]['Event']['event_name']));
				echo $form->end('次へ');
			}
			?>
		</div>
	</div>
</body>
</html>
