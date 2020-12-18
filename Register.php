<?php
function ExitAlert($msg){
    exit("gg.alert('".$msg."')");
}

$JDecode = json_decode(file_get_contents('php://input'),true); 
$FileName = "RegisterData.data";
$username= $JDecode["Username"];
$password=  $JDecode["Password"];
$confirm_password= $JDecode["ConfirmPassword"];
$content =json_decode(file_get_contents($FileName),true);
if ($content == null){
$content =[];
}
if(isset($username) == false || isset($password)== false ||trim($password) == ""|| trim($username) == ""){
ExitAlert('Invalid username or password');
}
if($confirm_password <>$password){
ExitAlert('Check the password field and confirm password should match, try again');
}
if($content[$username] == null){
	$content[$username] =  array(
    "password" => $password);
    file_put_contents($FileName,json_encode($content,true));
    ExitAlert("User successfully registered!!!");
	}
	else{
		ExitAlert("This username already exists, try another");
		}
?>