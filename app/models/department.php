<?php
class Department extends AppModel{
	var $name = 'Department';

	//体験予約フォームのバリデーションチェック用の配列	
	public $validate = array(
		'event_day'=>array(
			'rule'=>'notEmpty',
			'message'=>'日付を選択してください'
		),
		'dept'=>array(
			'rule'=>'notEmpty',
			'message'=>'学科を選択してください'
		)
	);

	function findDept($whereDept=null){
		return $this->find('all',
					array('conditions'=>$whereDept)
				  );
	}
}
