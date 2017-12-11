<?php
namespace App\operate_excel;
    class operate_excel
    {
        static $oprtObj;
        public $PHPExcelObj;
        private function __construct($Obj)
        {
            $this->PHPExcelObj = $Obj;
        }
        static function getoprtObj($Obj)
        {
            //在这里犯错了,直接调用了$oprtObj;
            if(is_null(self::$oprtObj)){
                self::$oprtObj = new self($Obj);
            }
            return self::$oprtObj;
        }
        //文件直接读取方法,全部导出
        public function readExcel()
        {
            $sheetCount = $this->PHPExcelObj->getSheetCount();
            $res_arr = array();
            for($i=0;$i<$sheetCount;$i++){
                $res_arr[$i] = $this->PHPExcelObj->getSheet($i)->toArray();
            }
            return $res_arr;
        }
        //文件逐行读取,节省内存
        public function readlineExcel()
        {
            $res_arr = array();
            //遍历每一个sheet
            foreach($this->PHPExcelObj->getWorksheetIterator() as $key_sheet => $sheet){
                //遍历的每一个sheet逐行读取
                foreach($sheet->getRowIterator() as $key_line => $row){
                    //如果excel有头部，可跳过。如果
                    if($row->getRowIndex() == 1){
                        continue;
                    }
                    //遍历的每一个行逐列读取
                    foreach($row->getCellIterator() as $key_column => $cell){
                        $data_cell = $cell->getValue();
                        $res_arr[$key_sheet][$key_line][$key_column] = $data_cell;
                    }
                }
            }
            return $res_arr;
        }

    }
