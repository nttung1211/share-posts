<?php require_once APPROOT . '/views/inc/header.php'; ?>

<form action="<?php echo URLROOT . '/users/register'; ?>" method="post">
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

  <div class="form-group">
    <label for="confirmPassword">confirmPassword: </label>
    <input id="confirmPassword" type="password"
           class="form-control form-control-lg <?php echo isset($data['errors']['confirmPassword']) ? 'is-invalid' : ''; ?>"
           name="confirmPassword" value="<?php echo $data['enteredData']['confirmPassword'] ?? ''; ?>">
    <div class="invalid-feedback">
			<?php echo $data['errors']['confirmPassword'] ?? ''; ?>
    </div>
  </div>

  <div class="form-group">
    <label for="email">email: </label>
    <input id="email" type="text"
           class="form-control form-control-lg <?php echo isset($data['errors']['email']) ? 'is-invalid' : ''; ?>"
           name="email" value="<?php echo $data['enteredData']['email'] ?? ''; ?>">
    <div class="invalid-feedback">
			<?php echo $data['errors']['email'] ?? ''; ?>
    </div>
  </div>

  <button class="btn btn-primary">Submit</button>
</form>


<?php require_once APPROOT . '/views/inc/footer.php'; ?>
