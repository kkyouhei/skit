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
		<p>体験入学の検索結果を表示する画面です confattend/exConf.ctp</p>

		<div id="form">
			<?php
			$fieldId = null ;
			$eventTime = null ;
			for($i=0 ; $i<count($sankashas) ; $i++){
				if($fieldId != $sankashas[$i]['Department']['dept_name']){
					echo $sankashas[$i]['Department']['dept_name'] . "<br />" ;
					echo "予約ID　参加者名　連絡先　メールアドレス　出席状況 <br />";
				}
				$fieldId = $sankashas[$i]['Department']['dept_name'];
				$eventTime = $sankashas[$i]['Event']['event_time']; 

				echo $sankashas[$i]['Reserv']['id'] . "：" ;
				echo $sankashas[$i]['Sankasha']['sei'] . $sankashas[$i]['Sankasha']['mei'] . "：" ;
				echo $sankashas[$i]['Sankasha']['tel'] ."：" ;
				echo $sankashas[$i]['Sankasha']['mail'] . "："  ;
				echo $sankashas[$i]['Reserv']['attend'] . "<br />" ;
			}
			?>
		</div>
	</div>
</body>
</html>
