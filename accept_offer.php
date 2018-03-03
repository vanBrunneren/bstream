<?php

	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'vendor/autoload.php';

	$mail = new PHPMailer(true);   

	require_once('header.php');

	$offer_id = $_GET['offer_id'];
	$request_id = $_GET['request_id'];

	$offer = new Offer($db_host, $db_name, $db_user, $db_pass);
	$offer->setAccpted($offer_id, 'accepted');
	$off = $offer->getById($offer_id);

	$xml_offer = new SimpleXMLElement("<offer></offer>");
	$xml_offer->addChild('title', $off['title']);
	$xml_offer->addChild('description', $off['description']);
	$xml_offer->addChild('amount', $off['amount']);
	$xml_offer->addChild('quality', $off['quality']);
	$xml_offer->addChild('price', $off['price']);
	$xml_offer->addChild('delivery_date', $off['delivery_date']);

	$xml_offer->asXML('xmlorders/'.$offer_id.'.xml');

	$customer = new Customer($db_host, $db_name, $db_user, $db_pass);
	$cust = $customer->getById($off['customer_id']);
	
	try {
		//Server settings
		$mail->SMTPDebug = 2;                                 // Enable verbose debug output
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'info@bstream.ch';                 // SMTP username
		$mail->Password = '';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		$mail->Port = 587;                                    // TCP port to connect to

		//Recipients
		$mail->setFrom('order@bstream.ch', 'Bstream Orders');
		$mail->addAddress($cust['email'], $cust['prename'] . " " . $cust['name']);     // Add a recipient
		$mail->addReplyTo('order@bstream.ch', 'BStream');

		//Attachments
		$mail->addAttachment('xmlorders/'.$offer_id.'.xml');         // Add attachments

		//Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = 'Bestellung BStream';
		$mail->Body    = 'Bestellung BStream';
		$mail->AltBody = 'Bestellung BStream';

		$mail->send();

	} catch (Exception $e) {
		echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
	}



	//header('Location: myrequests.php?show_details='.$request_id);

?>