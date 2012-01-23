<?php
class Event extends AppModel{
	var $name = 'Event' ;
	
	//conditionsの配列を受け取り検索するメソッド
	function findEvent($whereEvent=null, $field=null, $order=null){
		return $this->find('all',
					array('fields'=>$field,
					      'order'=>$order,
					      'conditions'=>$whereEvent)
				  );
	}

	//event表からイベント日を取得するメソッド
	//引数には体験入学かオープンキャンパスを指定
	function findEventDay($event_name){
		if(!empty($event_name)){
		 	return $this->find('all',
					array('fields'=>'DISTINCT Event.event_day',
					      'conditions'=>array(
					      'Event.event_day >= curdate()', 
					      'Event.event_name' => $event_name)
					     )
				 	  );
		}else{
		 	return $this->find('all',
					array('fields'=>'DISTINCT Event.event_day',
					      'conditions'=>array(
					      'Event.event_day >= curdate()')
					     )
				 	  );
		}

	}

	function findEventName($event_day){
		return $this->find('all', array('conditions'=>array(
					        'Event.event_day' => $event_day
								   )
					       )
				  );
	} 
}
