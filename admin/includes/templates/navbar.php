<!--Navbar -->
<nav class="navbar navbar-expand-lg navbar-light shadow-sm bg-white rounded">
  <a class="navbar-brand" href="#">
    <img class="logo" src='images/logo.png' alt='not found'/>
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="#"><?php echo lang('HOME_ADMIN')?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><?php echo lang('CATEGORIES')?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><?php echo lang('ITEMES')?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><?php echo lang('MEMBERS')?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><?php echo lang('STATICTICS')?></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"><?php echo lang('LOGS')?></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        Account
        </a>
        <div class="dropdown-menu shadow mb-2" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="members.php?do=Edit&userid=<?php echo $_SESSION['ID']?>">Edit Profile</a>
          <a class="dropdown-item" href="#">Setting</a>
          <a class="dropdown-item" href="logout.php">Logout</a>
      </li>
    </ul>

  </div>
</nav>