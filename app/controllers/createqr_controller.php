<?php
App::import('vendor', 'PHPExcel', array('file'=>'phpexcel' . DS . 'PHPExcel.php'));
App::import('vendor', 'PHPExcel_IOFactory', array('file'=>'phpexcel' . DS . 'PHPExcel' . DS . 'IOFactory.php'));

//require_once("Image/QRCode.php");

class CreateQrController extends AppController{
	public $name = 'Createqr';
	public $uses = array('Event', 'Reserv', 'Sankasha');	
	public $layout = 'layout';

	var $helpers = array('form', "exform");

	function index(){
		$field = "DISTINCT Event.event_day, Event.event_name";
		$order = "Event.event_day DESC";
		$event = $this->Event->findEvent(null, $field, $order);
		$this->set('event', $event);	
	}

	function deptSelect(){
		//index.ctpでチェックされたイベントのIDを保持する配列の添字
		$arrayCount = 0;
		//index.ctpでチェックされたIDを保持する配列
		$eventDay = array();
		//チェックされたイベントのIDのみを保持する配列へと整形する処理
		for($i=1 ; $i <= count($this->data['Event']) ; $i++){
			if($this->data['Event'][$i] != 0){
				$eventDay[$arrayCount] = $this->data['Event'][$i];
				$arrayCount++;
			}
		}
		//チェックされたイベントの日付を取得するためのSQL文の編集
		$i = 0;
		$where = "event_day ='" . $eventDay[$i] . "'";
		array_unique($eventDay);
		for($i=1 ; $i < count($eventDay) ; $i++){
			$where .= " OR event_day ='" . $eventDay[$i] . "'" ;
		}
		//イベントデータの取得
		$field = "DISTINCT Event.event_day, Event.event_name";
		$order = "Event.event_day DESC";
		$event = $this->Event->find('all', array('fields'=>$field, 'order'=>$order, 'conditions'=>$where));
		$this->set('event', $event);
	}

	function studentsSelect(){
		//viewで出力するイベントの参加者一覧を保持する変数
		$opencampus = null;

		//findEventへ渡すための引数
		$options = array('fields'=>'', 'conditions'=>'');
		
		$where = "";
		if(array_key_exists('Field', $this->data)){
			//deptSelectで選択されたイベントのIDを保持する変数
			$openDay = array_keys($this->data['Field']);	
			
			//deptSelectで選択されたイベントの数を保持する変数
			$fieldCount = count(array_keys($this->data['Field'])); 
		
			//whileで利用するカウンタ
			$i = 0;
			$j = 0;
			
			$where = "Event.event_day = '" . $openDay[$i] . "' AND Reserv.field_id IN(" . $this->data['Field'][$openDay[$i]][$j];
			$j++;
			while($j < count($this->data['Field'][$openDay[$i]])){
					$where .= " , " . $this->data['Field'][$openDay[$i]][$j];
					$j++;
			}
			$where .= ") ";
			$i++;
			
			while($i < $fieldCount){
				$j = 0;
				$where .= "OR Event.event_day = '" . $openDay[$i] . "' AND Reserv.field_id IN(" . $this->data['Field'][$openDay[$i]][$j];
				$j++;

				while($j < count($this->data['Field'][$openDay[$i]])){
					$where .= " , " . $this->data['Field'][$openDay[$i]][$j];
					$j++;
				}
				$where .= ")";
				$i++;
			}
		
			$options['conditions'] = $where;
			$options['order'] = "Event.event_day, Field.id, Sankasha.id DESC";
			$options['fields'] = "Event.event_day, Event.event_name, Sankasha.id, Sankasha.sei, Sankasha.mei, Reserv.id, Field.id, Field.field_name";
			$opencampus = $this->Reserv->findReserv($options);
		
		}//array_key_exists($this->data['Field'])
		
		$this->set('opencampus', $opencampus);
		
		//viewへ出力するためのイベント参加者一覧を保持する変数
		$experience = null;

		if(array_key_exists('Dept', $this->data)){
			//deptSelectで選択されたイベントのIDを保持する変数
			$exDay = array_keys($this->data['Dept']);	
		
			//deptSelectで選択されたイベントの数を保持する変数
			$exCount = count(array_keys($this->data['Dept'])); 
		
			//whileで利用するカウンタ
			$i = 0;
			$j = 0;
			
			$where = "Event.event_day = '" . $exDay[$i] . "' AND Reserv.dept_id IN('" . $this->data['Dept'][$exDay[$i]][$j] . "'";
			$j++;
			while($j < count($this->data['Dept'][$exDay[$i]])){
					$where .= " , '" . $this->data['Dept'][$exDay[$i]][$j] . "'";
					$j++;
			}
			$where .= ") ";
			$i++;
			
			while($i < $exCount){
				$j = 0;
				$where .= "OR Event.event_day = '" . $exDay[$i] . "' AND Reserv.dept_id IN('" . $this->data['Dept'][$exDay[$i]][$j] . "'";
				$j++;

				while($j < count($this->data['Dept'][$exDay[$i]])){
					$where .= " , '" . $this->data['Dept'][$exDay[$i]][$j] . "'";
					$j++;
				}
				$where .= ")";
				$i++;
			}
		
			$options['conditions'] = $where;
			$options['order'] = "Event.event_day DESC, Department.id, Sankasha.id";
			$optPoPs['fields'] = "Event.event_day, Event.event_name, Sankasha.id, Sankasha.sei, Sankasha.mei, Reserv.id, Department.id, Department.dept_name";
			$experience = $this->Reserv->findReserv($options);
		
		}//array_key_exists
		$this->set('experience', $experience);
	}

