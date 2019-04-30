<?php
$str = file_get_contents('TrTable.json');
$json = json_decode($str, true);

$fail = array(mt_rand(3, 5),mt_rand(0, 5),mt_rand(0, 5),mt_rand(0, 20),mt_rand(0, 30));
$Tardy_Grade;
$Xval = 0;
$PMGrade;

$PrgetAtt = $GradeCalc->GetQAO('attendance','att',$studID,'Prelim','Midterm',$Clr);
while($rowAtt = $PrgetAtt->fetchArray(SQLITE3_ASSOC)){
    $PrgetQz = $GradeCalc->GetQAO('quizes','quiz',$studID,'Prelim','Midterm',$Clr);
    while($rowQz = $PrgetQz->fetchArray(SQLITE3_ASSOC)){
        $PrgetOr = $GradeCalc->GetQAO('orals','oral',$studID,'Prelim','Midterm',$Clr);
        while($rowOr = $PrgetOr->fetchArray(SQLITE3_ASSOC)){
            $totalQAO = $rowAtt['PtSum'] + $rowQz['PtSum'] + $rowOr['PtSum'];
            $totalPfpoints = 80;

            $index = 0;
            $midval = 0.4;
            
        }


        $index = 0;
        $MD40 = 0;
        if($totalQAO == 0){
            $midTGrade =  $MD40 = (65 * $midval);
        }else{
            while($index != count($json['TPS'.$totalPfpoints])){
                if(is_numeric($json['TPS'.$totalPfpoints][$index]['score'])){
                    if($totalQAO == $json['TPS'.$totalPfpoints][$index]['score']){
                        $MD40 = $json['TPS'.$totalPfpoints][$index]['rating'];
                        $MD40 = (floatval($json['TPS'.$totalPfpoints][$index]['rating']) * $midval);
                    }
                }else{
                    $rangeval = explode("-",$json['TPS'.$totalPfpoints][$index]['score']);
                    if(($totalQAO >= $rangeval[0]) && ($totalQAO <= $rangeval[1])){
                        $MD40 = $json['TPS'.$totalPfpoints][$index]['rating'];
                        $MD40 = (floatval($json['TPS'.$totalPfpoints][$index]['rating']) * $midval);
                    }
                }
            $index++;
            }
        }

        //Prelim Exam
        $getPExam = $GradeCalc->GetExam($studID,'Prelim',$Clr);
        while($rowEx = $getPExam->fetchArray(SQLITE3_ASSOC)){
            $ix = 0;
            $PR = 0;
            $Extotalpoints = 50;
            if($rowEx['Expoints'] == 0){
                $PR = 65;
            }else if($rowEx['Expoints'] != 0){
                while($ix != count($json['TPS'.$Extotalpoints])){
                    if(is_numeric($json['TPS'.$Extotalpoints][$ix]['score'])){
                        if($rowEx['Expoints'] == $json['TPS'.$Extotalpoints][$ix]['score']){
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

        $getMdEx = $GradeCalc->GetExam($studID,'Midterm',$Clr);
        while($rowMdEx = $getMdEx->fetchArray(SQLITE3_ASSOC)){
            $mdix = 0;
            $MD = 0;
            $MdExTP = 100; 
            
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
        }//$rowMdEx

        //midterm average to grade
        $MDavr = (floatval($MD) + floatval($PR)) / 2;
        $Midgx =0;
        if((floatval($MD) == 0) && (floatval($PR) == 0)){
            $MidGrade = '65%';
            while($Midgx != count($json['GSMD'])){
                if($MidGrade == $json['GSMD'][$Midgx]['PG']){
                    $json['GSMD'][$Midgx]['EQ'];
                }
                $Midgx++;
            }
            // echo date('H:i:s').'==' , floatval($MD).';'.floatval($PR), EOL;
        }else{
            $Xval = round(($MD40 + ($MDavr * 0.6)) / 3);
            $MidGrade = round($MD40 + ($MDavr * 0.6));
            while($Midgx != count($json['GSMD'])){
                if($MidGrade == $json['GSMD'][$Midgx]['PG']){
                    $PMGrade = $json['GSMD'][$Midgx]['EQ'];
                }
                $Midgx++;
            }
            // echo date('H:i:s').'==' , floatval($MD).';'.floatval($PR), EOL;
        }

    }//$rowQz
}//$rowAtt

//FAILING PF
//Semi and Finals
$totalPfpoints = 50;
$SF40 = 0;
$PrQAO = $fail[0] + $fail[1] + $fail[2];
//Semi Final QAO
$index = 0;
while($index != count($json['TPS'.$totalPfpoints])){
    if(is_numeric($json['TPS'.$totalPfpoints][$index]['score'])){
        if($PrQAO == $json['TPS'.$totalPfpoints][$index]['score']){
            $SF40 = (floatval($json['TPS'.$totalPfpoints][$index]['rating']) * $midval);
        }
    }else{
        $rangeval = explode("-",$json['TPS'.$totalPfpoints][$index]['score']);
        if(($PrQAO >= $rangeval[0]) && ($PrQAO <= $rangeval[1])){
            $SF40 = (floatval($json['TPS'.$totalPfpoints][$index]['rating']) * $midval);
        }
    }
    $index++;
}

//Semi Exam
$ix = 0;
$SmEx = 0;
$SmExTP = 50;
while($ix != count($json['TPS'.$SmExTP])){
    if(is_numeric($json['TPS'.$SmExTP][$ix]['score'])){
        if($fail[3] == $json['TPS'.$SmExTP][$ix]['score']){
            $SmEx = $json['TPS'.$SmExTP][$ix]['rating'];
        }
    }else{
        $Prangeval = explode("-",$json['TPS'.$SmExTP][$ix]['score']);
        if(($fail[3] >= $Prangeval[0]) && ($fail[3] <= $Prangeval[1])){
            $SmEx = $json['TPS'.$SmExTP][$ix]['rating'];
        }
    }
    $ix++;
}

$Fnix = 0;
$FnEx = 0;
$FnExTP = 50;
while($Fnix != count($json['TPS'.$FnExTP])){
    if(is_numeric($json['TPS'.$FnExTP][$Fnix]['score'])){
        if($fail[4] == $json['TPS'.$FnExTP][$Fnix]['score']){
            $FnEx = $json['TPS'.$FnExTP][$Fnix]['rating'];
        }
    }else{
        $Mdrangeval = explode("-",$json['TPS'.$FnExTP][$Fnix]['score']);
        if(($fail[4] >= $Mdrangeval[0]) && ($fail[4] <= $Mdrangeval[1])){
            $FnEx = $json['TPS'.$FnExTP][$Fnix]['rating'];
        }
    }
    $Fnix++;
}

//final average to grade
$SFavr = (floatval($FnEx) + floatval($SmEx)) / 2;
$FnGr =0;
$FnPG = $Xval + round((($SF40 + ($SFavr * 0.6)) / 3) * 2);
while($FnGr != count($json['GSF'])){
    if($FnPG == $json['GSF'][$FnGr]['PG']){
        $Tardy_Grade = $json['GSF'][$FnGr]['EQ'];
    }
    $FnGr++;
}
?>