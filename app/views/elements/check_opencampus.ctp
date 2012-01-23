<?php
						$fields = array("1"=>'ゲーム分野',
										"2"=>'CG分野',
										"3"=>'アニメーション分野',
										"4"=>'デザイン分野',
										"5"=>'ミュージック分野',
										"6"=>'IT分野',
										"7"=>'電気・電子分野');
						echo $form->input('Field.' . $event[$i]['Event']['id'] , array('type'=>'select', 
										  'multiple'=>'checkbox', 'options'=>$fields,
										  'label'=>'出力したい分野を選択してください'));
?>
