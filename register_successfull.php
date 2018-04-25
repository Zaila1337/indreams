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
</head>

<body>

	<?php include 'header.php'; ?>
	<center>
		<?php include 'navigation.php'; ?> 

		<div class="container">
			<div class="row">
				<div class="col-sm">
					<br>
					<p>Registrering lyckades! <a href="login.php">Tryck här för att logga in.</a></p>
				</div>
			</div>
		</div>

	</center>

</body>

</html>