<?php
	
	require_once('class/request.class.php');
	require_once('db_connection.php');

?>
<div class="table-responsive">
<table class="table">
	<thead>
		<tr>
			<th scope="col">#</th>
			<th scope="col">Titel</th>
			<th scope="col">Beschreibung</th>
			<th scope="col">Menge</th>
			<th scope="col">Qualität</th>
			<th scope="col">Lieferdatum</th>
			<th scope="col"></th>
			<th scope="col"></th>
		</tr>
	</thead>
	<tbody>

	<?php

		$requests = new Request($db_host, $db_name, $db_user, $db_pass);
		if(isset($_POST['customer_id']) && $_POST['customer_id']) {
			$all_requests = $requests->search($_POST['searchText'], $_POST['customer_id']);
		} else {
			$all_requests = $requests->search($_POST['searchText']);
		}

		if($all_requests) {

			foreach($all_requests as $req) {
	?>
				<tr>
					<td><?= htmlentities($req['request_id']) ?></td>
					<td><?= htmlentities($req['title']) ?></td>
					<td><?= htmlentities($req['description']) ?></td>
					<td><?= htmlentities($req['amount']) ?></td>
					<td><?= htmlentities($req['quality']) ?></td>
					<td><?= htmlentities($req['delivery_date']) ?></td>
					<td>
						<?php
							if(!isset($_POST['customer_id'])) { 
						?>
								<a class="default-link" href="create_offer.php?request_id=<?= $req['request_id'] ?>">
									<i class="fa fa-plus" aria-hidden="true" title="Angebot erstellen"></i>
								</a>
						<?php
							}
						?>
					</td>
					<td>
						<?php
							if(isset($_POST['customer_id'])) { 
								echo '<a href="myrequests.php?show_details='.$req['request_id'].'" class="default-link" title="Angebote anzeigen">
										<i class="fa fa-eye" aria-hidden="true"></i>';
											
						?>	
								</a>
								<a href="edit_request.php?request_id=<?= $req['request_id'] ?>" class="default-link">
									<i class="fa fa-pencil" aria-hidden="true"></i>
								</a>
								<a href="delete_request.php?request_id=<?= $req['request_id'] ?>" class="default-link">
									<i class="fa fa-trash" aria-hidden="true"></i>
								</a>
						<?php 
							} 
						?>
					</td>
				</tr>
	<?php
			}

		} else {

	?>

			<tr>
				<td colspan="6"><p class="notfound">Keine Nachfragen gefunden</p></td>
			</tr>

	<?php

	} 

	?>

	</tbody>
</table>
</div>	