<?php require_once APPROOT . '/views/inc/header.php'; ?>

<?php showPopUp('loginMessage'); ?>

<form action="<?php echo URLROOT . '/users/login'; ?>" method="post">
  <div class="form-group">
    <label for="username">username: </label>
    <input id="username" type="text"
           class="form-control form-control-lg <?php echo isset($data['errors']['username']) ? 'is-invalid' : ''; ?>"
           name="username" value="<?php echo $data['enteredData']['username'] ?? ''; ?>">
    <div class="invalid-feedback">
			<?php echo $data['errors']['username'] ?? ''; ?>
    </div>
  </div>

  <div class="form-group">
    <label for="password">password: </label>
    <input id="password" type="password"
           class="form-control form-control-lg <?php echo isset($data['errors']['password']) ? 'is-invalid' : ''; ?>"
           name="password" value="<?php echo $data['enteredData']['password'] ?? ''; ?>">
    <div class="invalid-feedback">
			<?php echo $data['errors']['password'] ?? ''; ?>
    </div>
  </div>

	<button class='btn btn-primary'>Login</button>
</form>


<?php require_once APPROOT . '/views/inc/footer.php'; ?>
