<?php
// Файлы phpmailer
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

// Переменные, которые отправляет пользователь
$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE);

$amount = $input['amount'];
$amountCurrency = $input['amountCurrency'];
$email = $input['email'];
$nameCurrency = $input['nameCurrency'];

// Формирование самого письма
$title = "Калькулятор конвертации валюты";
$body = "
<h2>Вы записаны на обмен валюты:</h2>
Сумма: <b>$amount руб.</b><br>
Сумма в валюте: <b>$amountCurrency $nameCurrency</b><br>
";

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {
    $mail->isSMTP();
    $mail->CharSet = "UTF-8";
    $mail->SMTPAuth   = true;
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};

    // Настройки вашей почты
    $mail->Host       = 'smtp.yandex.ru'; // SMTP сервера вашей почты
    $mail->Username   = ''; // Логин на почте
    $mail->Password   = ''; // Пароль на почте
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;
    $mail->setFrom('', 'Калькулятор конвертации валюты'); // Адрес самой почты и имя отправителя

    // Получатель письма
    $mail->addAddress($email);


// Отправка сообщения
$mail->isHTML(true);
$mail->Subject = $title;
$mail->Body = $body;

// Проверяем отравленность сообщения
if ($mail->send()) {$result = "success";}
else {$result = "error";}

} catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}

// Отображение результата
echo json_encode(["result" => $result, "status" => $status]);
