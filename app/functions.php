<?php defined('BASE_PATH') or exit('No direct script access allowed.');

function error($code = 500, $message = 'Internal Server Error') {
	if (PHP_SAPI !== 'cli')
		@header("HTTP/1.0 {$code} {$message}", true, $code);

    die("Error {$code}: {$message}\n");
}

function config($key, $value = null) {
	static $config = array();

	if (is_file($key))
		$config = require $key;
	elseif ($value === null)
		return isset($config[$key]) ? $config[$key] : null;

	$config[$key] = $value;
}

function uri() {
	$uri = $_SERVER['REQUEST_URI'];
    
    if (strpos($uri, $_SERVER['SCRIPT_NAME']) !== FALSE)
        $uri = substr($uri, strlen($_SERVER['SCRIPT_NAME']));
    elseif (strpos($uri, dirname($_SERVER['SCRIPT_NAME'])) !== FALSE)
    	$uri = substr($uri, strlen(dirname($_SERVER['SCRIPT_NAME'])));

    if (strpos($uri, '/') !== 0)
		$uri = '/' . $uri;
    
    $uri = parse_url($uri, PHP_URL_PATH);
    
    return $uri;
}

function url($string) {
	return urlencode($string);
}

function html($string, $charset = 'UTF-8', $flags = ENT_QUOTES) {
	return htmlentities($string, $flags, $charset, false);
}

function from($array, $key) {
	if (is_array($key)) {
		foreach ($key as $_key)
			$data[$_key] = isset($array[$_key]) ? $array[$_key] : null;

		return $data;
	}

	return isset($array[$key]) ? $array[$key] : null;
}

function stash($key, $value = null) {
	static $stash = array();

	if ($value === null)
		return isset($stash[$key]) ? $stash[$key] : null;

	$stash[$key] = $value;

	return $value;
}

function method($method = null) {
	if (empty($method) || strtoupper($method) === strtoupper($_SERVER['REQUEST_METHOD']))
		return strtoupper($_SERVER['REQUEST_METHOD']);

	error(400, 'Bad Request');
}

function current_url() {
	return config('site_url') . uri();
}

function redirect($url = null, $code = 302) {
	if (empty($url))
		$url = current_url();

	header("Location: {$url}", true, $code);
	exit;
}

function render($view, $data = null) {
	if (is_array($data) && count($data))
		extract($data, EXTR_SKIP);

	$view_path = config('views');
	$view_file = (empty($view_path) ? BASE_PATH : $view_path) . DIRECTORY_SEPARATOR . $view;

	if (file_exists($view_file)) {
		ob_start();
  		require $view_file;
		echo ob_get_clean();
	} else {
		error(500, "The view file '{$view}' could not be found.");
	}
}

function database() {
	static $connection;

	if ( ! $connection instanceof PDO)
		$connection = new PDO(config('pdo_dsn'), config('pdo_username'), config('pdo_password'));

	return $connection;
}

function query($query, array $params = null) {
	$query = database()->prepare($query);

	if (is_array($params) && count($params)) {
		foreach ($params as $key => $value) {
			$param = is_int($key) ? ($key + 1) : $key;

			if (is_int($value))
				$type = PDO::PARAM_INT;
			elseif (is_bool($value))
				$type = PDO::PARAM_BOOL;
			elseif (is_null($value))
				$type = PDO::PARAM_NULL;
			else
				$type = PDO::PARAM_STR;

			$query->bindParam($param, $params[$key], $type);
		}
	}

	if ($query->execute())
		return $query;
	else
		return false;
}

function row($query) {
	return $query->fetch(PDO::FETCH_OBJ);
}

function result($query) {
	return $query->fetchAll(PDO::FETCH_OBJ);
}

function insert_id() {
	return database()->lastInsertId();
}

function num_rows($query) {
	return $query->rowCount();
}

function route($method, $pattern, $callback = null) {
	static $routes = array();

	$method = strtoupper($method);

	if (in_array($method, array('GET', 'POST', 'PUT', 'DELETE'))) {
		if ($callback !== null) {
			$routes[$method]["@^{$pattern}$@i"] = $callback;
		} else {
			foreach ($routes[$method] as $_pattern => $_callback) {
				if (preg_match($_pattern, $pattern, $params)) {
					array_shift($params);

					if (is_callable($_callback))
						return call_user_func_array($_callback, $params);
				}
			}

			error(404, 'Not Found');
		}
	} else {
		error(500, "Request method '{$method}' not supported.");
	}
}

function get($pattern, $callback) {
	route('GET', $pattern, $callback);
}

function post($pattern, $callback) {
	route('POST', $pattern, $callback);
}

function run($uri = null, $method = null) {
	if (empty($uri))
		$uri = uri();

	route(method($method), $uri);
}
