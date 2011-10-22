<?php
class ExperienceController extends AppController{
	public $name = 'Experience';
	public $uses = array('Sankasha', 'Event', 'Reserv', 'Department');
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

		//イベント日の取得して、select_eventday.ctpで使用する$event_dayへイベント日をセット
		$event_day = $this->Event->findEventDay('体験入学');
		//findEventDayで取得した配列は二次元配列になっているので、一次元配列へ整形する処理
		for($i=0 ; $i<count($event_day) ; $i++){
			$event_day[$i] = array($event_day[$i]['Event']['event_day'] => $event_day[$i]['Event']['event_day']); 
		}
		$this->set('event_day',$event_day);
	}

	function conf(){
		$sankasha = $this->params['form']['sankasha'];
		$this->set('sankasha', $sankasha);
		$this->set('event', $this->data['Event']);
	}

	function addRecord(){
		//findEventに渡す引数
		$whereEvent = array('Event.event_day' => $this->data['Reserv']['event_day']);
		$eventData = $this->Event->findEvent($whereEvent);

		//学科IDをDBから検索して$this->dataのdept_idへ代入して上書き
		$whereDept = array('Department.dept_name'=>$this->data['Reserv']['dept_id']);
		$deptData = $this->Department->findDept($whereDept);
		$this->data['Reserv']['dept_id'] = $deptData[0]['Department']['id'];

		$this->Reserv->saveExperience($this->data['Reserv'], $eventData[0]);
		$this->redirect('.');
	}
}