	function qrPrint(){
		$this->autoRender = false;
		
		//ハガキの表面に使用する変数
		//excelに表示する文字列とセルの番号
		$A3  = array('cell'=>3 , 'val'=>'当日はこの参加証を受け付けにご提出ください。');
		$A4  = array('cell'=>4 , 'val'=>'');
		$A5  = array('cell'=>5 , 'val'=>'');
		$A6  = array('cell'=>6 , 'val'=>'');
		$A16 = array('cell'=>16, 'val'=>'・保護者対象学校説明会： 11:00～12:00 or 14:00～15:00');
		$A17 = array('cell'=>17, 'val'=>'・学費サポート説明会     ： 13:00～13:30 or 15:15～15:45');
		$A19 = array('cell'=>19, 'val'=>'上記の参加予定分野および参加時刻は変更可能ですの');
		$A20 = array('cell'=>20, 'val'=>'で、ご希望の方はご連絡ください。');
		$A21 = array('cell'=>21, 'val'=>'なお、当日変更される場合は、受付または学校スタッフ');
		$A22 = array('cell'=>22, 'val'=>'にお申し付けください。');
		$A23 = array('cell'=>23, 'val'=>'学科や分野が決まっていない方は、入学相談担当スタッ');
		$A24 = array('cell'=>24, 'val'=>'フがご相談させていただきます。');
		$A25 = array('cell'=>25, 'val'=>'ご相談後、分野別説明 & 交流会にご参加頂けます。');
		
		$openTitle = "オープンキャンパス"; 
		$exTitle = "体験入学"; 
		$titleMergeCellStart = 1; 
		$titleMergeCellEnd = 2;
		$titleCell = 1;
		$A3CellStart = 0;
		$A3CellEnd = 3;
		$qrcodeCell = 7;

		//ハガキの裏面作成にしようする変数
		$postCell = 33;
		$stateCell = 34 ;
		$buildCell = 35;
		$cityCell = 36;
		$addressCell = 37;
		$nameCell = 38;
	
		$xl = new PHPExcel();

		//excelに出力する予約レコードの取り出し
		$where = "Event.event_day = '" . $this->data['Event'][1] . "'";
		for($i=2 ; $i < count($this->data['Event']) ; $i++){
				$where .= " OR event_day ='" . $this->data['Event'][$i] . "'";
		}
		$options = array('conditions'=>$where, 'fields'=>'DISTINCT Sankasha.id, Event.event_day', 'order'=>'Event.event_day DESC');
		$sankashas = $this->Reserv->findReserv($options);

		// 画像数が多い場合にタイムアウトになるのを防ぐ
		set_time_limit(0);

		//シートの作成
		$sheet = $xl->getActiveSheet();
		$sheet->setTitle($sankashas[0]['Event']['event_day']);
		$eventDay = $sankashas[0]['Event']['event_day']; 
	
		for($i=0 ; $i < count($sankashas) ; $i++){
			//イベント日ごとにシートを変更するので
			//イベント日が変わったら新しいシートを作成する処理
			if($eventDay != $sankashas[$i]['Event']['event_day']){
				//シートの設定
				$sheet = $xl->createSheet();
				$sheet->setTitle($sankashas[$i]['Event']['event_day']);
				$eventDay = $sankashas[$i]['Event']['event_day'];
				
				//イベントが変わったらシートを変更するのでcell番号を初期化
				$A3['cell'] = 3;   $A4['cell'] = 4;
				$A5['cell'] = 5;   $A6['cell'] = 6;
				$A16['cell'] = 16; $A17['cell'] = 17;
				$A19['cell'] = 19; $A20['cell'] = 20;
				$A21['cell'] = 21; $A22['cell'] = 22;
				$A23['cell'] = 23; $A24['cell'] = 24;
				$A25['cell'] = 25;
				$titleMergeCellStart = 1; 
				$titleMergeCellEnd = 2;
				$titleCell = 1;
				$A3CellStart = 0;
				$A3CellEnd = 3;
				$qrcodeCell = 7;
				$postCell = 33;
				$stateCell = 34 ;
				$buildCell = 35;
				$cityCell = 36;
				$addressCell = 37;
				$nameCell = 38;
			}
			
			//ハガキの裏面に出力するための情報を取得
			$where = "Sankasha.id={$sankashas[$i]['Sankasha']['id']}";
			$sankasha = $this->Sankasha->findSankasha($where);
			//ハガキの裏面に出力するための情報を取得
			$where = "Sankasha.id ={$sankashas[$i]['Sankasha']['id']} AND Event.event_day ='{$sankashas[$i]['Event']['event_day']}'";
			$options = array('conditions'=>$where, 'order'=>'Event.event_day DESC');
			$reservs = $this->Reserv->findReserv($options);
			
			//QRコード生成
			$imgfile = '/Applications/XAMPP/htdocs/skit/app/webroot/img/' . $reservs[0]['Sankasha']['id'] . '.png';
			if (!file_exists($imgfile)) {
				$qr = 'http://localhost/qr_img/php/qr_img.php?d=' . $reservs[0]['Sankasha']['id']  . '&s=6';
				copy($qr, $imgfile);
			}
			//QRコードをエクセルに貼付ける処理
			$gazo = new PHPExcel_Worksheet_Drawing();
			$gazo->setPath("/Applications/XAMPP/htdocs/skit/app/webroot/img/" . $reservs[0]['Sankasha']['id']  . ".png");
			$gazo->setCoordinates("B" . $qrcodeCell);
			$gazo->setWorksheet($sheet);
			//タイトルを出力するセル結合
			$sheet->mergeCells("A" . $titleMergeCellStart . ":E" . $titleMergeCellEnd);

			//(5)スタイルの設定(標準フォント、罫線、中央揃え)
			$sheet->getDefaultStyle()->getFont()->setName('ＭＳ Ｐゴシック');
			$sheet->getDefaultStyle()->getFont()->setSize(11);

			//フォントサイズ、書式の設定
			//A1
			$sheet->getStyleByColumnAndRow(0, $titleCell)->getFont()->setSize(20);
			$sheet->getStyle('A' . $titleMergeCellStart)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			
			$A4['val'] = "開催日:{$reservs[0]['Event']['event_day']}"; 
			if($reservs[0]['Event']['event_name'] == "オープンキャンパス"){
				$sheet->setCellValue('A' . $titleMergeCellStart , $openTitle);
				if(array_key_exists(0, $reservs)){
					if($reservs[0]['Event']['event_time'] == 'AM'){
						$A5['val'] = "午前参加予定分野:{$reservs[0]['Field']['field_name']}(10:00〜12:00)";
					}
					if($reservs[0]['Event']['event_time'] == 'PM'){
						$A6['val'] = "午後参加予定分野:{$reservs[0]['Field']['field_name']}(13:00〜15:00)";
					}
				}
				if(array_key_exists(1, $reservs)){
					if($reservs[1]['Event']['event_time'] == 'AM'){
						$A5['val'] = "午前参加予定分野:{$reservs[1]['Field']['field_name']}(10:00〜12:00)";
					}
					if($reservs[1]['Event']['event_time'] == 'PM'){
						$A6['val'] = "午後参加予定分野:{$reservs[1]['Field']['field_name']}(13:00〜15:00)";
					}
				}
			}else{
				$sheet->setCellValue('A' . $titleMergeCellStart , $exTitle);
				$A5['val'] = "参加予定学科:{$reservs[0]['Department']['dept_name']}";
				$A6['val'] = "";
			}
			//表面のセルの値を設定
			$sheet->setCellValue('A' . $A3['cell'] , $A3['val']); //文字列
			$sheet->setCellValue('A' . $A4['cell'], $A4['val']);
			$sheet->setCellValue('A' . $A5['cell'], $A5['val']);
			$sheet->setCellValue('A' . $A6['cell'], $A6['val']);
			$sheet->setCellValue('A' . $A16['cell'], $A16['val']);
			$sheet->setCellValue('A' . $A17['cell'], $A17['val']);
			$sheet->setCellValue('A' . $A19['cell'], $A19['val']);
			$sheet->setCellValue('A' . $A20['cell'], $A20['val']);
			$sheet->setCellValue('A' . $A21['cell'], $A21['val']);
			$sheet->setCellValue('A' . $A22['cell'], $A22['val']);
			$sheet->setCellValue('A' . $A23['cell'], $A23['val']);
			$sheet->setCellValue('A' . $A24['cell'], $A24['val']);
			$sheet->setCellValue('A' . $A25['cell'], $A25['val']);
			
			//裏面のセルの値を設定
			$sheet->setCellValue('C' . $postCell, $sankasha[0]['Sankasha']['post_id']);
			$sheet->setCellValue('C' . $stateCell, $sankasha[0]['Sankasha']['state']);
			$sheet->setCellValue('C' . $cityCell, $sankasha[0]['Sankasha']['city']);
			$sheet->setCellValue('C' . $buildCell, $sankasha[0]['Sankasha']['addr']);
			$sheet->setCellValue('C' . $buildCell, $sankasha[0]['Sankasha']['build']);
			$sheet->setCellValue('C' . $nameCell, $sankasha[0]['Sankasha']['sei'] . $sankasha[0]['Sankasha']['mei']);
			
			$postCell = $postCell + 50;
			$stateCell = $stateCell + 50 ;
			$buildCell = $buildCell + 50;
			$cityCell = $cityCell + 50;
			$addressCell = $addressCell + 50;
			$nameCell = $nameCell + 50;

			$A3['cell']  = $A3['cell'] + 50;
			$A4['cell']  = $A4['cell'] + 50;
			$A5['cell']  = $A5['cell'] + 50;
			$A6['cell']  = $A6['cell'] + 50;
			$A16['cell']  = $A16['cell'] + 50;
			$A17['cell']  = $A17['cell'] + 50;
			$A19['cell']  = $A19['cell'] + 50;
			$A20['cell']  = $A20['cell'] + 50;
			$A21['cell']  = $A21['cell'] + 50;
			$A22['cell']  = $A22['cell'] + 50;
			$A23['cell']  = $A23['cell'] + 50;
			$A24['cell']  = $A24['cell'] + 50;
			$A25['cell']  = $A25['cell'] + 50;
			$titleMergeCellStart = $titleMergeCellStart + 50; 
			$titleMergeCellEnd = $titleMergeCellEnd + 50;
			$A3CellStart = $A3CellStart + 50;
			$A3CellEnd = $A3CellEnd + 50;
			$qrcodeCell = $qrcodeCell + 50;
			$titleCell = $titleCell + 50;
			$A5['val'] = "";
			$A6['val'] = "";
		}//for($i < count($reservs)

		//Excel2007形式で保存
		$writer = PHPExcel_IOFactory::createWriter($xl, 'Excel2007');
		$writer->save("output.xlsx");
		$path = "/Applications/XAMPP/xamppfiles/htdocs/skit/app/webroot/output.xlsx";
		$filename = "output.xlsx";

		Configure::write('debug', 0);
		$path = "/Applications/XAMPP/xamppfiles/htdocs/skit/app/webroot/output.xlsx";
		header("Content-disposition: attachment; filename={$filename}");
		header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; name={$filename}");
		$result = file_get_contents($path);
		echo $result;
	}
}
/*
	function actionBranchi(){
		$test = $this->data;
		if($this->params['form']['qrPrint']){
			$this->redirect(array('action'=>'qrPrint', "test"));
		}else{
			$this->redirect(array('action'=>'deptSelect', "test"));
		}
	}
*/

?>
