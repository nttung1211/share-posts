<?php

function redirectTo(string $page) {
	header('location:' . URLROOT . '/' . $page);
	die();
}

