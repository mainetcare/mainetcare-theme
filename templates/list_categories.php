<?php
$taxonomy = $list_category_atts['cat'] ?? 'category';

$alle = [
  'category' => get_post_type_archive_link( 'post' ),
//  'essen_category' => get_post_type_archive_link( 'rezept' ),
//  'wissen_category' => get_post_type_archive_link( 'wissen' ),
];
$is_archive_active = function($taxonomy) {
    $mapper = [
        'category' => is_home(),
//        'essen_category' => is_post_type_archive( 'rezept' ),
//        'wissen_category' => is_post_type_archive( 'wissen' ),
    ];
    return $mapper[$taxonomy];
};
$list = get_terms( [
	'taxonomy'   => $taxonomy ,
	'hide_empty' => true,
] );
$is_term_active = function($taxonomy, WP_Term $term) {
    if($taxonomy == 'category') {
        return is_category($term);
    }
    return is_tax($taxonomy, $term);
}
?>

<ul class="mnc-list-categories">
	<?php $class = ( $is_archive_active($taxonomy) ) ? 'active' : '';  ?>
    <li><a class="<?= $class ?>" href="<?= $alle[$taxonomy] ?>" title="Alle Beiträge anzeigen">Alle</a></li>
	<?php foreach($list as $term): ?>
    <?php $class = ( $is_term_active( $taxonomy, $term ) ) ? 'active' : '';  ?>
	<li><a class="<?= $class ?>" href="<?= get_term_link($term) ?>" title="Alle Beiträge aus der Kategorie '<?= $term->name ?>' anzeigen"><?= $term->name ?></a></li>
	<?php endforeach; ?>
</ul>