<?php
global $post;

?>
<article class="mnc-item-top-stories">


    <div class="mnc-item-content">

        <div class="mnc-terms">
            Top-Story, [wpbb post:terms_list taxonomy='category' separator=', ' linked='yes']
        </div>

        <div class="mnc-title">
            <a href="<?= get_permalink( $post->ID ) ?>" title="Kompletten lesen für <?= get_the_title( $post->ID ) ?>">
                <h3 class="uppercase"><?= get_the_title(); ?></h3>
            </a>
        </div>

        <div class="mnc-excerpt">
            <?= get_the_excerpt($post); ?><a class="more" href="<?= get_permalink( $post->ID ) ?>" title="Kompletten lesen für <?= get_the_title( $post->ID ) ?>">Lesen</a>
        </div>
    </div>

    <div>
			<?= get_the_post_thumbnail( $post, 'large' ); ?>
    </div>

</article>
