<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'phpmailer/src/Exception.php';
	require 'phpmailer/src/PHPMailer.php';

	$mail = new PHPMailer(true);
	$mail->CharSet = 'UTF-8';
	$mail->setLanguage('ru', 'phpmailer/language/');
	$mail->IsHTML(true);

	//От кого письмо
	$mail->setFrom('info@fls.guru', 'От пользователя');
	//Кому отправить
	$mail->addAddress('fakdut.sl2017@gmail.com');
	//Тело письма
    $mail->Subject = 'Запись на гостевой визит';
    if(trim(!empty($_POST['guestOfficce']))){
		$body.="\r\n<br>Куда клиент хочет подъехать: ".$_POST['guestOfficce'];
	}
	if(trim(!empty($_POST['guestName']))){
		$body.="\r\n<br>Имя:".$_POST['guestName'];
	}
	if(trim(!empty($_POST['guestPhone']))){
		$body.="\r\n<br>Телефон: ".$_POST['guestPhone'];
	}
	$mail->Body = $body;

	//Отправляем
	if (!$mail->send()) {
		$message = 'Ошибка';
	} else {
		$message = 'Данные отправлены!';
	}

	$response = ['message' => $message];

	header('Content-type: application/json');
	echo json_encode($response);
?>