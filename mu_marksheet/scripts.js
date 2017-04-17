function validate(){
	var result=true;

	if(!vname())
		result=false;

	if(!vselect())
		result=false;

	if(!vseat())
		result=false;

	if(!vreg())
		result=false;

	return result;
}

function vname(){
	var name=document.getElementById("j01");
	var write=document.getElementById("j02");
	var regex=/^[A-Z ]{2,40}$/;
	if(name.value==""){
		write.innerHTML="Required field!";
		name.style.border="2px solid red";
		return false;

	}
  else if(!regex.test(name.value)){
		write.innerHTML="Please enter a valid name!<br>"+"For eg. LIGHT YAGAMI";
		name.style.border="2px solid red";
		return false;
	}
	else{
		write.innerHTML="";
		name.style.border="2px solid green";
		return true;
	}
}

function vselect(){
	var option=document.getElementById("j03");
	var write;
	switch(option.value){
		case "sel":
		  write=document.getElementById("j04");
			write.innerHTML="Required field!";
			option.style.border="2px solid red";
			document.getElementById("m01").innerHTML="";
			return false;
		case "sem1":
		case "sem2":
			var grade=document.getElementsByClassName("grades");
			var len=document.getElementsByClassName("grades").length;
			write=document.getElementById("j04");
			write.innerHTML="";
			option.style.border="2px solid green";
			write=document.getElementById("m01");
			var result=true;
			for(var i=0; i<len; ++i){
				if(grade[i].value=="sel"){
					grade[i].style.border="2px solid red";
					result=false;
				}
				else
					grade[i].style.border="2px solid green"
			}
			if(!result)
				write.innerHTML="Please enter all grades!";
			else
				write.innerHTML="";
			return result;
	}
}

function vseat(){
	var seat=document.getElementById("j05");
	var write=document.getElementById("j06");
	var regex=/^[0-9]{4,8}$/;
	if(seat.value==""){
		write.innerHTML="Required field!";
		seat.style.border="2px solid red";
		return false;
	}
	else if(!regex.test(seat.value)){
		write.innerHTML="Please enter a valid seat number!<br>"+"For eg. 12116793,3346";
		seat.style.border="2px solid red";
		return false;
	}
	else{
		write.innerHTML="";
		seat.style.border="2px solid green";
		return true;
	}
}

function vreg(){
	var reg=document.getElementById("j07");
	var write=document.getElementById("j08");
	var regex=/^[0-9]{4,11}$/;
	if(reg.value==""){
		write.innerHTML="Required field!";
		reg.style.border="2px solid red";
		return false;
	}
	else if(!regex.test(reg.value)){
		write.innerHTML="Please enter a valid registration number!<br>"+"For eg. 15012116793";
		reg.style.border="2px solid red";
		return false;
	}
	else{
		write.innerHTML="";
		reg.style.border="2px solid green";
		return true;
	}
}




