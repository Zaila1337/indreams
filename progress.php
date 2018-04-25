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
		<br>
		<div class="container">
			<div class="row">
				<div class="col-sm">
					<br>
					<h3>Progress</h3>
					<br>
					<center>Antorus, the Burning Throne - Normal (11/11)</center>
					<div class="progress">
						<div class="progress-bar progress-bar-striped progress-bar-animated" style="width:100%">100%</div>
					</div>
					<br>
					<center>Antorus, the Burning Throne - Heroic (1/11)</center>
					<div class="progress">
						<div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" style="width:45%">45%</div>
					</div>
					<br>
					<center>Antorus, the Burning Throne - Mythic (11/11)</center>
					<div class="progress">
						<div class="progress-bar progress-bar-striped progress-bar-animated bg-danger" style="width:100%">100%(WORLD FIRST BITCHES)</div>
					</div>

				</div>
			</div>
		</div>

	</center>

</body>

</html>