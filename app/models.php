<?php defined('BASE_PATH') or exit('No direct script access allowed.');

function get_auctions() {
	$sql = "SELECT a.*, COUNT(ab.id) AS num_bids, MAX(ab.amount) AS current_bid\n";
	$sql .= "FROM auctions AS a\n";
	$sql .= "LEFT JOIN auction_bids AS ab ON ab.auction_id = a.id\n";
	$sql .= "GROUP BY a.id\n";
	$sql .= "ORDER BY a.date_created DESC";

	$query = query($sql);

	return result($query);
}

function get_auction($auction_id) {
	$sql = "SELECT a.*, COUNT(ab.id) AS num_bids, MAX(ab.amount) AS current_bid\n";
	$sql .= "FROM auctions AS a\n";
	$sql .= "LEFT JOIN auction_bids AS ab ON ab.auction_id = a.id\n";
	$sql .= "WHERE a.id = ?\n";
	$sql .= "GROUP BY a.id\n";
	$sql .= "LIMIT 1";

	$query = query($sql, array($auction_id));

	return row($query);
}

function add_auction($title, $description, $reserve = null) {
	$sql = "INSERT INTO auctions (title, description, reserve, date_created)\n";
	$sql .= "VALUES (:title, :description, :reserve, :date_created)";

	$params = array(
		':title' => $title,
		':description' => $description,
		':reserve' => $reserve,
		':date_created' => date('Y-m-d H:i:s')
	);

	if (query($sql, $params))
		return insert_id();

	return false;
}

function get_auction_bids($auction_id) {
	$sql = "SELECT ab.*\n";
	$sql .= "FROM auction_bids AS ab\n";
	$sql .= "JOIN auctions AS a ON a.id = ab.auction_id\n";
	$sql .= "WHERE a.id = ?\n";
	$sql .= "ORDER BY ab.amount DESC";

	$query = query($sql, array($auction_id));

	return result($query);
}

function add_auction_bid($auction_id, $name, $amount) {
	$sql = "INSERT INTO auction_bids (auction_id, name, amount, date_created)\n";
	$sql .= "VALUES (:auction_id, :name, :amount, :date_created)";

	$params = array(
		':auction_id' => $auction_id,
		':name' => $name,
		':amount' => $amount,
		':date_created' => date('Y-m-d H:i:s')
	);

	if (query($sql, $params))
		return insert_id();

	return false;
}
