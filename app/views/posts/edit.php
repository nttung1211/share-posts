<?php require_once APPROOT . '/views/inc/header.php'; ?>

<form action="<?php echo URLROOT . '/posts/edit/' . $data['id']; ?>" method="post">
	<div class="form-group">
		<label for="title">title: </label>
		<input id="title" type="text"
		       class="form-control form-control-lg <?php echo isset($data['errors']['title']) ? 'is-invalid' : ''; ?>"
		       name="title" value="<?php echo $data['enteredData']['title'] ?? $data['oldPost']->title; ?>">
		<div class="invalid-feedback">
			<?php echo $data['errors']['title'] ?? ''; ?>
		</div>
	</div>

	<div class="form-group">
		<label for="body">body: </label>
		<textarea id="body"
		          class="form-control form-control-lg <?php echo isset($data['errors']['body']) ? 'is-invalid' : ''; ?>"
		          name="body"><?php echo $data['enteredData']['body'] ?? $data['oldPost']->body; ?></textarea>
		<div class="invalid-feedback">
			<?php echo $data['errors']['body'] ?? ''; ?>
		</div>
	</div>

	<button class='btn btn-primary'>Save</button>
</form>


<?php require_once APPROOT . '/views/inc/footer.php'; ?>
