<?php

	require_once('header.php');

	$request = new Request($db_host, $db_name, $db_user, $db_pass);
	$all_requests = $request->getAll();

?>

<main role="main" class="container">
	<div class="row">
		<div class="col-12 col-md-12 request-col">		
			<h1>Alle Nachfragen</h1>
		</div>
	</div>
	<div class="row">
		<div class="col-12 request-search">
			<div class="form-group">
				<form name="search" method="POST" action="">
					<input type="text" id="search" name="search" class="form-control" placeholder="Suche" />
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-12" id="request_list">
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
										<td><?= $req['request_id'] ?></td>
										<td><?= htmlentities($req['title']) ?></td>
										<td><?= htmlentities($req['description']) ?></td>
										<td><?= htmlentities($req['amount']) ?></td>
										<td><?= htmlentities($req['quality']) ?></td>
										<td><?= htmlentities($req['delivery_date']) ?></td>
										<td>
											<a class="default-link" href="create_offer.php?request_id=<?= $req['request_id'] ?>">
												<i class="fa fa-plus" aria-hidden="true" title="Angebot erstellen"></i>
											</a>
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
		</div>
	</div>
</main>

<?php

	require_once('footer.php');

?>