<?php

require __DIR__ . '/helpers.php';

verify_cli();

echo "\n";

switch($command = strtoupper(@$argv[1] ? : "NONE")) {
	case 'REMIND':
		if (!text("It's time to make this important decision... (type `/eat ...` in any of your chat winows)")) { echo "\n\n"; exit(1); }
		echo "\n";
		break;
	case 'LINK':
		if (!text("<" . BASE_URL . "lunch.php|Click here> for todays lunch list...")) { echo "\n\n"; exit(1); }
		echo "\n";
		break;
	default:
		echo "Unknown command: " . $command . "\n\n";
		exit(1);
}

echo "OK\n\n";
exit(0);
