<?php

define('STB_DIR', __DIR__ . '/data/');


function save($user, $pl) {
	$pl = parsePayload($pl);
	$file = getFile($user);

	if(!file_put_contents($file, json_encode($pl), LOCK_EX)) {
		throw new Exception("Unable to persist file for user " . $user);
	}
}

function listFiles() {
	$p = getSubpath();
	$data = array();

	foreach(glob($p . '*.json') as $file) {
		$userData = json_decode(file_get_contents($file), true) ? : array();
		$filename = basename($file);
		$user = str_replace('.json', '', $filename);

		$data[$user] = $userData;
	}

	return $data;
}

function getFile($user) {
	return getSubpath() . $user . '.json';
}

function getSubpath() {
	$p = STB_DIR . date('d-m-Y') . '/';

	if(!is_dir($p)) {
		mkdir($p, 0755);
	}

	return $p;
}

function parsePayload($pl) {
	$pl = explode(',', $pl);

	foreach($pl as $k => $v) {
		$pl[$k] = trim($v);
	}

	return $pl;
}
