<?php

$name = "Undefined name";

if(isset($_POST['name'])){
    $name = $_POST['name'];
}

$message = "<p>Hi!</p>";
$message .= "<p>Wazaaaaa $name</p>";

$to_email = 'u-kkm@mail.com';
$subject = 'Mail subject';
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=UTF-8';
$headers[] = 'From: Biloo <venovsky@yandex.ru>';

mail($to_email, $subject, $message, implode("\r\n", $headers));

?>
