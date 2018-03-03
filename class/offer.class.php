<?php

class Offer {

	private $conn;

	public function __construct($db_host, $db_name, $db_user, $db_pass) {
		
		try {
		  	$this->conn = new PDO('mysql:host='.$db_host.';dbname='.$db_name.';charset=utf8', $db_user, $db_pass);
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		} catch (PDOException $e) {
		    echo 'Verbindung fehlgeschlagen: ' . $e->getMessage();
		}

	}

	public function getById($offer_id) {
		$statement = $this->conn->prepare("SELECT * FROM offer WHERE offer_id = :offer_id");
		$statement->bindParam('offer_id', $offer_id);
		$statement->execute();
		$offer = $statement->fetch(PDO::FETCH_ASSOC);
		return $offer;
	}

	public function setAccpted($offer_id, $accpeted) {
		$statement = $this->conn->prepare("UPDATE offer SET accepted = :accepted WHERE offer_id = :offer_id");
		$statement->bindParam('accepted', $accpeted);
		$statement->bindParam('offer_id', $offer_id);
		$statement->execute();
	}

	public function create($request_id, $customer_id, $title, $description, $delivery_date, $amount, $quality, $price) {

		$statement = $this->conn->prepare("INSERT INTO 
			offer (
					request_id,
					customer_id,
					title,
					description,
					delivery_date,
					amount,
					quality,
					price,
					accepted
				) VALUES (
					:request_id,
					:customer_id,
					:title,
					:description,
					:delivery_date,
					:amount,
					:quality,
					:price,
					'pending'
				)");

		$statement->bindParam('request_id', $request_id);
		$statement->bindParam('customer_id', $customer_id);
		$statement->bindParam('title', $title);
		$statement->bindParam('description', $description);
		$statement->bindParam('delivery_date', $delivery_date, PDO::PARAM_STR);
		$statement->bindParam('amount', $amount);
		$statement->bindParam('quality', $quality);
		$statement->bindParam('price', $price);
		$statement->execute();

	}

}