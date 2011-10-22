<?php
//FormHelper拡張クラス
class ExformHelper extends FormHelper{

	//formhelperクラスにあるhidenメソッドへ配列を渡せるようにした拡張メソッド
	//渡した配列の数だけhiddenをreturnする
	function hiddenArray($arrName, $data){
		$html ="";
		if(is_array($data)){
			foreach($data as $v){
				$html .= sprintf('<input type="hidden" name="%s" value="%s">',
						h($arrName),h($v));
			}
			$html .= "\n";
		}
		return $html;
	}

	function dateYMD($fieldName, $selected=null, $attributes=array(), $showEmpty=true){
		if(!isset($this->options['month'])){
			$this->options['month']=array();
			for($i=1 ; $i<=12 ; $i++){
				$this->options['month'][sprintf("%02d", $i)] = $i;
			}
		}
		$sep = array('','','');
		if(isset($attributes['separator'])){
			if(is_array($attributes['separator'])){
				$sep = $attributes['separator'];
				$attributes['separator'] = "";
			}
		}else{
			$attributes['separator'] = "";
			$sep = array("年","月","日");
		}
		$ret = parent::dateTime($fieldName,'YMD','NONE',$selected,$attributes,$showEmpty);

		$ret = preg_replace('|</select>|','{/select}'.@$sep[0],$ret,1);
		$ret = preg_replace('|</select>|','{/select}'.@$sep[1],$ret,1);
		$ret = preg_replace('|</select>|','{/select}'.@$sep[2],$ret,1);
		$ret = $ret = str_replace('{/select}','</select>',$ret);

		return $ret;
	}


	//電話番号入力フォームを出力してくれるメソッド
/*	function tel($fieldName, $options = array()){
		$defaults = array(
			'separator'=>'-',
		);
		$options = array_merge($defaults,(array) $options);
		$separator = ($options['separator']);
		unset($options['separator']);

		$value = $this->value($fieldName);
		if(is_array($value)){
			$vals = $value;
		}else{
			$split = explode('-', $value);
			$vals['_1'] = (isset($split[0])) ? $split[0]:'';
			$vals['_2'] = (isset($split[1])) ? $split[1]:'';
			$vals['_3'] = (isset($split[2])) ? $split[2]:'';
		}

		$tels = array();
		$tels['_1'] = $this->text($fieldName . '_1', am($options, array('value'=>$vals['_1'])));
		$tels['_2'] = $this->text($fieldName . '_2', am($options, array('value'=>$vals['_2'])));
		$tels['_3'] = $this->text($fieldName . '_3', am($options, array('value'=>$vals['_3'])));

		return implode($separator, $tels);
	}
*/
}
?>
