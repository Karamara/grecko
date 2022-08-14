

<?php

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
      $errors[] = 'No is empty';
    }
 
    if (empty($inputPhone)) {
        $errors[] = 'Message is empty';
    }


    if (empty($errors)) {
        $toEmail = 'amiryacin46@gmail.com';
        $emailSubject = 'Nouveau reservation';
        $headers = ['From' => $inputEmail, 'Reply-To' => $inputEmail, 'Content-type' => 'text/html; charset=iso-8859-1'];

        $bodyParagraphs = ["Nom: {$inputName}", "Email: {$inputEmail}", "Date: {$inputDate}", "Personnes: {$inputNumber}", "No: {$inputPhone}", "Message: {$inputTextarea}"];
        $body = join(PHP_EOL, $bodyParagraphs);

        if (mail($toEmail, $emailSubject, $body, $headers)) {
            header('Location: thank-you.html');
        } else {
            $errorMessage = 'Oops, something went wrong. Please try again later';
        }
    } else {
        $allErrors = join('<br/>', $errors);
        $errorMessage = "<p style='color: red;'>{$allErrors}</p>";
    }
}

?>