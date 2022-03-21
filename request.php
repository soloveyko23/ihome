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
	//Тема письма
	$mail->Subject = 'Заявка с сайта"';
	if(trim(!empty($_POST['requestName']))){
		$body.="\r\n<br>Имя: ".$_POST['requestName'];
	}
	if(trim(!empty($_POST['requestPhone']))){
		$body.="\r\n<br>Телефон: ".$_POST['requestPhone'];
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