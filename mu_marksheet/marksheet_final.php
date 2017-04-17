<?php

require_once("../mysqli_connect.php");

$student_info=array("student_name"=>"","exam"=>"","seat_no"=>"","reg_no"=>"","result"=>"");

$query = "SELECT * FROM student_info WHERE seat_no='".$_POST['seat_no']."';";

$response = @mysqli_query($dbc,$query);


if(!$response){
  echo mysqli_error($dbc)."<br>";
  exit("Sorry, something went wrong!");
}
else{
  if (mysqli_num_rows($response) > 0) {
    $row = @mysqli_fetch_assoc($response);
    $student_info['student_name']=$row['student_name'];
    $student_info['exam']=$row['exam'];
    $student_info['seat_no']=$row['seat_no'];
    $student_info['reg_no']=$row['reg_no'];
    $student_info['result']=$row['result'];

  }
  else{
    echo "Sorry! Your result hasn't been uploaded yet. Try again after some time!";
    exit;
  }
}

$grade_info = array();
$gi=0;
$semester=$student_info['exam'];

$query = "SELECT * FROM $semester WHERE seat_no='".$_POST['seat_no']."';";

$response = @mysqli_query($dbc,$query);

if(!$response){
  echo mysqli_error($dbc)."<br>";
  exit("Sorry, something went wrong!");
}
else{
  while($row = @mysqli_fetch_assoc($response)){
    $grade_info[$gi]['code']=$row['code'];
    $grade_info[$gi]['subject']=$row['subject'];
    $grade_info[$gi]['creditE']=$row['creditE'];
    $grade_info[$gi]['creditI']=$row['creditI'];
    $grade_info[$gi]['ese']=$row['ese'];
    $grade_info[$gi]['ia']=$row['ia'];
    $grade_info[$gi]['avgE']=$row['avgE'];
    $grade_info[$gi]['pr']=$row['pr'];
    $grade_info[$gi]['tw']=$row['tw'];
    $grade_info[$gi]['avgI']=$row['avgI'];
    ++$gi;
  }

}

function gradeValue($grade){
  switch($grade){
    case "O":return 10;
    case "A":return 9;
    case "B":return 8;
    case "C":return 7;
    case "D":return 6;
    case "E":return 5;
    default:return 0;
  }


}

$gi=0;

?>

<!DOCTYPE html>
<html>
<head>
  <title>Marksheet</title>
