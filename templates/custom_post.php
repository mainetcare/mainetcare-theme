<?php
global $post;
?>
<article class="mnc-custom-post">

    <div class="mnc-scale-img-hover">
			<?= get_the_post_thumbnail( $post, 'large' ); ?>
    </div>

    <div class="mnc-cp-content">

        <div class="mnc-terms">
            <?php if($post->post_type === 'post'): ?>
            [wpbb post:terms_list taxonomy='category' separator=' ' linked='yes']
            <?php elseif ($post->post_type === 'newsletter'): ?>
            [wpbb post:terms_list taxonomy='newsletter_category' separator=' ' linked='yes']
            <?php else: ?>
            [wpbb post:terms_list taxonomy='essen_category' separator=' ' linked='yes']
            <?php endif; ?>
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


</article>
