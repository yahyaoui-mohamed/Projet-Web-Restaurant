<nav class="navbar navbar-expand-lg bg-transparent">
  <div class="container">
    <a class="navbar-brand" href="./">Restaurant <span>.</span></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav m-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="./">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menu.php">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="reserver.php">Reserver</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contact.php">Contact</a>
        </li>
      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a href=<?php if (isset($_SESSION["admin"])) echo "admin.php";
                  else if (isset($_SESSION["user"])) echo "account.php";
                  else echo "login.php"; ?>>
            <i class="fi fi-rs-user"></i>
          </a>
        </li>
        <li class="nav-item">
          <a href="cart.php">
            <span class="nav-shop">0</span>
            <i class="fi fi-rs-shopping-cart"></i>
          </a>
        </li>
      </ul>
    </div>

  </div>
</nav>