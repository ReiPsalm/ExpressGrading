<?php
include_once "../engine/loader.php";
$classR->clrid = $_GET['dataID'];
$getData = $classR->GetDataClr();
$row = $getData->fetchArray(SQLITE3_ASSOC);
$getStud = $Students->GetStud();
/**
 * PHPExcel
 *
 * Copyright (c) 2006 - 2015 PHPExcel
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301  USA
 *
 * @category   PHPExcel
 * @package    PHPExcel
 * @copyright  Copyright (c) 2006 - 2015 PHPExcel (http://www.codeplex.com/PHPExcel)
 * @license    http://www.gnu.org/licenses/old-licenses/lgpl-2.1.txt	LGPL
 * @version    ##VERSION##, ##DATE##
 */

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Asia/Manila');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

/** Include PHPExcel */
require_once 'PHPExcel-1.8/Classes/PHPExcel.php';

// Create new PHPExcel object
echo date('H:i:s') , " Create new PHPExcel object" , EOL;
$objPHPExcel = new PHPExcel();

// Set document properties
echo date('H:i:s') , " Set document properties" , EOL;
$objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
							 ->setLastModifiedBy("Maarten Balliauw")
							 ->setTitle("PHPExcel Test Document")
							 ->setSubject("PHPExcel Test Document")
							 ->setDescription("Test document for PHPExcel, generated using PHP classes.")
							 ->setKeywords("office PHPExcel php")
							 ->setCategory("Test result file");


// Add some data
echo date('H:i:s') , " Add some data" , EOL;
$ML = $objPHPExcel->setActiveSheetIndex();
$ML->setCellValue('A1', 'STUDENT ID');
$ML->setCellValue('B1', 'STUDENT NAME');
$i=2;
while($rows = $getStud->fetchArray(SQLITE3_ASSOC)){
    $sClass = explode(",",$rows['stud_classes']);
    foreach($sClass as $clr){
        if($clr == $row['cr_id']){
            $ML->setCellValue('A'.$i, $rows["stud_id"]);
            $ML->setCellValue('B'.$i, $rows["stud_name"]);
        }
    }
    ++$i;
}

// Rename worksheet
echo date('H:i:s') , " Rename worksheet" , EOL;
$objPHPExcel->getActiveSheet()->setTitle($row['Sec_desc']);


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
// Freeze third column
$objPHPExcel->getActiveSheet()->freezePane('C1');
//Set auto width on column A & B
foreach(range('A','B') as $columnID){
    $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
}



// Save Excel 2007 file
echo date('H:i:s') , " Write to Excel2007 format" , EOL;
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
// $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
$objWriter->save('C:/Users/user/Downloads/'.$row['subj_desc'].'('.$row['Sec_desc'].').xlsx');
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;

echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
// Echo memory usage
echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;


// Echo memory peak usage
echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;

// Echo done
echo date('H:i:s') , " Done writing files" , EOL;
echo 'Files have been created in ' , getcwd() , EOL;

?>