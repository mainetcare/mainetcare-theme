<?php
global $post;
?>
<article class="mnc-post-item">

    <div class="mnc-featured-img">
			<?= get_the_post_thumbnail( $post, 'large' ); ?>
    </div>

    <div class="mnc-cp-content">

        <div class="mnc-title">
            <a href="<?= get_permalink( $post->ID ) ?>" title="Kompletten Artikel '<?= get_the_title( $post->ID ) ?>' lesen">
                <h3 class="uppercase"><?= get_the_title(); ?></h3>
            </a>
        </div>

        <div class="mnc-excerpt">
            <?= get_the_excerpt($post); ?><a class="more" href="<?= get_permalink( $post->ID ) ?>" title="Kompletten lesen für <?= get_the_title( $post->ID ) ?>">Lesen</a>
        </div>
    </div>


</article>
