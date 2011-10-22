<?php
class AddStudentController extends AppController{
	public $name = 'Addstudent';
	public $uses = 'Sankasha';
	public $layout = 'layout';

	//ヘルパーと自作拡張ヘルパー呼び出しの下準備
	var $helpers = array('Form', 'Exform');
//	public $scaffold;

	//申込者の個人情報を入力するための入力フォーム
	function index(){
	}

	//個人情報を登録後に、登録されたデータを出力する画面
	function conf(){
		if(!empty($this->data)){
			//配列で渡された生年月日を結合して文字列にする処理
			$this->data['Sankasha']['birthday']  = 
				$this->Sankasha->deconstruct("birthday",$this->data['Sankasha']['birthday']);
		}

		$this->Sankasha->set($this->data);
		//バリデーションチェック
		$error = $this->validateErrors($this->Sankasha);
		if(!empty($error)){
			$this->set("errors",$error);
			$this->render($action = "index");
		}
	}

	//データベースに個人情報をinsertする処理
	function addRecord(){
		if(!empty($this->data)){
			$setEnc = 'SET NAMES UTF8 ;' ;
			$this->Sankasha->query($setEnc);
			$this->Sankasha->save($this->data);
		}
		$this->redirect('.');
	}
}
