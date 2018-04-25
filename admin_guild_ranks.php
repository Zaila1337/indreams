<?php
	// Initialize the session
	session_start();
	if($_SESSION["admin"] == 0) { header("location: index.php"); }
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
		<?php include 'navigation.php'; ?> 
			<br><br><br>
			<div class="row">
				<div class="col-sm-4" style="background-color:lavender;">
					<center>
					<a href="admin_guild_rank_add.php" class="btn btn-primary">Lägg till ny rank</a>
				</center>
				</div>
				<div class="col-sm-8" style="background-color:lavenderblush;">
					<h3>Admin panelen - Guild Ranker</h3>
					<br>
					Existerande ranker:
				</div>
			</div>

</body>

</html>