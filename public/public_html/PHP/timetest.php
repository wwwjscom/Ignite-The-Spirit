<?php

$Name = "Ignite The Spirit"; //senders name
$email = "do_not_reply@ignitethespirit.org"; //senders e-mail adress
$recipient = "mike.pisula@gmail.com"; //recipient
$mail_body = "Congratulations you are enrolled in the Lieutenant Study Group.\n".
			 "The group will meet at Illinois Masonic Hospital's Olsen Auditorium. (836 W. Wellington and free parking is available) The group will meet on these days between the hours of 6:00pm and 9:00pm:\n\n".
			 "Jan. 30 Friday (3D)\n".
			 "Feb. 5 Thursday (3A)\n".
			 "Feb. 9 Monday (1B)\n".
			 "Feb. 16 Monday (2E)\n".
			 "Feb. 26 Thursday (3C)\n".
			 "Mar. 5 Thursday (1E)\n".
			 "Mar. 12 Thursday (2C)\n".
			 "Mar. 19 Thursday (3E)\n".
			 "Mar. 23 Monday (1A)\n\n".

			 "For the lastest information please visit ignitethespirit.org."; //mail body
$subject = "Ignite the Spirit | Lieutenant Study Group"; //subject
$header = "From: ". $Name . " <" . $email . ">\r\n"; //optional headerfields

ini_set('sendmail_from', 'do_not_reply@ignitethespirit.org'); //Suggested by "Some Guy"

mail($recipient, $subject, $mail_body, $header); //mail command :)
?>