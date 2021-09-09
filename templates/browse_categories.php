<?php
global $post;
$list = get_terms( array( 'taxonomy' => 'category',
	'hide_empty' => true,
) );
?>

<ul class="mnc-list-categories">
	<?php foreach($list as $term): ?>
	<li><a href="<?= get_term_link($term) ?>" title="Alle Beiträge aus der Kategorie '<?= $term->name ?>' anzeigen"><?= $term->name ?></a></li>
	<?php endforeach; ?>
</ul>

