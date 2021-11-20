<?php
global $post;
?>
<article class="mnc-custom-post">

    <div class="mnc-post-image">
		<?= get_the_post_thumbnail( $post, 'large' ); ?>
    </div>

    <div class="mnc-post-terms">
		<?php if ( $post->post_type === 'post' ): ?>
            [wpbb post:terms_list taxonomy='category' separator=' ' linked='yes']
		<?php elseif ( $post->post_type === 'wissen' ): ?>
            [wpbb post:terms_list taxonomy='wissen_category' separator=' ' linked='yes']
		<?php else: ?>
            [wpbb post:terms_list taxonomy='essen_category' separator=' ' linked='yes']
		<?php endif; ?>
    </div>

    <div class="mnc-post-title">
        <a href="<?= get_permalink( $post->ID ) ?>" title="Mehr lesen für <?= get_the_title( $post->ID ) ?>">
            <h3 class="uppercase"><?= get_the_title(); ?></h3>
        </a>
    </div>

    <div class="mnc-post-excerpt">
		<?= get_the_excerpt( $post ); ?><a class="more" href="<?= get_permalink( $post->ID ) ?>"
                                           title="Mehr lesen lesen für <?= get_the_title( $post->ID ) ?>">Lesen</a>
    </div>


</article>
