<?php
require __DIR__ . '/storage.php';
require __DIR__ . '/helpers.php';

$user = isset($_REQUEST['user_name']) ? $_REQUEST['user_name'] : null;
$token = isset($_REQUEST['token']) ? $_REQUEST['token'] : null;
$command = isset($_REQUEST['command']) ? strtolower($_REQUEST['command']) : null;
$payload = isset($_REQUEST['text']) ? trim($_REQUEST['text']) : null;

if($command !== COMM) {
	exit("ERROR! Wrong command " . $command);
} elseif($token !== TOKEN) {
	exit("ERROR! Wrong token provided");
} elseif(empty($payload)) {
	exit('Empty request! Type `--help` for command info...');
} elseif(empty($user)) {
	exit("ERROR! No user provided");
}

try {
	$p = str_replace('—', '--', strtolower(trim($payload)));
	if ($p == '--help') {
		exit('Options: `--link`, `--list`, `--help`');
	} elseif($p == '--list') {
		$users = array_map(function($user){ return ucfirst($user); }, array_keys(listFiles()));
		exit('Users going to take the lunch today: ' . implode(', ', $users));
	} elseif($p == '--link') {
		exit('<' . BASE_URL . 'lunch.php|Click here> for todays lunch list...');
	}

	save($user, $payload);
} catch(\Exception $e) {
	exit("ERROR! " . $e->getMessage());
}

exit("Thank You for using " . DEF_NAME  . ". Your request was added.");
