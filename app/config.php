<?php defined('BASE_PATH') or exit('No direct script access allowed.');

return array(
	// URL
	'base_url' => 'http://localhost/SoT2012PHP',
	'site_url' => 'http://localhost/SoT2012PHP/index.php',

	// Views
	'views' => BASE_PATH . '/app/views',

	// Database (PDO)
	'pdo_dsn' => 'mysql:host=localhost;dbname=bidme_test',
	'pdo_username' => 'root',
	'pdo_password' => 'root'
);
