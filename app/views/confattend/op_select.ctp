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
		<p>分野を選択する画面です confattend/op_select.ctp</p>

		<div id="form">
			<?php
			echo $form->create(null, array('type'=>'post', 'action'=>'opConf'));
			//分野表示のための繰り返し
			for($i=0 ; $i<count($field) ; $i++){
				echo $form->checkbox($field[$i]['Field']['id'],
					array('value'=>$field[$i]['Field']['id']));
				echo $form->label($field[$i]['Field']['id'],
					$field[$i]['Field']['field_name']);
				echo "<br />";
			}
			echo $form->hidden('Reserv.event_day', array('value'=>$this->params['pass'][0]));
			echo $form->end('検索');
			?>
		</div>
	</div>
</body>
</html>
