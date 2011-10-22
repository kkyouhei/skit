<?php

	$state = array('東京都'=>'東京都', '埼玉県'=>'埼玉県');

	echo $form->select('Sankasha.state', $state, '都道府県を選択', array('showParent'=>true, 'empty'=>'都道府県を選択',),  null);

?>
