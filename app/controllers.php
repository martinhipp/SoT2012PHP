<?php defined('BASE_PATH') or exit('No direct script access allowed.');

get('/', 'home');

function home() {
	$data['auctions'] = get_auctions();

	render('home.php', $data);
}

get('/auction/(\d+)', 'auction_view');
post('/auction/(\d+)', 'auction_view');

function auction_view($id) {
	$data['auction'] = get_auction($id);

	if (empty($data['auction']))
		redirect(config('url'));

	if (method() == 'POST') {
		$name   = from($_POST, 'name');
        $amount = from($_POST, 'amount');

        if (add_auction_bid($id, $name, $amount))
			redirect(current_url());
	}

	$data['auction_bids'] = get_auction_bids($id);

	render('auction/view.php', $data);
}

get('/auction/new', 'auction_new');
post('/auction/new', 'auction_new');

function auction_new() {
	if (method() == 'POST') {
		$title       = from($_POST, 'title');
        $description = from($_POST, 'description');
        $reserve     = from($_POST, 'reserve');

        if (add_auction($title, $description, $reserve))
        	redirect(config('site_url') . '/auction/' . insert_id());
	}

	render('auction/new.php');
}