function showSubjects(){
	var option=document.getElementById("j03").value;
	var sub=document.getElementsByClassName("d2");
	var fieldbegin="<fieldset><legend>Subject Information</legend>";
	var fieldend="</fieldset>";
	var gradeSelectE=
	"<select class='grades' name='gradeListE[]'>"+
  	"<option value='sel' selected>Select</option>"+
 	"<option value='O'>O</option>"+
 	"<option value='A'>A</option>"+
  	"<option value='B'>B</option>"+
 	"<option value='C'>C</option>"+
  	"<option value='D'>D</option>"+
 	"<option value='E'>E</option>"+
 	"<option value='F'>F</option>"+
  	"<option value='--'>--</option>"+
  	"</select>";
  	var gradeSelectIA=
  	"<select class='grades' name='gradeListI[]'>"+
  	"<option value='sel' selected>Select</option>"+
 	"<option value='O'>O</option>"+
 	"<option value='A'>A</option>"+
  	"<option value='B'>B</option>"+
 	"<option value='C'>C</option>"+
  	"<option value='D'>D</option>"+
 	"<option value='E'>E</option>"+
 	"<option value='F'>F</option>"+
  	"<option value='--'>--</option>"+
  	"</select>";
		var gradeSelectTW=
  	"<select class='grades' name='gradeListI[]'>"+
  	"<option value='sel' selected>Select</option>"+
 	"<option value='O'>O</option>"+
 	"<option value='A'>A</option>"+
  	"<option value='B'>B</option>"+
 	"<option value='C'>C</option>"+
  	"<option value='D'>D</option>"+
 	"<option value='E'>E</option>"+
 	"<option value='F'>F</option>"+
  	"</select>";

	var empty="<tr><td colspan='5'>&nbsp;</td></tr>";
	switch(option){
	case "sel":
 	sub[0].innerHTML="";
	break;
	case "sem1":
	sub[0].innerHTML=
	fieldbegin+
	"<table id='t1' style='width:70%' align='center'>"+
 	"<tr>"+
	"<td>&nbsp;</td>"+
	"<td><span class='required'>*</span>ESE</td>"+
	"<td><span class='required'>*</span>PR/OR</td>"+
	"<td><span class='required'>*</span>IA</td>"+
	"<td><span class='required'>*</span>TW</td>"+
	"</tr>"+empty+
	"<tr>"+
 	"<td>APPLIED MATHEMATICS-I</td>"+
 	"<td>"+
 	gradeSelectE+
  	"</td>"+
  	"<td>"+
  	gradeSelectE+
  	"</td>"+
	"<td>"+
	gradeSelectIA+
	"</td>"+
	"<td>"+
	gradeSelectTW+
	"</td>"+
  	"</tr>"+empty+
  	"<tr>"+
 	"<td>APPLIED PHYSICS-I</td>"+
 	"<td>"+
 	gradeSelectE+
  	"</td>"+
	"<td>"+
	gradeSelectE+
	"</td>"+
	"<td>"+
	gradeSelectIA+
	"</td>"+
	"<td>"+
	gradeSelectTW+
	"</td>"+
  	"</tr>"+empty+
  	"<tr>"+
 	"<td>APPLIED CHEMISTRY-I</td>"+
	"<td>"+
	gradeSelectE+
	"</td>"+
	"<td>"+
	gradeSelectE+
	"</td>"+
	"<td>"+
	gradeSelectIA+
	"</td>"+
	"<td>"+
	gradeSelectTW+
	"</td>"+
  	"</tr>"+empty+
  	"<tr>"+
  	"<td>ENGINEERING MECHANICS</td>"+
	"<td>"+
	gradeSelectE+
	"</td>"+
	"<td>"+
	gradeSelectE+
	"</td>"+
	"<td>"+
	gradeSelectIA+
	"</td>"+
	"<td>"+
	gradeSelectTW+
	"</td>"+
  	"</tr>"+empty+
  	"<tr>"+
  	"<td>BASIC ELECTRONICS & ELECTRICAL ENGG</td>"+
	"<td>"+
	gradeSelectE+
	"</td>"+
	"<td>"+
	gradeSelectE+
	"</td>"+
	"<td>"+
	gradeSelectIA+
	"</td>"+
	"<td>"+
	gradeSelectTW+
	"</td>"+
	"</tr>"+empty+
	"<tr>"+
	"<td>BASIC WORKSHOP & PRACTICE-I</td>"+
	"<td>"+
	gradeSelectE+
	"</td>"+
	"<td>"+
	gradeSelectE+
	"</td>"+
	"<td>"+
	gradeSelectIA+
	"</td>"+
	"<td>"+
	gradeSelectTW+
	"</td>"+
	"</tr>"+
	"</table>"+
  	fieldend;
	break;
	case "sem2":
	sub[0].innerHTML=
	fieldbegin+
	"<table id='t1' width='70%' align='center'>"+
 	"<tr>"+
	"<td>&nbsp</td>"+
	"<td><span class='required'>*</span>ESE</td>"+
	"<td><span class='required'>*</span>PR/OR</td>"+
	"<td><span class='required'>*</span>IA</td>"+
	"<td><span class='required'>*</span>TW</td>"+
	"</tr>"+empty+
	"<tr>"+
 	"<td>APPLIED MATHEMATICS-II</td>"+
	"<td>"+
 	gradeSelectE+
  	"</td>"+
  	"<td>"+
  	gradeSelectE+
  	"</td>"+
	"<td>"+
	gradeSelectIA+
	"</td>"+
	"<td>"+
	gradeSelectTW+
	"</td>"+
	"</tr>"+empty+
	"<tr>"+
 	"<td>APPLIED PHYSICS-II</td>"+
	"<td>"+
 	gradeSelectE+
  	"</td>"+
  	"<td>"+
  	gradeSelectE+
  	"</td>"+
	"<td>"+
	gradeSelectIA+
	"</td>"+
	"<td>"+
	gradeSelectTW+
	"</td>"+
	"</tr>"+empty+
	"<tr>"+
 	"<td>APPLIED CHEMISTRY-II</td>"+
	"<td>"+
 	gradeSelectE+
  	"</td>"+
  	"<td>"+
  	gradeSelectE+
  	"</td>"+
	"<td>"+
	gradeSelectIA+
	"</td>"+
	"<td>"+
	gradeSelectTW+
	"</td>"+
	"</tr>"+empty+
	"<tr>"+
 	"<td>ENGINEERING DRAWING</td>"+
	"<td>"+
 	gradeSelectE+
  	"</td>"+
  	"<td>"+
  	gradeSelectE+
  	"</td>"+
	"<td>"+
	gradeSelectIA+
	"</td>"+
	"<td>"+
	gradeSelectTW+
	"</td>"+
	"</tr>"+empty+
	"<tr>"+
 	"<td>COMMUNICATION SKILLS</td>"+
	"<td>"+
  	gradeSelectE+
  	"</td>"+
  	"<td>"+
  	gradeSelectE+
  	"</td>"+
  	"<td>"+
  	gradeSelectIA+
  	"</td>"+
 	"<td>"+
  	gradeSelectTW+
  	"</td>"+
	"</tr>"+empty+
	"<tr>"+
 	"<td>BASIC WORKSHOP & PRACTICE-II</td>"+
	"<td>"+
 	gradeSelectE+
  	"</td>"+
  	"<td>"+
  	gradeSelectE+
  	"</td>"+
	"<td>"+
	gradeSelectIA+
	"</td>"+
	"<td>"+
	gradeSelectTW+
	"</td>"+
	"</tr>"+
	"</table>"+
  	fieldend;
	break;
}
}


function toUpper(){
     var x = document.getElementById("j01");
     x.value = x.value.toUpperCase();
}
