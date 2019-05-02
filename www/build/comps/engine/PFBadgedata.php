<?php
include_once "../engine/loader.php";

$Tardy_Pf=0;
$Mediocre_Pf=0;
$Excellent_Pf=0;

$str = file_get_contents('TrTable.json');
$json = json_decode($str, true);

$getStud = $Students->GetStud();
while($row = $getStud->fetchArray(SQLITE3_ASSOC)){
    $sClass = explode(",",$row['stud_classes']);

    foreach($sClass as $clr){
        $getStudSubj = $classR->GetDataClr();
        $rowSubj = $getStudSubj->fetchArray(SQLITE3_ASSOC);

        $PrgetAtt = $GradeCalc->GetQAO('attendance','att',$row['stud_id'],'Prelim','Midterm',$clr);
        while($rowAtt = $PrgetAtt->fetchArray(SQLITE3_ASSOC)){
            $PrgetQz = $GradeCalc->GetQAO('quizes','quiz',$row['stud_id'],'Prelim','Midterm',$clr);
            while($rowQz = $PrgetQz->fetchArray(SQLITE3_ASSOC)){
                $PrgetOr = $GradeCalc->GetQAO('orals','oral',$row['stud_id'],'Prelim','Midterm',$clr);
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
                $getPExam = $GradeCalc->GetExam($row['stud_id'],'Prelim',$clr);
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
                            }else{
                                $Prangeval = explode("-",$json['TPS'.$Extotalpoints][$ix]['score']);
                                if(($rowEx['Expoints'] >= $Prangeval[0]) && ($rowEx['Expoints'] <= $Prangeval[1])){
                                    $PR = $json['TPS'.$Extotalpoints][$ix]['rating'];
                                }
                            }
                            $ix++;
                        }
                    }
                }

                $getMdEx = $GradeCalc->GetExam($row['stud_id'],'Midterm',$clr);
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
                            }else{
                                $Mdrangeval = explode("-",$json['TPS'.$MdExTP][$mdix]['score']);
                                if(($rowMdEx['Expoints'] >= $Mdrangeval[0]) && ($rowMdEx['Expoints'] <= $Mdrangeval[1])){
                                    $MD = $json['TPS'.$MdExTP][$mdix]['rating'];
                                }
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
                }else{
                    $Xval = round(($MD40 + ($MDavr * 0.6)) / 3);
                    $MidGrade = round($MD40 + ($MDavr * 0.6));
                    while($Midgx != count($json['GSMD'])){
                        if($MidGrade == $json['GSMD'][$Midgx]['PG']){
                            $PMGrade = $json['GSMD'][$Midgx]['EQ'];
                            if($PMGrade == 4.0){
                                $Tardy_Pf++;
                            }else if($PMGrade == 3.0){
                                $Mediocre_Pf++;
                            }else if($PMGrade >= 1.0){
                                $Excellent_Pf++;
                            }
                        }
                        $Midgx++;
                    }
                }

            }//$rowQz
        }//$rowAtt
    }
}
?>
<div class="col-md-4 col-sm-6">
    <div class="widget widget-stats bg-red">
        <div class="stats-icon"><i class="fa fa-thumbs-down"></i></div>
        <div class="stats-info">
            <h4>TARDY STUDENTS</h4>
            <p><?php echo $Tardy_Pf; ?></p>	
        </div>
        <!-- <div class="stats-link">
            <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
        </div> -->
    </div>
</div>
<!-- end col-3 -->
<!-- begin col-3 -->
<div class="col-md-4 col-sm-6">
    <div class="widget widget-stats bg-orange">
        <div class="stats-icon"><i class="fa fa-warning"></i></div>
        <div class="stats-info">
            <h4>MEDIOCRE STUDENTS</h4>
            <p><?php echo $Mediocre_Pf; ?></p>	
        </div>
        <!-- <div class="stats-link">
            <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
        </div> -->
    </div>
</div>
<!-- end col-3 -->
<!-- begin col-3 -->
<div class="col-md-4 col-sm-6">
    <div class="widget widget-stats bg-green">
        <div class="stats-icon"><i class="fa fa-thumbs-up"></i></div>
        <div class="stats-info">
            <h4>DILIGENT STUDENTS</h4>
            <p><?php echo $Excellent_Pf; ?></p>	
        </div>
        <!-- <div class="stats-link">
            <a href="javascript:;">View Detail <i class="fa fa-arrow-circle-o-right"></i></a>
        </div> -->
    </div>
</div>