<?php
/* Проверка антиспама */
//if ( ( (!isset($_POST['email'])) and (!isset($_POST['phone'])) ) or ( ( $_POST['name'] != '' ) or ( $_POST['mail'] != '' ) or ( $_POST['email'] != '' ) or ( $_POST['phone'] != '' ) or ( $_POST['tel'] != '' ) or ( $_POST['url'] != '' ) ) ) { $status = 'spam'; }
/* Формируем сообщение */
$letter = '';
if (isset($_POST['name'])) {
    $letter .= "\r\n<br>Имя: " . $_POST['name'];
}
//    if (isset($_POST['email']))     { $letter .= '<br/>E-mail: '.$_POST['email']; }
if (isset($_POST['phone'])) {
    $letter .= "\r\n<br>Телефон: " . $_POST['phone'];
}
//    if (isset($_POST['mesago']))    { $letter .= '<br/>Сообщение: '.$_POST['mesago']; }

if (!empty(isset($_POST['planirovka']))) {
    $letter .= "\r\n<br>Планировка: " . $_POST['planirovka'];
}
if (!empty(isset($_POST['orientir']))) {
    $letter .= "\r\n<br>Ориентировочные размеры: " . $_POST['orientir'];
}
if (!empty(isset($_POST['fasad']))) {
    $letter .= "\r\n<br>Фасад: " . $_POST['fasad'];
}
if (!empty(isset($_POST['stoleshnica']))) {
    $letter .= "\r\n<br>Столешница: " . $_POST['stoleshnica'];
}
if (!empty(isset($_POST['budget']))) {
    $letter .= "\r\n<br>Бюджет: " . $_POST['budget'];
}
if (!empty(isset($_POST['type-pay']))) {
    $letter .= "\r\n<br>Тип оплаты: " . $_POST['type-pay'];
}
if (!empty(isset($_POST['podarki']))) {
    $letter .= "\r\n<br>Подарки: " . $_POST['podarki'];
}










date_default_timezone_set('Europe/Kiev');
$fd = fopen("sended.txt", 'a+') or die("не удалось открыть файл");
$ip_user = $_SERVER['REMOTE_ADDR'];
$browser_user = $_SERVER['HTTP_USER_AGENT'];
$date = date('l jS \of F Y H:i:s');
$str = $ip_user.' ' .$date.PHP_EOL.$letter.PHP_EOL;
fwrite($fd, $str);
fclose($fd);


/* Отправка e-mail */
 $our_email = 'fakdut.sl2017@gmail.com';

if(isset($_POST['zahvat'])) {
    $mail_subject = 'Захват с сайта: ' . $_SERVER['HTTP_HOST'] . ' (';
} else {
    $mail_subject = 'Заказ звонка: ' . $_SERVER['HTTP_HOST'] . ' (';
}
if (isset($_POST['name'])) {
    $mail_subject .= ' Имя: ' . $_POST['name'];
    if(strlen($_POST['name']) > 20) {
        exit('спам');
    }
}
//if (isset($_POST['email']))     { $mail_subject .= ' E-mail: '.$_POST['email'] ; }
if (isset($_POST['phone'])) {
    $mail_subject .= ' Телефон: ' . $_POST['phone'];
    if(strlen($_POST['phone']) > 20) {
        exit('спам');
    }
}



$mail_subject .= ')';
$mail_headers = "MIME-Version: 1.0\r\n";
$mail_headers .= "Content-type: text/html; charset=utf-8\r\n";
$mail_headers .= "From: <" . $_SERVER['HTTP_HOST'] . ">" . "\r\n";
if (mail($our_email, $mail_subject, $letter, $mail_headers)) {
    $status = 'true';
} else {
    $status = 'false';
}
