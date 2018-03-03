<?php

class customer {

	private $conn;

	public function __construct($db_host, $db_name, $db_user, $db_pass) {
		
		try {
		  	$this->conn = new PDO('mysql:host='.$db_host.';dbname='.$db_name.';charset=utf8', $db_user, $db_pass);
			$this->conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
		} catch (PDOException $e) {
		    echo 'Verbindung fehlgeschlagen: ' . $e->getMessage();
		}

	}

	public function getById($customer_id) {
		$statement = $this->conn->prepare("SELECT * FROM customer WHERE customer_id = :customer_id");
		$statement->bindParam('customer_id', $customer_id);
		$statement->execute();
		$customer = $statement->fetch(PDO::FETCH_ASSOC);
		return $customer;
	}

	public function findByEmail($email) {
		$statement = $this->conn->prepare("SELECT * FROM customer WHERE email = :email");
		$statement->bindParam('email', $email);
		$statement->execute();
		$row = $statement->fetch();
		return $row;
	}

	public function create($company_name, $sex, $name, $prename, $email, $phone, $street, $plz, $city, $password) {

		$statement = $this->conn->prepare("INSERT INTO 
			customer (
				company_name, 
				sex, 
				name,
				prename,
				email,
				phone,
				street,
				plz,
				city,
				password
			) VALUES (
				:company_name, 
				:sex, 
				:name,
				:prename,
				:email,
				:phone,
				:street,
				:plz,
				:city,
				:password
			)
		");

		$statement->bindParam('company_name', $company_name);
		$statement->bindParam('sex', $sex);
		$statement->bindParam('name', $name);
		$statement->bindParam('prename', $prename);
		$statement->bindParam('email', $email);
		$statement->bindParam('phone', $phone);
		$statement->bindParam('street', $street);
		$statement->bindParam('plz', $plz);
		$statement->bindParam('city', $city);
		$statement->bindParam('password', $password);
		$statement->execute();

	}

}

?>