<?php require_once APPROOT . '/views/inc/header.php'; ?>

<?php showPopUp('postMessage'); ?>

<a class='btn btn-success' href='<?php echo URLROOT . '/posts/add'; ?>'>Add post</a>
<?php foreach ($data['posts'] as $post) { ?>
	<h2><?php echo $post->title ?></h2>
	<a class='btn btn-primary' href='<?php echo URLROOT . '/posts/detail/' . $post->id; ?>'>See detail</a>
<?php } ?>

<?php require_once APPROOT . '/views/inc/footer.php'; ?>
