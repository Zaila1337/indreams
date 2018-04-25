 <nav class="navbar navbar-expand-sm bg-dark navbar-dark">

  <!-- Links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" href="index.php">Nyheter</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="roster.php">Raid Grupp</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="progress.php">Progress</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="apply.php">Ansök</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="forum.php">Forum</a>
    </li>
  </ul>
  <ul class="navbar-nav ml-auto">
    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <?php 
        if(!isset($_SESSION["username"])){ echo 'Konto'; }
        else echo $_SESSION["username"];
      ?>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        
        <?php if(!isset($_SESSION["username"])){ ?>
          <?php /* Inte inloggad, måste logga in eller registrera */  ?>
          <a class="dropdown-item" href="login.php">Logga in</a>
          <a class="dropdown-item" href="register.php">Registrera</a>
        <?php }
        else
        {?>
          <?php /* Inloggad, lägg till sidor här för dom som är inloggad */  ?>
          <a class="dropdown-item" href="#">Mina Inställningar</a>
          <?php if($_SESSION["admin"] > 0) { ?> <a class="dropdown-item" href="admin_index.php">Admin</a> <?php } ?>
          <a class="dropdown-item" href="logout.php">Logga ut</a>

        <?php }  ?>

      </div>
    </li>
  </ul>
</nav> 