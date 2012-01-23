<?php
class Reserv extends AppModel{
	var $name = 'Reserv';

	//OP予約フォームのバリデーションチェック用の配列
	public $validate = array(
		'event_day'=>array(
				'rule'=>'notEmpty',
				'message'=>'日付を選択して下さい'),
		'amField'=>array(
				'rule'=>array('isSetFields', 'Reserv.amField', 'Reserv.pmField'),
				'message'=>'必ず一つは分野を選択して下さい'),
		'dept'=>array(
				'rule'=>array('notEmpty'),
				'message'=>'学科を選択してください'
		)
	);

	//OP予約画面のバリデーションルール
	function isSetFields(){
		if(!empty($this->data['Reserv']['amField']) || !empty($this->data['Reserv']['pmField'])){
			return true;
		}else{
			return false;
		}
	}

	var $belongsTo = array('Sankasha'=>array(
						'className'  => 'Sankasha',
						'foreignKey' => 'sankasha_id'
			       		        ),
				'Event'  =>array(
						'className' => 'Event',
						'foreignKey'=> 'event_id'
					        ),
				'Field'  =>array(
						'className' =>'Field',
						'foreignKey'=>'field_id'
						),
				'Department'=>array(
						'className'=>'Department',
						'foreignKey'=>'dept_id'
						    )
			      );

	function findReserv($options=null/*$whereReserv=null, $fields=null*/){
		//findメソッドの引数に指定する変数
		return $this->find('all', $options);
	}

	//findOpとfindExは重複しているので同じにする
	//fieldsは違う内容なので、fieldsを引数にする必要がある
	//findメソッドの日付は動作確認のためconditionsへ日付を与えているが
	//リリース時はdate('Y-m-d')を引数に指定する
	function findOpAttend($whereReserv){
		$fields = array('Reserv.id',
				'Sankasha.id', 'Sankasha.sei', 'Sankasha.mei', 'Sankasha.tel',
				'Event.event_name', 'Event.event_time',
				'Field.field_name');

		return $this->find('all', array('fields'=>$fields,
						'conditions'=>$whereReserv)	
				  );
	}

	function findExAttend($whereReserv){
		$fields = array('Reserv.id',
				'Sankasha.id', 'Sankasha.sei', 'Sankasha.mei', 'Sankasha.tel',
				'Event.event_name', 'Event.event_time',
				'Department.dept_name');


		return $this->find('all',array('fields'=>$fields,
					       'conditions'=>$whereReserv)
				  );
	}

	//Reservs表に値をinsertするメソッド
	//$eventTimeのAM,PMによってinsertする値を変える
	function saveOpencampus($opencampusDatas, $eventData){
		$opencampusData = array('Reserv'=>array(
					'id'=>null,
					'sankasha_id'=>$opencampusDatas['sankasha_id'],
					'event_id'=>'',
					'field_id'=>'',
					'dept_id'=>'',
					'attend'=>'未出席'
				   	));

		switch($opencampusDatas['am_field']){
			case 'ゲーム分野':
				$amField = 1;
				break;
			case 'CG分野':
				$amField = 2;
				break;
			case 'アニメーション分野':
				$amField = 3;
				break;
			case 'デザイン分野':
				$amField = 4;
				break;
			case 'ミュージック分野':
				$amField = 5;
				break;
			case 'IT分野':
				$amField = 6;
				break;
			case '電気・電子分野':
				$amField = 7;
				break;
			default:
				$amField = '';
		}

		switch($opencampusDatas['pm_field']){
			case 'ゲーム分野':
				$pmField = 1;
				break;
			case 'CG分野':
				$pmField = 2;
				break;
			case 'アニメーション分野':
				$pmField = 3;
				break;
			case 'デザイン分野':
				$pmField = 4;
				break;
			case 'ミュージック分野':
				$pmField = 5;
				break;
			case 'IT分野':
				$pmField = 6;
				break;
			case '電気・電子分野':
				$pmField = 7;
				break;
			default:
				$pmField = '';
		}

		//reserv表へ値を挿入する処理
		if($eventData['Event']['event_time'] == 'AM'){
			$opencampusData['Reserv']['field_id'] = $amField;
			$opencampusData['Reserv']['event_id'] = $eventData['Event']['id'];
			$this->save($opencampusData);
		}elseif($eventData['Event']['event_time'] == 'PM'){
			$opencampusData['Reserv']['field_id'] = $pmField;
			$opencampusData['Reserv']['event_id'] = $eventData['Event']['id'];
			$this->save($opencampusData);
		}else{
			return false;
		}
	}

	//reserv表に体験入学の予約を行うメソッド
	function saveExperience($experienceDatas, $eventData){
		$experienceData = array('Reserv'=>array(
					'id'=>null,
					'sankasha_id'=>$experienceDatas['sankasha_id'],
					'event_id'=>$eventData['Event']['id'],
					'field_id'=>null,
					'dept_id'=>$experienceDatas['dept_id'],
					'attend'=>'未出席'
				   	));

		$this->save($experienceData);

	}


	//予約レコードをアップデートを行う処理
	function updateReserv($whereReserv){
		$updateRecord = $this->find('all', array('conditions'=>$whereReserv));

		if(!empty($updateRecord)){
			for($i=0 ; $i<count($updataRecord) ; $i++){
				$updateRecord[$i]['Reserv']['attend'] = '出席' ; 
				$this->save($updateRecord[$i]);
			}
		}else{
			return false;
		}
	}
}
