<?php

	require_once('header.php');

	$request = new Request($db_host, $db_name, $db_user, $db_pass);
	$all_requests = $request->getByCustomerId($_SESSION['customer_id']);

	$show_details = $_GET['show_details'];

?>

<main role="main" class="container">
	<div class="row">
		<div class="col-12 col-md-12 request-col">		
			<h1>Meine Nachfragen</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-12 request-col">
			<a href="create_request.php"><button type="button" class="btn btn-success">Neue Nachfrage erstellen</button></a>
		</div>
	</div>
	<div class="row">
		<div class="col-12 request-search">
			<div class="form-group">
				<form name="search" method="POST" action="">
					<input type="text" id="my_request_search" name="search" class="form-control" placeholder="Suche" />
					<input type="hidden" id="customer_id" name="customer_id" value="<?= $_SESSION['customer_id'] ?>" />
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12" id="my_request_list">
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
						</tr>
					</thead>
					<tbody>
						<?php
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
											if($show_details == $req['request_id']) {
												echo '<a href="myrequests.php" class="default-link" title="Angebote ausblenden">
														<i class="fa fa-eye-slash" aria-hidden="true"></i>';
											} else {
												echo '<a href="myrequests.php?show_details='.$req['request_id'].'" class="default-link" title="Angebote anzeigen">
															<i class="fa fa-eye" aria-hidden="true"></i>';
											}
										?>										
											
										</a>
										<a href="edit_request.php?request_id=<?= $req['request_id'] ?>" class="default-link">
											<i class="fa fa-pencil" aria-hidden="true"></i>
										</a>
										<a href="delete_request.php?request_id=<?= $req['request_id'] ?>" class="default-link">
											<i class="fa fa-trash" aria-hidden="true"></i>
										</a>
									</td>
								</tr>
								<?php

									if($show_details == $req['request_id']) {

										$offers = $request->getOffersById($req['request_id']);
										if($offers) {

											echo '<tr><td></td><td colspan="6">';
											echo '<table class="table"><tr><td colspan="7"><b>Angebote:</b></td></tr>';
											echo '<tr><td>Titel</td><td>Beschreibung</td><td>Menge</td><td>Qualität</td><td>Preis</td><td>Lieferdatum</td><td></td>';

											foreach($offers as $off) {

												switch($off['accepted']) {

													case "accepted":
														echo '<tr style="background-color: #d4edda;">';
														break;

													case "declined":
														echo '<tr style="background-color: #f8d7da;">';
														break;

													case "pending":
														echo '<tr style="background-color: #e2e3e5;">';
														break;

												}

												?>
													<td><?= $off['title'] ?></td>
													<td><?= $off['description'] ?></td>
													<td><?= $off['amount'] ?></td>
													<td><?= $off['quality'] ?></td>
													<td><?= $off['price'] ?></td>
													<td><?= date("d.m.Y H:i", strtotime($off['delivery_date'])) ?></td>
													<td>
														<a href="accept_offer.php?offer_id=<?= $off['offer_id'] ?>&request_id=<?= $req['request_id'] ?>" class="default-link">
															<i class="fa fa-check" aria-hidden="true" title="Angebot annehmen"></i>
														</a>
														<a href="decline_offer.php?offer_id=<?= $off['offer_id'] ?>&request_id=<?= $req['request_id'] ?>" class="default-link">
															<i class="fa fa-times" aria-hidden="true" title="Angebot ablehnen"></i>
														</a>
													</td>
												</tr>
											<?php

											}

											echo '</table></td></tr>';

										}

									}

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
		</div>
	</div>
</main>

<?php

	require_once('footer.php');

?>