<?php

define('BASE_PATH', realpath(dirname(__FILE__)));

error_reporting(E_ALL);

require BASE_PATH . '/app/functions.php';

config(BASE_PATH . '/app/config.php');
