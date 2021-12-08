<!--Navbar -->

<nav class="navbar navbar-expand-lg navbar-light shadow-sm bg-white rounded">
  <div class="container-fluid">

    <a class="navbar-brand" href="dashboard.php">
      <img class="logo" src='images/logo.png' alt='not found'/>
  </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        
      <li class="nav-item">
        <a class="nav-link" href="dashboard.php"><?php echo lang('HOME_ADMIN')?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="categories.php"><?php echo lang('CATEGORIES')?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="items.php"><?php echo lang('ITEMES')?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="members.php"><?php echo lang('MEMBERS')?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><?php echo lang('STATICTICS')?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><?php echo lang('LOGS')?></a>
      </li>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Account
          </a>
          <ul class="dropdown-menu shadow mb-2" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="members.php?do=Edit&userid=<?php echo $_SESSION['ID']?>">Edit Profile</a></li>
            <li><a class="dropdown-item" href="#">Setting</a></li>
            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
          </ul>
        </li>
      </ul>
      
    </div>
  </div>
</nav>