</head>
<style>
#t01{
width:80%;
border:1px solid red;
border-bottom-style: none;
background: linear-gradient(to right,#b3d9ff,#ffad99,#ccffb3);
}
#t02{
width: 80%;
border-collapse: collapse;
background: linear-gradient(to right,#b3d9ff,#ffad99,#ccffb3);
}
#t03{
width: 80%;
border: 1px solid red;
border-top-style: none;
background: linear-gradient(to right,#b3d9ff,#ffad99,#ccffb3);
}
.c01,.c03{
border: 1px solid red;
}
.c02{
border: 1px solid red;
border-bottom-style: none;
border-top-style: none;
}
</style>
<body>
<center>
<table id="t01">
  <tr>
	<td  rowspan="2" width="15%">
		<img src="mu_logo.png" width="65%" height="20%">
	</td>
	<td style="color:red;padding-left:220px;font-family:Old English Text Mt;" colspan="5"><font size="6">University of Mumbai</font></td>
  </tr>
  <tr>
	<td align="right" colspan="5">CCF:00688: 0205</td>
  </tr>
  <tr>
	<td align="center" style="color:red;padding-bottom:30px;" colspan="6"><strong><font size="5">GRADE CARD</font></strong></td>
  </tr>
  <tr>
	<td style="color:red;padding-left:50px;padding-bottom:20px;">NAME</td>
	<td style="color:red;padding-bottom:20px;" align="center">:</td>
	<td style="padding-left:70px;padding-bottom:20px;" colspan="4"><?php echo $student_info['student_name']; ?></td>
  </tr>
  <tr>
	<td style="color:red;padding-left:50px;padding-bottom:20px;" >EXAMINATION</td>
	<td style="color:red;padding-bottom:20px;" align="center">:</td>
	<td style="padding-left:70px;padding-bottom:20px;" colspan="4">
  <?php
  switch($student_info['exam']){
    case 'sem1':
    echo "FIRST YEAR ENGINEERING SEMESTER I(CBGS)";
    break;
    case 'sem2':
    echo "FIRST YEAR ENGINEERING SEMESTER II(CBGS)";
    break;
  }
  ?>
  </td>
  </tr>
  <tr>
	<td style="color:red;padding-left:50px;padding-bottom:20px;">SEAT NUMBER</td>
	<td style="color:red;padding-bottom:20px;" align="center">:</td>
	<td style="padding-left:70px;padding-bottom:20px;"><?php echo $student_info['seat_no']; ?></td>
	<td style="color:red;padding-bottom:20px;" align="right">REGISTRATION NO</td>
	<td style="color:red;padding-bottom:20px;" align="center">:</td>
	<td style="padding-left:50px;padding-bottom:20px;"><?php echo $student_info['reg_no']; ?></td>
  </tr>
  </table>
  <table id="t02">
	<tr>
	<td class="c01" style="color:red" align="center" rowspan="2"><strong>COURSE<br>CODE</strong></td>
	<td class="c01" style="color:red" align="center" rowspan="2"><strong>COURSE TITLE</strong></td>
	<td class="c01" style="color:red" align="center" rowspan="2"><strong>COURSE<br>CREDITS</strong></td>
	<td class="c01" style="color:red" align="center" colspan="3"><strong>GRADE</strong></td>
	<td class="c01" style="color:red" align="center" rowspan="2"><strong>CREDIT<br>EARNED<br>(C)</strong></td>
	<td class="c01" style="color:red" align="center" rowspan="2"><strong>GRADE<br>POINTS<br>(G)</strong></td>
	<td class="c01" style="color:red" align="center" rowspan="2"><strong>C X G</strong></td>
	</tr>
	<tr>
	<td class="c01" style="color:red" align="center"><strong>ESE/PR/<br>OR</strong></td>
	<td class="c01" style="color:red" align="center"><strong>IA/TW</strong></td>
	<td class="c01" style="color:red" align="center"><strong>OVERALL</strong></td>
	</tr>
	<tr>
	<td class="c02" rowspan="2"><?php echo $grade_info[$gi]['code']; ?></td>
	<td class="c02" rowspan="2"><?php echo $grade_info[$gi]['subject']; ?></td>
	<td class="c02" align="center"><?php echo $grade_info[$gi]['creditE']; $sumGP=0; $sumGP+=$grade_info[$gi]['creditE']; ?></td>
	<td class="c02" align="center"><?php echo $grade_info[$gi]['ese']; ?></td>
	<td class="c02" align="center"><?php echo $grade_info[$gi]['ia']; ?></td>
	<td class="c02" align="center"><?php echo $grade_info[$gi]['avgE']; ?></td>
	<td class="c02" align="center">
  <?php
  $gradePoint=gradeValue($grade_info[$gi]['avgE']);
  $sumGPE=0;
  if($gradePoint){
    $GP=$grade_info[$gi]['creditE'];
    echo $GP;
    $sumGPE+=$GP;
  }
  else
    echo "-";
  ?>
  </td>
	<td class="c02" align="center">
  <?php
  if($gradePoint)
    echo $gradePoint;
  else
    echo "-";
  ?>
  </td>
	<td class="c02" align="center">
  <?php
  $sumCXG=0;
  if($gradePoint){
    $mul=$grade_info[$gi]['creditE']*$gradePoint;
    echo $mul;
    $sumCXG+=$mul;
  }
  else
    echo "-";
  ?>
  </td>
	</tr>
	<tr>
    <td class="c02" align="center"><?php echo $grade_info[$gi]['creditI']; $sumGP+=$grade_info[$gi]['creditI']; ?></td>
  	<td class="c02" align="center"><?php echo $grade_info[$gi]['pr']; ?></td>
  	<td class="c02" align="center"><?php echo $grade_info[$gi]['tw']; ?></td>
  	<td class="c02" align="center"><?php echo $grade_info[$gi]['avgI']; ?></td>
  	<td class="c02" align="center">
    <?php
    $gradePoint=gradeValue($grade_info[$gi]['avgI']);
    if($gradePoint){
      $GP=$grade_info[$gi]['creditI'];
      echo $GP;
      $sumGPE+=$GP;
    }
    else
      echo "-";
    ?>
    </td>
  	<td class="c02" align="center">
    <?php
    if($gradePoint)
      echo $gradePoint;
    else
      echo "-";
    ?>
    </td>
  	<td class="c02" align="center">
    <?php
    if($gradePoint){
      $mul=$grade_info[$gi]['creditI']*$gradePoint;
      echo $mul;
      $sumCXG+=$mul;
    }
    else
      echo "-";
    ++$gi;
    ?>
    </td>
	</tr>

	<tr>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	</tr>



  <tr>
	<td class="c02" rowspan="2"><?php echo $grade_info[$gi]['code']; ?></td>
	<td class="c02" rowspan="2"><?php echo $grade_info[$gi]['subject']; ?></td>
	<td class="c02" align="center"><?php echo $grade_info[$gi]['creditE']; $sumGP+=$grade_info[$gi]['creditE']; ?></td>
	<td class="c02" align="center"><?php echo $grade_info[$gi]['ese']; ?></td>
	<td class="c02" align="center"><?php echo $grade_info[$gi]['ia']; ?></td>
	<td class="c02" align="center"><?php echo $grade_info[$gi]['avgE']; ?></td>
	<td class="c02" align="center">
  <?php
  $gradePoint=gradeValue($grade_info[$gi]['avgE']);
  if($gradePoint){
    $GP=$grade_info[$gi]['creditE'];
    echo $GP;
    $sumGPE+=$GP;
  }
  else
    echo "-";
  ?>
  </td>
	<td class="c02" align="center">
  <?php
  if($gradePoint)
    echo $gradePoint;
  else
    echo "-";
  ?>
  </td>
	<td class="c02" align="center">
  <?php

  if($gradePoint){
    $mul=$grade_info[$gi]['creditE']*$gradePoint;
    echo $mul;
    $sumCXG+=$mul;
  }
  else
    echo "-";
  ?>
  </td>
	</tr>
	<tr>
    <td class="c02" align="center"><?php echo $grade_info[$gi]['creditI']; $sumGP+=$grade_info[$gi]['creditI']; ?></td>
  	<td class="c02" align="center"><?php echo $grade_info[$gi]['pr']; ?></td>
  	<td class="c02" align="center"><?php echo $grade_info[$gi]['tw']; ?></td>
  	<td class="c02" align="center"><?php echo $grade_info[$gi]['avgI']; ?></td>
  	<td class="c02" align="center">
    <?php
    $gradePoint=gradeValue($grade_info[$gi]['avgI']);
    if($gradePoint){
      $GP=$grade_info[$gi]['creditI'];
      echo $GP;
      $sumGPE+=$GP;
    }
    else
      echo "-";
    ?>
    </td>
  	<td class="c02" align="center">
    <?php
    if($gradePoint)
      echo $gradePoint;
    else
      echo "-";
    ?>
    </td>
  	<td class="c02" align="center">
    <?php
    if($gradePoint){
      $mul=$grade_info[$gi]['creditI']*$gradePoint;
      echo $mul;
      $sumCXG+=$mul;
    }
    else
      echo "-";
    ++$gi;
    ?>
    </td>
	</tr>

	<tr>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	</tr>

  <tr>
  <td class="c02" rowspan="2"><?php echo $grade_info[$gi]['code']; ?></td>
  <td class="c02" rowspan="2"><?php echo $grade_info[$gi]['subject']; ?></td>
  <td class="c02" align="center"><?php echo $grade_info[$gi]['creditE']; $sumGP+=$grade_info[$gi]['creditE']; ?></td>
  <td class="c02" align="center"><?php echo $grade_info[$gi]['ese']; ?></td>
  <td class="c02" align="center"><?php echo $grade_info[$gi]['ia']; ?></td>
  <td class="c02" align="center"><?php echo $grade_info[$gi]['avgE']; ?></td>
  <td class="c02" align="center">
  <?php
  $gradePoint=gradeValue($grade_info[$gi]['avgE']);
  if($gradePoint){
    $GP=$grade_info[$gi]['creditE'];
    echo $GP;
    $sumGPE+=$GP;
  }
  else
    echo "-";
  ?>
  </td>
  <td class="c02" align="center">
  <?php
  if($gradePoint)
    echo $gradePoint;
  else
    echo "-";
  ?>
  </td>
  <td class="c02" align="center">
  <?php

  if($gradePoint){
    $mul=$grade_info[$gi]['creditE']*$gradePoint;
    echo $mul;
    $sumCXG+=$mul;
  }
  else
    echo "-";
  ?>
  </td>
  </tr>
  <tr>
    <td class="c02" align="center"><?php echo $grade_info[$gi]['creditI']; $sumGP+=$grade_info[$gi]['creditI']; ?></td>
    <td class="c02" align="center"><?php echo $grade_info[$gi]['pr']; ?></td>
    <td class="c02" align="center"><?php echo $grade_info[$gi]['tw']; ?></td>
    <td class="c02" align="center"><?php echo $grade_info[$gi]['avgI']; ?></td>
    <td class="c02" align="center">
    <?php
    $gradePoint=gradeValue($grade_info[$gi]['avgI']);
    if($gradePoint){
      $GP=$grade_info[$gi]['creditI'];
      echo $GP;
      $sumGPE+=$GP;
    }
    else
      echo "-";
    ?>
    </td>
    <td class="c02" align="center">
    <?php
    if($gradePoint)
      echo $gradePoint;
    else
      echo "-";
    ?>
    </td>
    <td class="c02" align="center">
    <?php
    if($gradePoint){
      $mul=$grade_info[$gi]['creditI']*$gradePoint;
      echo $mul;
      $sumCXG+=$mul;
    }
    else
      echo "-";
    ++$gi;
    ?>
    </td>
  </tr>

  <tr>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  </tr>

  <tr>
  <td class="c02" rowspan="2"><?php echo $grade_info[$gi]['code']; ?></td>
  <td class="c02" rowspan="2"><?php echo $grade_info[$gi]['subject']; ?></td>
  <td class="c02" align="center"><?php echo $grade_info[$gi]['creditE']; $sumGP+=$grade_info[$gi]['creditE']; ?></td>
  <td class="c02" align="center"><?php echo $grade_info[$gi]['ese']; ?></td>
  <td class="c02" align="center"><?php echo $grade_info[$gi]['ia']; ?></td>
  <td class="c02" align="center"><?php echo $grade_info[$gi]['avgE']; ?></td>
  <td class="c02" align="center">
  <?php
  $gradePoint=gradeValue($grade_info[$gi]['avgE']);
  if($gradePoint){
    $GP=$grade_info[$gi]['creditE'];
    echo $GP;
    $sumGPE+=$GP;
  }
  else
    echo "-";
  ?>
  </td>
  <td class="c02" align="center">
  <?php
  if($gradePoint)
    echo $gradePoint;
  else
    echo "-";
  ?>
  </td>
  <td class="c02" align="center">
  <?php

  if($gradePoint){
    $mul=$grade_info[$gi]['creditE']*$gradePoint;
    echo $mul;
    $sumCXG+=$mul;
  }
  else
    echo "-";
  ?>
  </td>
  </tr>
  <tr>
    <td class="c02" align="center"><?php echo $grade_info[$gi]['creditI']; $sumGP+=$grade_info[$gi]['creditI']; ?></td>
    <td class="c02" align="center"><?php echo $grade_info[$gi]['pr']; ?></td>
    <td class="c02" align="center"><?php echo $grade_info[$gi]['tw']; ?></td>
    <td class="c02" align="center"><?php echo $grade_info[$gi]['avgI']; ?></td>
    <td class="c02" align="center">
    <?php
    $gradePoint=gradeValue($grade_info[$gi]['avgI']);
    if($gradePoint){
      $GP=$grade_info[$gi]['creditI'];
      echo $GP;
      $sumGPE+=$GP;
    }
    else
      echo "-";
    ?>
    </td>
    <td class="c02" align="center">
    <?php
    if($gradePoint)
      echo $gradePoint;
    else
      echo "-";
    ?>
    </td>
    <td class="c02" align="center">
    <?php
    if($gradePoint){
      $mul=$grade_info[$gi]['creditI']*$gradePoint;
      echo $mul;
      $sumCXG+=$mul;
    }
    else
      echo "-";
    ++$gi;
    ?>
    </td>
  </tr>

  <tr>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  </tr>

  <tr>
  <td class="c02" rowspan="2"><?php echo $grade_info[$gi]['code']; ?></td>
  <td class="c02" rowspan="2"><?php echo $grade_info[$gi]['subject']; ?></td>
  <td class="c02" align="center"><?php echo $grade_info[$gi]['creditE']; $sumGP+=$grade_info[$gi]['creditE']; ?></td>
  <td class="c02" align="center"><?php echo $grade_info[$gi]['ese']; ?></td>
  <td class="c02" align="center"><?php echo $grade_info[$gi]['ia']; ?></td>
  <td class="c02" align="center"><?php echo $grade_info[$gi]['avgE']; ?></td>
  <td class="c02" align="center">
  <?php
  $gradePoint=gradeValue($grade_info[$gi]['avgE']);
  if($gradePoint){
    $GP=$grade_info[$gi]['creditE'];
    echo $GP;
    $sumGPE+=$GP;
  }
  else
    echo "-";
  ?>
  </td>
  <td class="c02" align="center">
  <?php
  if($gradePoint)
    echo $gradePoint;
  else
    echo "-";
  ?>
  </td>
  <td class="c02" align="center">
  <?php

  if($gradePoint){
    $mul=$grade_info[$gi]['creditE']*$gradePoint;
    echo $mul;
    $sumCXG+=$mul;
  }
  else
    echo "-";
  ?>
  </td>
  </tr>
  <tr>
    <td class="c02" align="center"><?php echo $grade_info[$gi]['creditI']; $sumGP+=$grade_info[$gi]['creditI']; ?></td>
    <td class="c02" align="center"><?php echo $grade_info[$gi]['pr']; ?></td>
    <td class="c02" align="center"><?php echo $grade_info[$gi]['tw']; ?></td>
    <td class="c02" align="center"><?php echo $grade_info[$gi]['avgI']; ?></td>
    <td class="c02" align="center">
    <?php
    $gradePoint=gradeValue($grade_info[$gi]['avgI']);
    if($gradePoint){
      $GP=$grade_info[$gi]['creditI'];
      echo $GP;
      $sumGPE+=$GP;
    }
    else
      echo "-";
    ?>
    </td>
    <td class="c02" align="center">
    <?php
    if($gradePoint)
      echo $gradePoint;
    else
      echo "-";
    ?>
    </td>
    <td class="c02" align="center">
    <?php
    if($gradePoint){
      $mul=$grade_info[$gi]['creditI']*$gradePoint;
      echo $mul;
      $sumCXG+=$mul;
    }
    else
      echo "-";
    ++$gi;
    ?>
    </td>
  </tr>

  <tr>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  </tr>


  <tr>
  <td class="c02" rowspan="2"><?php echo $grade_info[$gi]['code']; ?></td>
  <td class="c02" rowspan="2"><?php echo $grade_info[$gi]['subject']; ?></td>
  <td class="c02" align="center"><?php echo $grade_info[$gi]['creditE']; $sumGP+=$grade_info[$gi]['creditE']; ?></td>
  <td class="c02" align="center"><?php echo $grade_info[$gi]['ese']; ?></td>
  <td class="c02" align="center"><?php echo $grade_info[$gi]['ia']; ?></td>
  <td class="c02" align="center"><?php echo $grade_info[$gi]['avgE']; ?></td>
  <td class="c02" align="center">
  <?php
  $gradePoint=gradeValue($grade_info[$gi]['avgE']);
  if($gradePoint){
    $GP=$grade_info[$gi]['creditE'];
    echo $GP;
    $sumGPE+=$GP;
  }
  else
    echo "-";
  ?>
  </td>
  <td class="c02" align="center">
  <?php
  if($gradePoint)
    echo $gradePoint;
  else
    echo "-";
  ?>
  </td>
  <td class="c02" align="center">
  <?php

  if($gradePoint){
    $mul=$grade_info[$gi]['creditE']*$gradePoint;
    echo $mul;
    $sumCXG+=$mul;
  }
  else
    echo "-";
  ?>
  </td>
  </tr>
  <tr>
    <td class="c02" align="center"><?php echo $grade_info[$gi]['creditI']; $sumGP+=$grade_info[$gi]['creditI']; ?></td>
    <td class="c02" align="center"><?php echo $grade_info[$gi]['pr']; ?></td>
    <td class="c02" align="center"><?php echo $grade_info[$gi]['tw']; ?></td>
    <td class="c02" align="center"><?php echo $grade_info[$gi]['avgI']; ?></td>
    <td class="c02" align="center">
    <?php
    $gradePoint=gradeValue($grade_info[$gi]['avgI']);
    if($gradePoint){
      $GP=$grade_info[$gi]['creditI'];
      echo $GP;
      $sumGPE+=$GP;
    }
    else
      echo "-";
    ?>
    </td>
    <td class="c02" align="center">
    <?php
    if($gradePoint)
      echo $gradePoint;
    else
      echo "-";
    ?>
    </td>
    <td class="c02" align="center">
    <?php
    if($gradePoint){
      $mul=$grade_info[$gi]['creditI']*$gradePoint;
      echo $mul;
      $sumCXG+=$mul;
    }
    else
      echo "-";
    ++$gi;
    ?>
    </td>
  </tr>

  <tr>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  <td class="c02">&nbsp;</td>
  </tr>

	<tr>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	</tr>
	<tr>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	</tr>
	<tr>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	</tr>
	<tr>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	</tr>
	<tr>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	</tr>
	<tr>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	</tr>
	<tr>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	</tr>
	<tr>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	</tr>
	<tr>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	</tr>
	<tr>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	</tr>
	<tr>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	</tr>
	<tr>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	<td class="c02">&nbsp;</td>
	</tr>
	<tr>
	<td class="c03" colspan="2" style="color:red;" align="right"><strong>TOTAL</strong></td>
	<td class="c03" align="center"><?php echo $sumGP; ?></td>
	<td class="c03" colspan="3">&nbsp;</td>
	<td class="c03" align="center"><?php echo $sumGPE; ?></td>
	<td class="c03" align="center">--</td>
	<td class="c03" align="center"><?php echo $sumCXG; ?></td>
	</tr>
</table>
<table id="t03">
	<tr>
	<td style="color:red;padding-right:20px;">Remark:</td>
	<td style="color:black;"><strong>
  <?php
  if($student_info['result'])
    echo "Successful";
  else
    echo "Unsuccessful";
   ?>
  </strong></td>
	<td style="color:red;padding-right:20px;" align="right">SGPI:</td>
    <td style="color:black;"><strong>
    <?php
    if($student_info['result'])
      echo round($sumCXG/$sumGPE,2);
    else
      echo "--";
     ?>
    </strong></td>
	<td style="color:red;padding-right:20px;" align="right">CGPI:</td>
    <td style="color:black;"><strong>--</strong></td>
	</tr>
	<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	</tr>
	<tr>
	<td style="color:red;padding-right:20px;">Result Declared on:</td>
	<td style="color:black" colspan="5"><?php echo date('F d').",".date('Y'); ?></td>
	</tr>
</table>
</center>
</body>
</html>
