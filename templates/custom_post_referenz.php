<?php
global $post;
?>
<a href="<?= get_field('refurl') ?>" title="Klick, um Website in einem neuem Tab/Fenster anzuschauen" target="_blank">
<article class="mnc-custom-post-referenz">
    <div class="mnc-post-image-referenz">
		<?= get_the_post_thumbnail( $post, 'large' ); ?>
    </div>
    <div class="mnc-post-excerpt-referenz">
		<?= get_the_excerpt( $post ); ?>
    </div>
</article>
</a>