<?php
$arrMap = [
	'aus Kategorie' => 'aus der Kategorie',
	'aus Jahr:'     => 'aus dem Jahr'
];
$mnc_title = 'Beiträge aus ' . get_the_archive_title();
$mnc_title = str_replace(array_keys($arrMap), array_values($arrMap), $mnc_title);
$desc = get_the_archive_description();
?>
<?php if ( is_home() ): ?>
<?php elseif ( is_archive() ): get_the_archive_title() ?>
    <p class="mnc-subtitle"><?= $mnc_title ?></p>
<?php endif; ?>
<?php if ($desc): ?>
    <p class="mnc-archive-description"><?= $desc ?></p>
<?php endif; ?>

