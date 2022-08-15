

<?php
//get data from form  
$inputName = $_POST['inputName'];
$inputEmail = $_POST['inputEmail'];
$inputDate = $_POST['inputDate'];
$inputNumber = $_POST['inputNumber'];
$inputPhone = $_POST['inputPhone'];
$inputTextarea = $_POST['inputTextarea'];
$to = "amiryacin46@mail.com";
$subject = "Mail From website";
$txt ="inputName = ". $inputName . "\r\n  inputEmail = " . $inputEmail . "\r\n inputTextarea =" . $inputTextarea;
$headers = "From: noreply@karamara-tours.com" . "\r\n" .
"CC: abdourahmandaher15@gmail.com";
if($inputEmail!=NULL){
    mail($to,$subject,$txt,$headers);
}
//redirect
header("Location:thankyou.html");
?>