<?php render('header.php'); ?>

<ul class="breadcrumb">
	<li class="active">Home</li>
</ul>

<div class="page-header clearfix">
	<h1 class="pull-left">Auctions</h1>
	<a href="<?php echo config('site_url'); ?>/auction/new" class="btn btn-large btn-primary pull-right"><i class="icon-plus icon-white"></i> Add Auction</a>
</div>

<table class="table">
	<thead>
		<tr>
			<th>Title</th>
			<th>Description</th>
			<th>Date</th>
			<th>Reserve</th>
			<th>Bids</th>
			<th>Current Bid</th>
		</tr>
	</thead>
	<tbody>

	<?php foreach ($auctions as $auction): ?>

		<tr>
			<td><a href="<?php echo config('site_url'); ?>/auction/<?php echo $auction->id; ?>"><?php echo $auction->title; ?></a></td>
			<td><?php echo $auction->description; ?></td>
			<td><?php echo date('F j, g:i a', strtotime($auction->date_created)); ?></td>
			<td>$<?php echo number_format($auction->reserve, 2); ?></td>
			<td><?php echo ($auction->num_bids > 0) ? $auction->num_bids : 'No Bids'; ?></td>
			<td>$<?php echo number_format($auction->current_bid, 2); ?></td>
		</tr>

	<?php endforeach; ?>

	</tbody>
</table>

<?php render('footer.php'); ?>