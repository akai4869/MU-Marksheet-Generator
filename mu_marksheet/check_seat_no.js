function vseat(){
	var seat=document.getElementById("o1");
	var write=document.getElementById("e1");
	var regex=/^[0-9]{4,8}$/;
  
	if(seat.value==""){
		write.innerHTML="Required field!";
		seat.style.border="2px solid red";
    return false;
	}
	else if(!regex.test(seat.value)){
		write.innerHTML="Please enter a valid seat number!<br>"+"For eg. 12116793";
		seat.style.border="2px solid red";
    return false;
	}
	else{
		write.innerHTML="";
		seat.style.border="2px solid green";
		return true;
	}
}
