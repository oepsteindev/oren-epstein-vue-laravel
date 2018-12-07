<?php defined('SYSPATH') OR die('No direct access allowed.');

return array(

	'driver'       => 'ORM',
	'hash_method'  => 'sha256',
	'hash_key'     => "88E9A44D41A087B394B89AF6BF379FB1CDBDD3C5BB032D5D4F2C795B90BE6AAF",
	'lifetime'     => Date::MINUTE * 120,
	'session_type' => Session::$default,
	'session_key'  => 'auth_user',
	'login_with_username'   => TRUE,


	// Username/password combinations for the Auth File driver
	'users' => array(
		 //'finespun1@gmail.com' => 'cd7b4a971fd6c72f02c15fe9af16f6b9cd8266bb074ad7194899a6ce87f7f6b0',
	),

);
