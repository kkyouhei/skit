<?php
class AttendController extends AppController{
	public $name = 'Attend';
	public $uses = array('Sankasha', 'Reserv','Event', 'Field', 'Department');
	public $layout = "layout";

	function index(){
	}

	function find(){
	}

	function ifEvent(){
		//リリース時は引数をdate('Y-m-d')にする
		$eventName = $this->Event->findEventName('2011-12-30');
		//オープンキャンパスか体験入学で表示させるビューが違うので当日のイベントによって
		//使用するビューを変える
		if($eventName[0]['Event']['event_name'] == 'オープンキャンパス'){
			$this->redirect(array('action'=>'opConf' ,$this->params['data']['Sankasha']['id']));
		}else{
			$this->redirect(array('action'=>'exConf', $this->params['data']['Sankasha']['id']));
		}
	}

	function opConf(){
		//opConfで表示する予約情報の配列
		$reservData = array('am_id'=>'',
				    'pm_id'=>'',
				    'name'=>'',
				    'am_field'=>'',
				    'pm_field'=>'',
				    'tel'=>'');

		//SQLのWhere句に設定するための、findSanakshaの引数を作成
		$sankasha_id = $this->params['pass'][0];

		//動作確認のためEvent.event_dayに日付を直接打ち込んでいるが
		//リリースはdate('Y-m-d')を引数に指定
		$whereReserv = array('Reserv.sankasha_id'=>$this->params['pass'][0],
				     'Event.event_day'=>'2012-08-05');
		$reservDatas = $this->Reserv->findOpAttend($whereReserv);

		//opConfで表示する予約情報の配列を整形
		if(!empty($reservDatas)){
			for($i=0 ; count($reservDatas)>$i ; $i++){
				if($reservDatas[$i]['Event']['event_time'] == 'AM'){
					$reservData['am_id'] = $reservDatas[$i]['Reserv']['id'];
					$reservData['am_field'] = $reservDatas[$i]['Field']['field_name'];	
				}else if($reservDatas[$i]['Event']['event_time'] == 'PM'){
					$reservData['pm_id'] = $reservDatas[$i]['Reserv']['id'];
					$reservData['pm_field'] = $reservDatas[$i]['Field']['field_name'];	
				}
			}
			$reservData['name'] = $reservDatas[0]['Sankasha']['sei'] . $reservDatas[0]['Sankasha']['mei'];
			$reservData['tel'] = $reservDatas[0]['Sankasha']['tel'];
		}
		$this->set('reservData', $reservData);
	}

	function exConf(){
		$reservData = array('id'=>'',
				    'name'=>'',
				    'dept_name'=>'',
				    'tel'=>'');

		$whereReserv = array('Reserv.sankasha_id'=> $this->params['pass'][0],
				     'Event.event_day' => '2011-12-30');

		$reservDatas = $this->Reserv->findExAttend($whereReserv);
		$reservData['id'] = $reservDatas[0]['Reserv']['id'];
		$reservData['name'] = $reservDatas[0]['Sankasha']['sei'] . $reservDatas[0]['Sankasha']['mei'];
		$reservData['dept_name'] = $reservDatas[0]['Department']['dept_name'];
		$reservData['tel'] = $reservDatas[0]['Sankasha']['tel'];

		$this->set('reservData', $reservData);
	}
	

	function updateRecord(){
		//どこ予約レコードをアップデートするのかを判別するための
		//where句の条件に渡すための配列の作成
		$saveReserv = array('id'=>'', 'attend'=>'出席');
		if(!empty($this->data['am_id'])){
			$whereReserv['id'] = $this->data['am_id'];
			$this->Reserv->save($saveReserv);
		}else if(!empty($this->data['pm_id'])){
			$whereReserv['id'] = $this->data['pm_id'];
			$this->Reserv->save($saveReserv);
		}else if(!empty($this->data['Reserv']['id'])){
			$saveReserv['id'] = $this->data['Reserv']['id'];
			$this->Reserv->save($saveReserv);
		}
		$this->redirect('.');
	}

}
