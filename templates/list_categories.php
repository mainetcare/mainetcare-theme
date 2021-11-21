<?php
$taxonomy_key   = $list_category_atts['cat'] ?? 'category';

$alle              = [
	'category'    => get_post_type_archive_link( 'post' ),
	'techdoc_kat' => get_post_type_archive_link( 'techdoc' ),
];

$is_archive_active = function ( $taxonomy ) {
	$mapper = [
		'category'    => is_home(),
		'techdoc_kat' => is_post_type_archive( 'techdoc' ),
	];

	return $mapper[ $taxonomy ];
};

$list           = get_terms( [
	'taxonomy'   => $taxonomy_key,
	'hide_empty' => true,
] );
if($list instanceof WP_Error) {
    $list = [];
}

$is_term_active = function ( $taxonomy, WP_Term $term ) {
	if ( $taxonomy === 'category' ) {
		return is_category( $term );
	}
	return is_tax( $taxonomy, $term );
}
?>

<ul class="mnc-list-categories">
	<?php $class = ( $is_archive_active( $taxonomy_key ) ) ? 'active' : ''; ?>
    <li><a class="<?= $class ?>" href="<?= $alle[ $taxonomy_key ] ?>" title="Alle Beiträge anzeigen">Alle</a></li>
	<?php foreach ( $list as $term ): ?>
		<?php $class = ( $is_term_active( $taxonomy_key, $term ) ) ? 'active' : ''; ?>
        <li><a class="<?= $class ?>" href="<?= get_term_link( $term ) ?>"
               title="Alle Beiträge aus der Kategorie '<?= $term->name ?>' anzeigen"><?= $term->name ?></a></li>
	<?php endforeach; ?>
</ul>