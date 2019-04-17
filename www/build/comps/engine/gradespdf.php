<?php
include_once "../engine/loader.php";
$classR->clrid = $_POST['dataID'];
$getData = $classR->GetDataClr();
$row = $getData->fetchArray(SQLITE3_ASSOC);
$getStud = $Students->GetStud();

if($_POST['Grinfo'] == 'FinalGr'){
    /** Error reporting */
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    date_default_timezone_set('Asia/Manila');

    define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

    /** Include PHPExcel */
    require_once 'PHPExcel-1.8/Classes/PHPExcel.php';

    // Create new PHPExcel object
    // echo date('H:i:s') , " Create new PHPExcel object" , EOL;
    $objPHPExcel = new PHPExcel();

    // Set document properties
    // echo date('H:i:s') , " Set document properties" , EOL;
    $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
                                ->setLastModifiedBy("Maarten Balliauw")
                                ->setTitle("PHPExcel Test Document")
                                ->setSubject("PHPExcel Test Document")
                                ->setDescription("Test document for PHPExcel, generated using PHP classes.")
                                ->setKeywords("office PHPExcel php")
                                ->setCategory("Test result file");


    // Add some data
    // echo date('H:i:s') , " Add some data" , EOL;
    $CL = $objPHPExcel->setActiveSheetIndex();
    $CL->setCellValue('A1', 'STUDENT ID');
    $CL->setCellValue('B1', 'STUDENT NAME');
    $CL->setCellValue('C1', 'FINAL GRADE');
    $i=2;

    // $str = file_get_contents('TrTable.json');
    // $json = json_decode($str, true);
    // echo print_r($json, true), EOL;
    // echo $json['TPS70'][0]['score'], EOL;
    $midval = 0.4;
    $Xval = 0;
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
        $PrgetAtt = $GradeCalc->GetQAO('attendance','att',$rows["stud_id"],'Prelim','Midterm',$_POST['dataID']);
        while($rowAtt = $PrgetAtt->fetchArray(SQLITE3_ASSOC)){
            $PrgetQz = $GradeCalc->GetQAO('quizes','quiz',$rows["stud_id"],'Prelim','Midterm',$_POST['dataID']);
            while($rowQz = $PrgetQz->fetchArray(SQLITE3_ASSOC)){
                $PrgetOr = $GradeCalc->GetQAO('orals','oral',$rows["stud_id"],'Prelim','Midterm',$_POST['dataID']);
                while($rowOr = $PrgetOr->fetchArray(SQLITE3_ASSOC)){
                    $totalQAO = $rowAtt['PtSum'] + $rowQz['PtSum'] + $rowOr['PtSum'];
                    //total items Q,A,O
                    // $totalPfpoints = ($rowAtt['PtCount'] * 5) + ($rowQz['PtCount'] * 10) + ($rowOr['PtCount'] * 10);
                    $totalPfpoints = 80; // to be set on the class record creation *add tbl on DB and input on form*
                    if($totalQAO != ''){
                        $CL->setCellValue('C'.$i, $totalQAO);
                    }else{
                        $CL->setCellValue('C'.$i, '0');
                    }
                }

                /*for items 50-110*/
                $index = 0;
                $MD40 = 0;
                if($totalQAO == 0){
                    $MD40 = 0;
                }else if($totalQAO != 0){
                    while($index != count($json['TPS'.$totalPfpoints])){
                        if(is_numeric($json['TPS'.$totalPfpoints][$index]['score'])){
                            if($totalQAO == $json['TPS'.$totalPfpoints][$index]['score']){
                                $MD40 = (floatval($json['TPS'.$totalPfpoints][$index]['rating']) * $midval);
                            }
                        }else{
                            $rangeval = explode("-",$json['TPS'.$totalPfpoints][$index]['score']);
                            if(($totalQAO >= $rangeval[0]) && ($totalQAO <= $rangeval[1])){
                                $MD40 = (floatval($json['TPS'.$totalPfpoints][$index]['rating']) * $midval);
                            }
                        }
                        $index++;
                    }
                }
                
                //Prelim Exam
                $getPExam = $GradeCalc->GetExam($rows["stud_id"],'Prelim',$_POST['dataID']);
                while($rowEx = $getPExam->fetchArray(SQLITE3_ASSOC)){
                    //Prelim points
                    $ix = 0;
                    $PR = 0;
                    $Extotalpoints = 50; // to be set on the class record creation *add tbl on DB and input on form*\

                    if($rowEx['Expoints'] == 0){
                        $PR = 65;
                    }else if($rowEx['Expoints'] != 0){
                        while($ix != count($json['TPS'.$Extotalpoints])){
                            if(is_numeric($json['TPS'.$Extotalpoints][$ix]['score'])){
                                if($rowEx['Expoints']== $json['TPS'.$Extotalpoints][$ix]['score']){
                                    $PR = $json['TPS'.$Extotalpoints][$ix]['rating'];
                                }
                                // echo date('H:i:s').'==' , $json['TPS'.$Extotalpoints][$ix]['score'].' is numeric', EOL;
                            }else{
                                $Prangeval = explode("-",$json['TPS'.$Extotalpoints][$ix]['score']);
                                if(($rowEx['Expoints'] >= $Prangeval[0]) && ($rowEx['Expoints'] <= $Prangeval[1])){
                                    $PR = $json['TPS'.$Extotalpoints][$ix]['rating'];
                                }
                                // echo date('H:i:s').'==' , $json['TPS'.$Extotalpoints][$ix]['score'].' is string', EOL;
                            }
                            $ix++;
                        }
                    }
                }

                //Midterm Exam
                $getMdEx = $GradeCalc->GetExam($rows["stud_id"],'Midterm',$_POST['dataID']);
                while($rowMdEx = $getMdEx->fetchArray(SQLITE3_ASSOC)){
                    $mdix = 0;
                    $MD = 0;
                    $MdExTP = 100; // to be set on the class record creation *add tbl on DB and input on form*

                    if($rowMdEx['Expoints'] == 0){
                        $MD = 65;
                    }else if($rowMdEx['Expoints'] != 0){
                        while($mdix != count($json['TPS'.$MdExTP])){
                            if(is_numeric($json['TPS'.$MdExTP][$mdix]['score'])){
                                if($rowMdEx['Expoints']== $json['TPS'.$MdExTP][$mdix]['score']){
                                    $MD = $json['TPS'.$MdExTP][$mdix]['rating'];
                                }
                                // echo date('H:i:s').'==' , $json['TPS'.$Extotalpoints][$ix]['score'].' is numeric', EOL;
                            }else{
                                $Mdrangeval = explode("-",$json['TPS'.$MdExTP][$mdix]['score']);
                                if(($rowMdEx['Expoints'] >= $Mdrangeval[0]) && ($rowMdEx['Expoints'] <= $Mdrangeval[1])){
                                    $MD = $json['TPS'.$MdExTP][$mdix]['rating'];
                                }
                                // echo date('H:i:s').'==' , $json['TPS'.$Extotalpoints][$ix]['score'].' is string', EOL;
                            }
                            $mdix++;
                        }
                    }
                }

                //midterm average to grade
                $MDavr = (floatval($MD) + floatval($PR)) / 2;
                $Midgx =0;
                if((floatval($MD) == 0) && (floatval($PR) == 0)){
                    $Xval = 0;
                    $MidGrade = 0;
                    // echo date('H:i:s').'==' , floatval($MD).';'.floatval($PR), EOL;
                }else{
                    $Xval = round(($MD40 + ($MDavr * 0.6)) / 3);
                    $MidGrade = round($MD40 + ($MDavr * 0.6));
                    // echo date('H:i:s').'==' , floatval($MD).';'.floatval($PR), EOL;
                }
                
            }
        }


        /*Semi and Final calculations*/
        //Total Q,A,O
        $SfgetAtt = $GradeCalc->GetQAO('attendance','att',$rows["stud_id"],'Semi','Final',$_POST['dataID']);
        while($rowAtt = $SfgetAtt->fetchArray(SQLITE3_ASSOC)){
            $SfgetQz = $GradeCalc->GetQAO('quizes','quiz',$rows["stud_id"],'Semi','Final',$_POST['dataID']);
            while($rowQz = $SfgetQz->fetchArray(SQLITE3_ASSOC)){
                $SfgetOr = $GradeCalc->GetQAO('orals','oral',$rows["stud_id"],'Semi','Final',$_POST['dataID']);
                while($rowOr = $SfgetOr->fetchArray(SQLITE3_ASSOC)){
                    $totalQAO = $rowAtt['PtSum'] + $rowQz['PtSum'] + $rowOr['PtSum'];
                    //total items Q,A,O
                    // $totalPfpoints = ($rowAtt['PtCount'] * 5) + ($rowQz['PtCount'] * 10) + ($rowOr['PtCount'] * 10);
                    $totalPfpoints = 50; // to be set on the class record creation *add tbl on DB and input on form*
                }

                /*for items 50-110*/
                $index = 0;
                $MD40 = 0;
                if($totalQAO == 0){
                    $MD40 = 0;
                }else if($totalQAO != 0){
                    while($index != count($json['TPS'.$totalPfpoints])){
                        if(is_numeric($json['TPS'.$totalPfpoints][$index]['score'])){
                            if($totalQAO == $json['TPS'.$totalPfpoints][$index]['score']){
                                $MD40 = (floatval($json['TPS'.$totalPfpoints][$index]['rating']) * $midval);
                            }
                            // echo date('H:i:s').'==' , $json['TPS'.$totalPfpoints][$index]['score'].' is numeric', EOL;
                        }else{
                            $rangeval = explode("-",$json['TPS'.$totalPfpoints][$index]['score']);
                            if(($totalQAO >= $rangeval[0]) && ($totalQAO <= $rangeval[1])){
                                $MD40 = (floatval($json['TPS'.$totalPfpoints][$index]['rating']) * $midval);
                            }
                            // echo date('H:i:s').'==' , $json['TPS'.$totalPfpoints][$index]['score'].' is string', EOL;
                        }
                        $index++;
                    }
                }
                
                //Prelim Exam
                $getPExam = $GradeCalc->GetExam($rows["stud_id"],'Semi',$_POST['dataID']);
                while($rowEx = $getPExam->fetchArray(SQLITE3_ASSOC)){
                    //Prelim points
                    $ix = 0;
                    $PR = 0;
                    $Extotalpoints = 50; // to be set on the class record creation *add tbl on DB and input on form*

                    if($rowEx['Expoints'] == 0){
                        $PR = 65;
                    }else if($rowEx['Expoints'] != 0){
                        while($ix != count($json['TPS'.$Extotalpoints])){
                            if(is_numeric($json['TPS'.$Extotalpoints][$ix]['score'])){
                                if($rowEx['Expoints']== $json['TPS'.$Extotalpoints][$ix]['score']){
                                    $PR = $json['TPS'.$Extotalpoints][$ix]['rating'];
                                }
                                // echo date('H:i:s').'==' , $json['TPS'.$Extotalpoints][$ix]['score'].' is numeric', EOL;
                            }else{
                                $Prangeval = explode("-",$json['TPS'.$Extotalpoints][$ix]['score']);
                                if(($rowEx['Expoints'] >= $Prangeval[0]) && ($rowEx['Expoints'] <= $Prangeval[1])){
                                    $PR = $json['TPS'.$Extotalpoints][$ix]['rating'];
                                }
                                // echo date('H:i:s').'==' , $json['TPS'.$Extotalpoints][$ix]['score'].' is string', EOL;
                            }
                            $ix++;
                        }
                    }
                }

                //Midterm Exam
                $getMdEx = $GradeCalc->GetExam($rows["stud_id"],'Final',$_POST['dataID']);
                while($rowMdEx = $getMdEx->fetchArray(SQLITE3_ASSOC)){
                    $mdix = 0;
                    $MD = 0;
                    $MdExTP = 50; // to be set on the class record creation *add tbl on DB and input on form*

                    if($rowMdEx['Expoints'] == 0){
                        $MD = 0;
                    }else if($rowMdEx['Expoints'] != 0){
                        while($mdix != count($json['TPS'.$MdExTP])){
                            if(is_numeric($json['TPS'.$MdExTP][$mdix]['score'])){
                                if($rowMdEx['Expoints']== $json['TPS'.$MdExTP][$mdix]['score']){
                                    $MD = $json['TPS'.$MdExTP][$mdix]['rating'];
                                }
                                // echo date('H:i:s').'==' , $json['TPS'.$Extotalpoints][$ix]['score'].' is numeric', EOL;
                            }else{
                                $Mdrangeval = explode("-",$json['TPS'.$MdExTP][$mdix]['score']);
                                if(($rowMdEx['Expoints'] >= $Mdrangeval[0]) && ($rowMdEx['Expoints'] <= $Mdrangeval[1])){
                                    $MD = $json['TPS'.$MdExTP][$mdix]['rating'];
                                }
                                // echo date('H:i:s').'==' , $json['TPS'.$Extotalpoints][$ix]['score'].' is string', EOL;
                            }
                            $mdix++;
                        }
                    }
                }

                //midterm average to grade
                $MDavr = (floatval($MD) + floatval($PR)) / 2;
                $Midgx =0;
                if($MDavr == 0){
                    while($Midgx != count($json['GSF'])){
                        $CL->setCellValue('C'.$i, '5');
                        $Midgx++;
                    }
                    // echo date('H:i:s').'==' , floatval($MD).';'.floatval($PR), EOL;
                }else{
                    $MidGrade = $Xval + round((($MD40 + ($MDavr * 0.6)) / 3) * 2);
                    while($Midgx != count($json['GSF'])){
                        if($MidGrade == $json['GSF'][$Midgx]['PG']){
                            $CL->setCellValue('C'.$i, $json['GSF'][$Midgx]['EQ']);
                        }
                        $Midgx++;
                    }
                    // echo date('H:i:s').'==' , floatval($MD).';'.floatval($PR), EOL;
                }
                
            }
        }
        ++$i;
    }

    // Rename worksheet
    // echo date('H:i:s') , " Rename worksheet" , EOL;
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
    // echo date('H:i:s') , " Write to Excel2007 format" , EOL;
    $callStartTime = microtime(true);

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    // $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
    $objWriter->save('C:/Users/user/Downloads/'.$row['subj_desc'].'('.$row['Sec_desc'].').xlsx');
    $callEndTime = microtime(true);
    $callTime = $callEndTime - $callStartTime;

    // echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
    // echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
    // // Echo memory usage
    // echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;


    // // Echo memory peak usage
    // echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;

    // // Echo done
    // echo date('H:i:s') , " Done writing files" , EOL;
    // echo 'Files have been created in ' , getcwd() , EOL;


    echo "1";
}else if($_POST['Grinfo'] == 'FullGr'){
    /** Error reporting */
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    date_default_timezone_set('Asia/Manila');

    define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');

    /** Include PHPExcel */
    require_once 'PHPExcel-1.8/Classes/PHPExcel.php';

    // Create new PHPExcel object
    // echo date('H:i:s') , " Create new PHPExcel object" , EOL;
    $objPHPExcel = new PHPExcel();

    // Set document properties
    // echo date('H:i:s') , " Set document properties" , EOL;
    $objPHPExcel->getProperties()->setCreator("Maarten Balliauw")
                                ->setLastModifiedBy("Maarten Balliauw")
                                ->setTitle("PHPExcel Test Document")
                                ->setSubject("PHPExcel Test Document")
                                ->setDescription("Test document for PHPExcel, generated using PHP classes.")
                                ->setKeywords("office PHPExcel php")
                                ->setCategory("Test result file");


    // Add some data
    // echo date('H:i:s') , " Add some data" , EOL;
    $CL = $objPHPExcel->setActiveSheetIndex();
    $CL->setCellValue('A1', 'STUDENT ID');
    $CL->setCellValue('B1', 'STUDENT NAME');
    $CL->setCellValue('C1', 'TOTAL Q, A, O');
    $CL->setCellValue('D1', 'ITEMS 50-110');
    $CL->setCellValue('E1', 'MID 40%');
    $CL->setCellValue('F1', 'PRELIM');
    $CL->setCellValue('G1', 'PRELIM FOR 50-110');
    $CL->setCellValue('H1', 'MIDTERM');
    $CL->setCellValue('I1', 'MIDTERM FOR 50-110');
    $CL->setCellValue('J1', 'MIDTERM AVERAGE');
    $CL->setCellValue('K1', 'MIDTERM 60%');
    $CL->setCellValue('L1', 'MIDTERM GRADE %');
    $CL->setCellValue('M1', 'MIDTERM GRADE');


    $CL->setCellValue('N1', 'TOTAL Q, A, O');
    $CL->setCellValue('O1', 'ITEMS 50-110');
    $CL->setCellValue('P1', 'FINAL 40%');
    $CL->setCellValue('Q1', 'SEMI-FINAL');
    $CL->setCellValue('R1', 'SEMI FOR 50-110');
    $CL->setCellValue('S1', 'FINAL');
    $CL->setCellValue('T1', 'FINAL FOR 50-110');
    $CL->setCellValue('U1', 'FINAL AVERAGE');
    $CL->setCellValue('V1', 'FINAL 60%');
    $CL->setCellValue('W1', 'FINAL TENTATIVE GRADE');
    $CL->setCellValue('X1', '1/3 OF MIDTERM GRADE');
    $CL->setCellValue('Y1', '2/3 OF FINAL GRADE');
    $CL->setCellValue('Z1', 'FINAL GRADE %');
    $CL->setCellValue('AA1', 'FINAL GRADE');
    $i=2;

    // $str = file_get_contents('TrTable.json');
    // $json = json_decode($str, true);
    // echo print_r($json, true), EOL;
    // echo $json['TPS70'][0]['score'], EOL;
    $midval = 0.4;
    $Xval = 0;
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
        $PrgetAtt = $GradeCalc->GetQAO('attendance','att',$rows["stud_id"],'Prelim','Midterm',$_POST['dataID']);
        while($rowAtt = $PrgetAtt->fetchArray(SQLITE3_ASSOC)){
            $PrgetQz = $GradeCalc->GetQAO('quizes','quiz',$rows["stud_id"],'Prelim','Midterm',$_POST['dataID']);
            while($rowQz = $PrgetQz->fetchArray(SQLITE3_ASSOC)){
                $PrgetOr = $GradeCalc->GetQAO('orals','oral',$rows["stud_id"],'Prelim','Midterm',$_POST['dataID']);
                while($rowOr = $PrgetOr->fetchArray(SQLITE3_ASSOC)){
                    $totalQAO = $rowAtt['PtSum'] + $rowQz['PtSum'] + $rowOr['PtSum'];
                    //total items Q,A,O
                    // $totalPfpoints = ($rowAtt['PtCount'] * 5) + ($rowQz['PtCount'] * 10) + ($rowOr['PtCount'] * 10);
                    $totalPfpoints = 80; // to be set on the class record creation *add tbl on DB and input on form*
                    if($totalQAO != ''){
                        $CL->setCellValue('C'.$i, $totalQAO);
                    }else{
                        $CL->setCellValue('C'.$i, '0');
                    }
                }

                /*for items 50-110*/
                $index = 0;
                $MD40 = 0;
                if($totalQAO == 0){
                    $CL->setCellValue('D'.$i, '65%');
                    $CL->setCellValue('E'.$i, (floatval('65%') * $midval).'%');
                }else if($totalQAO != 0){
                    while($index != count($json['TPS'.$totalPfpoints])){
                        if(is_numeric($json['TPS'.$totalPfpoints][$index]['score'])){
                            if($totalQAO == $json['TPS'.$totalPfpoints][$index]['score']){
                                $CL->setCellValue('D'.$i, $json['TPS'.$totalPfpoints][$index]['rating']);
                                $CL->setCellValue('E'.$i, (floatval($json['TPS'.$totalPfpoints][$index]['rating']) * $midval).'%');
                                $MD40 = (floatval($json['TPS'.$totalPfpoints][$index]['rating']) * $midval);
                            }
                            // echo date('H:i:s').'==' , $json['TPS'.$totalPfpoints][$index]['score'].' is numeric', EOL;
                        }else{
                            $rangeval = explode("-",$json['TPS'.$totalPfpoints][$index]['score']);
                            if(($totalQAO >= $rangeval[0]) && ($totalQAO <= $rangeval[1])){
                                $CL->setCellValue('D'.$i, $json['TPS'.$totalPfpoints][$index]['rating']);
                                $CL->setCellValue('E'.$i, (floatval($json['TPS'.$totalPfpoints][$index]['rating']) * $midval).'%');
                                $MD40 = (floatval($json['TPS'.$totalPfpoints][$index]['rating']) * $midval);
                            }
                            // echo date('H:i:s').'==' , $json['TPS'.$totalPfpoints][$index]['score'].' is string', EOL;
                        }
                        $index++;
                    }
                }
                
                //Prelim Exam
                $getPExam = $GradeCalc->GetExam($rows["stud_id"],'Prelim',$_POST['dataID']);
                while($rowEx = $getPExam->fetchArray(SQLITE3_ASSOC)){
                    //Prelim points
                    $ix = 0;
                    $PR = 0;
                    $Extotalpoints = 50; // to be set on the class record creation *add tbl on DB and input on form*
                    if($rowEx['Expoints'] != ''){
                        $CL->setCellValue('F'.$i, $rowEx['Expoints']);
                    }else{
                        $CL->setCellValue('F'.$i, '0');
                    }

                    if($rowEx['Expoints'] == 0){
                        $CL->setCellValue('G'.$i, '65%');
                    }else if($rowEx['Expoints'] != 0){
                        while($ix != count($json['TPS'.$Extotalpoints])){
                            if(is_numeric($json['TPS'.$Extotalpoints][$ix]['score'])){
                                if($rowEx['Expoints']== $json['TPS'.$Extotalpoints][$ix]['score']){
                                    $CL->setCellValue('G'.$i, $json['TPS'.$Extotalpoints][$ix]['rating']);
                                    $PR = $json['TPS'.$Extotalpoints][$ix]['rating'];
                                }
                                // echo date('H:i:s').'==' , $json['TPS'.$Extotalpoints][$ix]['score'].' is numeric', EOL;
                            }else{
                                $Prangeval = explode("-",$json['TPS'.$Extotalpoints][$ix]['score']);
                                if(($rowEx['Expoints'] >= $Prangeval[0]) && ($rowEx['Expoints'] <= $Prangeval[1])){
                                    $CL->setCellValue('G'.$i, $json['TPS'.$Extotalpoints][$ix]['rating']);
                                    $PR = $json['TPS'.$Extotalpoints][$ix]['rating'];
                                }
                                // echo date('H:i:s').'==' , $json['TPS'.$Extotalpoints][$ix]['score'].' is string', EOL;
                            }
                            $ix++;
                        }
                    }
                }

                //Midterm Exam
                $getMdEx = $GradeCalc->GetExam($rows["stud_id"],'Midterm',$_POST['dataID']);
                while($rowMdEx = $getMdEx->fetchArray(SQLITE3_ASSOC)){
                    $mdix = 0;
                    $MD = 0;
                    $MdExTP = 100; // to be set on the class record creation *add tbl on DB and input on form*
                    if($rowMdEx['Expoints'] != ''){
                        $CL->setCellValue('H'.$i, $rowMdEx['Expoints']);
                    }else{
                        $CL->setCellValue('H'.$i, '0');
                    }

                    if($rowMdEx['Expoints'] == 0){
                        $CL->setCellValue('I'.$i, '65%');
                    }else if($rowMdEx['Expoints'] != 0){
                        while($mdix != count($json['TPS'.$MdExTP])){
                            if(is_numeric($json['TPS'.$MdExTP][$mdix]['score'])){
                                if($rowMdEx['Expoints']== $json['TPS'.$MdExTP][$mdix]['score']){
                                    $CL->setCellValue('I'.$i, $json['TPS'.$MdExTP][$mdix]['rating']);
                                    $MD = $json['TPS'.$MdExTP][$mdix]['rating'];
                                }
                                // echo date('H:i:s').'==' , $json['TPS'.$Extotalpoints][$ix]['score'].' is numeric', EOL;
                            }else{
                                $Mdrangeval = explode("-",$json['TPS'.$MdExTP][$mdix]['score']);
                                if(($rowMdEx['Expoints'] >= $Mdrangeval[0]) && ($rowMdEx['Expoints'] <= $Mdrangeval[1])){
                                    $CL->setCellValue('I'.$i, $json['TPS'.$MdExTP][$mdix]['rating']);
                                    $MD = $json['TPS'.$MdExTP][$mdix]['rating'];
                                }
                                // echo date('H:i:s').'==' , $json['TPS'.$Extotalpoints][$ix]['score'].' is string', EOL;
                            }
                            $mdix++;
                        }
                    }
                }

                //midterm average to grade
                $MDavr = (floatval($MD) + floatval($PR)) / 2;
                $Midgx =0;
                if((floatval($MD) == 0) && (floatval($PR) == 0)){
                    $CL->setCellValue('J'.$i, '65%');
                    $CL->setCellValue('K'.$i, '65%');
                    $CL->setCellValue('L'.$i, '65%');
                    $CL->setCellValue('X'.$i, '65%');
                    $MidGrade = '65%';
                    while($Midgx != count($json['GSMD'])){
                        if($MidGrade == $json['GSMD'][$Midgx]['PG']){
                            $CL->setCellValue('M'.$i, $json['GSMD'][$Midgx]['EQ']);
                        }
                        $Midgx++;
                    }
                    // echo date('H:i:s').'==' , floatval($MD).';'.floatval($PR), EOL;
                }else{
                    $CL->setCellValue('J'.$i, $MDavr.'%');
                    $CL->setCellValue('K'.$i, $MDavr * 0.6.'%');
                    $CL->setCellValue('L'.$i, $MD40 + ($MDavr * 0.6).'%');
                    $CL->setCellValue('X'.$i, round(($MD40 + ($MDavr * 0.6)) / 3) .'%');
                    $Xval = round(($MD40 + ($MDavr * 0.6)) / 3);
                    $MidGrade = round($MD40 + ($MDavr * 0.6));
                    while($Midgx != count($json['GSMD'])){
                        if($MidGrade == $json['GSMD'][$Midgx]['PG']){
                            $CL->setCellValue('M'.$i, $json['GSMD'][$Midgx]['EQ']);
                        }
                        $Midgx++;
                    }
                    // echo date('H:i:s').'==' , floatval($MD).';'.floatval($PR), EOL;
                }
                
            }
        }


        /*Semi and Final calculations*/
        //Total Q,A,O
        $SfgetAtt = $GradeCalc->GetQAO('attendance','att',$rows["stud_id"],'Semi','Final',$_POST['dataID']);
        while($rowAtt = $SfgetAtt->fetchArray(SQLITE3_ASSOC)){
            $SfgetQz = $GradeCalc->GetQAO('quizes','quiz',$rows["stud_id"],'Semi','Final',$_POST['dataID']);
            while($rowQz = $SfgetQz->fetchArray(SQLITE3_ASSOC)){
                $SfgetOr = $GradeCalc->GetQAO('orals','oral',$rows["stud_id"],'Semi','Final',$_POST['dataID']);
                while($rowOr = $SfgetOr->fetchArray(SQLITE3_ASSOC)){
                    $totalQAO = $rowAtt['PtSum'] + $rowQz['PtSum'] + $rowOr['PtSum'];
                    //total items Q,A,O
                    // $totalPfpoints = ($rowAtt['PtCount'] * 5) + ($rowQz['PtCount'] * 10) + ($rowOr['PtCount'] * 10);
                    $totalPfpoints = 50; // to be set on the class record creation *add tbl on DB and input on form*
                    if($totalQAO != ''){
                        $CL->setCellValue('N'.$i, $totalQAO);
                    }else{
                        $CL->setCellValue('N'.$i, '0');
                    }
                }

                /*for items 50-110*/
                $index = 0;
                $MD40 = 0;
                if($totalQAO == 0){
                    $CL->setCellValue('O'.$i, '65%');
                    $CL->setCellValue('P'.$i, (floatval('65%') * $midval).'%');
                }else if($totalQAO != 0){
                    while($index != count($json['TPS'.$totalPfpoints])){
                        if(is_numeric($json['TPS'.$totalPfpoints][$index]['score'])){
                            if($totalQAO == $json['TPS'.$totalPfpoints][$index]['score']){
                                $CL->setCellValue('O'.$i, $json['TPS'.$totalPfpoints][$index]['rating']);
                                $CL->setCellValue('P'.$i, (floatval($json['TPS'.$totalPfpoints][$index]['rating']) * $midval).'%');
                                $MD40 = (floatval($json['TPS'.$totalPfpoints][$index]['rating']) * $midval);
                            }
                            // echo date('H:i:s').'==' , $json['TPS'.$totalPfpoints][$index]['score'].' is numeric', EOL;
                        }else{
                            $rangeval = explode("-",$json['TPS'.$totalPfpoints][$index]['score']);
                            if(($totalQAO >= $rangeval[0]) && ($totalQAO <= $rangeval[1])){
                                $CL->setCellValue('O'.$i, $json['TPS'.$totalPfpoints][$index]['rating']);
                                $CL->setCellValue('P'.$i, (floatval($json['TPS'.$totalPfpoints][$index]['rating']) * $midval).'%');
                                $MD40 = (floatval($json['TPS'.$totalPfpoints][$index]['rating']) * $midval);
                            }
                            // echo date('H:i:s').'==' , $json['TPS'.$totalPfpoints][$index]['score'].' is string', EOL;
                        }
                        $index++;
                    }
                }
                
                //Prelim Exam
                $getPExam = $GradeCalc->GetExam($rows["stud_id"],'Semi',$_POST['dataID']);
                while($rowEx = $getPExam->fetchArray(SQLITE3_ASSOC)){
                    //Prelim points
                    $ix = 0;
                    $PR = 0;
                    $Extotalpoints = 50; // to be set on the class record creation *add tbl on DB and input on form*
                    if($rowEx['Expoints'] != ''){
                        $CL->setCellValue('Q'.$i, $rowEx['Expoints']);
                    }else{
                        $CL->setCellValue('Q'.$i, '0');
                    }

                    if($rowEx['Expoints'] == 0){
                        $CL->setCellValue('R'.$i, '65%');
                    }else if($rowEx['Expoints'] != 0){
                        while($ix != count($json['TPS'.$Extotalpoints])){
                            if(is_numeric($json['TPS'.$Extotalpoints][$ix]['score'])){
                                if($rowEx['Expoints']== $json['TPS'.$Extotalpoints][$ix]['score']){
                                    $CL->setCellValue('R'.$i, $json['TPS'.$Extotalpoints][$ix]['rating']);
                                    $PR = $json['TPS'.$Extotalpoints][$ix]['rating'];
                                }
                                // echo date('H:i:s').'==' , $json['TPS'.$Extotalpoints][$ix]['score'].' is numeric', EOL;
                            }else{
                                $Prangeval = explode("-",$json['TPS'.$Extotalpoints][$ix]['score']);
                                if(($rowEx['Expoints'] >= $Prangeval[0]) && ($rowEx['Expoints'] <= $Prangeval[1])){
                                    $CL->setCellValue('R'.$i, $json['TPS'.$Extotalpoints][$ix]['rating']);
                                    $PR = $json['TPS'.$Extotalpoints][$ix]['rating'];
                                }
                                // echo date('H:i:s').'==' , $json['TPS'.$Extotalpoints][$ix]['score'].' is string', EOL;
                            }
                            $ix++;
                        }
                    }
                }

                //Midterm Exam
                $getMdEx = $GradeCalc->GetExam($rows["stud_id"],'Final',$_POST['dataID']);
                while($rowMdEx = $getMdEx->fetchArray(SQLITE3_ASSOC)){
                    $mdix = 0;
                    $MD = 0;
                    $MdExTP = 50; // to be set on the class record creation *add tbl on DB and input on form*
                    if($rowMdEx['Expoints'] != ''){
                        $CL->setCellValue('S'.$i, $rowMdEx['Expoints']);
                    }else{
                        $CL->setCellValue('S'.$i, '0');
                    }

                    if($rowMdEx['Expoints'] == 0){
                        $CL->setCellValue('T'.$i, '65%');
                    }else if($rowMdEx['Expoints'] != 0){
                        while($mdix != count($json['TPS'.$MdExTP])){
                            if(is_numeric($json['TPS'.$MdExTP][$mdix]['score'])){
                                if($rowMdEx['Expoints']== $json['TPS'.$MdExTP][$mdix]['score']){
                                    $CL->setCellValue('T'.$i, $json['TPS'.$MdExTP][$mdix]['rating']);
                                    $MD = $json['TPS'.$MdExTP][$mdix]['rating'];
                                }
                                // echo date('H:i:s').'==' , $json['TPS'.$Extotalpoints][$ix]['score'].' is numeric', EOL;
                            }else{
                                $Mdrangeval = explode("-",$json['TPS'.$MdExTP][$mdix]['score']);
                                if(($rowMdEx['Expoints'] >= $Mdrangeval[0]) && ($rowMdEx['Expoints'] <= $Mdrangeval[1])){
                                    $CL->setCellValue('T'.$i, $json['TPS'.$MdExTP][$mdix]['rating']);
                                    $MD = $json['TPS'.$MdExTP][$mdix]['rating'];
                                }
                                // echo date('H:i:s').'==' , $json['TPS'.$Extotalpoints][$ix]['score'].' is string', EOL;
                            }
                            $mdix++;
                        }
                    }
                }

                //midterm average to grade
                $MDavr = (floatval($MD) + floatval($PR)) / 2;
                $Midgx =0;
                if((floatval($MD) == 0) && (floatval($PR) == 0)){
                    $CL->setCellValue('U'.$i, '65%');
                    $CL->setCellValue('V'.$i, '65%');
                    $CL->setCellValue('W'.$i, '65%');
                    $CL->setCellValue('Y'.$i, '65%');
                    $CL->setCellValue('Z'.$i, '65%');
                    $MidGrade = '65%';
                    while($Midgx != count($json['GSF'])){
                        if($MidGrade == $json['GSF'][$Midgx]['PG']){
                            $CL->setCellValue('AA'.$i, $json['GSF'][$Midgx]['EQ']);
                        }
                        $Midgx++;
                    }
                    // echo date('H:i:s').'==' , floatval($MD).';'.floatval($PR), EOL;
                }else{
                    $CL->setCellValue('U'.$i, $MDavr.'%');
                    $CL->setCellValue('V'.$i, $MDavr * 0.6.'%');
                    $CL->setCellValue('W'.$i, $MD40 + ($MDavr * 0.6).'%');
                    $CL->setCellValue('Y'.$i, round((($MD40 + ($MDavr * 0.6)) / 3) * 2).'%');
                    $CL->setCellValue('Z'.$i, $Xval + round((($MD40 + ($MDavr * 0.6)) / 3) * 2).'%');
                    $MidGrade = $Xval + round((($MD40 + ($MDavr * 0.6)) / 3) * 2);
                    while($Midgx != count($json['GSF'])){
                        if($MidGrade == $json['GSF'][$Midgx]['PG']){
                            $CL->setCellValue('AA'.$i, $json['GSF'][$Midgx]['EQ']);
                        }
                        $Midgx++;
                    }
                    // echo date('H:i:s').'==' , floatval($MD).';'.floatval($PR), EOL;
                }
                
            }
        }
        ++$i;
    }

    // Rename worksheet
    // echo date('H:i:s') , " Rename worksheet" , EOL;
    $objPHPExcel->getActiveSheet()->setTitle($row['Sec_desc']);


    // Set active sheet index to the first sheet, so Excel opens this as the first sheet
    $objPHPExcel->setActiveSheetIndex(0);
    // Freeze third column
    $objPHPExcel->getActiveSheet()->freezePane('C1');
    //Set auto width on column A & B
    foreach(range('A','Z') as $columnID){
        $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
    }
    foreach(range('AA','ZZ') as $columnID){
        $objPHPExcel->getActiveSheet()->getColumnDimension($columnID)->setAutoSize(true);
    }



    // Save Excel 2007 file
    // echo date('H:i:s') , " Write to Excel2007 format" , EOL;
    $callStartTime = microtime(true);

    $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
    // $objWriter->save(str_replace('.php', '.xlsx', __FILE__));
    $objWriter->save('C:/Users/user/Downloads/'.$row['subj_desc'].'('.$row['Sec_desc'].').xlsx');
    $callEndTime = microtime(true);
    $callTime = $callEndTime - $callStartTime;

    // echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
    // echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
    // // Echo memory usage
    // echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;


    // // Echo memory peak usage
    // echo date('H:i:s') , " Peak memory usage: " , (memory_get_peak_usage(true) / 1024 / 1024) , " MB" , EOL;

    // // Echo done
    // echo date('H:i:s') , " Done writing files" , EOL;
    // echo 'Files have been created in ' , getcwd() , EOL;


    echo "1";
}

?>