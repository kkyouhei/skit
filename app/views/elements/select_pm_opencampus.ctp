<?php
	$pmFields = array('ゲーム分野'=>'ゲーム分野',
			'CG分野'=>'CG分野',
			'アニメーション分野'=>'アニメーション分野',
			'デザイン分野'=>'デザイン分野',
			'ミュージック分野'=>'ミュージック分野',
			'IT分野'=>'IT分野',
			'電気・電子分野'=>'電気・電子分野');
	echo $form->select('Event.pmField', $pmFields, '分野を選択', array('showParent'=>true, 'empty'=>'分野を選択'), null);
?>
