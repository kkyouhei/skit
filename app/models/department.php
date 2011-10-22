<?php
class Department extends AppModel{
	var $name = 'Department';

	function findDept($whereDept=null){
		return $this->find('all',
					array('conditions'=>$whereDept)
				  );
	}
}
