<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />	
<?php echo $html->charset(); ?>	
<title>
<?php echo $title_for_layout ?>
</title>
<?php
	echo $html->css('addstudent.layout');
?>
</head>
<body>
	<div id="contents">
		<h4 class="selectorH4">参加者の情報を登録する画面です addstudent/index.ctp</h4>
		<?php
			//javascriptの読み込み
			echo $javascript->link('ajaxzip2/prototype.js');
			echo $javascript->link('ajaxzip2/ajaxzip2.js');
		?>

		<?php
		if(!empty($errors)){
			echo "記入漏れがあります";
		}
		?>


		<div id="form">
			<?php
			//氏名入力フォーム作成
			echo $form->create(null,array('type'=>'post','action'=>'conf')); 
			echo $form->label('name','氏名');
			echo $form->label('Sankasha.sei','姓');
			echo $form->text('Sankasha.sei');
			echo $form->label('Sankasha.mei','名');
			echo $form->text('Sankasha.mei');
			echo "<br />";

			//フリガナ入力フォーム作成
			echo $form->label('furigana','フリガナ');
			echo $form->label('Sankasha.sei_kana','セイ');
			echo $form->text('Sankasha.sei_kana');
			echo $form->label('Sankasha.mei_kana','メイ');	
			echo $form->text('Sankasha.mei_kana');
			echo "<br />";

			//性別フォーム作成
			echo $form->label('Sankasha.sex','性別');
			echo $form->select('Sankasha.sex',
				array('男性'=>'男性','女性'=>'女性','両性'=>'不明'),
				'男性',array("showParent"=>true),null); 
			echo "<br />";

			//生年月日フォーム
			echo $form->label('Sankasha.birthday','生年月日');
			echo $exform->dateYMD('Sankasha.birthday',null,array(
						'minYear'=>1900,
						'maxYear'=>date('Y'),
						'separator'=>array("年","月","日"),),
						true		
			);

			echo "<br />";

			//郵便番号入力フォーム
			echo $form->label('Sankasha.post_id','郵便番号');
			echo $form->text('Sankasha.post_id',array('onKeyUp'=>'AjaxZip2.zip2addr(this, "state", "city")',
								  'maxlength'=>8
								 ));
			echo "<br />";

			//都道府県を選択フォーム
			//未実装
			echo $form->label('Sankasha.state','都道府県');
			echo $this->element('select_state');
//			echo $form->text('Sankasha.state');
			echo "<br />";				

			//市町村入力フォーム
			echo $form->label('Sankasha.city','市町村');
			echo $form->text('Sankasha.city');
			echo "<br />";

			//番地入力フォーム
			echo $form->label('Sankasha.addr','番地');
			echo $form->text('Sankasha.addr');
			echo "<br />";

			//建物名入力フォーム
			echo $form->label('Sankasha.build','建物名');
			echo $form->text('Sankasha.build');
			echo "<br />";

			//電話番号入力フォーム
			echo $form->label('Sankasha.tel','電話番号');
			echo $form->text('Sankasha.tel');
			echo "<br />";

			//メールアドレス入力フォーム
			echo $form->label('Sankasha.mail','メールアドレス');
			echo $form->text('Sankasha.mail');
			echo "<br />";

			//国籍
			//未実装都 道府県と同じ問題
			echo $form->label('Sankasha.country','国籍');
			echo $this->element('select_country');
			echo "<br />";

			//職業
			//未実装　都道府県と同じ問題
			echo $form->label('Sankasha.job','職業');
			echo $form->text('Sankasha.job');
			echo "<br />";

			//学校名
			echo $form->label('Sankasha.school_name','学校名');
			echo $form->text('Sankasha.school_name');
			echo "<br />";

			//学年フォーム
			echo $form->label('Sankasha.school_grade','学年');
			echo $form->select('Sankasha.school_grade',
				array("1年"=>"1年","2年"=>"2年","3年"=>"3年","4年"=>"4年","その他"=>"その他"),
				'1年',array("showParent"=>true),null);
			echo "<br />";

			echo $form->error('Sankasha.sei');
			echo $form->error('Sankasha.mei');
			echo $form->error('Sankasha.sei_kana');
			echo $form->error('Sankasha.mei_kana');
			echo $form->error('Sankasha.sex');
			echo $form->error('Sankasha.birthday');
			echo $form->error('Sankasha.post_id');
			echo $form->error('Sankasha.state');
			echo $form->error('Sankasha.city');
			echo $form->error('Sankasha.addr');
			echo $form->error('Sankasha.build');
			echo $form->error('Sankasha.tel');
			echo $form->error('Sankasha.mail');
			echo $form->error('Sankasha.country');
			echo $form->error('Sankasha.job');
			echo $form->error('Sankasha.school_name');
			echo $form->error('Sankasha.school_grade');

			//ボタンの作成
			echo $form->end('登録');
			?>
		</div>

	</div>
</body>
</html>
