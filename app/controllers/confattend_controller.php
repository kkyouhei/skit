<?php
class ConfAttendController extends AppController{
	public $name = 'Confattend';
	public $uses = array('Reserv', 'Event', 'Field', 'Department');
	public $layout = "layout" ;

	function index(){
	//select_eventdayへ表示するイベントの取得
	$order = 'Event.event_day DESC'; 
	$field = 'DISTINCT Event.event_day, Event.event_name';

	$eventDay = $this->Event->findEvent(null, $field, $order);
	$this->set('events', $eventDay);
	}

	function ifEvent(){
		//オープンキャンパスか体験入学で表示させるビューが違うので当日のイベントによって
		//使用するビューを変える
		$eventData = $this->data;
		if($eventData['Reserv']['event_name'] == 'オープンキャンパス'){
			$this->redirect(array('action'=>'opSelect', $eventData['Reserv']['event_day']));
		}else{
			$this->redirect(array('action'=>'exSelect', $eventData['Reserv']['event_day']));
		}
	}

	//学科を選択するアクション
	function exSelect(){
		$dept = $this->Department->findDept();
		$this->set('dept', $dept);
	}

	//分野を選択するアクション
	function opSelect(){
		$field = $this->Field->findField();
		$this->set('field', $field);
	}

	function opConf(){
		//SQLで取得する列
		$fields = array('Reserv.id', 'Reserv.attend',
				'Sankasha.id', 'Sankasha.sei', 'Sankasha.mei', 'Sankasha.tel', 'Sankasha.mail',
				'Field.id', 'Field.field_name',
				'Event.event_time');
		//イベント日を保持する変数
		$eventDay = $this->params['data']['Reserv']['event_day'];
		//利用者が選択した分野のIDを保持する変数
		$fieldId = $this->params['data']['Reserv'];
		unset($fieldId['event_day']); 
		//where句の条件
		$conditions = array('Event.event_day'=>$eventDay,
				     'or'=>array('Reserv.field_id'=>$fieldId));
		$order = array('Reserv.field_id', 'Event.event_time');
		$options = array('fields'=>$fields, 'conditions'=>$conditions, 'order'=>$order);
		$sankashas = $this->Reserv->findReserv($options);

		$this->set('sankashas', $sankashas);
	}

	function exConf(){
		//SQLで取得する列
		$fields = array('Reserv.id', 'Reserv.attend',
				'Sankasha.id', 'Sankasha.sei', 'Sankasha.mei', 'Sankasha.tel', 'Sankasha.mail',
				'Department.id', 'Department.dept_name',
				'Event.event_time');
		//イベント日を保持する変数
		$eventDay = $this->data['Reserv']['event_day'];
		//利用者が選択した分野のIDを保持する変数
		$deptId = $this->data['Reserv'];
		unset($deptId['event_day']); 
		//where句の条件
		$conditions = array('Event.event_day'=>$eventDay,
				     'or'=>array('Reserv.dept_id'=>$deptId));
		$order = array('Reserv.dept_id');
		$options = array('fields'=>$fields, 'conditions'=>$conditions, 'order'=>$order);
		$sankashas = $this->Reserv->findReserv($options);

		$this->set('sankashas', $sankashas);
	}
}
?>
