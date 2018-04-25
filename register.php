<?php

// Include config file

require_once 'config/database.php';
session_start();

 

// Define variables and initialize with empty values

$username = $password = $confirm_password = "";

$username_err = $password_err = $confirm_password_err = "";

 

// Processing form data when form is submitted

if($_SERVER["REQUEST_METHOD"] == "POST"){

 

    // Validate username

    if(empty(trim($_POST["username"]))){

        $username_err = "Please enter a username.";

    } else{

        // Prepare a select statement

        $sql = "SELECT id FROM users WHERE username = :username";

        

        if($stmt = $pdo->prepare($sql)){

            // Bind variables to the prepared statement as parameters

            $stmt->bindParam(':username', $param_username, PDO::PARAM_STR);

            

            // Set parameters

            $param_username = trim($_POST["username"]);

            

            // Attempt to execute the prepared statement

            if($stmt->execute()){

                if($stmt->rowCount() == 1){

                    $username_err = "This username is already taken.";

                } else{

                    $username = trim($_POST["username"]);

                }

            } else{

                echo "Oops! Något gick fel. Vänta en liten stund eller rapportera detta till en webmaster. [Kod: r1]";

            }

        }

         

        // Close statement

        unset($stmt);

    }

    

    // Validate password

    if(empty(trim($_POST['password']))){

        $password_err = "Please enter a password.";     

    } elseif(strlen(trim($_POST['password'])) < 6){

        $password_err = "Password must have atleast 6 characters.";

    } else{

        $password = trim($_POST['password']);

    }

    

    // Validate confirm password

    if(empty(trim($_POST["confirm_password"]))){

        $confirm_password_err = 'Please confirm password.';     

    } else{

        $confirm_password = trim($_POST['confirm_password']);

        if($password != $confirm_password){

            $confirm_password_err = 'Password did not match.';

        }

    }

    

    // Check input errors before inserting in database

    if(empty($username_err) && empty($password_err) && empty($confirm_password_err)){

        

        // Prepare an insert statement

        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";

         

        if($stmt = $pdo->prepare($sql)){

            // Bind variables to the prepared statement as parameters

            $stmt->bindParam(':username', $param_username, PDO::PARAM_STR);

            $stmt->bindParam(':password', $param_password, PDO::PARAM_STR);

            

            // Set parameters

            $param_username = $username;

            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash

            

            // Attempt to execute the prepared statement

            if($stmt->execute()){

                // Redirect to login page

                header("location: register_successfull.php");

            } else{

                echo "Oops! Något gick fel. Vänta en liten stund eller rapportera detta till en webmaster. [Kod: r2]";

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
  <br><h2>Registrera</h2><br>

  <div class="alert alert-danger">
  <strong>Viktigt!</strong><br>
  Kom ihåg att använda ett unikt lösenord för att hemsidan är hemmagjord. Även fast vi har haft databas säkerhet i åtanke under skapandet av hemsidan så kan vi <strong>inte garantera</strong> att det är omöjligt
  för obehöriga att komma åt din konto information och om det skulle hända så är vi inte ansvariga för eventuella konsekvenser vid en eventuell databas läcka.
  </div>
  <br>

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
    <p>Redan registrerad? <a href="register.php">Logga in här</a>!</p>
  </form>
</div>

</body>
</html>
