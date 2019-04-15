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
$CL = $objPHPExcel->setActiveSheetIndex();
$CL->setCellValue('A1', 'STUDENT ID');
$CL->setCellValue('B1', 'STUDENT NAME');
$CL->setCellValue('C1', 'TOTAL Q, A, O');
$CL->setCellValue('D1', 'ITEMS 50-110');
$CL->setCellValue('E1', 'MID 40%');
$CL->setCellValue('F1', 'PRELIM');
$CL->setCellValue('G1', 'PRELIM FOR 50-110');
$i=2;

// $str = file_get_contents('TrTable.json');
// $json = json_decode($str, true);
// echo print_r($json, true), EOL;
// echo $json['TPS70'][0]['score'], EOL;
$index=0;
$midval = 0.4;
$str = file_get_contents('TrTable.json');
$json = json_decode($str, true);
//Fetch students
while($rows = $getStud->fetchArray(SQLITE3_ASSOC)){
    $sClass = explode(",",$rows['stud_classes']);
    foreach($sClass as $clr){
        if($clr == $row['cr_id']){
            $CL->setCellValue('A'.$i, $rows["stud_id"]);
            $CL->setCellValue('B'.$i, $rows["stud_name"]);
        }
    }
    /*Prelim and midterm calculations*/
    //Total Q,A,O
    $getAtt = $GradeCalc->GetQAO('attendance','att',$rows["stud_id"],'Prelim','Midterm',$_GET['dataID']);
    while($rowAtt = $getAtt->fetchArray(SQLITE3_ASSOC)){
        $getQz = $GradeCalc->GetQAO('quizes','quiz',$rows["stud_id"],'Prelim','Midterm',$_GET['dataID']);
        while($rowQz = $getQz->fetchArray(SQLITE3_ASSOC)){
            $getOr = $GradeCalc->GetQAO('orals','oral',$rows["stud_id"],'Prelim','Midterm',$_GET['dataID']);
            while($rowOr = $getOr->fetchArray(SQLITE3_ASSOC)){
                $totalQAO = $rowAtt['PtSum'] + $rowQz['PtSum'] + $rowOr['PtSum'];
                //total items Q,A,O
                // $totalPfpoints = ($rowAtt['PtCount'] * 5) + ($rowQz['PtCount'] * 10) + ($rowOr['PtCount'] * 10);
                $totalPfpoints = 80; // to be set on the class record creation *add tbl on DB and input on form*
                if($totalQAO != ''){
                    $CL->setCellValue('C'.$i, $totalQAO);
                }else{
                    $CL->setCellValue('C'.$i, '0');
                }
                echo $rows["stud_id"].'-'.$totalQAO, EOL;
            }

            /*for items 50-110*/
            if($totalQAO == 0){
                $CL->setCellValue('D'.$i, '65%');
                $CL->setCellValue('E'.$i, (floatval('65%') * $midval).'%');
            }else if($totalQAO != 0){
                // echo date('H:i:s').'=' , count($json['TPS50']), EOL;
                while($index != count($json['TPS'.$totalPfpoints])){
                    if(is_numeric($json['TPS'.$totalPfpoints][$index]['score'])){
                        if($totalQAO == $json['TPS'.$totalPfpoints][$index]['score']){
                            $CL->setCellValue('D'.$i, $json['TPS'.$totalPfpoints][$index]['rating']);
                            $CL->setCellValue('E'.$i, (floatval($json['TPS'.$totalPfpoints][$index]['rating']) * $midval).'%');
                            // echo date('H:i:s').'RAW'.$totalQAO.'TPS:' , $json['TPS'.$totalPfpoints][$index]['score'], EOL;
                        }
                        // echo date('H:i:s').'==' , $json['TPS'.$totalPfpoints][$index]['score'].' is numeric', EOL;
                    }else{
                        $rangeval = explode("-",$json['TPS'.$totalPfpoints][$index]['score']);
                        if(($totalQAO >= $rangeval[0]) && ($totalQAO <= $rangeval[1])){
                            $CL->setCellValue('D'.$i, $json['TPS'.$totalPfpoints][$index]['rating']);
                            $CL->setCellValue('E'.$i, (floatval($json['TPS'.$totalPfpoints][$index]['rating']) * $midval).'%');
                            // echo date('H:i:s').'RAW'.$totalQAO.'TPS:' , $json['TPS'.$totalPfpoints][$index]['score'], EOL;
                        }
                        // echo date('H:i:s').'==' , $json['TPS'.$totalPfpoints][$index]['score'].' is string', EOL;
                    }
                    $index++;
                }
            }
            
            //Prelim Exam
            $getPExam = $GradeCalc->GetExam($rows["stud_id"],'Prelim',$_GET['dataID']);
            while($rowEx = $getPExam->fetchArray(SQLITE3_ASSOC)){
                //Prelim points
                $Extotalpoints = 50; // to be set on the class record creation *add tbl on DB and input on form*
                if($rowEx['Expoints'] != ''){
                    $CL->setCellValue('F'.$i, $rowEx['Expoints']);
                }else{
                    $CL->setCellValue('F'.$i, '0');
                }
            }
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
foreach(range('A','Z') as $columnID){
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