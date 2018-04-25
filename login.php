<?php

require_once 'config/database.php';
session_start();

// Define variables and initialize with empty values

$username = $password = "";
$username_err = $password_err = "";

 

// Processing form data when form is submitted

if($_SERVER["REQUEST_METHOD"] == "POST")
{
  // Check if username is empty
  if(empty(trim($_POST["username"])))
  {
      $username_err = 'Please enter username.';
  } 
  else
  {
      $username = trim($_POST["username"]);
  }

  // Check if password is empty
  if(empty(trim($_POST['password'])))
  {
      $password_err = 'Please enter your password.';
  } 
  else
  {
      $password = trim($_POST['password']);
  }

  // Validate credentials
  if(empty($username_err) && empty($password_err))
  {
    // Prepare a select statement
    $sql = "SELECT username, password, admin FROM users WHERE username = :username";

    if($stmt = $pdo->prepare($sql))
    {
      // Bind variables to the prepared statement as parameters
      $stmt->bindParam(':username', $param_username, PDO::PARAM_STR);

      // Set parameters
      $param_username = trim($_POST["username"]);

      // Attempt to execute the prepared statement
      if($stmt->execute())
      {
        // Check if username exists, if yes then verify password
        if($stmt->rowCount() == 1)
        {
          if($row = $stmt->fetch())
          {
            $hashed_password = $row['password'];
            if(password_verify($password, $hashed_password))
            {
              /* Password is correct, so start a new session and save the username to the session */
              session_start();
              $_SESSION['username'] = $username;
              $_SESSION['guild_rank'] = $row['guild_rank'];
              $_SESSION['admin'] = $row['admin'];
              header("location: index.php");
            }
            else
            {
              // Display an error message if password is not valid
              $password_err = 'Invalid lösenord.';
            }
          }
        } 
        else
        {
          // Display an error message if username doesn't exist
          $username_err = 'Kontot existerar inte.';
        }
      } 
      else
      {
        echo "Oops! Något gick fel. Vänta en liten stund eller rapportera detta till en webmaster. [Kod: l1]";
      }
    }
    // Close statement
    unset($stmt);
  }
  // Close connection
  unset($pdo);
}

?>

<!DOCTYPE html>
<html lang="en">
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
</center>
<div class="container">
  <h2>Logga in</h2>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
      <label>Användarnamn</label>
      <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
      <span class="help-block"><?php echo $username_err; ?></span>
    </div>    

    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
      <label>Lösenord</label>
      <input type="password" name="password" class="form-control">
      <span class="help-block"><?php echo $password_err; ?></span>
    </div>

    <div class="form-group">
      <input type="submit" class="btn btn-primary" value="Login">
    </div>

    <p>Inget konto än? <a href="register.php">Registrera dig här</a>!</p>
  </form>
</div>

</body>
</html>
