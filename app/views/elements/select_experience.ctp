<?php
	$depts = array('高度情報処理科'=>'高度情報処理科',
			'Webデザイン科'=>'Webデザイン科',
			'ゲーム企画科'=>'ゲーム企画科',
			'電気工学科'=>'電気工学科',
			'CG映像科'=>'CG映像科');
	echo $form->select('Reserv.dept', $depts, '学科を選択', array('showParent'=>true, 'empty'=>'学科を選択'), null);
?>
