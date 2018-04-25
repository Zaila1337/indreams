<?php
	// Initialize the session
	session_start();
?>

<html>

<head>
  <title>In Dreams @ Silvermoon EU - A swedish World of Warcraft raiding guild</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>

	<style type="text/css">
	   body { background: black !important; } /* Adding !important forces the browser to overwrite the default style applied by Bootstrap */
	</style>

</head>

<body>
	<?php include 'header.php'; ?>
	<center>
		<?php include 'navigation.php'; ?> 
		<br>
		<div class="container">
			<div class="row">
				<div class="col-sm">
					<h3>Roster</h3>

					<div class="table-responsive">
						<table class="table table-dark table-striped">
							<thead>
								<tr>
									<th>Name</th>
									<th>Class</th>
									<th>Specc</th>
									<th>Guild Rank</th>
								<tr>
							</thead>

							<tbody>
								<tr>
									<td>Zailá</td>
									<td>Priest</td>
									<td>Shadow</td>
									<td>Guild Master</td>
								</tr>
								<tr>
									<td>Mikate</td>
									<td>Death Knight</td>
									<td>Blood</td>
									<td>Officer / Raid Leader</td>
								</tr>
								<tr>
									<td>Sofý</td>
									<td>Hunter</td>
									<td>Marksmanship</td>
									<td>Officer</td>
								</tr>
							</tbody>

						</table>
					</div>

				</div>
			</div>
		</div>

	</center>

</body>

</html>