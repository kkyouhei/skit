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
		<p>学科を選択する画面です confattend/ex_select.ctp</p>

		<div id="form">
			<?php
			echo $form->create(null, array('type'=>'post', 'action'=>'exConf'));
			//分野表示のための繰り返し
			for($i=0 ; $i<count($dept) ; $i++){
				echo $form->checkbox($dept[$i]['Department']['id'],
					array('value'=>$dept[$i]['Department']['id']));
				echo $form->label($dept[$i]['Department']['id'],
					$dept[$i]['Department']['dept_name']);
				echo "<br />";
			}
			echo $form->hidden('Reserv.event_day', array('value'=>$this->params['pass'][0]));
			echo $form->end('検索');
			?>
		</div>
	</div>
</body>
</html>
