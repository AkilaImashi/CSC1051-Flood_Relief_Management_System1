function validateRequestForm(){

let phone = document.forms["requestForm"]["contact_number"].value;
let members = document.forms["requestForm"]["family_members"].value;

if(phone.length < 10){
alert("Contact number must be at least 10 digits");
return false;
}

if(members <= 0){
alert("Family members must be greater than 0");
return false;
}

return true;
}