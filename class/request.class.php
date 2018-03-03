<?php

class request {

	private $conn;

	public function __construct($db_host, $db_name, $db_user, $db_pass) {
		
		try {
		  	$this->conn = new PDO('mysql:host='.$db_host.';dbname='.$db_name.';charset=utf8', $db_user, $db_pass);
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		} catch (PDOException $e) {
		    echo 'Verbindung fehlgeschlagen: ' . $e->getMessage();
		}

	}

	public function getOffersById($request_id) {
		$statement = $this->conn->prepare("SELECT * FROM offer WHERE request_id = :request_id AND entry_status = 'public'");
		$statement->bindParam('request_id', $request_id);
		$statement->execute();
		$offers = $statement->fetchAll(PDO::FETCH_ASSOC);
		return $offers;
	}

	public function deleteById($request_id) {
		$statement = $this->conn->prepare("UPDATE requests SET entry_status = 'deleted' WHERE request_id = :request_id ");
		$statement->bindParam('request_id', $request_id);
		$statement->execute();
	}

	public function getAll() {
		$statement = $this->conn->prepare("SELECT * FROM requests WHERE entry_status = 'public' ");
		$statement->execute();
		$requests = $statement->fetchAll(PDO::FETCH_ASSOC);
		return $requests;		
	}

	public function getById($request_id) {
		$statement = $this->conn->prepare("SELECT * FROM requests WHERE request_id = :request_id");
		$statement->bindParam('request_id', $request_id);
		$statement->execute();
		$request = $statement->fetch(PDO::FETCH_ASSOC);
		return $request;
	}

	public function getByCustomerId($customer_id) {
		$statement = $this->conn->prepare("SELECT * FROM requests WHERE customer_id = :customer_id AND entry_status = 'public'");
		$statement->bindParam('customer_id', $customer_id);
		$statement->execute();
		$requests = $statement->fetchAll(PDO::FETCH_ASSOC);
		return $requests;
	}

	public function search($searchText, $customer_id = false) {
		$searchText = "%".$searchText."%";
		if($customer_id) {
			$statement = $this->conn->prepare("SELECT * FROM requests WHERE (title LIKE :searchTitle OR description LIKE :searchDescription) AND customer_id = :customer_id AND entry_status = 'public'");
			$statement->bindParam('customer_id', $customer_id);
		} else {
			$statement = $this->conn->prepare("SELECT * FROM requests WHERE (title LIKE :searchTitle OR description LIKE :searchDescription) AND entry_status = 'public'");
		}

		$statement->bindParam('searchTitle', $searchText);
		$statement->bindParam('searchDescription', $searchText);
		$statement->execute();
		$requests = $statement->fetchAll(PDO::FETCH_ASSOC);
		return $requests;	
	}

	public function create($customer_id, $title, $description, $delivery_date, $amount, $quality) {
	
		$statement = $this->conn->prepare("INSERT INTO 
			requests (
					customer_id,
					title,
					description,
					delivery_date,
					amount,
					quality
				) VALUES (
					:customer_id,
					:title,
					:description,
					:delivery_date,
					:amount,
					:quality
				)");

		$statement->bindParam('customer_id', $customer_id);
		$statement->bindParam('title', $title);
		$statement->bindParam('description', $description);
		$statement->bindParam('delivery_date', $delivery_date, PDO::PARAM_STR);
		$statement->bindParam('amount', $amount);
		$statement->bindParam('quality', $quality);
		$statement->execute();
		
	}

	public function update($request_id, $title, $description, $delivery_date, $amount, $quality) {
	
		$statement = $this->conn->prepare("
			UPDATE 
				requests 
			SET 
				title = :title,
				description = :description,
				delivery_date = :delivery_date,
				amount = :amount,
				quality = :quality
			WHERE 
				request_id = :request_id 
		");		

		$statement->bindParam('request_id', $request_id);
		$statement->bindParam('title', $title);
		$statement->bindParam('description', $description);
		$statement->bindParam('delivery_date', $delivery_date, PDO::PARAM_STR);
		$statement->bindParam('amount', $amount);
		$statement->bindParam('quality', $quality);
		$statement->execute();
		
	}

}

?>