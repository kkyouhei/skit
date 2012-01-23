<?php
	$depts = array('test.高度情報処理科'=>'高度情報処理科',
			'Webデザイン科'=>'Webデザイン科',
			'ゲーム企画科'=>'ゲーム企画科',
			'電気工学科'=>'電気工学科',
			'CG映像科'=>'CG映像科');
	echo $form->input("Event.Dept", array('type'=>'select',
					  'multiple'=>'checkbox', 'options'=>$depts,
					  'label'=>'出力したい学科を選択してください'));
?>
