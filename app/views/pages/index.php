<?php require_once APPROOT . '/views/inc/header.php' ?>

<?php

/** @var array $data */
foreach ($data['posts'] as $post) {
  echo "
    <h2>$post->title</h2>
    <p>$post->body</p>
  ";
}

?>

<?php require_once APPROOT . '/views/inc/footer.php' ?>
