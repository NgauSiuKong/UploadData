<?php
$file = "./file/data.xlsx";
//phpexcel实例化对象,composer已经完全加载
$PHPExcelObj = PHPExcel_IOFactory::load($file);
use App\operate_excel\operate_excel;
$oprtObj = operate_excel::getoprtObj($PHPExcelObj);
//$res = $oprtObj->readlineExcel();
$res = file($file);
dump($res);



