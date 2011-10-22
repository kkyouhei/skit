<?php
class OpencampusController extends AppController{
	public $name = 'Opencampus';
	public $uses = array('Sankasha', 'Event', 'Reserv');
	public $layout = 'layout';

	//通常のヘルパーと拡張ヘルパーの下準備
	var $helpers = array('Form', 'Exform'); 

	function index(){
		//入力された参加者情報(電話番号、姓カナ、名カナ)の配列を整形するforeach文
		//整形内容は配列の空(入力されていない)の部分を削除
		if(!empty($this->data)){
			foreach($this->data as $key => $whereSankasha){
				foreach($whereSankasha as $key => $val){
					if(empty($val)){
						unset($whereSankasha[$key]);
					}
				}
			}
		}
		//条件に一致する参加者の情報を取得
		if(!empty($whereSankasha)){
			$sankashas = $this->Sankasha->findSankasha($whereSankasha);
			$this->set('sankashas',$sankashas);
		}
	}

	function reserv(){
		//reserv/index.ctpのfromから送られて来た参加者情報の配列を$sankashaに格納
		$sankasha = $this->params['form']['sankasha'];
		$this->set('sankasha', $sankasha);
		//イベント日の取得
		$event_day = $this->Event->findEventDay('オープンキャンパス');
		for($i=0 ; $i<count($event_day) ; $i++){
			$event_day[$i] = array($event_day[$i]['Event']['event_day'] => $event_day[$i]['Event']['event_day']); 
		}
		$this->set('event_day',$event_day);
	}

	function conf(){
		$sankasha = $this->params['form']['sankasha'];
		$this->set('sankasha', $sankasha);

		$this->set('event', $this->data['Event']);
		$this->Event->set($this->data);
		$error = $this->validateErrors($this->Event);
		if($error){
			//イベント日の取得
			$event_day = $this->Event->findEventDay('オープンキャンパス');
			for($i=0 ; $i<count($event_day) ; $i++){
				$event_day[$i] = array($event_day[$i]['Event']['event_day'] => $event_day[$i]['Event']['event_day']); 
			}
			$this->set('event_day',$event_day);

			$this->set('errors', $error);
			$this->render($action = 'reserv');
		}
	}

	function addRecord(){
		//findEventに渡す引数
		$whereEvent = array('Event.event_day'=>$this->data['Reserv']['event_day'],
				    'Event.event_time'=>'');

		//予約表へinsertするための値でaveOpencampusに渡すための引数
		$reservData = $this->data['Reserv'];

		//午前、午後の予約している個数分だけsaveOpencampusメソッドを実行
		if($reservData['am_field'] != null){
			$whereEvent['Event.event_time'] = 'AM';
			$eventData = $this->Event->findEvent($whereEvent);
			$this->Reserv->saveOpencampus($reservData, $eventData[0]);
		}
		if($reservData['pm_field'] != null){
			$whereEvent['Event.event_time'] = 'PM';
			$eventData = $this->Event->findEvent($whereEvent);
			$this->Reserv->saveOpencampus($reservData, $eventData[0]);
		}
		$this->redirect('.');
	}



}
