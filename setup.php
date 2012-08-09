<?php

require 'init.php';

$sql = 'DROP TABLE IF EXISTS auctions';

echo "<strong>Executing Query:</strong>\n<br>\n<pre>{$sql}</pre>\n";

if (query($sql))
	echo "<strong style=\"color: #390\">Success</strong>\n";
else
	die("<strong style=\"color: #c00\">Failed</strong>\n");

echo "<br><br>\n";

$sql = "CREATE TABLE auctions (\n";
$sql .= "\tid int(10) unsigned NOT NULL AUTO_INCREMENT,\n";
$sql .= "\ttitle varchar(50) NOT NULL,\n";
$sql .= "\tdescription text,\n";
$sql .= "\treserve decimal(10,2) NOT NULL,\n";
$sql .= "\tdate_created datetime NOT NULL,\n";
$sql .= "\tPRIMARY KEY (id)\n";
$sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";

echo "<strong>Executing Query:</strong>\n<br>\n<pre>{$sql}</pre>\n";

if (query($sql))
	echo "<strong style=\"color: #390\">Success</strong>\n";
else
	die("<strong style=\"color: #c00\">Failed</strong>\n");

echo "<br><br>\n";

$sql = "INSERT INTO auctions (id, title, description, reserve, date_created)\n";
$sql .= "VALUES\n";
$sql .= "\t(1, 'Time Machine', 'A device used to travel through time and space.', 500.00, '2012-08-06 09:36:24'),\n";
$sql .= "\t(2, 'Flux Capacitor', 'Goes perfect with a time machine.', 500.00, '2012-08-06 10:43:15'),\n";
$sql .= "\t(3, 'Darth Maul\'s Lightsaber', 'Maul\'s red-colored double-bladed lightsaber.', 2000.00, '2012-08-06 14:13:53')";

echo "<strong>Executing Query:</strong>\n<br>\n<pre>{$sql}</pre>\n";

if (query($sql))
	echo "<strong style=\"color: #390\">Success</strong>\n";
else
	die("<strong style=\"color: #c00\">Failed</strong>\n");

echo "<br><br>\n";

$sql = 'DROP TABLE IF EXISTS auction_bids';

echo "<strong>Executing Query:</strong>\n<br>\n<pre>{$sql}</pre>\n";

if (query($sql))
	echo "<strong style=\"color: #390\">Success</strong>\n";
else
	die("<strong style=\"color: #c00\">Failed</strong>\n");

echo "<br><br>\n";

$sql = "CREATE TABLE auction_bids (\n";
$sql .= "\tid int(10) unsigned NOT NULL AUTO_INCREMENT,\n";
$sql .= "\tauction_id int(10) unsigned NOT NULL,\n";
$sql .= "\tname varchar(50) NOT NULL,\n";
$sql .= "\tamount decimal(10,2) NOT NULL,\n";
$sql .= "\tdate_created datetime NOT NULL,\n";
$sql .= "\tPRIMARY KEY (id)\n";
$sql .= ") ENGINE=InnoDB DEFAULT CHARSET=utf8";

echo "<strong>Executing Query:</strong>\n<br>\n<pre>{$sql}</pre>\n";

if (query($sql))
	echo "<strong style=\"color: #390\">Success</strong>\n";
else
	die("<strong style=\"color: #c00\">Failed</strong>\n");

echo "<br><br>\n";

$sql = "INSERT INTO auction_bids (id, auction_id, name, amount, date_created)\n";
$sql .= "VALUES\n";
$sql .= "\t(1, 1, 'Martin', 100.00, '2012-08-06 10:12:35'),\n";
$sql .= "\t(2, 1, 'Peter',  150.00, '2012-08-06 10:51:12'),\n";
$sql .= "\t(3, 2, 'Martin', 300.00, '2012-08-06 11:25:41'),\n";
$sql .= "\t(4, 1, 'John', 300.00, '2012-08-06 13:51:26'),\n";
$sql .= "\t(5, 3, 'John', 1000.00, '2012-08-06 14:16:10')";

echo "<strong>Executing Query:</strong>\n<br>\n<pre>{$sql}</pre>\n";

if (query($sql))
	echo "<strong style=\"color: #390\">Success</strong>\n";
else
	die("<strong style=\"color: #c00\">Failed</strong>\n");

exit;
