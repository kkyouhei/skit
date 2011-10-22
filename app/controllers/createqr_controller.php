<?php
class CreateQrController extends AppController{
	public $name = 'Createqr';
	public $uses = array('Event', 'Reserv', 'Sankasha');	
	public $layout = 'layout';

	function index(){

	}

	function selectQr(){
		//イベント単位、個別でQRコードを発行するかによって画面遷移先を変更する
		//Event = イベント単位   Reserv = 個別
		$qr = $this->data['qr'];
print_r($this->data);
echo $qr;
//		if($qr == 'Event'){
//			$this->redirect('eventQr');
//		}else/*($qr == 'Reserv')*/{
//			$this->redirect('reservQr');
//		}
	}

	function eventQr(){
		$whereEvent = array('event_day >'=>date('Y-m-d'));
		$fields = array('event_day');
		$order = array('event_day'); 
		$eventDay = $this->Event->findEvent($whereEvent, $fields, $order);

		print_r($eventDay);
	}

	function reservQr(){

	}
}
?>
