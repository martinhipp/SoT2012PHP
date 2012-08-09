<?php render('header.php'); ?>

<ul class="breadcrumb">
	<li><a href="<?php echo config('site_url'); ?>">Home</a> <span class="divider">&rang;</span></li>
	<li class="active">Add Auction</li>
</ul>

<div class="page-header">
	<h1>Add Auction</h1>
</div>

<form method="post" class="form-horizontal">
    <div class="control-group">
        <label class="control-label">Name</label>
        <div class="controls">
        	<input type="text" name="title" class="input-large">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Description</label>
        <div class="controls">
        	<textarea name="description" rows="3" class="input-xlarge"></textarea>
        </div>
    </div>
    <div class="control-group">
        <label class="control-label">Reserve</label>
        <div class="controls">
        	<div class="input-prepend">
            	<span class="add-on">$</span><input type="text" name="reserve" placeholder="0.00" class="input-small">
            </div>
        </div>
    </div>
    <div class="form-actions">
		<button type="submit" class="btn btn-large btn-primary"><i class="icon-ok icon-white"></i> Save</button>
		<a href="<?php echo config('site_url'); ?>" class="btn btn-large" onclick="return confirm('Are you sure?');"><i class="icon-remove"></i> Cancel</a>
	</div>
</form>

<?php render('footer.php'); ?>