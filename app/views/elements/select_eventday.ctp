<?php

	//イベント日を表示するセレクトボックスへ渡す配列の整形
	$i = 0;
	foreach($event_day as $key => $val){
		foreach($val as $key => $val){
			$temp[$i] = $val;
			$i++;
		}
	}
	$event_day = array_combine($temp, $temp);

	echo $form->select('Field.event_day',$event_day,null,
					array('empty'=>'日付を選択して下さい'),null);	
?>
