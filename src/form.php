

<?php
    ini_set('memory_limit', '1024M');

use PHPMailer\PHPMailer\PHPMailer;
require __DIR__ . '/form.php';

$errors = [];
$errorMessage = '';

if (!empty($_POST)) {
    $inputName = $_POST['inputName'];
    $inputEmail = $_POST['inputEmail'];
    $inputDate = $_POST['inputDate'];
    $inputNumber = $_POST['inputNumber'];
    $inputPhone = $_POST['inputPhone'];
    $inputTextarea = $_POST['inputTextarea'];

    if (empty($inputName)) {
        $errors[] = 'Name is empty';
    }
 
    if (empty($inputEmail)) {
        $errors[] = 'Email is empty';
    } else if (!filter_var($inputEmail, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email is invalid';
    }

    if (empty($inputDate)) {
      $errors[] = 'Date is empty';
    }

    if (empty($inputNumber)) {
      $errors[] = 'Numero is empty';
    }
 
    if (empty($inputPhone)) {
        $errors[] = 'No is empty';
    }


    if (!empty($errors)) {
        $allErrors = join('<br/>', $errors);
        $errorMessage = "<p style='color: red;'>{$allErrors}</p>";
    } else {
        $mail = new PHPMailer();

        // specify SMTP credentials
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = 'd5g6bc7a7dd6c7';
        $mail->Password = '27f211b3fcad87';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 2525;

        $mail->setFrom($email, 'Mailtrap Website');
        $mail->addAddress('piotr@mailtrap.io', 'Me');
        $mail->Subject = 'Nouveau reservation';

        // Enable HTML if needed
        $mail->isHTML(true);

        $bodyParagraphs = ["Nom: {$inputName}", "Email: {$inputEmail}", "Date: {$inputDate}", "Personnes: {$inputNumber}", "No: {$inputPhone}", "Message:", nl2br($inputTextarea)];
        $body = join('<br />', $bodyParagraphs);
        $mail->Body = $body;

        echo $body;
        if($mail->send()){

            header('Location: thank-you.html'); // redirect to 'thank you' page
        } else {
            $errorMessage = 'Oops, something went wrong. Mailer Error: ' . $mail->ErrorInfo;
        }
    }
}

?>

<?php
use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST['name']) && isset($_POST['email'])){
    $inputName = $_POST['inputName'];
    $inputEmail = $_POST['inputEmail'];
    $inputDate = $_POST['inputDate'];
    $inputNumber = $_POST['inputNumber'];
    $inputPhone = $_POST['inputPhone'];
    $inputTextarea = $_POST['inputTextarea'];
    $body = $_POST['body'];

    require_once "";
    require_once "PHPMailer/SMTP.php";
    require_once "PHPMailer/Exception.php";

    $mail = new PHPMailer();

    //smtp settings
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "amiryacin46@gmail.com";
    $mail->Password = 'Amir140';
    $mail->Port = 465;
    $mail->SMTPSecure = "ssl";

    //email settings
    $mail->isHTML(true);
    $mail->setFrom($email, $name);
    $mail->addAddress("amiryacin46@gmail.com");
    $mail->Subject = ("$email ($subject)");
    $mail->Body = $body;

    if($mail->send()){
        $status = "success";
        $response = "Email is sent!";
    }
    else
    {
        $status = "failed";
        $response = "Something is wrong: <br>" . $mail->ErrorInfo;
    }

    exit(json_encode(array("status" => $status, "response" => $response)));
}

?>
      