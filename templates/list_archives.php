<?php
global $post;
?>
<ul class="mnc-list-categories">
	<?= wp_get_archives( [
		'type'      => 'yearly',
		'order'     => 'DESC',
		'post_type' => 'post'
	], true ); ?>
</ul>



