<?php
class Field extends AppModel{
	var $name = 'Field';


	function findField($whereField=null){
		return $this->find('all',
				     array('conditions'=>$whereField)
				  );
	}
}
