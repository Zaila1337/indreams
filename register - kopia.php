<?php
  
  require_once 'config/database.php';

  $username = $password = $comfirm_password = "";
  $username_err = $password_err = $confirm_password_err = "";

  // Processing form data when form is submitted

  if($_SERVER["REQUEST_METHOD"] == "POST")
  {
    // Validate username
    if(empty(trim($_POST["username"])))
    {
      $username_err = "Please enter a username.";
    }
    else 
    {
      // Prepare a select statement
      $sql = "SELECT id FROM users WHERE username = ?";

      if($stmt = $mysqli->prepare($sql))
      {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_params("s", $param_username);

        // Set Parameters
        $param_username = trim($_POST["username"]);

        // Attempt to execute the prepared statement
        if($stmt->execute())
        {
          // Store result
          $stmt->store_result();

          if($stmt->num_rows == 1)
          {
            $username_err = "Användarnamnet är redan registrerad.";
          }
          else
          {
            $username = trim($_POST["username"]);
          }
        }
        else
        {
          echo "Oops! Något gick fel, försök senare eller rapportera detta till en webmaster. [Kod: r1]";
        }
      }
      $stmt->close();
    }

    // Validate password
    if(empty(trim($_POST['password'])))
    {
      $password_err = "Fyll i ett lösenord.";
    }
    else if(strlen(trim($_POST['password'])) < 6)
    {
      $password_err = "Lösenordet är för kort. Lösenordet måste vara minst 6 tecken lång.";
    }
    else
    {
      $password = trim($_POSt['password']);
    }

    // Validate confirm password

    if(empty(trim($_POST["confirm_password"])))
    {
        $confirm_password_err = 'Var snäll och bekräfta lösenordet.';     
    } 
    else
    {
        $confirm_password = trim($_POST['confirm_password']);

        if($password != $confirm_password){

            $confirm_password_err = 'Lösenordet matchade inte.';
        }
    }

    // Check input errors before inserting in database

    if(empty($username_err) && empty($password_err) && empty($confirm_password_err))
    {
      // Prepare an insert statement

      $sql = "INSERT INTO users (username, password) VALUES (?, ?)";

      if($stmt = $mysqli ->prepare($sql))
      {
        // Bind variables to the prepared statement as parameters

        $stmt->bind_params("ss", $param_username, $param_password);

        $param_username = $username;
        $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

        if($stmt->execute())
        {
          header("location: login.php");
        }
        else
        {
          echo "Oops! Något gick fel, försök igen senare eller rapportera detta till en webmaster. [Kod: e2]";
        }
      }
      // Close statement
      $stmt->close();
    }
    $mysqli->close();
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
  <br><h2>Registrera</h2><br>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

    <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
      <label>Användarnamn</label>
      <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
      <span class="help-block"><?php echo $username_err; ?></span>
    </div>

    <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
      <label>Lösenord:</label>
      <input type="password" name="password" class="form-control" value="<?php echo $password; ?>">
      <span class="help-block"><?php echo $password_err; ?></span>
    </div>

    <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
      <label>Bekräfta lösenord:</label>
      <input type="password" name="confirm_password" class="form-control" value="<?php echo $confirm_password; ?>">
      <span class="help-block"><?php echo $confirm_password_err; ?></span>
    </div>

    <div class="form_group">
      <input type="submit" class="btn btn-primary" value="Registrera">
      <input type="reset" class="btn btn-default" value"Reset">
    </div>
  </form>
</div>

</body>
</html>
