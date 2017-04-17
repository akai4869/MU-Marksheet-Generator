<?php
$name=$exam=$seat_no=$reg_no="";
$gradesE=$gradesI=array();
if ($_SERVER['REQUEST_METHOD']=="POST") {
	$name=$_POST['name'];
	$exam=$_POST['exam'];
	$seat_no=$_POST['sno'];
	$reg_no=$_POST['regno'];
	$gradesE=$_POST['gradeListE'];    //array of external exam grades
	$gradesI=$_POST['gradeListI'];    //array of internal exam grades
}

function gradeValue($grade){
	switch($grade){
		case "O":return 1;
		case "A":return 2;
		case "B":return 3;
		case "C":return 4;
		case "D":return 5;
		case "E":return 6;
		case "F":return -1;
		default: return 0;
	}
}

function valueGrade($value){
	switch($value){
		case 1:return "O";
		case 2:return "A";
		case 3:return "B";
		case 4:return "C";
		case 5:return "D";
		case 6:return "E";
		default: return "--";
	}

}



$gradeListE=array();         //grade list for external exam having 3 columns -ESE,PR/OR,AVG
$gradeListI=array();         //grade list for internal exam having 3 columns -IA,TW,AVG

$lenE=count($gradesE);
$lenI=count($gradesI);
$h=0;
$k=0;
$sum=0;
$pass=true;
$result=1;
for($i=1; $i<=$lenE; ++$i){                                      //creating gradeListE

	$gradeListE[$h][$k++] = $gradesE[$i-1];
	$temp=gradeValue($gradesE[$i-1]);
	if($temp == -1){
		$pass=false;
		$result=0;
	}
	$sum+=$temp;
	if($i%2==0){
		if($pass){
			$gradeListE[$h][$k]=valueGrade(ceil($sum/2));
		}
		else
			$gradeListE[$h][$k]="-";
		++$h;
		$k=0;
		$sum=0;
		$pass=true;
	}
}

$h=0;

for($i=1; $i<=$lenI; ++$i){                                    //creating gradeListI

	$gradeListI[$h][$k++] = $gradesI[$i-1];
	$temp=gradeValue($gradesI[$i-1]);
	if($temp == -1){
		$pass=false;
		$result=0;
	}
	$sum+=$temp;
	if($i%2==0){
		if($pass){
			$gradeListI[$h][$k]=valueGrade(ceil($sum/2));
		}
		else
			$gradeListI[$h][$k]="-";
		++$h;
		$k=0;
		$sum=0;
		$pass=true;
	}
}

$finalGradeList=array();

for($h=0; $h<6; ++$h){                                    //merging gradeListE and gradeListI into finalGradeList
	for($k=0; $k<3; ++$k){
		$finalGradeList[$h][$k]=$gradeListE[$h][$k];
		$finalGradeList[$h][$k+3]=$gradeListI[$h][$k];
	}
}

require_once('../mysqli_connect.php');



$query= "INSERT INTO student_info (student_name,exam,seat_no,reg_no,result) values(
				'$name','$exam','$seat_no','$reg_no',$result);";

if(!@mysqli_query($dbc,$query)){
	echo mysqli_error($dbc)."<br>";
	exit("Sorry, something went wrong!");
}

$courseCode=$subjectList=$creditE=$creditI="";

switch($exam){
	case 'sem1':
	$courseCode=array("FEC101","FEC102","FEC103","FEC104","FEC105","FEL101");
	$subjectList=array("APPLIED MATHEMATICS-I",
	"APPLIED PHYSICS-I",
	"APPLIED CHEMISTRY-I",
	"ENGINEERING MECHANICS",
	"BASIC ELECTRONICS & ELECTRICAL ENGG",
	"BASIC WORKSHOP & PRACTICE-I");
	$creditE=array(4.0,4.0,4.0,4.0,3.0,3.0);
	$creditI=array(1.0,1.0,1.0,1.0,1.0,1.0);
	break;
	case 'sem2':
	$courseCode=array("FEC201","FEC202","FEC203","FEC204","FEC205","FEL201");
	$subjectList=array("APPLIED MATHEMATICS-II",
	"APPLIED PHYSICS-II",
	"APPLIED CHEMISTRY-II",
	"ENGINEERING DRAWING",
	"COMMUNICATION SKILLS",
	"BASIC WORKSHOP & PRACTICE-II");
	$creditE=array(4.0,4.0,4.0,4.0,3.0,3.0);
	$creditI=array(1.0,1.0,1.0,1.0,1.0,1.0);
	break;
}

$query="";

for($h=0; $h<6; ++$h){
	$query.= "INSERT INTO $exam (seat_no,code,subject,creditE,creditI,ese,ia,avgE,pr,tw,avgI) values(
						'$seat_no','$courseCode[$h]','$subjectList[$h]',$creditE[$h],$creditI[$h],";
	for($k=0; $k<6; ++$k){
		if($k<5)
			$query.="'".$finalGradeList[$h][$k]."'".",";
		else
			$query.="'".$finalGradeList[$h][$k]."'".");";
	}
}

if (!@mysqli_multi_query($dbc, $query)){
	echo mysqli_error($dbc)."<br>";
	exit("Sorry, something went wrong!");
}


@mysqli_close($dbc);

header("Location:get_marksheet.html");
exit;

?>
