<?php render('header.php'); ?>

<ul class="breadcrumb">
	<li><a href="<?php echo config('site_url'); ?>">Home</a> <span class="divider">&rang;</span></li>
	<li class="active"><?php echo $auction->title; ?></li>
</ul>

<div class="page-header">
	<h1><?php echo $auction->title; ?></h1>
</div>

<h4>Reserve Price</h4>
<p>$<?php echo number_format($auction->reserve, 2); ?></p>
<h4>Current Bid</h4>
<p>$<?php echo number_format($auction->current_bid, 2); ?></p>

<p><?php echo $auction->description; ?></p>

<h2>Bid History</h2>

<table class="table">
	<thead>
		<tr>
			<th>Name</th>
			<th>Date</th>
			<th>Amount</th>
		</tr>
	</thead>
	<tbody>

	<?php foreach ($auction_bids as $bid): ?>

		<tr>
			<td><?php echo $bid->name; ?></td>
			<td><?php echo date('F j, g:i a', strtotime($bid->date_created)); ?></td>
			<td>$<?php echo number_format($bid->amount, 2); ?></td>
		</tr>

	<?php endforeach; ?>

	</tbody>
</table>

<form method="post" class="form-horizontal">
	<fieldset>
    	<legend>Add Bid</legend>
	    <div class="control-group">
	        <label class="control-label">Name</label>
	        <div class="controls">
	        	<input type="text" name="name" class="input-medium">
	        </div>
	    </div>
	    <div class="control-group">
	        <label class="control-label">Amount</label>
	        <div class="controls">
	        	<div class="input-prepend">
	        		<?php $min_bid = intval($auction->current_bid + 1); ?>
                	<span class="add-on">$</span><input type="number" name="amount" value="<?php echo $min_bid; ?>" min="<?php echo $min_bid; ?>" class="input-small">
                </div>
	        </div>
	    </div>
	    <div class="form-actions">
			<button type="submit" class="btn btn-large btn-primary" onclick="return confirm('Are you sure?');"><i class="icon-plus icon-white"></i> Add Bid</button>
		</div>
	</fieldset>
</form>

<?php render('footer.php'); ?>