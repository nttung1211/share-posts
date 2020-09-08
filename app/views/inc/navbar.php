<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="<?php echo URLROOT ?>"><?php echo strtoupper(SITENAME); ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <?php  ?>
        <li class="nav-item <?php if (!isset($currentPage)) echo 'active'; ?>">
          <a class="nav-link" href="<?php echo URLROOT ?>">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT ?>/pages/about">About</a>
        </li>
	      <?php if (isset($_SESSION['user_id'])) { ?>
	      <li class="nav-item">
		      <a class="nav-link" href="<?php echo URLROOT ?>/posts">My Posts</a>
	      </li>
	      <li class="nav-item dropdown">
		      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			      <?php echo getLoginInfo()['username']; ?>
		      </a>
		      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
			      <a class="dropdown-item" href="<?php echo URLROOT ?>/users/logout">Logout</a>
		      </div>
	      </li>
	      <?php } else { ?>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT ?>/users/register">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo URLROOT ?>/users/login">Login</a>
        </li>
	      <?php } ?>
      </ul>
    </div>
  </div>
</nav>