<?php
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly
}
$search_input_id = 'search-input-' . uniqid();
?>

<form role="search" method="get" class="flex flex-col gap-1" action="<?php echo esc_url(home_url('/')); ?>">
	<label for="<?= $search_input_id; ?>">Maybe try a search?</label>
	<div class="flex gap-2">
		<input type="search" id="<?= $search_input_id; ?>" class="flex-1 border border-stone-400 p-4 bg-white" placeholder="Search..."
					 value="<?php echo get_search_query(); ?>" name="s" />
		<button type="submit" class="bg-primary text-white py-4 px-6 shrink-0 cursor-pointer">Search</button>
	</div>
</form>