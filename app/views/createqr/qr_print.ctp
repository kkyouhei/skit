			<?php
				App::import('vendor', 'PHPExcel', array('file'=>'phpexcel' . DS . 'PHPExcel.php'));
				App::import('vendor', 'PHPExcel_IOFactory', array('file'=>'phpexcel' . DS . 'PHPExcel' . DS . 'IOFactory.php'));
/*				App::import('vendor', 'PHPExcel_Cell_AdvancedValueBinder', array('file'=>'phpexcel' . DS . 'Cell' . DS . 'AdvancedValueBinder.php'));
				App::import('vendor', 'PHPExcel', array('file'=>'phpexcel' . DS . 'PHPExcel.php'));
				App::import('vendor', 'PHPExcel', array('file'=>'phpexcel' . DS . 'PHPExcel.php'))
*/
//(1)必要なクラスをインクルード
/*set_include_path(get_include_path() . PATH_SEPARATOR . './Classes/');
include 'PHPExcel.php';
include 'PHPExcel/IOFactory.php';
*/
//(2)PHPExcelオブジェクトの生成
$xl = new PHPExcel();

$obj = new PHPExcel_Worksheet_Drawing();

//(3)シートの設定
$xl->setActiveSheetIndex(0);
$sheet = $xl->getActiveSheet();
$sheet->setTitle('シート1です');

//(4)セルの値を設定
$sheet->setCellValue('A1', 'PHPExcelテスト'); //文字列
$sheet->setCellValue('B2', 123);              //数値
$sheet->setCellValue('C3', '=B2-100');        //計算式
$sheet->setCellValue('D4', true);             //真偽値
$sheet->setCellValue('E5', false);            //真偽値

//(5)スタイルの設定(標準フォント、罫線、中央揃え)
$sheet->getDefaultStyle()->getFont()->setName('ＭＳ Ｐゴシック');
$sheet->getDefaultStyle()->getFont()->setSize(11);
$sheet->getStyle('C3')->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
$sheet->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

//(6)Excel2007形式で保存
$writer = PHPExcel_IOFactory::createWriter($xl, 'Excel2007');
$writer->save("output.xlsx");
$path = "/Applications/XAMPP/xamppfiles/htdocs/skit/app/webroot/output.xlsx";
$filename = "output.xlsx";
Configure::write('debug', 0);
//header("Content-disposition: attachment; filename={$filename}");
//header("Content-type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; name={$filename}");
$result = file_get_contents($path);
}
?>
