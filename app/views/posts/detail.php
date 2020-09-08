<?php require_once APPROOT . '/views/inc/header.php'; ?>

<?php showPopup('postDetailMessage'); ?>
<a class='btn btn-success mb-4' href='<?php echo URLROOT . '/posts'; ?>'>Back</a>
<h2><?php echo $data['post']->title; ?></h2>
<p><?php echo $data['post']->body; ?></p>
<a href='<?php echo URLROOT . '/posts/edit/' . $data['post']->id ?>' class='btn btn-primary my-1'>Edit</a>
<form action='<?php echo URLROOT . '/posts/delete/' . $data['post']->id ?>' method='post'>
	<button class='btn btn-danger'>Delete</button>
</form>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>
