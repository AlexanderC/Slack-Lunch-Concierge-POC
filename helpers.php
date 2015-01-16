<?php

define('BASE_URL', "http://slack.example.com/");
define('HOOK_URL', "https://hooks.slack.com/services/kjnergre/egrerger/D5Va6KxknTT0esrmqDxk54NA");
define('TOKEN', "wergowierh7owijerpohijw");
define('COMM', "/eat");

define('DEF_ICON', BASE_URL . "assets/lunch.png");
define('DEF_NAME', "Lunch Concierge");

function text($msg, $name=DEF_NAME, $icon=DEF_ICON) {
	$payload = array(
		'username' => $name,
		'text' => $msg,
		'icon_url' => $icon
	);

	$data_string = json_encode($payload);

	$ch = curl_init();

	curl_setopt($ch, CURLOPT_URL, HOOK_URL);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    		'Content-Type: application/json',
    		'Content-Length: ' . strlen($data_string))
	);

	$result = curl_exec($ch);

	curl_close($ch);

	return $result <= 0;
}

function verify_cli() {
        $uri = '/' . ltrim(@$_SERVER['REQUEST_URI'] ? : '', '/');

        $_404 = <<<EOF
<!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
<html><head>
<title>404 Not Found</title>
</head><body>
<h1>Not Found</h1>
<p>The requested URL %s was not found on this server.</p>
</body></html>
EOF;

        if(strtolower(php_sapi_name()) !== 'cli') { 
                exit(sprintf($_404, $uri));
        }
}
